<!-- Modal -->
<div class="modal fade" id="modalTambahM_Kriteria" tabindex="-1" role="dialog" aria-labelledby="modalTambahM_KriteriaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahM_KriteriaLabel">Tambah Data Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('m_kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kriteria_nama">Nama Kriteria</label>
                        <input type="text" class="form-control" id="kriteria_nama" name="kriteria_nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Kriteria</button>
                </div>
            </form>
        </div>
    </div>
</div>