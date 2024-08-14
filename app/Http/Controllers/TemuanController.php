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
            $file = $request->file('file-upload');
            $filePath = $file->store('laporan', 'public');

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
                'file_path' => $filePath, // Path relatif dari storage
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => $user->nip ?? '',
                'bidang' => $user->bidang ?? '',
                'role' => $user->role ?? '',
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

    
    public function downloadTemuan($id)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
        
        // Tentukan model berdasarkan bidang pengguna
        $model = $this->getModelByBidang($user->bidang);

        // Jika bidang tidak dikenali, kembali dengan pesan error
        if (!$model) {
            return redirect()->route('pemberitahuan')->with('error', 'Bidang tidak dikenali.');
        }

        // Temukan temuan berdasarkan ID
        $temuan = $model::findOrFail($id);

        // Buat path lengkap ke file
        $filePath = storage_path("app/public/{$temuan->file_path}");

        // Log informasi untuk debugging
        \Log::info('File path untuk unduhan: ' . $filePath);

        // Cek apakah file ada di path tersebut
        if (!file_exists($filePath)) {
            \Log::error('File tidak ditemukan di path: ' . $filePath);
            return redirect()->route('pemberitahuan')->with('error', 'File tidak ditemukan.');
        }

        // Ambil nama file beserta ekstensi untuk unduhan
        $fileNameWithExtension = $temuan->nama_temuan . '.' . pathinfo($temuan->file_path, PATHINFO_EXTENSION);

        // Log nama file yang akan diunduh
        \Log::info('Nama file untuk unduhan: ' . $fileNameWithExtension);

        // Kembalikan respons unduhan dengan nama file dan path yang benar
        return response()->download($filePath, $fileNameWithExtension);

        response()->download($filePath, $fileNameWithExtension);
    }
}


