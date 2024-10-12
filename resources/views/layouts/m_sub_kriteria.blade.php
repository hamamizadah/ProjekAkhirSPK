@extends('layouts.masterlayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-left justify-content-between mb-4">
        <div class="row">
            <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
            <h1 class="h3 mb-2 text-gray-800">Data Sub Kriteria</h1>
        </div>
    </div>

    <!-- Modal Input -->
    @include('modal.sub_kriteria.m_sub_kriteria_input')

    <!-- Modal Edit -->
    @include('modal.sub_kriteria.m_sub_kriteria_edit')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Tabel Sub Kriteria</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#" data-toggle="modal" data-target="#modalTambahM_Sub_Kriteria"
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
                            <th>Nama Kriteria</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Nama Sub Kriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($subKriteria as $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->kriteria->kriteria_nama }}</td>
                                <td>{{ $item->sub_kriteria_nama }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#modalEditSubKriteria{{ $item->sub_kriteria_id }}"
                                        class="btn btn-warning btn-icon-split">
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="{{ route('m_sub_kriteria.destroy', $item->sub_kriteria_id) }}" method="POST" style="display:inline;">
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
