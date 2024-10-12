<!-- Modal Edit -->
<div class="modal fade" id="modalEditKriteria{{ $item->kriteria_id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalEditKriteriaLabel{{ $item->kriteria_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditKriteriaLabel{{ $item->kriteria_id }}">Edit Data Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('m_kriteria.update', $item->kriteria_id) }}" method="POST" id="formEditKriteria{{ $item->kriteria_id }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_kriteria_id{{ $item->kriteria_id }}" name="kriteria_id"
                        value="{{ $item->kriteria_id }}">
                    <div class="form-group">
                        <label for="edit_kriteria_nama{{ $item->kriteria_id }}">Nama Kriteria</label>
                        <input type="text" class="form-control" id="edit_kriteria_nama{{ $item->kriteria_id }}"
                            name="kriteria_nama" value="{{ $item->kriteria_nama }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
