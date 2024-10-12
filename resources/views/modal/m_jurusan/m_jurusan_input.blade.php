<!-- Modal Input -->
<div class="modal fade" id="modalTambahM_Jurusan" tabindex="-1" role="dialog" aria-labelledby="modalTambahM_JurusanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahM_JurusanLabel">Tambah Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('m_jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan_kode">Kode Jurusan</label>
                        <input type="text" class="form-control" id="jurusan_kode" name="jurusan_kode" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan_nama">Nama Jurusan</label>
                        <input type="text" class="form-control" id="jurusan_nama" name="jurusan_nama" required>
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
