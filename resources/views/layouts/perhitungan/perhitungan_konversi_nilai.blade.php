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