<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Sub_Kriteria;
use App\Models\M_Kriteria;

class M_Sub_KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subKriteria = M_Sub_Kriteria::paginate(10); // paginate(10) untuk mengambil 10 item per halaman
        $kriteria = M_Kriteria::all();
        if (auth()->user()->level != 0) {
            return redirect('/dashboard');
        }
        return view('layouts.m_sub_kriteria', compact('subKriteria', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required',
            'sub_kriteria_nama' => 'required',
        ]);

        $subKriteria = new M_Sub_Kriteria();
        $subKriteria->kriteria_id = $request->kriteria_id;
        $subKriteria->sub_kriteria_nama = $request->sub_kriteria_nama;
        $subKriteria->save();

        return redirect()->route('m_sub_kriteria.index')->with('success', 'Data sub kriteria berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\M_Sub_Kriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($sub_kriteria_id)
    {
        $subKriteria = M_Sub_Kriteria::findOrFail($sub_kriteria_id);
        $kriteria = M_Kriteria::all();

        return view('m_subkriteria.edit', compact('subKriteria', 'kriteria'));
    }

    public function update(Request $request, $sub_kriteria_id)
    {
    $request->validate([
        'kriteria_id' => 'required',
        'sub_kriteria_nama' => 'required',
    ]);

    $subKriteria = M_Sub_Kriteria::findOrFail($sub_kriteria_id);
    $subKriteria->kriteria_id = $request->kriteria_id;
    $subKriteria->sub_kriteria_nama = $request->sub_kriteria_nama;
    $subKriteria->save();

    return redirect()->route('m_sub_kriteria.index')->with('success', 'Data sub kriteria berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $sub_kriteria_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sub_kriteria_id)
    {
        $subKriteria = M_Sub_Kriteria::findOrFail($sub_kriteria_id);
        $subKriteria->delete();

        return redirect()->route('m_sub_kriteria.index')->with('success', 'Data sub kriteria berhasil dihapus.');
    }
}
