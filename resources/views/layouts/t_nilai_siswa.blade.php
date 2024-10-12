@extends('layouts.masterlayouts')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-left justify-content-between mb-4">
        <div class="row">
            <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
            <h1 class="h3 mb-2 text-gray-800">Data Nilai Siswa</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Table Nilai Siswa</h6>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            @foreach ($sub_kriteria as $sk)
                                <th>{{ $sk->sub_kriteria_nama }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
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
                                        $nilai_display = '-';
                                        if ($nilai) {
                                            if ($sk->sub_kriteria_nama == 'Peminatan Jurusan') {
                                                switch ($nilai->nilai_siswa_count) {
                                                    case 20:
                                                        $nilai_display = 'Teknik Sepeda Motor (TSM)';
                                                        break;
                                                    case 40:
                                                        $nilai_display = 'Teknik Komputer Jaringan (TKJ)';
                                                        break;
                                                    case 60:
                                                        $nilai_display = 'Rekayasa Perangkat Lunak (RPL)';
                                                        break;
                                                    default:
                                                        $nilai_display = '-';
                                                        break;
                                                }
                                            } elseif ($sk->sub_kriteria_nama == 'Bakat') {
                                                switch ($nilai->nilai_siswa_count) {
                                                    case 60:
                                                        $nilai_display = 'Teknik Sepeda Motor (TSM)';
                                                        break;
                                                    case 80:
                                                        $nilai_display = 'Teknik Komputer Jaringan (TKJ)';
                                                        break;
                                                    case 100:
                                                        $nilai_display = 'Rekayasa Perangkat Lunak (RPL)';
                                                        break;
                                                    default:
                                                        $nilai_display = '-';
                                                        break;
                                                }
                                            } else {
                                                $nilai_display = $nilai->nilai_siswa_count;
                                            }
                                        }
                                    @endphp
                                    <td>{{ $nilai_display }}</td>
                                @endforeach
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modalEditNilaiSiswa{{ $item->siswa_id }}" class="btn btn-warning btn-icon-split">
                                        <span class="text">Input Nilai</span>
                                    </a>
                                    @include('modal.t_nilai_siswa.t_nilai_siswa_edit')
                                    <form action="{{ route('t_nilai_siswa.destroy', $item->siswa_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon-split" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <span class="text">Hapus</span>
                                        </button>
                                    </form>
                                </td>
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
