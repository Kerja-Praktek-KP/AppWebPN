<?php

namespace App\Http\Controllers;

use App\Models\TL_Pimpinan;
use Illuminate\Http\Request;

class TLPimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = TL_Pimpinan::all();
        return view('tl_pimpinan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tl_pimpinan.create');
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

        $validated['file_path'] = $request->file('file_path')->store('laporan_pimpinan');

        TL_Pimpinan::create($validated);

        return redirect()->route('tl_pimpinan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TL_Pimpinan $tL_Pimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TL_Pimpinan $tL_Pimpinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TL_Pimpinan $tL_Pimpinan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TL_Pimpinan $tL_Pimpinan)
    {
        $tL_Pimpinan->delete();
        return redirect()->route('tl_pimpinan.index');
    }
}
