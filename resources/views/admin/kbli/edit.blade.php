<!-- Modal untuk mengedit KBLI -->
<div class="modal fade" id="editKbliModal" tabindex="-1" aria-labelledby="editKbliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKbliModalLabel">Edit KBLI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKbliForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_kode_kbli" class="form-label">Kode KBLI</label>
                        <input type="text" class="form-control" id="edit_kode_kbli" name="kode_kbli" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi_kbli" class="form-label">Deskripsi KBLI</label>
                        <input type="text" class="form-control" id="edit_deskripsi_kbli" name="deskripsi_kbli" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kbli_category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="edit_kbli_category_id" name="kbli_category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>