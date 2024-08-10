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

class UnggahLaporanPLController extends Controller
{

    public function create()
    {
        return view('Pemberi Laporan.unggahLaporan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Laporan Mingguan,Laporan Bulanan,TLHP Mingguan,TLHP Bulanan',
            'bulan' => 'required|string',
            'minggu' => 'nullable|string',
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
                'nama_laporan' => $request->input('judul'),
                'jenis' => $request->input('jenis'),
                'file_path' => $filePath,
                'user_id' => $user->id, // ID pengguna
                'nama' => $user->name, // Nama pengguna
                'nip' => $user->nip ?? '', // NIP pengguna jika ada
                'bidang' => $user->bidang ?? '', // Bidang pengguna jika ada
                'role' => $user->role ?? '', // Role pengguna jika ada
            ]);

            return redirect()->route('unggahLaporanPL')->with('success', 'Laporan berhasil diunggah');
        } catch (\Exception $e) {
            return redirect()->route('unggahLaporanPL')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            // Tambahkan kasus lain jika ada
            default:
                return null;
        }
    }
}
