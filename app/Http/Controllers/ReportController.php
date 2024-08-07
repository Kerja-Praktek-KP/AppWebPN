<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:mingguan,bulanan,tlhp_mingguan,tlhp_bulanan,tlhp,eksternal',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $filePath = $request->file('file')->store('reports');

        Report::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('reports.index')->with('success', 'Report uploaded successfully.');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
