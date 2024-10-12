<?php

namespace App\Http\Controllers;

use App\Models\D_Siswa;
use Illuminate\Http\Request;

class D_SiswaController extends Controller
{
    public function index()
    {
        $data['siswa'] = D_Siswa::all();
        return view('layouts.d_siswa', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_no_pendaftaran' => 'required|integer|unique:d_siswa',
            'siswa_nama' => 'required|string',
            'siswa_tempat_lahir' => 'required|string',
            'siswa_tanggal_lahir' => 'required|date',
            'siswa_asal_sekolah' => 'required|string',
            'siswa_jenis_kelamin' => 'required|boolean',
        ]);

        $latestSiswa = D_Siswa::orderBy('siswa_id', 'desc')->first();
        $newSiswaId = $latestSiswa ? $latestSiswa->siswa_id + 1 : 1;

        $siswa = new D_Siswa();
        $siswa->siswa_id = $newSiswaId;  
        $siswa->siswa_no_pendaftaran = $request->input('siswa_no_pendaftaran');
        $siswa->siswa_nama = $request->input('siswa_nama');
        $siswa->siswa_tempat_lahir = $request->input('siswa_tempat_lahir');
        $siswa->siswa_tanggal_lahir = $request->input('siswa_tanggal_lahir');
        $siswa->siswa_asal_sekolah = $request->input('siswa_asal_sekolah');
        $siswa->siswa_jenis_kelamin = $request->input('siswa_jenis_kelamin');

        $siswa->save();

        return redirect()->route('d_siswa.index')->with('success', 'Siswa created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_no_pendaftaran' => 'required|integer',
            'siswa_nama' => 'required|string',
            'siswa_tempat_lahir' => 'required|string',
            'siswa_tanggal_lahir' => 'required|date',
            'siswa_asal_sekolah' => 'required|string',
            'siswa_jenis_kelamin' => 'required|boolean',
        ]);

        $siswa = D_Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('d_siswa.index')->with('success', 'Siswa updated successfully.');
    }

    public function destroy($id)
    {
        $siswa = D_Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('d_siswa.index')->with('success', 'Siswa deleted successfully.');
    }
}
