<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Marketing;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class TaiwanController extends Controller
{
    public function download($id)
    {
        // Validasi ID
        if (!is_numeric($id)) {
            return response()->json(['error' => 'Format ID tidak valid.'], 400);
        }

        // Dapatkan data Marketing beserta relasi sales dan pendaftaran
        $marketing = Marketing::with(['sales', 'pendaftaran'])->find($id);
        if (!$marketing) {
            return response()->json(['error' => 'Data marketing tidak ditemukan.'], 404);
        }

        // Validasi Otorisasi (Mencegah IDOR)
        $user = auth()->user();
        if (!$user) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        $canAccess = false;
        if ($user->is_admin || (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['super_admin', 'admin']))) {
            $canAccess = true;
        } elseif ($user->is_agency) {
            if ($marketing->agency_id == 2 || (isset($user->agency_id) && $marketing->agency_id == $user->agency_id)) {
                $canAccess = true;
            }
        } elseif ($marketing->pendaftaran && $marketing->pendaftaran->user_id === $user->id) {
            $canAccess = true;
        }

        if (!$canAccess) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengunduh biodata ini.');
        }

        // Dapatkan data Pendaftaran dan Kantor terkait jika tersedia
        $pendaftaran = Pendaftaran::find($marketing->pendaftaran_id);
        $kantor = $pendaftaran ? Kantor::find($pendaftaran->kantor_id) : null;

        // Periksa apakah 'code_tw' ada di model Marketing
        if (empty($marketing->code_tw)) {
            return response()->json(['error' => 'code_tw pada Marketing tidak valid atau kosong.'], 400);
        }

        // Render tampilan ke HTML
        $htmlContent = View::make('taiwan', [
            'marketing' => $marketing,
            'pendaftaran' => $pendaftaran,
            'kantor' => $kantor,
            'sales' => $marketing->sales,
        ])->render();

        // Tentukan nama file yang aman dengan timestamp dan nama perusahaan
        $timestamp = now()->format('Ymd_His');
        $appName = env('COMPANY_NAME', 'DefaultApp');
        $safeCode = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $marketing->code_tw);
        $safeApp = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $appName);
        $filename = $safeCode . '_' . $safeApp . '_TW_' . $timestamp . '.pdf';

        // Atur opsi untuk DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi DOMPDF
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Kembalikan PDF sebagai unduhan langsung secara aman tanpa menyimpan di folder publik
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
