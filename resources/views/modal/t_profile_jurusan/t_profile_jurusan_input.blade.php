<!-- Modal Input -->
<div class="modal fade" id="modalTambahTProfileJurusan" tabindex="-1" role="dialog" aria-labelledby="modalTambahTProfileJurusanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahTProfileJurusanLabel">Tambah Profile Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('t_profile_jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control">
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->jurusan_id }}">{{ $j->jurusan_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_kriteria_id">Sub Kriteria</label>
                        <select name="sub_kriteria_id" id="sub_kriteria_id" class="form-control">
                            @foreach ($sub_kriteria as $sk)
                                <option value="{{ $sk->sub_kriteria_id }}">{{ $sk->sub_kriteria_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile_nilai_target">Nilai Target</label>
                        <select class="form-control" id="profile_nilai_target" name="profile_nilai_target" required >
                            <option value="">--- Range Nilai ---</option>
                            <option value="1">(1) 00  -  20 </option>
                            <option value="2">(2) 21  -  40 </option>
                            <option value="3">(3) 41  -  60 </option>
                            <option value="4">(4) 61  -  80 </option>
                            <option value="5">(5) 81  - 100 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile_core">Core</label>
                        <select class="form-control" id="profile_core" name="profile_core" required >
                            <option value="">--- Core/Seconndary  ---</option>
                            <option value="0.6">Core Factor</option>
                            <option value="0.4">Secondary Factor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

