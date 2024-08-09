<?php

namespace App\Http\Controllers;

use App\Models\TL_PL_Panmud_Perdata;
use Illuminate\Http\Request;

class TLPLPanmudPerdataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = TL_PL_Panmud_Perdata::all();
        return view('tl_pl.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tl_pl.create');
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

        $validated['file_path'] = $request->file('file_path')->store('laporan_pl');

        TL_PL_Panmud_Perdata::create($validated);

        return redirect()->route('tl_pl.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TL_PL_Panmud_Perdata $tL_PL_Panmud_Perdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TL_PL_Panmud_Perdata $tL_PL_Panmud_Perdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TL_PL_Panmud_Perdata $tL_PL_Panmud_Perdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TL_PL_Panmud_Perdata $tL_PL_Panmud_Perdata)
    {
        $tL_PL_Panmud_Perdata->delete();
        return redirect()->route('tl_pl.index');
    }
}
