<?php

namespace App\Http\Controllers;

use App\Models\TL_Koordinator_Pengawas;

use App\Models\User; // Pastikan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class infoDetailKPController extends Controller
{
    public function showKoordinatorPengawas(Request $request, $id = null)
    {
        $currentUser = Auth::user(); // Mendapatkan pengguna yang sedang login
        $koordinatorPengawas = User::where('role', 'Koordinator Pengawas')
            ->get();

        $model = TL_Koordinator_Pengawas::class;
        if (!$model) {
            return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
        }

        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('F');
        $currentYear = $currentDate->year;

        // Map bulan dalam bahasa Inggris ke bahasa lokal
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        
        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F'); // Bulan dalam format Inggris
            $bulanLocal = $months[$bulan]; // Mengubah ke format lokal
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model,  $bulanLocal);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);


        $laporan = TL_Koordinator_Pengawas::orderBy('created_at', 'desc')->get();

        return view('Pimpinan.penilaianDetailKoordinatorPengawas', [
            'koordinatorPengawas' => $koordinatorPengawas,
            'statusBulanan' => $statusBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'laporan' => $laporan,

        ])->with('debugLaporan', $laporan);
    }


    public function downloadLaporan($id)
{
    $currentUser = Auth::user(); // Mendapatkan pengguna yang sedang login
    $model = TL_Koordinator_Pengawas::class;

    if (!$model) {
        return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
    }

    // Temukan laporan milik Pemberi Laporan dengan ID
    $laporan = $model::where('id', $id)
        ->whereHas('user', function($query) use ($currentUser) {
            $query->where('role', 'Koordinator Pengawas')
                ->where('bidang', $currentUser->bidang);
        })
        ->first();

    // Cek apakah laporan ditemukan
    if (!$laporan) {
        return redirect()->route('penilaianDetailKoordinatorPengawasPimpinan')->with('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
    }

    // Path file
    $filePath = storage_path("app/public/{$laporan->file_path}");

    // Nama file dengan ekstensi
    $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

    // Cek apakah file ada
    if (!file_exists($filePath)) {
        return redirect()->route('penilaianDetailKoordinatorPengawasPimpinan')->with('error', 'File tidak ditemukan.');
    }

    // Unduh file
    return response()->download($filePath, $fileNameWithExtension);
}


    private function cekStatusLaporanBulan($model, $periode = null)
    {
        $query = $model::query();
        
        if ($periode) {
            $query->where('bulan', $periode);
        }
        
        return $query->exists();
    }
}
