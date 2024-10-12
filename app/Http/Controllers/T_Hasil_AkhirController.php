<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\D_Siswa;
use App\Models\T_Hasil_Akhir;
use App\Models\M_Jurusan;
use Barryvdh\DomPDF\Facade\Pdf;

class T_Hasil_AkhirController extends Controller
{
    public function index()
    {
        $hasilAkhir = T_Hasil_Akhir::all();
        $siswa = D_Siswa::all();
        $jurusan = M_Jurusan::all();

        $nilsiswa = DB::table('t_nilai_siswa')
            ->select('siswa_id', DB::raw('GROUP_CONCAT(nilai_siswa_count SEPARATOR ", ") as nilai_siswa_count'))
            ->groupBy('siswa_id')
            ->get();
        $arrayNilaiSiswa = [];
        foreach ($nilsiswa as $data) {
            $arrayNilaiSiswa[] = explode(', ', $data->nilai_siswa_count);
        }

        $nilaikonversi = $this->konversinilai($arrayNilaiSiswa);

        for ($i = 0; $i < count($arrayNilaiSiswa); $i++) {
            if($nilaikonversi[$i][4] == 2){
                $minat[$i] = 'TKJ';
            }elseif($nilaikonversi[$i][4] == 3){
                $minat[$i] = 'RPL';
            }else{
                $minat[$i] = 'TSM';
            }
        }

        return view('layouts.hasilakhir', compact('hasilAkhir','siswa','jurusan','minat',));
    }

    public function create()
    {
        return view('t_hasil_akhir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:d_siswa,id',
            'jurusan_id' => 'required|exists:m_jurusan,id',
            'hasil_akhir_nilai' => 'required|integer',
            'created_by' => 'nullable|integer',
        ]);

        T_Hasil_Akhir::create($request->all());

        return redirect()->route('t_hasil_akhir.index')->with('success', 'Hasil Akhir berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $hasilAkhir = T_Hasil_Akhir::find($id);
        return view('t_hasil_akhir.edit', compact('hasilAkhir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required|exists:d_siswa,id',
            'jurusan_id' => 'required|exists:m_jurusan,id',
            'hasil_akhir_nilai' => 'required|integer',
            'created_by' => 'nullable|integer',
        ]);

        $hasilAkhir = T_Hasil_Akhir::find($id);
        $hasilAkhir->update($request->all());

        return redirect()->route('t_hasil_akhir.index')->with('success', 'Hasil Akhir berhasil diubah.');
    }

    public function destroy($id)
    {
        $hasilAkhir = T_Hasil_Akhir::find($id);
        $hasilAkhir->delete();

        return redirect()->route('t_hasil_akhir.index')->with('success', 'Hasil Akhir berhasil dihapus.');
    }

    public function konversinilai($nilaiawal){
        for ($i = 0; $i < count($nilaiawal); $i++) {
            for ($j = 0; $j < count($nilaiawal[$i]); $j++) {
                $nilai = $nilaiawal[$i][$j];
                switch (true) {
                    case ($nilai == 0):
                        $nilaiawal[$i][$j] = 0;
                        break;
                    case ($nilai <= 20):
                        $nilaiawal[$i][$j] = 1;
                        break;
                    case ($nilai <= 40):
                        $nilaiawal[$i][$j] = 2;
                        break;
                    case ($nilai <= 60):
                        $nilaiawal[$i][$j] = 3;
                        break;
                    case ($nilai <= 80):
                        $nilaiawal[$i][$j] = 4;
                        break;
                    default:
                        $nilaiawal[$i][$j] = 5;
                        break;
                }
            }
        }
        return $nilaiawal;
     }

    public function print()
    {
        $siswa = D_Siswa::all();
        $jurusan = M_Jurusan::all();
        $hasilAkhir = T_Hasil_Akhir::all();
        $nilsiswa = DB::table('t_nilai_siswa')
            ->select('siswa_id', DB::raw('GROUP_CONCAT(nilai_siswa_count SEPARATOR ", ") as nilai_siswa_count'))
            ->groupBy('siswa_id')
            ->get();
        $arrayNilaiSiswa = [];
        foreach ($nilsiswa as $data) {
            $arrayNilaiSiswa[] = explode(', ', $data->nilai_siswa_count);
        }

        $nilaikonversi = $this->konversinilai($arrayNilaiSiswa);

        for ($i = 0; $i < count($arrayNilaiSiswa); $i++) {
            if($nilaikonversi[$i][4] == 2){
                $minat[$i] = 'TKJ';
            }elseif($nilaikonversi[$i][4] == 3){
                $minat[$i] = 'RPL';
            }else{
                $minat[$i] = 'TSM';
            }
        }

        $pdf = Pdf::loadView('print', compact('siswa', 'jurusan', 'hasilAkhir', 'minat'));
        return $pdf->download('hasil_akhir.pdf');
    }
}
