<div class="modal fade" id="modalTambahDSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('d_siswa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="siswa_no_pendaftaran">No Pendaftaran</label>
                        <input type="number" class="form-control" id="siswa_no_pendaftaran" name="siswa_no_pendaftaran" required>
                    </div>
                    <div class="form-group">
                        <label for="siswa_nama">Nama</label>
                        <input type="text" class="form-control" id="siswa_nama" name="siswa_nama" required>
                    </div>
                    <div class="form-group">
                        <label for="siswa_tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="siswa_tempat_lahir" name="siswa_tempat_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="siswa_tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="siswa_tanggal_lahir" name="siswa_tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="siswa_asal_sekolah">Asal Sekolah</label>
                        <input type="text" class="form-control" id="siswa_asal_sekolah" name="siswa_asal_sekolah" required>
                    </div>
                    <div class="form-group">
                        <label for="siswa_jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="siswa_jenis_kelamin" name="siswa_jenis_kelamin" required>
                            <option value="1">Laki-laki</option>
                            <option value="0">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
