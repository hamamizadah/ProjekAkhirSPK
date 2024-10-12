<!-- Modal Edit -->
@foreach ($jurusan as $item)
<div class="modal fade" id="modalEditJurusan{{ $item->jurusan_id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditJurusanLabel{{ $item->jurusan_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditJurusanLabel{{ $item->jurusan_id }}">Edit Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('m_jurusan.update', $item->jurusan_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="jurusan_id" value="{{ $item->jurusan_id }}">
                    <div class="form-group">
                        <label for="edit_jurusan_kode{{ $item->jurusan_id }}">Kode Jurusan</label>
                        <input type="text" class="form-control" id="edit_jurusan_kode{{ $item->jurusan_id }}" name="jurusan_kode" value="{{ $item->jurusan_kode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jurusan_nama{{ $item->jurusan_id }}">Nama Jurusan</label>
                        <input type="text" class="form-control" id="edit_jurusan_nama{{ $item->jurusan_id }}" name="jurusan_nama" value="{{ $item->jurusan_nama }}" required>
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
@endforeach
