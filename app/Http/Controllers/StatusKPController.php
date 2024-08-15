<?php

namespace App\Http\Controllers;

use App\Models\TL_Koordinator_Pengawas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class StatusKPController extends Controller
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

    private function cekStatusLaporanBulan($model, $periode = null)
    {
        $query = $model::query();
        
        if ($periode) {
            $query->where('bulan', $periode);
        }
        
        return $query->exists();
    }
    

    
    public function getStatus()
    {
        $user = Auth::user();
        $model = TL_Koordinator_Pengawas::class;
        
        
        
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

        return view('Koordinator Pengawas.beranda', [
            'statusBulanan' => $statusBulanan,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear
        ]);
    }

    public function index()
    {
        $status = [
            'laporan_bulanan' => true,
            'total_bulanan' => 1,
            'current_month_name' => 'Januari',
            // Tambahkan data lainnya
        ];

        return view('Koordinator Pengawas.beranda', compact('status'));
    }
}