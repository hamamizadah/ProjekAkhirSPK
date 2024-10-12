<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_Profile_Jurusan;
use App\Models\M_Jurusan;
use App\Models\M_Sub_Kriteria;

class T_Profile_JurusanController extends Controller
{
    public function index()
    {
        // Mengambil data profile jurusan dengan relasi jurusan dan subkriteria
        $profiles = T_Profile_Jurusan::with(['jurusan', 'subKriteria'])->get();
        
        // Mengelompokkan profile berdasarkan jurusan
        $groupedProfiles = $profiles->groupBy('jurusan.jurusan_nama');

        $jurusan = M_Jurusan::all();
        $sub_kriteria = M_Sub_Kriteria::all();
        if(auth()->user()->level != 0){
            return redirect('/dashboard');
        }
        
        return view('layouts.t_profile_jurusan', compact('groupedProfiles', 'jurusan', 'sub_kriteria'));
    }

    public function create()
    {
        $jurusan = M_Jurusan::all();
        $sub_kriteria = M_SubKriteria::all();
        return view('t_profile_jurusan.create', compact('jurusan', 'sub_kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'sub_kriteria_id' => 'required',
            'profile_nilai_target' => 'required|integer',
            'profile_core' => 'required|numeric'
        ]);

        T_Profile_Jurusan::create($request->all());

        return redirect()->route('t_profile_jurusan.index');
    }

    public function edit($profile_id)
    {
        $profile = T_Profile_Jurusan::findOrFail($profile_id);
        $jurusan = M_Jurusan::all();
        $sub_kriteria = M_Sub_Kriteria::all();
        return view('t_profile_jurusan.edit', compact('profile', 'jurusan', 'sub_kriteria'));
    }

    public function update(Request $request, $profile_id)
    {
        $request->validate([
            'jurusan_id' => 'required',
            'sub_kriteria_id' => 'required',
            'profile_nilai_target' => 'required|integer',
            'profile_core' => 'required|numeric'
        ]);

        $profile = T_Profile_Jurusan::findOrFail($profile_id);
        $profile->update($request->all());

        return redirect()->route('t_profile_jurusan.index');
    }

    public function destroy($profile_id)
    {
        $profile = T_Profile_Jurusan::findOrFail($profile_id);
        $profile->delete();

        return redirect()->route('t_profile_jurusan.index');
    }
}
