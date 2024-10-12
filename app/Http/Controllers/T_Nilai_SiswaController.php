<?php

namespace App\Http\Controllers;

use App\Models\T_Nilai_Siswa;
use App\Models\D_Siswa;
use App\Models\M_Sub_Kriteria;
use Illuminate\Http\Request;

class T_Nilai_SiswaController extends Controller
{
    public function index()
    {
        $nilai_siswa = T_Nilai_Siswa::with(['siswa', 'subKriteria'])->get();
        $siswa = D_Siswa::all();
        $sub_kriteria = M_Sub_Kriteria::all();

        return view('layouts.t_nilai_siswa', compact('nilai_siswa', 'siswa', 'sub_kriteria'));
    }

    public function create()
    {
        $siswa = D_Siswa::all();
        $sub_kriteria = M_Sub_Kriteria::all();
        return view('t_nilai_siswa.create', compact('siswa', 'sub_kriteria'));
    }

    public function store(StoreNilaiSiswaRequest $request)
    {
        foreach ($request->sub_kriteria_id as $index => $sub_kriteria_id) {
            T_Nilai_Siswa::create([
                'siswa_id' => $request->siswa_id,
                'sub_kriteria_id' => $sub_kriteria_id,
                'nilai_siswa_count' => $request->nilai_siswa_count[$index],
                'created_by' => auth()->user()->id,
            ]);
        }

        return redirect()->route('t_nilai_siswa.index')->with('success', 'Nilai Siswa created successfully.');
    }

    public function show($id)
    {
        $siswa = D_Siswa::with('nilaiSiswa.subKriteria')->findOrFail($id);
        return view('t_nilai_siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = D_Siswa::findOrFail($id);
        $nilai_siswa = $siswa->nilaiSiswa;
        $sub_kriteria = M_Sub_Kriteria::all();
        return view('t_nilai_siswa.edit', compact('siswa', 'nilai_siswa', 'sub_kriteria'));
    }

    public function update(Request $request, $id)
    {
        $siswa = D_Siswa::findOrFail($id);
        foreach ($request->sub_kriteria_id as $index => $sub_kriteria_id) {
            $nilai_siswa = T_Nilai_Siswa::where('siswa_id', $siswa->siswa_id)
                ->where('sub_kriteria_id', $sub_kriteria_id)
                ->first();
            if ($nilai_siswa) {
                $nilai_siswa->update([
                    'nilai_siswa_count' => $request->nilai_siswa_count[$index],
                    'created_by' => auth()->user()->id,
                ]);
            } else {
                T_Nilai_Siswa::create([
                    'siswa_id' => $siswa->siswa_id,
                    'sub_kriteria_id' => $sub_kriteria_id,
                    'nilai_siswa_count' => $request->nilai_siswa_count[$index],
                    'created_by' => auth()->user()->id,
                ]);
            }
        }

        return redirect()->route('t_nilai_siswa.index')->with('success', 'Nilai Siswa updated successfully.');
    }

    public function destroy($id)
    {
        $siswa = D_Siswa::findOrFail($id);
        
        // Hapus nilai siswa dari setiap subkriteria
        foreach ($siswa->nilaiSiswa as $nilai) {
            $nilai->delete();
        }

        return redirect()->route('t_nilai_siswa.index')->with('success', 'Nilai Siswa deleted successfully.');
    }
 
}
