<?php

namespace App\Http\Controllers;

use App\Models\TL_Koordinator_Pengawas;
use Illuminate\Http\Request;

class TLKoordinatorPengawasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = TL_Koordinator_Pengawas::all();
        return view('tl_koordinator_pengawas.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tl_koordinator_pengawas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_laporan' => 'required',
            'tanggal_laporan' => 'required|date',
            'file_path' => 'required|file',
        ]);

        $validated['file_path'] = $request->file('file_path')->store('laporan_koordinator_pengawas');

        TL_Koordinator_Pengawas::create($validated);

        return redirect()->route('tl_koordinator_pengawas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TL_Koordinator_Pengawas $tL_Koordinator_Pengawas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TL_Koordinator_Pengawas $tL_Koordinator_Pengawas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TL_Koordinator_Pengawas $tL_Koordinator_Pengawas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TL_Koordinator_Pengawas $tL_Koordinator_Pengawas)
    {
        $tL_Koordinator_Pengawas->delete();
        return redirect()->route('tl_koordinator_pengawas.index');
    }
}
