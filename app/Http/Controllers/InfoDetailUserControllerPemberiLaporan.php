<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TL_PL_Panmud_Hukum;
use App\Models\TL_PL_Panmud_Perdata;
use App\Models\TL_PL_Panmud_PHI;
use App\Models\TL_PL_Panmud_Pidana;
use App\Models\TL_PL_Panmud_Tipikor;
use App\Models\TL_PL_Sub_Bag_Kepegawaian_dan_Ortala;
use App\Models\TL_PL_Sub_Bag_Perencanaan_TI_dan_Pelaporan;
use App\Models\TL_PL_Sub_Bag_Umum_dan_Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class InfoDetailUserControllerPemberiLaporan extends Controller
{
    public function showPemberiLaporanuntukPengawas(Request $request, $id = null)
    {
        $currentUser = Auth::user(); // Mendapatkan pengguna yang sedang login
        $pemberiLaporan = User::where('role', 'Pemberi Laporan')
            ->where('bidang', $currentUser->bidang)
            ->get();

        // Debugging output untuk memastikan data dikirimkan
        // dd($pemberiLaporan);

        // Mendapatkan status laporan
        $model = $this->getModelByBidang($currentUser->bidang);

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

        // Status Mingguan
        $statusMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'Laporan Mingguan', $minggu);
        }
        Log::info('Status Mingguan', ['statusMingguan' => $statusMingguan]);

        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F'); // Bulan dalam format Inggris
            $bulanLocal = $months[$bulan]; // Mengubah ke format lokal
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model, 'Laporan Bulanan', $bulanLocal);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);

        // Status TLHP Mingguan
        $statusTLHPMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusTLHPMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'TLHP Mingguan', $minggu);
        }
        Log::info('Status TLHP Mingguan', ['statusTLHPMingguan' => $statusTLHPMingguan]);

        // Status TLHP Bulanan
        $statusTLHPBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F'); // Bulan dalam format Inggris
            $bulanLocal = $months[$bulan]; // Mengubah ke format lokal
            $statusTLHPBulanan[$i] = $this->cekStatusLaporanBulan($model, 'TLHP Bulanan', $bulanLocal);
        }
        Log::info('Status TLHP Bulanan', ['statusTLHPBulanan' => $statusTLHPBulanan]);

        

        // Menggabungkan Laporan Mingguan dan Laporan Bulanan menjadi satu variabel
        $laporan = $model::whereIn('jenis', ['Laporan Mingguan', 'Laporan Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Menggabungkan TLHP Mingguan dan TLHP Bulanan menjadi satu variabel
        $tlhp = $model::whereIn('jenis', ['TLHP Mingguan', 'TLHP Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();


        return view('Pengawas.penilaianDetailPemberiLaporan', [
            'pemberiLaporan' => $pemberiLaporan,
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'statusTLHPMingguan' => $statusTLHPMingguan,
            'statusTLHPBulanan' => $statusTLHPBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'laporan' => $laporan,
            'tlhp' => $tlhp,
        ]);
    }

    //============//============//============//============//
    public function showPemberiLaporanuntukPimpinan($id)
    {
        // Mendapatkan data user Pemberi Laporan
        $pemberiLaporan = User::findOrFail($id);

        // Mendapatkan model berdasarkan bidang user saat ini
        $model = $this->getModelByBidang($pemberiLaporan->bidang);

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
            $statusMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'Laporan Mingguan', $minggu);
        }
        Log::info('Status Mingguan', ['statusMingguan' => $statusMingguan]);

        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model, 'Laporan Bulanan', $bulanLocal);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);

        // Status TLHP Mingguan
        $statusTLHPMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusTLHPMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'TLHP Mingguan', $minggu);
        }
        Log::info('Status TLHP Mingguan', ['statusTLHPMingguan' => $statusTLHPMingguan]);

        // Status TLHP Bulanan
        $statusTLHPBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusTLHPBulanan[$i] = $this->cekStatusLaporanBulan($model, 'TLHP Bulanan', $bulanLocal);
        }
        Log::info('Status TLHP Bulanan', ['statusTLHPBulanan' => $statusTLHPBulanan]);

        // Menggabungkan Laporan Mingguan dan Bulanan
        $laporan = $model::whereIn('jenis', ['Laporan Mingguan', 'Laporan Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Menggabungkan TLHP Mingguan dan Bulanan
        $tlhp = $model::whereIn('jenis', ['TLHP Mingguan', 'TLHP Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirim data ke view pimpinan.penilaianDetailPemberiLaporan
        return view('Pimpinan.penilaianDetailPemberiLaporan', [
            'user' => $pemberiLaporan, // Ini mengoperasikan variabel $user ke view
            'pemberiLaporan' => $pemberiLaporan,
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'statusTLHPMingguan' => $statusTLHPMingguan,
            'statusTLHPBulanan' => $statusTLHPBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'laporan' => $laporan,
            'tlhp' => $tlhp,
        ]);
    }

    //============//============//============//============//
    public function showPemberiLaporanuntukKoordinatorPengawas($id)
    {
        // Mendapatkan data user Pemberi Laporan
        $pemberiLaporan = User::findOrFail($id);

        // Mendapatkan model berdasarkan bidang user saat ini
        $model = $this->getModelByBidang($pemberiLaporan->bidang);

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
            $statusMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'Laporan Mingguan', $minggu);
        }
        Log::info('Status Mingguan', ['statusMingguan' => $statusMingguan]);

        // Status Bulanan
        $statusBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusBulanan[$i] = $this->cekStatusLaporanBulan($model, 'Laporan Bulanan', $bulanLocal);
        }
        Log::info('Status Bulanan', ['statusBulanan' => $statusBulanan]);

        // Status TLHP Mingguan
        $statusTLHPMingguan = [];
        for ($i = 1; $i <= 4; $i++) {
            $minggu = "Laporan Minggu $i";
            $statusTLHPMingguan[$i] = $this->cekStatusLaporanMinggu($model, 'TLHP Mingguan', $minggu);
        }
        Log::info('Status TLHP Mingguan', ['statusTLHPMingguan' => $statusTLHPMingguan]);

        // Status TLHP Bulanan
        $statusTLHPBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('F');
            $bulanLocal = $months[$bulan];
            $statusTLHPBulanan[$i] = $this->cekStatusLaporanBulan($model, 'TLHP Bulanan', $bulanLocal);
        }
        Log::info('Status TLHP Bulanan', ['statusTLHPBulanan' => $statusTLHPBulanan]);

        // Menggabungkan Laporan Mingguan dan Bulanan
        $laporan = $model::whereIn('jenis', ['Laporan Mingguan', 'Laporan Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Menggabungkan TLHP Mingguan dan Bulanan
        $tlhp = $model::whereIn('jenis', ['TLHP Mingguan', 'TLHP Bulanan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Mengirim data ke view pimpinan.penilaianDetailPemberiLaporan
        return view('Koordinator Pengawas.penilaianDetailPemberiLaporan', [
            'user' => $pemberiLaporan, // Ini mengoperasikan variabel $user ke view
            'pemberiLaporan' => $pemberiLaporan,
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'statusTLHPMingguan' => $statusTLHPMingguan,
            'statusTLHPBulanan' => $statusTLHPBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'laporan' => $laporan,
            'tlhp' => $tlhp,
        ]);
    }

    //============//============//============//============//
    public function downloadLaporanPLuntukPengawas($id)
    {
        $currentUser = Auth::user(); // Mendapatkan pengguna yang sedang login
        $model = $this->getModelByBidang($currentUser->bidang);

        if (!$model) {
            return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
        }

        // Temukan laporan milik Pemberi Laporan dengan ID
        $laporan = $model::where('id', $id)
            ->whereHas('user', function($query) use ($currentUser) {
                $query->where('role', 'Pemberi Laporan')
                    ->where('bidang', $currentUser->bidang);
            })
            ->first();

        // Cek apakah laporan ditemukan
        if (!$laporan) {
            return redirect()->route('pengawas.pemberiLaporan')->with('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
        }

        // Path file
        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Nama file dengan ekstensi
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->route('pengawas.pemberiLaporan')->with('error', 'File tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, $fileNameWithExtension);
    }
   
    //============//============//============//============//
    public function downloadLaporanPLuntukPimpinan($id)
    {
        // Mendapatkan pengguna yang sedang login
        $currentUser = Auth::user();

        // Temukan laporan berdasarkan ID
        $laporan = $this->getModelByBidang($currentUser->bidang)::find($id);

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

    //============//============//============//============//
    public function downloadLaporanPLuntukKoordinatorPengawas($id)
    {
        // Mendapatkan pengguna yang sedang login
        $currentUser = Auth::user();

        // Temukan laporan berdasarkan ID
        $laporan = $this->getModelByBidang($currentUser->bidang)::find($id);

        if (!$laporan) {
            return redirect()->route('Koordinator Pengawas.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
        }

        // Path file
        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Nama file dengan ekstensi
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->route('Koordinator Pengawas.penilaianDetailPemberiLaporan', ['id' => $id])
                ->with('error', 'File tidak ditemukan.');
        }

        // Unduh file
        return response()->download($filePath, $fileNameWithExtension);
    }


    private function getModelByBidang($bidang)
    {
        switch ($bidang) {
            case 'Panmud Perdata':
                return TL_PL_Panmud_Perdata::class;
            case 'Panmud Pidana':
                return TL_PL_Panmud_Pidana::class;
            case 'Panmud Tipikor':
                return TL_PL_Panmud_Tipikor::class;
            case 'Panmud PHI':
                return TL_PL_Panmud_PHI::class; 
            case 'Panmud Hukum':
                return TL_PL_Panmud_Hukum::class;
            case 'Sub Bag. Kepegawaian dan Ortala':
                return TL_PL_Sub_Bag_Kepegawaian_dan_Ortala::class; 
            case 'Sub Bag. Perencanaan, TI, dan Pelaporan':
                return TL_PL_Sub_Bag_Perencanaan_TI_dan_Pelaporan::class;    
            case 'Sub Bag. Umum dan Keuangan':
                return TL_PL_Sub_Bag_Umum_dan_Keuangan::class;      
            default:
                return null;
        }
    }

    private function cekStatusLaporanBulan($model, $jenis, $periode = null)
    {
        $query = $model::where('jenis', $jenis);
        
        if ($periode) {
            $query->where('bulan', $periode);
        }
        
        return $query->exists();
    }

    private function cekStatusLaporanMinggu($model, $jenis, $minggu = null)
    {
        $query = $model::where('jenis', $jenis);
    
        if ($minggu) {
            $query->where('minggu', $minggu);
        }
    
        return $query->exists();
    }

    
}
