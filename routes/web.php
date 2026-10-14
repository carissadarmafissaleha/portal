<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\HongkongController;
use App\Http\Controllers\MalaysiaController;
use App\Http\Controllers\SingaporeController;
use App\Http\Controllers\TaiwanController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Filament\Pages\Workers;
use App\Http\Controllers\LandingPageController;

Route::get('/', function () {
    return view('landing');
});


//---------------------------------------------------------------- Blog
// Route::get('/', function () {
//     return Redirect::guest('blogs');
// })->name('home');

//---------------------------------------------------------------- Admin
// Route::get('/', function () {
//     return Redirect::guest('admin');
// })->name('home');

Route::get('/login', function () {
    return redirect('/admin/login'); // Sesuaikan rute ini jika halaman login Anda berbeda
})->name('login');

Route::post('/logout', function () {
    auth('web')->logout();
    return redirect('/');
})->name('logout');

Route::get('/biodata/foto/{filename}', [HongkongController::class, 'showPhoto'])->name('biodata.photo.hongkong');
Route::get('/biodata/taiwan/foto/{filename}', [TaiwanController::class, 'showPhoto'])->name('biodata.photo.taiwan');
Route::get('/biodata/singapore/foto/{filename}', [SingaporeController::class, 'showPhoto'])->name('biodata.photo.singapore');
Route::get('/biodata/malaysia/foto/{filename}', [MalaysiaController::class, 'showPhoto'])->name('biodata.photo.malaysia');
//---------------------------------------------------------------- Biodata
Route::get('/hongkong/{id}/pdf/download', [HongkongController::class, 'download'])
    ->name('hongkong.pdf.download')
    ->middleware('auth');  // Enforce authentication if needed
Route::get('/taiwan/{id}/pdf/download', [TaiwanController::class, 'download'])
    ->name('taiwan.pdf.download')
    ->middleware('auth');  // Enforce authentication if needed
Route::get('/singapore/{id}/pdf/download', [SingaporeController::class, 'download'])
    ->name('singapore.pdf.download')
    ->middleware('auth');  // Enforce authentication if needed
Route::get('/malaysia/{id}/pdf/download', [MalaysiaController::class, 'download'])
    ->name('malaysia.pdf.download')
    ->middleware('auth');

use App\Http\Controllers\LaporanController;

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/pdf/download', [LaporanController::class, 'generatePdf'])->name('laporan.pdf.download');


Route::get('/', [LandingPageController::class, 'index']);
Route::get('/foto/{filename}', function ($filename) {
    $path = storage_path('app/public/biodata/foto/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header("Content-Type", $type);
});
