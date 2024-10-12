<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Jurusan;

class M_JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $jurusan = M_Jurusan::all();
        if(auth()->user()->level != 0){
            return redirect('/dashboard');
        }
        return view('layouts.m_jurusan', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('m_jurusan.create');
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
            'jurusan_kode' => 'required',
            'jurusan_nama' => 'required',
        ]);

        M_Jurusan::create($request->all());

        return redirect()->route('m_jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\M_Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(M_Jurusan $jurusan)
    {
        return view('m_jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, M_Jurusan $jurusan)
    {
        $request->validate([
            'jurusan_kode' => 'required',
            'jurusan_nama' => 'required',
        ]);

        $jurusan->update($request->all());

        return redirect()->route('m_jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\M_Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(M_Jurusan $jurusan, $jurusan_id)
    {
        $jurusan = M_Jurusan::findOrFail($jurusan_id);
        $jurusan->delete();

        return redirect()->route('m_jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}

