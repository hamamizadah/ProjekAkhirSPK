@extends('layouts.masterlayouts')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-left justify-content-between mb-4">
    <div class="row">
        <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
        <h1 class="h3 mb-2 text-gray-800">Data Hasil Akhir Rekomendasi Jurusan</h1>
    </div>
</div>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h5 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Table Nilai Akhir</h5>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('t_hasil_akhir.print') }}" class="btn btn-primary"><i class="fas fa-print mr-2"></i>Print PDF</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        @foreach ($jurusan as $item)
                        <th>{{ $item->jurusan_kode }}</th>
                        @endforeach
                        <th>Minat</th>
                        <th>Rekomendasi</th>
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
                                $nilai1 = null;
                                $nilai2 = null;
                                $nilai3 = null;
                            @endphp
                            @foreach ($hasilAkhir as $hasil)
                                @if ($hasil->siswa_id == $item->siswa_id)
                                    @php
                                        if (is_null($nilai1)) {
                                            $nilai1 = $hasil->hasil_akhir_nilai;
                                        } elseif (is_null($nilai2)) {
                                            $nilai2 = $hasil->hasil_akhir_nilai;
                                        } else {
                                            $nilai3 = $hasil->hasil_akhir_nilai;
                                        }
                                    @endphp
                                    <td>{{ $hasil->hasil_akhir_nilai }} </td>
                                @endif
                            @endforeach
                            <td>{{ $minat[$i-1] }}</td>
                            @php
                                if ($nilai1 > $nilai2 && $nilai1 > $nilai3) {
                                    $rekomendasi = 'TKJ';
                                } elseif ($nilai2 > $nilai1 && $nilai2 > $nilai3) {
                                    $rekomendasi = 'RPL';
                                } elseif ($nilai3 > $nilai1 && $nilai3 > $nilai2) {
                                    $rekomendasi = 'TSM';
                                } else {
                                    $rekomendasi = $minat[$i-1]; 
                                }
                            @endphp
                            <td>{{ $rekomendasi }}</td>
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
