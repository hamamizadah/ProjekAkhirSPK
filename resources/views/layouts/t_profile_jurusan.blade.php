@extends('layouts.masterlayouts')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-left justify-content-between mb-4">
        <div class="row">
            <i class="fas fa-cubes fa-2x mr-3 mb-3" aria-hidden="true"></i>
            <h1 class="h3 mb-2 text-gray-800">Data Profile Jurusan</h1>
        </div>
    </div>

    @include('modal.t_profile_jurusan.t_profile_jurusan_input')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-2"></i>Table Profile Jurusan</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#" data-toggle="modal" data-target="#modalTambahTProfileJurusan"
                        class="d-none d-sm-inline-block btn btn-success btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Tambah
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Sub Kriteria</th>
                            <th>Nilai Target</th>
                            <th>Core</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($groupedProfiles as $jurusanNama => $profiles)
                            <tr>
                                <td rowspan="{{ count($profiles) }}">{{ $i }}</td>
                                <td rowspan="{{ count($profiles) }}">{{ $jurusanNama }}</td>
                                @foreach ($profiles as $index => $profile)
                                    @if ($index != 0)
                                        <tr>
                                    @endif
                                    <td>{{ $profile->subKriteria->sub_kriteria_nama }}</td>
                                    <td>{{ $profile->profile_nilai_target }}</td>
                                    <td>
                                        @if ($profile->profile_core == 0.6)
                                            Core Factor
                                        @elseif ($profile->profile_core == 0.4)
                                            Secondary Factor
                                        @else
                                            {{ $profile->profile_core }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal"
                                            data-target="#modalEditTProfileJurusan{{ $profile->profile_id }}"
                                            class="btn btn-warning btn-icon-split">
                                            <span class="text">Edit</span>
                                        </a>
                                        @include('modal.t_profile_jurusan.t_profile_jurusan_edit')
                                        <form action="{{ route('t_profile_jurusan.destroy', $profile->profile_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <span class="text">Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                    @if ($index != count($profiles) - 1)
                                        </tr>
                                    @endif
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
