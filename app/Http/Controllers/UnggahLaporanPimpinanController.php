<?php

namespace App\Http\Controllers;

use App\Models\TL_Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnggahLaporanPimpinanController extends Controller
{
    public function create()
    {
        return view('Pimpinan.unggahLaporan');
    }

    
    public function laporan()
    {
        $user = Auth::user();

        $tlhp = TL_Pimpinan::where('jenis', 'Laporan TLHP')
            ->orderBy('created_at', 'desc')
            ->get();

        $eksternal = TL_Pimpinan::where('jenis', 'Laporan Eksternal')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Pimpinan.riwayatLaporan', [
            'laporanTLHP' => $tlhp,
            'laporanEksternal' => $eksternal,
        ]);
    }


    public function downloadLaporan($id)
    {
     
        $model =TL_Pimpinan::class;

        $laporan = $model::findOrFail($id);
        $filePath = storage_path("app/public/{$laporan->file_path}");

        // Ambil ekstensi file dari file_path
        $fileNameWithExtension = $laporan->nama_laporan . '.' . pathinfo($laporan->file_path, PATHINFO_EXTENSION);
        
        if (!file_exists($filePath)) {
            return redirect()->route('riwayatLaporanPL')->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath, $fileNameWithExtension);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Laporan TLHP,Laporan Eksternal',
            'file-upload' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        try {
            // Simpan file dan ambil path-nya
            $filePath = $request->file('file-upload')->store('laporan', 'public');

            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Data untuk disimpan, termasuk kolom bulan
            $data = [
                'nama_laporan' => $request->input('judul'),
                'jenis' => $request->input('jenis'),
                'file_path' => $filePath,
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => $user->nip ?? '',
                'role' => $user->role ?? '',
            ];

            // Debugging: Lihat data sebelum disimpan
            \Log::info('Data laporan yang akan disimpan:', $data);

            // Buat entri laporan baru
            TL_Pimpinan::create($data);

            return redirect()->route('unggahLaporanPimpinan')->with('success', 'Laporan berhasil diunggah');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan laporan: ' . $e->getMessage());
            return redirect()->route('unggahLaporanPimpinan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
