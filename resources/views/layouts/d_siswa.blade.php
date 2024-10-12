@extends('layouts.masterlayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-left justify-content-between mb-4">
        <div class="row">
            <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
            <h1 class="h3 mb-2 text-gray-800">Data Siswa</h1>
        </div>
    </div>

    <!-- Modal Input -->
    @include('modal.d_siswa.d_siswa_input')

    <!-- Modal Edit -->
    @foreach ($siswa as $item)
        @include('modal.d_siswa.d_siswa_edit', ['siswa' => $item])
    @endforeach

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Siswa</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#" data-toggle="modal" data-target="#modalTambahDSiswa"
                        class="d-none d-sm-inline-block btn btn-success btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Tambah
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Asal Sekolah</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Asal Sekolah</th>
                            <th>Jenis Kelamin</th>
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
                                <td>{{ $item->siswa_no_pendaftaran }}</td>
                                <td>{{ $item->siswa_nama }}</td>
                                <td>{{ $item->siswa_tempat_lahir }}</td>
                                <td>{{ $item->siswa_tanggal_lahir }}</td>
                                <td>{{ $item->siswa_asal_sekolah }}</td>
                                <td>{{ $item->siswa_jenis_kelamin ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modalEditDSiswa{{ $item->siswa_id }}"
                                        class="btn btn-warning btn-icon-split">
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="{{ route('d_siswa.destroy', $item->siswa_id) }}" method="POST" style="display:inline;">
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
