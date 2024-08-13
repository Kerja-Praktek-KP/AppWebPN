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

class UnggahLaporanPWController extends Controller
{

    public function create()
    {
        return view('Pengawas.unggahLaporan');
    }


    public function laporan()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPW')->with('error', 'Bidang tidak dikenali.');
        }

        $laporanMingguan = $model::where('jenis', 'Laporan Mingguan')
            ->orderBy('created_at', 'desc')
            ->get();

        $laporanBulanan = $model::where('jenis', 'Laporan Bulanan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengawas.riwayatLaporan', [
            'laporanMingguan' => $laporanMingguan,
            'laporanBulanan' => $laporanBulanan,
        ]);
    }

    public function downloadLaporan($id)
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            // \Log::error('Model tidak ditemukan untuk bidang: ' . $user->bidang);
            return redirect()->route('riwayatLaporanPW')->with('error', 'Bidang tidak dikenali.');
        }

        $laporan = $model::findOrFail($id);
        $filePath = storage_path("app/public/{$laporan->file_path}"); // Path file di storage

        // Ambil ekstensi file dari file_path
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // \Log::info('Mencoba mengunduh file dari path: ' . $filePath);

        if (!file_exists($filePath)) {
            // \Log::error('File tidak ditemukan di path: ' . $filePath);
            return redirect()->route('riwayatLaporanPW')->with('error', 'File tidak ditemukan.');
        }

        // \Log::info('File ditemukan, mulai mengunduh: ' . $filePath);

        // Gunakan nama file dengan ekstensi saat mengunduh
        return response()->download($filePath, $fileNameWithExtension);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Laporan Mingguan,Laporan Bulanan',
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
                'bulan' => $request->input('bulan'),
                'minggu' => $request->input('minggu'),
                'file_path' => $filePath,
                'user_id' => $user->id, // ID pengguna
                'nama' => $user->name, // Nama pengguna
                'nip' => $user->nip ?? '', // NIP pengguna jika ada
                'bidang' => $user->bidang ?? '', // Bidang pengguna jika ada
                'role' => $user->role ?? '', // Role pengguna jika ada
            ]);

            return redirect()->route('unggahLaporanPW')->with('success', 'Laporan berhasil diunggah');
        } catch (\Exception $e) {
            return redirect()->route('unggahLaporanPW')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            // Tambahkan kasus lain jika ada
            default:
                return null;
        }
    }
}
