<?php

namespace App\Http\Controllers;

use App\Models\ReportFormat;
use Illuminate\Http\Request;

class ReportFormatController extends Controller
{
    public function index()
    {
        $formats = ReportFormat::all();
        return view('report_formats.index', compact('formats'));
    }

    public function create()
    {
        return view('report_formats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $filePath = $request->file('file')->store('report_formats');

        ReportFormat::create([
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Report format uploaded successfully.');
    }

    public function destroy(ReportFormat $reportFormat)
    {
        $reportFormat->delete();
        return redirect()->route('report_formats.index')->with('success', 'Report format deleted successfully.');
    }
}