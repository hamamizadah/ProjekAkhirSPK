<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Kriteria;

class M_KriteriaController extends Controller
{
    /**
     * Menampilkan semua data kriteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = M_Kriteria::all();
        if(auth()->user()->level != 0){
            return redirect('/dashboard');
        }
        return view('layouts.m_kriteria', compact('kriteria'));
    }

    /**
     * Menyimpan data kriteria baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_nama' => 'required',

            
        ]);

        M_Kriteria::create([
            'kriteria_nama' => $request->kriteria_nama,
            
        ]);

        return redirect()->route('m_kriteria.index')->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data kriteria.
     *
     * @param  \App\Models\M_Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(M_Kriteria $kriteria)
    {
        return view('m_kriteria.edit', compact('kriteria'));
    }

    /**
     * Memperbarui data kriteria yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kriteria_id)
    {
        $request->validate([
            
            'kriteria_nama' => 'required',

            
        ]);

        
            $kriteria = M_Kriteria::findOrFail($kriteria_id);
            $kriteria->kriteria_nama = $request->kriteria_nama;
            $kriteria->save();
            

        return redirect()->route('m_kriteria.index')->with('success', 'Data kriteria berhasil diperbarui.');
    }


    /**
     * Menampilkan detail data kriteria.
     *
     * @param  \App\Models\M_Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(M_Kriteria $kriteria)
    {
        $kriteria = M_Kriteria::all();
        return view('layouts.m_kriteria', compact('kriteria'));
    }

    /**
     * Menghapus data kriteria yang sudah ada.
     *
     * @param  \App\Models\M_Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(M_Kriteria $kriteria, $kriteria_id)
    {
        $kriteria = M_Kriteria::findOrFail($kriteria_id);
        $kriteria->delete();

        return redirect()->route('m_kriteria.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}