<?php

namespace App\Http\Controllers;

use App\Models\Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan;
use Illuminate\Http\Request;

class TemuanPWSubBagPerencanaanTIDanPelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temuans = Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan::all();
        return view('temuan_pw.index', compact('temuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('temuan_pw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_temuan' => 'required',
            'jenis' => 'required',
            'file_path' => 'required|file',
        ]);

        $validated['file_path'] = $request->file('file_path')->store('temuan_pw');

        Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan::create($validated);

        return redirect()->route('temuan_pw.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan $temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan $temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan $temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan $temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan)
    {
        $temuan_PW_Sub_Bag_Perencanaan_TI_dan_Pelaporan->delete();
        return redirect()->route('temuan_pw.index');
    }
}
