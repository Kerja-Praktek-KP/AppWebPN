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
use Illuminate\Support\Facades\Auth;

class TemuanController extends Controller
{

    public function create()
    {
        return view('Pengawas.penilaianDetailPemberiLaporan');
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'judul' => 'required|string|max:255',
            'file-upload' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        try {
            // Simpan file dan ambil path-nya
            $filePath = $request->file('file-upload')->store('laporan');

            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Tentukan model berdasarkan bidang
            $model = $this->getModelByBidang($user->bidang);

            if (!$model) {
                throw new \Exception('Bidang tidak dikenali.');
            }

            // Buat entri laporan baru
            $model::create([
                'nama_temuan' => $request->input('judul'),
                'file_path' => $filePath,
                'user_id' => $user->id, // ID pengguna
                'nama' => $user->name, // Nama pengguna
                'nip' => $user->nip ?? '', // NIP pengguna jika ada
                'bidang' => $user->bidang ?? '', // Bidang pengguna jika ada
                'role' => $user->role ?? '', // Role pengguna jika ada
            ]);

            return redirect()->route('TemuanPW')->with('success', 'Laporan berhasil diunggah');
        } catch (\Exception $e) {
            return redirect()->route('TemuanPW')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            // Tambahkan kasus lain jika ada
            default:
                return null;
        }
    }
}
