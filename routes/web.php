<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HongkongController;
use App\Http\Controllers\MalaysiaController;
use App\Http\Controllers\SingaporeController;
use App\Http\Controllers\TaiwanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\File;

//---------------------------------------------------------------- Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('home');

//---------------------------------------------------------------- Auth Redirects
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

Route::post('/logout', function () {
    auth('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//---------------------------------------------------------------- Foto Biodata (Aman dari Path Traversal)
Route::get('/foto/{filename}', function ($filename) {
    // 1. Validasi karakter nama berkas secara ketat
    if (!preg_match('/^[a-zA-Z0-9_\-\.]+$/', $filename) || basename($filename) !== $filename) {
        abort(404);
    }

    $baseDir = realpath(storage_path('app/public/biodata/foto'));
    if (!$baseDir) {
        abort(404);
    }

    $filePath = realpath($baseDir . DIRECTORY_SEPARATOR . $filename);

    // 2. Cegah Directory Traversal (pastikan file berada dalam direktori yang diizinkan)
    if (!$filePath || !str_starts_with($filePath, $baseDir) || !is_file($filePath)) {
        abort(404);
    }

    // 3. Batasi hanya untuk tipe file gambar yang aman
    $mimeType = File::mimeType($filePath);
    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($mimeType, $allowedMimes)) {
        abort(403, 'Tipe file tidak diizinkan.');
    }

    return response()->file($filePath, [
        'Content-Type' => $mimeType,
        'X-Content-Type-Options' => 'nosniff',
    ]);
})->where('filename', '[a-zA-Z0-9_\-\.]+')->name('foto.show');

// Alias untuk kompatibilitas tautan lama ke /biodata/foto/{filename}
Route::get('/biodata/foto/{filename}', function ($filename) {
    return redirect()->route('foto.show', ['filename' => $filename]);
})->where('filename', '[a-zA-Z0-9_\-\.]+')->name('biodata.photo');

//---------------------------------------------------------------- Unduh Dokumen Biodata (Memerlukan Otentikasi)
Route::middleware(['auth'])->group(function () {
    Route::get('/hongkong/{id}/pdf/download', [HongkongController::class, 'download'])
        ->name('hongkong.pdf.download');

    Route::get('/taiwan/{id}/pdf/download', [TaiwanController::class, 'download'])
        ->name('taiwan.pdf.download');

    Route::get('/singapore/{id}/pdf/download', [SingaporeController::class, 'download'])
        ->name('singapore.pdf.download');

    Route::get('/malaysia/{id}/pdf/download', [MalaysiaController::class, 'download'])
        ->name('malaysia.pdf.download');

    //---------------------------------------------------------------- Laporan Internal Perusahaan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/pdf/download', [LaporanController::class, 'generatePdf'])
        ->name('laporan.pdf.download');
});

