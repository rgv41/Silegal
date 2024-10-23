<!-- Modal untuk menambah KBLI -->
<div class="modal fade" id="addKbliModal" tabindex="-1" aria-labelledby="addKbliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKbliModalLabel">Tambah KBLI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addKbliForm" action="{{ route('admin.kbli.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_kbli" class="form-label">Kode KBLI</label>
                        <input type="text" class="form-control" id="kode_kbli" name="kode_kbli" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_kbli" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi_kbli" name="deskripsi_kbli" required>
                    </div>
                    <div class="mb-3">
                        <label for="kbli_category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="kbli_category_id" name="kbli_category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan KBLI</button>
                </div>
            </form>
        </div>
    </div>
</div>