<div class="modal fade" id="modalTambahM_Sub_Kriteria" tabindex="-1" role="dialog"
    aria-labelledby="modalTambahM_Sub_KriteriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahM_Sub_KriteriaLabel">Tambah Sub Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('m_sub_kriteria.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kriteria_id">Nama Kriteria</label>
                        <select class="form-control" id="kriteria_id" name="kriteria_id">
                            @foreach ($kriteria as $item)
                                <option value="{{ $item->kriteria_id }}">{{ $item->kriteria_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_kriteria_nama">Nama Sub Kriteria</label>
                        <input type="text" class="form-control" id="sub_kriteria_nama" name="sub_kriteria_nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
