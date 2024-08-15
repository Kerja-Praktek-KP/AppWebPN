<?php

namespace App\Http\Controllers;

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


class StatusPWController extends Controller
{
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

        return view('Pengawas.beranda', [
            'statusMingguan' => $statusMingguan,
            'statusBulanan' => $statusBulanan,
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
            'total_mingguan' => 2,
            'total_bulanan' => 1,
            'current_month_name' => 'Januari',
            // Tambahkan data lainnya
        ];

        return view('Pengawas.beranda', compact('status'));
    }
}