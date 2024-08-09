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



    public function create()
    {
        return view('report_formats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,png,jpg|max:10240',
        ]);

       // Menyimpan nama asli file
        $originalName = $request->file('file')->getClientOriginalName();
        
        // Menyimpan file ke penyimpanan dan mengambil jalur file
        $filePath = $request->file('file')->store('report_formats');

        // Menyimpan jalur file dan nama asli file ke database
        ReportFormat::create([
            'file_path' => $filePath,
            'original_name' => $originalName,
        ]);

        return redirect()->back()->with('success', 'Format laporan berhasil di unggah');
    }

    public function download(ReportFormat $reportFormat)
    {
        if (Storage::exists($reportFormat->file_path)) {
            return Storage::download($reportFormat->file_path, $reportFormat->original_name);
        }

        return redirect()->route('report_formats.index')->with('error', 'File tidak ditemukan.');
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
