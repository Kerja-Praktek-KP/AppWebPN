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

    public function create()
    {
        return view('Pemberi Laporan.unggahLaporan');
    }


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

    public function laporanBulanIni()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        // Mapping bulan
        $bulanMapping = [
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

        // Dapatkan nama bulan saat ini dalam bahasa Inggris
        $currentMonthNameEnglish = now()->format('F');

        // Konversi nama bulan ke bahasa Indonesia
        $currentMonthName = $bulanMapping[$currentMonthNameEnglish];

        $currentYear = now()->year;

        $laporanMingguan = $model::where('jenis', 'Laporan Mingguan')
            ->where('Bulan', $currentMonthName) // Filter berdasarkan nama bulan dalam bahasa Indonesia
            ->whereYear('created_at', $currentYear) // Filter berdasarkan tahun
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pemberi Laporan.statusLaporanMingguanPL', [
            'laporanMingguan' => $laporanMingguan,
        ]);
    }

    public function laporanTahunIni()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        // Mapping bulan
        $bulanMapping = [
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

        // Dapatkan nama bulan saat ini dalam bahasa Inggris
        $currentMonthNameEnglish = now()->format('F');

        // Konversi nama bulan ke bahasa Indonesia
        $currentMonthName = $bulanMapping[$currentMonthNameEnglish];

        $currentYear = now()->year;

        $laporanBulanan = $model::where('jenis', 'Laporan Bulanan')
            ->whereYear('created_at', $currentYear) // Filter berdasarkan tahun
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pemberi Laporan.statusLaporanBulananPL', [
            'laporanBulanan' => $laporanBulanan,
        ]);
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

    public function TLHPBulanIni()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        // Mapping bulan
        $bulanMapping = [
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

        // Dapatkan nama bulan saat ini dalam bahasa Inggris
        $currentMonthNameEnglish = now()->format('F');

        // Konversi nama bulan ke bahasa Indonesia
        $currentMonthName = $bulanMapping[$currentMonthNameEnglish];

        $currentYear = now()->year;

        $tlhpMingguan = $model::where('jenis', 'TLHP Mingguan')
            ->where('Bulan', $currentMonthName) // Filter berdasarkan nama bulan dalam bahasa Indonesia
            ->whereYear('created_at', $currentYear) // Filter berdasarkan tahun
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pemberi Laporan.statusTLHPMingguanPL', [
            'tlhpMingguan' => $tlhpMingguan,
        ]);
    }

    public function tlhpTahunIni()
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        if (!$model) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        }

        // Mapping bulan
        $bulanMapping = [
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

        // Dapatkan nama bulan saat ini dalam bahasa Inggris
        $currentMonthNameEnglish = now()->format('F');

        // Konversi nama bulan ke bahasa Indonesia
        $currentMonthName = $bulanMapping[$currentMonthNameEnglish];

        $currentYear = now()->year;

        $tlhpBulanan = $model::where('jenis', 'TLHP Bulanan')
            ->whereYear('created_at', $currentYear) // Filter berdasarkan tahun
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pemberi Laporan.statusTLHPBulananPL', [
            'tlhpBulanan' => $tlhpBulanan,
        ]);
    }

    public function downloadLaporan($id)
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        // if (!$model) {
        //     // \Log::error('Model tidak ditemukan untuk bidang: ' . $user->bidang);
        //     return redirect()->route('riwayatLaporanPL')->with('error', 'Bidang tidak dikenali.');
        // }

        $laporan = $model::findOrFail($id);
        $filePath = storage_path("app/public/{$laporan->file_path}"); // Path file di storage

        // Ambil ekstensi file dari file_path
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // \Log::info('Mencoba mengunduh file dari path: ' . $filePath);

        // if (!file_exists($filePath)) {
        //     // \Log::error('File tidak ditemukan di path: ' . $filePath);
        //     return redirect()->route('riwayatLaporanPL')->with('error', 'File tidak ditemukan.');
        // }

        // \Log::info('File ditemukan, mulai mengunduh: ' . $filePath);

        // Gunakan nama file dengan ekstensi saat mengunduh
        return response()->download($filePath, $fileNameWithExtension);
    }

    

    public function downloadTLHP($id)
    {
        $user = Auth::user();
        $model = $this->getModelByBidang($user->bidang);

        // if (!$model) {
        //     return redirect()->route('riwayatTLHPPL')->with('error', 'Bidang tidak dikenali.');
        // }

        $laporan = $model::findOrFail($id);

        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Ambil ekstensi file dari file_path
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        // if (!file_exists($filePath)) {
        //     return redirect()->route('riwayatLaporanPL')->with('error', 'File tidak ditemukan.');
        // }

        return response()->download($filePath, $fileNameWithExtension);
    }



    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Laporan Mingguan,Laporan Bulanan,TLHP Mingguan,TLHP Bulanan',
            'bulan' => 'required|string',
            'minggu' => [
                'nullable',
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
            // Ambil nama laporan
            $namaLaporan = $request->input('judul');

            // Format tanggal
            $tanggalPenguploadan = now()->format('d-m-Y'); // Format: dd-mm-yyyy

            // Buat nama file
            $fileName = str_replace(' ', ' ', $namaLaporan) . "_{$tanggalPenguploadan}." . $request->file('file-upload')->getClientOriginalExtension();

            // Ambil bidang pengguna yang sedang login
            $user = Auth::user();
            $bidang = $user->bidang;

            // Simpan file ke dalam folder sesuai bidang
            $filePath = $request->file('file-upload')->storeAs("Pemberi Laporan-{$bidang}", $fileName, 'public');

            // Tentukan model berdasarkan bidang
            $model = $this->getModelByBidang($bidang);

            if (!$model) {
                throw new \Exception('Bidang tidak dikenali.');
            }

            // Buat entri laporan baru
            $model::create([
                'nama_laporan' => $namaLaporan,
                'jenis' => $request->input('jenis'),
                'bulan' => $request->input('bulan'),
                'minggu' => $request->input('minggu'),
                'file_path' => $filePath,
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => $user->nip ?? '',
                'bidang' => $bidang ?? '',
                'role' => $user->role ?? '',
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
