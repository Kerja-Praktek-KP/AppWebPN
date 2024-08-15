<?php

namespace App\Http\Controllers;

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


class StatusPLController extends Controller
{
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

    public function cekStatusLaporanMinggu($model, $jenis, $minggu = null)
    {
        $query = $model::where('jenis', $jenis);
    
        if ($minggu) {
            $query->where('minggu', $minggu);
        }
    
        $result = $query->exists(); // atau ->count() > 0 jika ingin hasil boolean
        return $result;
    }
    
    public function getStatus()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);
        
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

        return view('Pemberi Laporan.berandaPemberiLaporan', [
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
            'statusTLHPMingguan' => $statusTLHPMingguan,
            'statusTLHPBulanan' => $statusTLHPBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear
        ]);
    }

    public function index()
    {
        $status = [
            'laporan_mingguan_minggu_1' => true,
            'laporan_mingguan_minggu_2' => false,
            'laporan_mingguan_minggu_3' => true,
            'laporan_mingguan_minggu_4' => false,
            'laporan_bulanan' => true,
            'tlhp_mingguan_minggu_1' => false,
            'tlhp_mingguan_minggu_2' => true,
            'tlhp_mingguan_minggu_3' => true,
            'tlhp_mingguan_minggu_4' => false,
            'tlhp_bulanan' => true,
            'total_mingguan' => 2,
            'total_bulanan' => 1,
            'total_tlhp_mingguan' => 3,
            'total_tlhp_bulanan' => 1,
            'current_month_name' => 'Januari',
            // Tambahkan data lainnya
        ];

        return view('Pemberi Laporan.berandaPemberiLaporan', compact('status'));
    }
}



// public function cekStatusLaporan($model, $jenis, $minggu = null)
    // {
    //     $currentDate = Carbon::now();

    //     if (in_array($jenis, ['Laporan Mingguan', 'TLHP Mingguan'])) {
    //         return $model::where('jenis', $jenis)
    //                      ->where('bulan', $currentDate->format('Y-m'))
    //                      ->where('minggu', $minggu)
    //                      ->exists();
    //     } else if (in_array($jenis, ['Laporan Bulanan', 'TLHP Bulanan'])) {
    //         return $model::where('jenis', $jenis)
    //                      ->whereMonth('bulan', $currentDate->month)
    //                      ->whereYear('bulan', $currentDate->year)
    //                      ->exists();
    //     }

    //     return false;
    // }



    // public function resetStatusLaporan()
    // {
    //     $user = Auth::user();
    //     $model = $this->getModelByBidang($user->bidang);

    //     if (!$model) {
    //         return false;
    //     }

    //     $currentDate = Carbon::now();
    //     $model::where('jenis', 'Laporan Mingguan')
    //           ->where('bulan', '<', $currentDate->format('Y-m'))
    //           ->update(['status' => 'belum diunggah']);
        
    //     $model::where('jenis', 'Laporan Bulanan')
    //           ->whereYear('bulan', '<', $currentDate->year)
    //           ->update(['status' => 'belum diunggah']);
    // }

    // public function berandaPemberiLaporan()
    // {
    //     $user = Auth::user();
    //     $model = $this->getModelByBidang($user->bidang);

    //     if (!$model) {
    //         return redirect()->route('home')->with('error', 'Bidang tidak dikenali.');
    //     }

    //     $currentDate = Carbon::now();

    //     $status = [
    //         'laporan_mingguan_minggu_1' => $this->cekStatusLaporan($model, 'Laporan Mingguan', 'Minggu 1'),
    //         'laporan_mingguan_minggu_2' => $this->cekStatusLaporan($model, 'Laporan Mingguan', 'Minggu 2'),
    //         'laporan_mingguan_minggu_3' => $this->cekStatusLaporan($model, 'Laporan Mingguan', 'Minggu 3'),
    //         'laporan_mingguan_minggu_4' => $this->cekStatusLaporan($model, 'Laporan Mingguan', 'Minggu 4'),
    //         'laporan_bulanan' => $this->cekStatusLaporan($model, 'Laporan Bulanan'),
    //         'tlhp_mingguan' => $this->cekStatusLaporan($model, 'TLHP Mingguan'),
    //         'tlhp_bulanan' => $this->cekStatusLaporan($model, 'TLHP Bulanan'),
    //         'total_mingguan' => $model::where('jenis', 'Laporan Mingguan')
    //                                 ->where('bulan', $currentDate->format('Y-m'))
    //                                 ->count(),
    //         'total_bulanan' => $model::where('jenis', 'Laporan Bulanan')
    //                                 ->whereMonth('bulan', $currentDate->month)
    //                                 ->whereYear('bulan', $currentDate->year)
    //                                 ->count(),
    //         'total_tlhp_mingguan' => $model::where('jenis', 'TLHP Mingguan')
    //                                     ->where('bulan', $currentDate->format('Y-m'))
    //                                     ->count(),
    //         'total_tlhp_bulanan' => $model::where('jenis', 'TLHP Bulanan')
    //                                     ->whereMonth('bulan', $currentDate->month)
    //                                     ->whereYear('bulan', $currentDate->year)
    //                                     ->count(),
    //         'current_month_name' => $currentDate->format('F'),
    //         'current_year' => $currentDate->year,
    //     ];

    //     return view('Pemberi Laporan.berandaPemberiLaporan', compact('status'));
    // }