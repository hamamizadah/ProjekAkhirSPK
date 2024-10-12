<div class="modal fade" id="modalEditNilaiSiswa{{ $item->siswa_id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditNilaiSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('t_nilai_siswa.update', ['t_nilai_siswa' => $item->siswa_id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditNilaiSiswaLabel">Input Nilai Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="siswa_nama">Nama Siswa</label>
                        <input type="text" name="siswa_nama" id="siswa_nama" class="form-control" value="{{ $item->siswa_nama }}" disabled>
                    </div>
                    @foreach ($sub_kriteria as $sk)
                        @php
                            $nilai = $item->nilaiSiswa->firstWhere('sub_kriteria_id', $sk->sub_kriteria_id);
                        @endphp
                        <div class="form-group">
                            <label for="nilai_siswa_count_{{ $sk->sub_kriteria_id }}">
                                @if($sk->sub_kriteria_nama == 'Peminatan Jurusan')
                                    Peminatan Jurusan
                                @elseif($sk->sub_kriteria_nama == 'Bakat')
                                    Bakat
                                @else
                                    {{ $sk->sub_kriteria_nama }}
                                @endif
                            </label>
                            @if($sk->sub_kriteria_nama == 'Peminatan Jurusan')
                                <select name="nilai_siswa_count[]" id="nilai_siswa_count_{{ $sk->sub_kriteria_id }}" class="form-control" required>
                                    <option value="">Pilih Peminatan Jurusan</option>
                                    <!-- Tambahkan opsi di sini -->
                                    <option value="20" {{ $nilai && $nilai->nilai_siswa_count == 20 ? 'selected' : '' }}>Teknik Sepeda Motor (TSM)</option>
                                    <option value="40" {{ $nilai && $nilai->nilai_siswa_count == 40 ? 'selected' : '' }}>Teknik Komputer Jaringan (TKJ)</option>
                                    <option value="60" {{ $nilai && $nilai->nilai_siswa_count == 60 ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                </select>
                            @elseif($sk->sub_kriteria_nama == 'Bakat')
                                <select name="nilai_siswa_count[]" id="nilai_siswa_count_{{ $sk->sub_kriteria_id }}" class="form-control" required>
                                    <option value="">Pilih Bakat</option>
                                    <!-- Tambahkan opsi di sini -->
                                    <option value="60" {{ $nilai && $nilai->nilai_siswa_count == 60 ? 'selected' : '' }}>Teknik Sepeda Motor (TSM)</option>
                                    <option value="80" {{ $nilai && $nilai->nilai_siswa_count == 80 ? 'selected' : '' }}>Teknik Komputer Jaringan (TKJ)</option>
                                    <option value="100" {{ $nilai && $nilai->nilai_siswa_count == 100 ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                                </select>
                            @else
                                <input type="number" name="nilai_siswa_count[]" id="nilai_siswa_count{{ $sk->sub_kriteria_id }}" class="form-control" value="{{ $nilai ? $nilai->nilai_siswa_count : '' }}" required>
                            @endif
                            <input type="hidden" name="sub_kriteria_id[]" value="{{ $sk->sub_kriteria_id }}">
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi untuk memperbarui tampilan nama opsi yang dipilih
        function updateSelectDisplay() {
            const selects = document.querySelectorAll('select');
            selects.forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                if (selectedOption) {
                    const label = select.parentElement.querySelector('label');
                    const originalLabel = label.getAttribute('data-original-label');
                    if (originalLabel) {
                        label.innerHTML = originalLabel;
                    } else {
                        label.setAttribute('data-original-label', label.innerHTML);
                    }
                }
            });
        }

        // Panggil fungsi untuk mengatur tampilan awal
        updateSelectDisplay();

        // Opsional: Perbarui tampilan saat pemilihan berubah
        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', updateSelectDisplay);
        });
    });
</script>
