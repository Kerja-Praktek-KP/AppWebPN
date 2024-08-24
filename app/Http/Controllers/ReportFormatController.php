<?php

namespace App\Http\Controllers;

use App\Models\ReportFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class ReportFormatController extends Controller
{
    public function index()
    {
        $formats = ReportFormat::all();
        // dd($formats); // Memastikan data sudah benar sebelum dikirim ke view
        return view('Super Admin.formatLaporan', compact('formats'));
    }

    public function indexPemberiLaporan()
    {
        $formats = ReportFormat::all();
        // dd($formats); // Memastikan data sudah benar sebelum dikirim ke view
        return view('Pemberi Laporan.unggahLaporan', compact('formats'));
    }



    public function create()
    {
        return view('report_formats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:10240',
        ], [
            'file.mimes' => 'Format file tidak didukung.',
            'file.max' => 'Ukuran file terlalu besar.',
            'file.required' => 'File yang diunggah tidak ada.',
        ]);
    
        // Hapus format laporan lama jika ada
        $existingFormat = ReportFormat::first(); // Asumsikan hanya ada satu format laporan yang disimpan
        if ($existingFormat) {
            if (Storage::exists($existingFormat->file_path)) {
                Storage::delete($existingFormat->file_path);
            }
            $existingFormat->delete();
        }
    
        // Mendapatkan nama asli file tanpa ekstensi
        $originalName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
    
        // Mendapatkan ekstensi file
        $extension = $request->file('file')->getClientOriginalExtension();
    
        // Membuat nama file baru dengan menambahkan tanggal, bulan, dan tahun
        $dateSuffix = '_'.date('d_m_Y');
        $newFileName = $originalName . $dateSuffix . '.' . $extension;
    
        // Simpan file dengan nama baru ke direktori 'report_formats'
        $filePath = $request->file('file')->storeAs('report_formats', $newFileName);
    
        // Menyimpan jalur file dan nama asli file ke database
        ReportFormat::create([
            'file_path' => $filePath, // Path dengan nama baru
            'original_name' => $newFileName,
        ]);
    
        return redirect()->back()->with('success', 'Format laporan berhasil diunggah.');
    }
    

    public function download()
    {
        $reportFormat = ReportFormat::first(); // Mengambil satu-satunya file format laporan

        if ($reportFormat && Storage::exists($reportFormat->file_path)) {
            // Memisahkan nama file asli berdasarkan underscore (_)
            $parts = explode('_', pathinfo($reportFormat->original_name, PATHINFO_FILENAME));
            
            // Hapus 3 bagian terakhir (tanggal, bulan, tahun) jika ada
            array_pop($parts); // Hapus bagian tahun
            array_pop($parts); // Hapus bagian bulan
            array_pop($parts); // Hapus bagian tanggal

            // Gabungkan kembali nama file tanpa tanggal, bulan, dan tahun
            $fileNameWithoutDate = implode('_', $parts);
            
            // Tambahkan ekstensi file asli
            $fileNameWithExtension = $fileNameWithoutDate . '.' . pathinfo($reportFormat->original_name, PATHINFO_EXTENSION);

            // Mengunduh file dengan nama baru
            return Storage::download($reportFormat->file_path, $fileNameWithExtension);
        }

        return redirect()->route('formatLaporan.index')->with('error', 'File tidak ditemukan.');
    }


    public function destroyAll()
    {
        $formats = ReportFormat::all();

        foreach ($formats as $format) {
            if (Storage::exists($format->file_path)) {
                Storage::delete($format->file_path);
            }
            $format->delete();
        }

        return redirect()->route('report_formats.index')->with('success', 'All report formats deleted successfully.');
    }

    public function destroy(ReportFormat $reportFormat)
    {
        if (Storage::exists($reportFormat->file_path)) {
            Storage::delete($reportFormat->file_path);
            $reportFormat->delete();
            return redirect()->route('report_formats.index')->with('success', 'Report format deleted successfully.');
        }

        return redirect()->route('report_formats.index')->with('error', 'File not found.');
    }
}
