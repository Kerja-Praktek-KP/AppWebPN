<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TL_PW_Panmud_Hukum;
use App\Models\TL_PW_Panmud_Perdata;
use App\Models\TL_PW_Panmud_PHI;
use App\Models\TL_PW_Panmud_Pidana;
use App\Models\TL_PW_Panmud_Tipikor;
use App\Models\TL_PW_Sub_Bag_Kepegawaian_dan_Ortala;
use App\Models\TL_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan;
use App\Models\TL_PW_Sub_Bag_Umum_dan_Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InfoDetailUserControllerPengawas extends Controller
{
    //UNTUK PIMPINAN
    public function showPengawasPimpinan($id)
    {
        // Mendapatkan data user Pengawas
        $pengawas = User::findOrFail($id);

        // Mendapatkan model berdasarkan bidang user saat ini
        $model = $this->getModelByBidang($pengawas->bidang);

        if (!$model) {
            return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
        }

        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('F');
        $currentYear = $currentDate->year;

        // Pemetaan bulan dari bahasa Inggris ke bahasa lokal
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

        // Status Mingguan
        $statusMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'Laporan Mingguan', $minggu, $id);
        }
        Log::info('Status Mingguan', ['statusMingguan' => $statusMingguan]);

        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model, 'Laporan Bulanan', $bulanLocal, $id);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);

        // Laporan Mingguan
        $mingguan = $model::whereIn('jenis', ['Laporan Mingguan'])
            ->where('user_id', $id) // Menambahkan kondisi untuk user ID
            ->orderBy('created_at', 'desc')
            ->get();

        // Laporan Bulanan
        $bulanan = $model::whereIn('jenis', ['Laporan Bulanan'])
            ->where('user_id', $id) // Menambahkan kondisi untuk user ID
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirim data ke view pimpinan.penilaianDetailPengawas
        return view('Pimpinan.penilaianDetailPengawas', [
            'user' => $pengawas, // Ini mengoperasikan variabel $user ke view
            'pengawas' => $pengawas,
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'mingguan' => $mingguan,
            'bulanan' => $bulanan,
        ]);
    }

    public function downloadLaporanPWuntukPimpinan($id)
    {
        $pengawas = User::findOrFail($id);

        // Temukan laporan berdasarkan ID
        $laporan = $this->getModelByBidang($pengawas->bidang)::find($id);

        if (!$laporan) {
            return redirect()->route('Pimpinan.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
        }

        // Path file
        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Nama file dengan ekstensi
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->route('Pimpinan.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'File tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, $fileNameWithExtension);
    }

    //UNTUK KOORDINATOR PENGAWAS
    public function showPengawasKoordinatorPengawas($id)
    {
        // Mendapatkan data user Pengawas
        $pengawas = User::findOrFail($id);

        // Mendapatkan model berdasarkan bidang user saat ini
        $model = $this->getModelByBidang($pengawas->bidang);

        if (!$model) {
            return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
        }

        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('F');
        $currentYear = $currentDate->year;

        // Pemetaan bulan dari bahasa Inggris ke bahasa lokal
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

        // Status Mingguan
        $statusMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'Laporan Mingguan', $minggu, $id);
        }
        Log::info('Status Mingguan', ['statusMingguan' => $statusMingguan]);

        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model, 'Laporan Bulanan', $bulanLocal, $id);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);

        // Laporan Mingguan
        $mingguan = $model::whereIn('jenis', ['Laporan Mingguan'])
            ->where('user_id', $id) // Menambahkan kondisi untuk user ID
            ->orderBy('created_at', 'desc')
            ->get();

        // Laporan Bulanan
        $bulanan = $model::whereIn('jenis', ['Laporan Bulanan'])
            ->where('user_id', $id) // Menambahkan kondisi untuk user ID
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirim data ke view pimpinan.penilaianDetailPengawas
        return view('Koordinator Pengawas.penilaianDetailPengawas', [
            'user' => $pengawas, // Ini mengoperasikan variabel $user ke view
            'pengawas' => $pengawas,
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'mingguan' => $mingguan,
            'bulanan' => $bulanan,
        ]);
    }

    public function downloadLaporanPWuntukKoordinatorPengawas($id)
    {
        $pengawas = User::findOrFail($id);

        // Temukan laporan berdasarkan ID
        $laporan = $this->getModelByBidang($pengawas->bidang)::find($id);

        if (!$laporan) {
            return redirect()->route('Pimpinan.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
        }

        // Path file
        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Nama file dengan ekstensi
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->route('Pimpinan.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'File tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, $fileNameWithExtension);
    }

    private function getModelByBidang($bidang)
    {
        switch ($bidang) {
            case 'Panmud Perdata':
                return TL_PW_Panmud_Perdata::class;
            case 'Panmud Pidana':
                return TL_PW_Panmud_Pidana::class;
            case 'Panmud Tipikor':
                return TL_PW_Panmud_Tipikor::class;
            case 'Panmud PHI':
                return TL_PW_Panmud_PHI::class; 
            case 'Panmud Hukum':
                return TL_PW_Panmud_Hukum::class;
            case 'Sub Bag. Kepegawaian dan Ortala':
                return TL_PW_Sub_Bag_Kepegawaian_dan_Ortala::class; 
            case 'Sub Bag. Perencanaan, TI, dan Pelaporan':
                return TL_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan::class;    
            case 'Sub Bag. Umum dan Keuangan':
                return TL_PW_Sub_Bag_Umum_dan_Keuangan::class;      
            default:
                return null;
        }
    }

    private function cekStatusLaporanBulan($model, $jenis, $periode = null, $userId = null)
    {
        $query = $model::where('jenis', $jenis);

        if ($periode) {
            $query->where('bulan', $periode);
        }

        if ($userId) {
            $query->where('user_id', $userId); // Menambahkan kondisi untuk user ID
        }

        return $query->exists();
    }

    private function cekStatusLaporanMinggu($model, $jenis, $minggu = null, $userId = null)
    {
        $query = $model::where('jenis', $jenis);

        if ($minggu) {
            $query->where('minggu', $minggu);
        }

        if ($userId) {
            $query->where('user_id', $userId); // Menambahkan kondisi untuk user ID
        }

        return $query->exists();
    }

    
}
