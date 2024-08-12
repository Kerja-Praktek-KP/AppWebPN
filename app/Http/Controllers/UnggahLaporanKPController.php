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

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bulan' => 'required|string',
            'file-upload' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        try {
            // Simpan file dan ambil path-nya
            $filePath = $request->file('file-upload')->store('laporan');

            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Data untuk disimpan, termasuk kolom bulan
            $data = [
                'nama_laporan' => $request->input('judul'),
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
