<?php

namespace App\Http\Controllers;

use App\Models\TL_PW_Panmud_Hukum;
use Illuminate\Http\Request;

class TLPWPanmudHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = TL_PW_Panmud_Hukum::all();
        return view('tl_pw.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tl_pw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_laporan' => 'required',
            'jenis' => 'required',
            'file_path' => 'required|file',
        ]);

        $validated['file_path'] = $request->file('file_path')->store('laporan_pw');

        TL_PW_Panmud_Hukum::create($validated);

        return redirect()->route('tl_pw.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TL_PW_Panmud_Hukum $tL_PW_Panmud_Hukum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TL_PW_Panmud_Hukum $tL_PW_Panmud_Hukum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TL_PW_Panmud_Hukum $tL_PW_Panmud_Hukum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TL_PW_Panmud_Hukum $tL_PW_Panmud_Hukum)
    {
        $tL_PW_Panmud_Hukum->delete();
        return redirect()->route('tl_pw.index');
    }
}
