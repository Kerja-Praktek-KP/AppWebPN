<?php

namespace App\Http\Controllers;

use App\Models\TL_Koordinator_Pengawas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnggahLaporanKPController extends Controller
{

    public function create()
    {
        return view('Koordinator Pengawas.unggahLaporan');
    }


    public function laporan()
    {
        $user = Auth::user();

        // Mengambil data laporan berdasarkan user_id pengguna yang sedang login
        $laporans = TL_Koordinator_Pengawas::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Mengirim data laporan ke view
        return view('Koordinator Pengawas.riwayatLaporan', compact('laporans'));
    }


    public function downloadLaporan($id)
    {
        
        $model = TL_Koordinator_Pengawas::class;

        $laporan = $model::findOrFail($id);
        $filePath = storage_path("app/public/{$laporan->file_path}"); // Path file di storage

        // Ambil ekstensi file dari file_path
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);

        \Log::info('Mencoba mengunduh file dari path: ' . $filePath);

        if (!file_exists($filePath)) {
            \Log::error('File tidak ditemukan di path: ' . $filePath);
            return redirect()->route('riwayatLaporanKP')->with('error', 'File tidak ditemukan.');
        }

        \Log::info('File ditemukan, mulai mengunduh: ' . $filePath);

        // Gunakan nama file dengan ekstensi saat mengunduh
        return response()->download($filePath, $fileNameWithExtension);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bulan' => 'required|string',
            'file-upload' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        try {
            // Ambil nama laporan
            $namaLaporan = $request->input('judul');

            // Format tanggal
            $tanggalPenguploadan = now()->format('d-m-Y'); // Format: dd-mm-yyyy

            // Buat nama file
            $fileName = str_replace(' ', ' ', $namaLaporan) . "_{$tanggalPenguploadan}." . $request->file('file-upload')->getClientOriginalExtension();

            // Simpan file ke dalam folder
            $filePath = $request->file('file-upload')->storeAs("Koorniator Pengawas", $fileName, 'public');
            
            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Data untuk disimpan, termasuk kolom bulan
            $data = [
                'nama_laporan' => $namaLaporan,
                'bulan' => $request->input('bulan'), // Tambahkan bulan
                'file_path' => $filePath,
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => $user->nip ?? '',
                'role' => $user->role ?? '',
            ];

            // Debugging: Lihat data sebelum disimpan
            \Log::info('Data laporan yang akan disimpan:', $data);

            // Buat entri laporan baru
            TL_Koordinator_Pengawas::create($data);

            return redirect()->route('unggahLaporanKP')->with('success', 'Laporan berhasil diunggah');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan laporan: ' . $e->getMessage());
            return redirect()->route('unggahLaporanKP')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    // private function getAdditionalDataByRole($user)
    // {
    //     return [
    //         'nama' => $user->name,
    //         'nip' => $user->nip ?? '',
    //         'role' => $user->role ?? '',
    //     ];
    // }
}
