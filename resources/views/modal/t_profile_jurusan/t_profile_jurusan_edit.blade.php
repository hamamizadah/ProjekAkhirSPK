<!-- Modal Edit -->
<div class="modal fade" id="modalEditTProfileJurusan{{ $profile->profile_id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditTProfileJurusanLabel{{ $profile->profile_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTProfileJurusanLabel{{ $profile->profile_id }}">Edit Profile Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('t_profile_jurusan.update', $profile->profile_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan_nama">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan_nama" value="{{ $profile->jurusan->jurusan_nama }}" disabled>
                        <input type="hidden" name="jurusan_id" value="{{ $profile->jurusan_id }}">
                    </div>
                    <div class="form-group">
                        <label for="sub_kriteria_nama">Sub Kriteria</label>
                        <input type="text" class="form-control" id="sub_kriteria_nama" value="{{ $profile->subKriteria->sub_kriteria_nama }}" disabled>
                        <input type="hidden" name="sub_kriteria_id" value="{{ $profile->sub_kriteria_id }}">
                    </div>
                    <div class="form-group">
                        <label for="profile_nilai_target">Nilai Target</label>
                        <input type="number" name="profile_nilai_target" id="profile_nilai_target" class="form-control" value="{{ $profile->profile_nilai_target }}" required>
                    </div>
                    <div class="form-group">
                        <label for="profile_core">Core</label>
                        <select class="form-control" id="profile_core" name="profile_core" required>
                            <option value="">--- Core/Secondary ---</option>
                           <option value="0.6" {{ $profile->profile_core == 0.6 ? 'selected' : '' }}>Core Factor</option>
                           <option value="0.4" {{ $profile->profile_core == 0.4 ? 'selected' : '' }}>Secondary Factor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
