@foreach ($subKriteria as $item)
    <div class="modal fade" id="modalEditSubKriteria{{ $item->sub_kriteria_id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalEditSubKriteria{{ $item->sub_kriteria_id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSubKriteria{{ $item->sub_kriteria_id }}Label">Edit Sub Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('m_sub_kriteria.update', $item->sub_kriteria_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kriteria_id">Nama Kriteria</label>
                            <select class="form-control" id="kriteria_id" name="kriteria_id">
                                @foreach ($kriteria as $kriteriaItem)
                                    <option value="{{ $kriteriaItem->id }}" {{ $item->kriteria_id == $kriteriaItem->id ? 'selected' : '' }}>
                                        {{ $kriteriaItem->kriteria_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sub_kriteria_nama">Nama Sub Kriteria</label>
                            <input type="text" class="form-control" id="sub_kriteria_nama" name="sub_kriteria_nama"
                                value="{{ $item->sub_kriteria_nama }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
