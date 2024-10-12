@extends('layouts.masterlayouts')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-left justify-content-between mb-4">
        <div class="row">
            <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
            <h1 class="h3 mb-2 text-gray-800">Data Perhitungan</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Table Nilai Siswa</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($sub_kriteria as $sk)
                                    @php
                                        $nilai = $item->nilaiSiswa->firstWhere('sub_kriteria_id', $sk->sub_kriteria_id);
                                    @endphp
                                    <td>{{ $nilai ? $nilai->nilai_siswa_count : '-' }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Konversi Nilai</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid">
                    <thead>
                        <tr role="row" >
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($nilaikonversi[$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Perhitungan Nilai Gap</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
        <h5>Perhitungan GAP Nilai TKJ</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($nilaigap[0][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan GAP Nilai RPL</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($nilaigap[1][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan GAP Nilai TSM</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($nilaigap[2][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Perhitungan Pembobotan</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
        <h5>Perhitungan Pembobotan Nilai TKJ</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($bobotan[0][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Pembobotan Nilai RPL</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($bobotan[1][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Pembobotan Nilai TSM</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @foreach ($bobotan[2][$i-1] as $nk)
                                    <td>{{ $nk }}</td>
                                @endforeach
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Perhitungan Core & Secondary Factor</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
        <h5>Perhitungan Core & Secondary Factor Nilai TKJ</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($sub_kriteria as $sk)
                                @if($i == $jumsubkrit)
                                <th>Total CF</th>
                                <th>Total SF</th>
                                @endif
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            <th>Total CF</th>
                            <th>Total SF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @php
                                    $j = 0;
                                @endphp
                                @foreach ($bobotan[0][$i-1] as $nk)
                                    @if($jumsubkrit == $j)
                                        <th>{{ $cfsf[0][0][$i-1] }}</th>
                                        <th>{{ $cfsf[0][1][$i-1] }}</th>
                                    @endif
                                    <td>{{ $nk }}</td>
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                                <th>{{ $cfsf[0][2][$i-1] }}</th>
                                <th>{{ $cfsf[0][3][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Core & Secondary Factor Nilai RPL</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($sub_kriteria as $sk)
                                @if($i == $jumsubkrit)
                                <th>Total CF</th>
                                <th>Total SF</th>
                                @endif
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            <th>Total CF</th>
                            <th>Total SF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @php
                                    $j = 0;
                                @endphp
                                @foreach ($bobotan[0][$i-1] as $nk)
                                    @if($jumsubkrit == $j)
                                        <th>{{ $cfsf[1][0][$i-1] }}</th>
                                        <th>{{ $cfsf[1][1][$i-1] }}</th>
                                    @endif
                                    <td>{{ $nk }}</td>
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                                <th>{{ $cfsf[1][2][$i-1] }}</th>
                                <th>{{ $cfsf[1][3][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Core & Secondary Factor Nilai TSM</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($sub_kriteria as $sk)
                                @if($i == $jumsubkrit)
                                <th>Total CF</th>
                                <th>Total SF</th>
                                @endif
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            <th>Total CF</th>
                            <th>Total SF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                @php
                                    $j = 0;
                                @endphp
                                @foreach ($bobotan[0][$i-1] as $nk)
                                    @if($jumsubkrit == $j)
                                        <th>{{ $cfsf[2][0][$i-1] }}</th>
                                        <th>{{ $cfsf[2][1][$i-1] }}</th>
                                    @endif
                                    <td>{{ $nk }}</td>
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                                <th>{{ $cfsf[2][2][$i-1] }}</th>
                                <th>{{ $cfsf[2][3][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Perhitungan Hasil Akhir Jurusan</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
        <h5>Perhitungan Hasil Akhir Jurusan TKJ</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Akademik</th>
                            <th>Non Akademik</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                <th>{{ $cfsf[0][0][$i-1] + $cfsf[0][1][$i-1] }}</th>
                                <th>{{ $cfsf[0][2][$i-1] + $cfsf[0][3][$i-1] }}</th>
                                <th>{{ $nilaiakhir[0][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Hasil Akhir Jurusan RPL</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Akademik</th>
                            <th>Non Akademik</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                <th>{{ $cfsf[1][0][$i-1] + $cfsf[1][1][$i-1] }}</th>
                                <th>{{ $cfsf[1][2][$i-1] + $cfsf[1][3][$i-1] }}</th>
                                <th>{{ $nilaiakhir[1][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-body">
            <h5>Perhitungan Hasil Akhir Jurusan TSM</h5>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Akademik</th>
                            <th>Non Akademik</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($siswa as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                <th>{{ $cfsf[2][0][$i-1] + $cfsf[2][1][$i-1] }}</th>
                                <th>{{ $cfsf[2][2][$i-1] + $cfsf[2][3][$i-1] }}</th>
                                <th>{{ $nilaiakhir[2][$i-1] }}</th>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
@endsection
