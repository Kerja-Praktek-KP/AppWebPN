<?php

namespace App\Http\Controllers;

use App\Models\Temuan_PW_Panmud_Hukum;
use App\Models\Temuan_PW_Panmud_Perdata;
use App\Models\Temuan_PW_Panmud_PHI;
use App\Models\Temuan_PW_Panmud_Pidana;
use App\Models\Temuan_PW_Panmud_Tipikor;
use App\Models\Temuan_PW_Sub_Bag_Kepegawaian_dan_Ortala;
use App\Models\Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan;
use App\Models\Temuan_PW_Sub_Bag_Umum_dan_Keuangan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('Pemberitahuan')->with('error', 'Bidang tidak dikenali.');
        }

        $temuans = $model::orderBy('created_at', 'desc')->get();

        return view('Pemberi Laporan.pemberitahuan', compact('temuans'));
    }


    private function getModelByBidang($bidang)
    {
        switch ($bidang) {
            case 'Panmud Perdata':
                return Temuan_PW_Panmud_Perdata::class;
            case 'Panmud Pidana':
                return Temuan_PW_Panmud_Pidana::class;
            case 'Panmud Tipikor':
                return Temuan_PW_Panmud_Tipikor::class;
            case 'Panmud PHI':
                return Temuan_PW_Panmud_PHI::class; 
            case 'Panmud Hukum':
                return Temuan_PW_Panmud_Hukum::class;
            case 'Sub Bag. Kepegawaian dan Ortala':
                return Temuan_PW_Sub_Bag_Kepegawaian_dan_Ortala::class; 
            case 'Sub Bag. Perencanaan, TI, dan Pelaporan':
                return Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan::class;    
            case 'Sub Bag. Umum dan Keuangan':
                return Temuan_PW_Sub_Bag_Umum_dan_Keuangan::class;      
            default:
                return null;
        }
    }

}
