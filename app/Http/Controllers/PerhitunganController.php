<?php

namespace App\Http\Controllers;

use App\Models\T_Hasil_Akhir;
use App\Models\T_Nilai_Siswa;
use App\Models\D_Siswa;
use App\Models\M_Sub_Kriteria;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    
    public function index(){
        if(auth()->user()->level != 0){
            return redirect('/dashboard');
        }
        $nilai_siswa = T_Nilai_Siswa::with(['siswa', 'subKriteria'])->get();

        $nilsiswa = DB::table('t_nilai_siswa')
            ->select('siswa_id', DB::raw('GROUP_CONCAT(nilai_siswa_count SEPARATOR ", ") as nilai_siswa_count'))
            ->groupBy('siswa_id')
            ->get();
        $arrayNilaiSiswa = [];
        foreach ($nilsiswa as $data) {
            // Tambahkan data ke dalam array
            $arrayNilaiSiswa[] = explode(', ', $data->nilai_siswa_count);
        }

        $gap = DB::table('t_profile_jurusan')
            ->select('jurusan_id', DB::raw('GROUP_CONCAT(profile_nilai_target SEPARATOR ", ") as profile_nilai_target'))
            ->groupBy('jurusan_id')
            ->get();
        $arraygap = [];
        foreach ($gap as $data) {
            // Tambahkan data ke dalam array
            $arraygap[] = explode(', ', $data->profile_nilai_target);
        }

        $core = DB::table('t_profile_jurusan')
            ->select('jurusan_id', DB::raw('GROUP_CONCAT(profile_core SEPARATOR ", ") as profile_core'))
            ->groupBy('jurusan_id')
            ->get();
        $arraycore = [];
        foreach ($core as $data) {
            // Tambahkan data ke dalam array
            $arraycore[] = explode(', ', $data->profile_core);
        }
        for ($i = 0; $i < count($arraycore); $i++) {
            for ($j = 0; $j < count($arraycore[$i]); $j++) {
                if($arraycore[$i][$j] == 0.6){
                    $arraycore[$i][$j] = 1;
                }else{
                    $arraycore[$i][$j] = 0;
                }
            }
        }

        $D_siswa = D_Siswa::all();
        $siswa  = [];
        for($i=0;$i<count($arrayNilaiSiswa);$i++){
            $siswa[$i] = $D_siswa[$i];
        }
        $sub_kriteria = M_Sub_Kriteria::all();
        $jumsubkrit = M_Sub_Kriteria::where('kriteria_id', 1)->count();

        $nilaikonversi = $this->konversinilai($arrayNilaiSiswa);
        $nilaigap = $this->nilaigap($nilaikonversi,$arraygap[0],$arraygap[1],$arraygap[2]);
        $bobotan = $this->pembobotan($nilaikonversi,$nilaigap[0],$nilaigap[1],$nilaigap[2]);
        $cfsf = $this->cfsf($nilaikonversi,$bobotan[0],$bobotan[1],$bobotan[2],$jumsubkrit,$arraycore[0],$arraycore[1],$arraycore[2]);

        $nilaiakhir = [];
        for ($i = 0; $i < count($cfsf); $i++) {
            $innerArrayLength = count($cfsf[$i][0]); 
            $nilaiakhir[$i] = []; 
    
            for ($j = 0; $j < $innerArrayLength; $j++) {
                $nilai = 0;
                for ($k = 0; $k < count($cfsf[$i]); $k++) {
                    $nilai += $cfsf[$i][$k][$j];
                }
                $nilaiakhir[$i][$j] = $nilai; 
            }
        }

        $hasilakhir = T_Hasil_Akhir::all();

        if ($hasilakhir->isEmpty()) {
            for ($i = 0; $i < count($nilaiakhir); $i++) {
                for ($j = 0; $j < count($nilaiakhir[$i]); $j++) {
                    $idsis = $j + 1;
                    $idjur = $i + 1;
                    T_Hasil_Akhir::create([
                        'siswa_id' => $idsis,
                        'jurusan_id' => $idjur,
                        'hasil_akhir_nilai' => $nilaiakhir[$i][$j],
                    ]);
                }
            }
        }else{
            T_Hasil_Akhir::truncate();
            for ($i = 0; $i < count($nilaiakhir); $i++) {
                for ($j = 0; $j < count($nilaiakhir[$i]); $j++) {
                    $idsis = $j + 1;
                    $idjur = $i + 1;
                    T_Hasil_Akhir::create([
                        'siswa_id' => $idsis,
                        'jurusan_id' => $idjur,
                        'hasil_akhir_nilai' => $nilaiakhir[$i][$j],
                    ]);
                }
            }
        }

        return view('layouts.perhitungan', compact('nilai_siswa', 'siswa', 'sub_kriteria','nilaikonversi','nilaigap','bobotan','cfsf','nilaiakhir','jumsubkrit'));
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

     public function nilaigap($nilaiawal,$targettkj,$targetrpl,$targettsm){
        // $targettkj = [4	,2	,4	,3	,2	,4	,5];
        // $targetrpl = [5	,2	,4	,3	,3	,4	,5];
        // $targettsm = [4	,4	,3	,3	,1	,4	,5];

        for ($i = 0; $i < count($nilaiawal); $i++) {
            for ($j = 0; $j < count($nilaiawal[$i]); $j++) {
                $nilaigaptkj[$i][$j] = $nilaiawal[$i][$j] - $targettkj[$j];
                $nilaigaprpl[$i][$j] = $nilaiawal[$i][$j] - $targetrpl[$j];
                $nilaigaptsm[$i][$j] = $nilaiawal[$i][$j] - $targettsm[$j];
            }
        }

        return array($nilaigaptkj, $nilaigaprpl, $nilaigaptsm);
     }

     public function pembobotan($nilaiawal,$nilaigaptkj,$nilaigaprpl,$nilaigaptsm){
        for ($i = 0; $i < count($nilaiawal); $i++) {
            for ($j = 0; $j < count($nilaiawal[$i]); $j++) {
                $nilai = $nilaigaptkj[$i][$j];
                switch (true) {
                    case ($nilai == 0):
                        $bobottkj[$i][$j] = 5;
                        break;
                    case ($nilai == 1):
                        $bobottkj[$i][$j] = 4.5;
                        break;
                    case ($nilai == -1):
                        $bobottkj[$i][$j] = 4;
                        break;
                    case ($nilai == 2):
                        $bobottkj[$i][$j] = 3.5;
                        break;
                    case ($nilai == -2):
                        $bobottkj[$i][$j] = 3;
                        break;
                    case ($nilai == 3):
                        $bobottkj[$i][$j] = 2.5;
                        break;
                    case ($nilai == -3):
                        $bobottkj[$i][$j] = 2;
                        break;
                    case ($nilai == 4):
                        $bobottkj[$i][$j] = 1.5;
                        break;
                    default:
                        $bobottkj[$i][$j] = 1;
                        break;
                }
                $nilai = $nilaigaprpl[$i][$j];
                switch (true) {
                    case ($nilai == 0):
                        $bobotrpl[$i][$j] = 5;
                        break;
                    case ($nilai == 1):
                        $bobotrpl[$i][$j] = 4.5;
                        break;
                    case ($nilai == -1):
                        $bobotrpl[$i][$j] = 4;
                        break;
                    case ($nilai == 2):
                        $bobotrpl[$i][$j] = 3.5;
                        break;
                    case ($nilai == -2):
                        $bobotrpl[$i][$j] = 3;
                        break;
                    case ($nilai == 3):
                        $bobotrpl[$i][$j] = 2.5;
                        break;
                    case ($nilai == -3):
                        $bobotrpl[$i][$j] = 2;
                        break;
                    case ($nilai == 4):
                        $bobotrpl[$i][$j] = 1.5;
                        break;
                    default:
                        $bobotrpl[$i][$j] = 1;
                        break;
                }

                $nilai = $nilaigaptsm[$i][$j];
                switch (true) {
                    case ($nilai == 0):
                        $bobottsm[$i][$j] = 5;
                        break;
                    case ($nilai == 1):
                        $bobottsm[$i][$j] = 4.5;
                        break;
                    case ($nilai == -1):
                        $bobottsm[$i][$j] = 4;
                        break;
                    case ($nilai == 2):
                        $bobottsm[$i][$j] = 3.5;
                        break;
                    case ($nilai == -2):
                        $bobottsm[$i][$j] = 3;
                        break;
                    case ($nilai == 3):
                        $bobottsm[$i][$j] = 2.5;
                        break;
                    case ($nilai == -3):
                        $bobottsm[$i][$j] = 2;
                        break;
                    case ($nilai == 4):
                        $bobottsm[$i][$j] = 1.5;
                        break;
                    default:
                        $bobottsm[$i][$j] = 1;
                        break;
                }
            }
        }
        
        return array($bobottkj,$bobotrpl,$bobottsm);
     }
     
     public function cfsf($nilaiawal,$bobottkj,$bobotrpl,$bobottsm,$jumkritakdmk,$cfsfakdmktkj,$cfsfakdmkrpl,$cfsfakdmktsm){
        // $jumkritakdmk = 4;
        // $cfsfakdmktkj = [1,0,1,0,1,1,0];
        // $cfsfakdmkrpl = [1,0,1,0,1,1,0];
        // $cfsfakdmktsm = [1,1,0,0,1,1,0];
        for ($i = 0; $i < count($nilaiawal); $i++) {
            $k1 = 0; $k2 = 0; $k3 = 0;
            $l1 = 0; $l2 = 0; $l3 = 0;
            $m1 = 0; $m2 = 0; $m3 = 0;
            $n1 = 0; $n2 = 0; $n3 = 0;
            for ($j = 0; $j < count($nilaiawal[$i]); $j++) {
                if($j < $jumkritakdmk){
                    if($cfsfakdmktkj[$j] == 1){
                        $cfakdmktkj[$i][$k1] = $bobottkj[$i][$j];
                        $k1 += 1;
                    }else{
                        $sfakdmktkj[$i][$l1] = $bobottkj[$i][$j];
                        $l1 += 1;
                    }
                }else{
                    if($cfsfakdmktkj[$j] == 1){
                        $cfnonakdmktkj[$i][$m1] = $bobottkj[$i][$j];
                        $m1 += 1;
                    }else{
                        $sfnonakdmktkj[$i][$n1] = $bobottkj[$i][$j];
                        $n1 += 1;
                    }
                }
                if($j < $jumkritakdmk){
                    if($cfsfakdmkrpl[$j] == 1){
                        $cfakdmkrpl[$i][$k2] = $bobotrpl[$i][$j];
                        $k2 += 1;
                    }else{
                        $sfakdmkrpl[$i][$l2] = $bobotrpl[$i][$j];
                        $l2 += 1;
                    }
                }else{
                    if($cfsfakdmkrpl[$j] == 1){
                        $cfnonakdmkrpl[$i][$m2] = $bobotrpl[$i][$j];
                        $m2 += 1;
                    }else{
                        $sfnonakdmkrpl[$i][$n2] = $bobotrpl[$i][$j];
                        $n2 += 1;
                    }
                }
                if($j < $jumkritakdmk){
                    if($cfsfakdmktsm[$j] == 1){
                        $cfakdmktsm[$i][$k3] = $bobottsm[$i][$j];
                        $k3 += 1;
                    }else{
                        $sfakdmktsm[$i][$l3] = $bobottsm[$i][$j];
                        $l3 += 1;
                    }
                }else{
                    if($cfsfakdmktsm[$j] == 1){
                        $cfnonakdmktsm[$i][$m3] = $bobottsm[$i][$j];
                        $m3 += 1;
                    }else{
                        $sfnonakdmktsm[$i][$n3] = $bobottsm[$i][$j];
                        $n3 += 1;
                    }
                }
            }
        }

        for ($i = 0; $i < count($cfakdmktkj); $i++) {
            $totalcfakdmktkj[$i] = 0;
            for ($j = 0; $j < count($cfakdmktkj[$i]); $j++) {
                $totalcfakdmktkj[$i] += $cfakdmktkj[$i][$j];
            }
        }
        for ($i = 0; $i < count($cfnonakdmktkj); $i++) {
            $totalcfnonakdmktkj[$i] = 0;
            for ($j = 0; $j < count($cfnonakdmktkj[$i]); $j++) {
                $totalcfnonakdmktkj[$i] += $cfnonakdmktkj[$i][$j];
            }
        }
        for ($i = 0; $i < count($cfakdmkrpl); $i++) {
            $totalcfakdmkrpl[$i] = 0;
            for ($j = 0; $j < count($cfakdmkrpl[$i]); $j++) {
                $totalcfakdmkrpl[$i] += $cfakdmkrpl[$i][$j];
            }
        }
        for ($i = 0; $i < count($cfnonakdmkrpl); $i++) {
            $totalcfnonakdmkrpl[$i] = 0;
            for ($j = 0; $j < count($cfnonakdmkrpl[$i]); $j++) {
                $totalcfnonakdmkrpl[$i] += $cfnonakdmkrpl[$i][$j];
            }
        }
        for ($i = 0; $i < count($cfakdmktsm); $i++) {
            $totalcfakdmktsm[$i] = 0;
            for ($j = 0; $j < count($cfakdmktsm[$i]); $j++) {
                $totalcfakdmktsm[$i] += $cfakdmktsm[$i][$j];
            }
        }
        for ($i = 0; $i < count($cfnonakdmktsm); $i++) {
            $totalcfnonakdmktsm[$i] = 0;
            for ($j = 0; $j < count($cfnonakdmktsm[$i]); $j++) {
                $totalcfnonakdmktsm[$i] += $cfnonakdmktsm[$i][$j];
            }
        }

        for ($i = 0; $i < count($cfakdmktkj); $i++) {
            $totalcfakdmktkj[$i] = ($totalcfakdmktkj[$i] / count($cfakdmktkj[$i])) * 0.6;
        }
        for ($i = 0; $i < count($cfnonakdmktkj); $i++) {
            $totalcfnonakdmktkj[$i] = ($totalcfnonakdmktkj[$i] / count($cfnonakdmktkj[$i])) * 0.6;
        }
        for ($i = 0; $i < count($cfakdmkrpl); $i++) {
            $totalcfakdmkrpl[$i] = ($totalcfakdmkrpl[$i] / count($cfakdmkrpl[$i])) * 0.6;
        }
        for ($i = 0; $i < count($cfnonakdmkrpl); $i++) {
            $totalcfnonakdmkrpl[$i] = ($totalcfnonakdmkrpl[$i] / count($cfnonakdmkrpl[$i])) * 0.6;
        }
        for ($i = 0; $i < count($cfakdmktsm); $i++) {
            $totalcfakdmktsm[$i] = ($totalcfakdmktsm[$i] / count($cfakdmktsm[$i])) * 0.6;
        }
        for ($i = 0; $i < count($cfnonakdmktsm); $i++) {
            $totalcfnonakdmktsm[$i] = ($totalcfnonakdmktsm[$i] / count($cfnonakdmktsm[$i])) * 0.6;
        }

        for ($i = 0; $i < count($sfakdmktkj); $i++) {
            $totalsfakdmktkj[$i] = 0;
            for ($j = 0; $j < count($sfakdmktkj[$i]); $j++) {
                $totalsfakdmktkj[$i] += $sfakdmktkj[$i][$j];
            }
        }
        for ($i = 0; $i < count($sfnonakdmktkj); $i++) {
            $totalsfnonakdmktkj[$i] = 0;
            for ($j = 0; $j < count($sfnonakdmktkj[$i]); $j++) {
                $totalsfnonakdmktkj[$i] += $sfnonakdmktkj[$i][$j];
            }
        }
        for ($i = 0; $i < count($sfakdmkrpl); $i++) {
            $totalsfakdmkrpl[$i] = 0;
            for ($j = 0; $j < count($sfakdmkrpl[$i]); $j++) {
                $totalsfakdmkrpl[$i] += $sfakdmkrpl[$i][$j];
            }
        }
        for ($i = 0; $i < count($sfnonakdmkrpl); $i++) {
            $totalsfnonakdmkrpl[$i] = 0;
            for ($j = 0; $j < count($sfnonakdmkrpl[$i]); $j++) {
                $totalsfnonakdmkrpl[$i] += $sfnonakdmkrpl[$i][$j];
            }
        }
        for ($i = 0; $i < count($sfakdmktsm); $i++) {
            $totalsfakdmktsm[$i] = 0;
            for ($j = 0; $j < count($sfakdmktsm[$i]); $j++) {
                $totalsfakdmktsm[$i] += $sfakdmktsm[$i][$j];
            }
        }
        for ($i = 0; $i < count($sfnonakdmktsm); $i++) {
            $totalsfnonakdmktsm[$i] = 0;
            for ($j = 0; $j < count($sfnonakdmktsm[$i]); $j++) {
                $totalsfnonakdmktsm[$i] += $sfnonakdmktsm[$i][$j];
            }
        }

        for ($i = 0; $i < count($sfakdmktkj); $i++) {
            $totalsfakdmktkj[$i] = ($totalsfakdmktkj[$i] / count($sfakdmktkj[$i])) * 0.4;
        }
        for ($i = 0; $i < count($sfnonakdmktkj); $i++) {
            $totalsfnonakdmktkj[$i] = ($totalsfnonakdmktkj[$i] / count($sfnonakdmktkj[$i])) * 0.4;
        }
        for ($i = 0; $i < count($sfakdmkrpl); $i++) {
            $totalsfakdmkrpl[$i] = ($totalsfakdmkrpl[$i] / count($sfakdmkrpl[$i])) * 0.4;
        }
        for ($i = 0; $i < count($sfnonakdmkrpl); $i++) {
            $totalsfnonakdmkrpl[$i] = ($totalsfnonakdmkrpl[$i] / count($sfnonakdmkrpl[$i])) * 0.4;
        }
        for ($i = 0; $i < count($sfakdmktsm); $i++) {
            $totalsfakdmktsm[$i] = ($totalsfakdmktsm[$i] / count($sfakdmktsm[$i])) * 0.4;
        }
        for ($i = 0; $i < count($sfnonakdmktsm); $i++) {
            $totalsfnonakdmktsm[$i] = ($totalsfnonakdmktsm[$i] / count($sfnonakdmktsm[$i])) * 0.4;
        }
        
        return array(
            array($totalcfakdmktkj, $totalsfakdmktkj, $totalcfnonakdmktkj, $totalsfnonakdmktkj),
            array($totalcfakdmkrpl, $totalsfakdmkrpl, $totalcfnonakdmkrpl, $totalsfnonakdmkrpl),
            array($totalcfakdmktsm, $totalsfakdmktsm, $totalcfnonakdmktsm, $totalsfnonakdmktsm)
        );        
     }
}
