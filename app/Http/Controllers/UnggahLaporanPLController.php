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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UnggahLaporanPLController extends Controller
{
    public function laporan()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        $laporanMingguan = $model::where('jenis', 'Laporan Mingguan')
            ->orderBy('created_at', 'desc')
            ->get();

        $laporanBulanan = $model::where('jenis', 'Laporan Bulanan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pemberi Laporan.riwayatLaporanPemberiLaporan', [
            'laporanMingguan' => $laporanMingguan,
            'laporanBulanan' => $laporanBulanan,
        ]);
    }

    public function downloadLaporan($id)
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        $laporan = $model::findOrFail($id);

        $filePath = storage_path("app/{$laporan->file_path}");

        if (!file_exists($filePath)) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath, $laporan->nama_laporan);

    }

    public function tlhp()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatTLHPPL')->with('error', 'Bidang tidak dikenali.');
        }

        $tlhpMingguan = $model::where('jenis', 'TLHP Mingguan')
        ->orderBy('created_at', 'desc')
        ->get();

        $tlhpBulanan = $model::where('jenis', 'TLHP Bulanan')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('Pemberi Laporan.riwayatTLHPPemberiLaporan', [
            'tlhpMingguan' => $tlhpMingguan,
            'tlhpBulanan' => $tlhpBulanan,
        ]);
    }

    public function downloadTLHP($id)
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatTLHPPL')->with('error', 'Bidang tidak dikenali.');
        }

        $laporan = $model::findOrFail($id);

        $filePath = storage_path("app/{$laporan->file_path}");

        if (!file_exists($filePath)) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath, $laporan->nama_laporan);
    }

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
            'minggu' => [
                'nullable', // Set bidang to nullable
                Rule::requiredIf(function () use ($request) {
                    return !in_array($request->jenis, ['Laporan Bulanan', 'TLHP Bulanan']);
                }),
                Rule::in([
                    'Laporan Minggu 1',
                    'Laporan Minggu 2',
                    'Laporan Minggu 3',
                    'Laporan Minggu 4',
                ]),
            ],
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
