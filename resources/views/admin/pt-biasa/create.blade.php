<!-- Modal Tambah PT Biasa -->
<div class="modal fade" id="addPTBiasaModal" tabindex="-1" aria-labelledby="addPTBiasaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addPTBiasaForm" method="POST" action="{{ route('admin.pt-biasa.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPTBiasaModalLabel">Tambah PT Biasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nama PT -->
                    <div class="form-group">
                        <label for="nama_pt">Nama PT</label>
                        <input type="text" class="form-control" id="nama_pt" name="nama_pt" required>
                    </div>
                    
                    <!-- Modal Dasar -->
                    <div class="form-group">
                        <label for="modal_dasar">Modal Dasar</label>
                        <input type="number" class="form-control" id="modal_dasar" name="modal_dasar" required>
                    </div>
                    
                    <!-- Modal Setor -->
                    <div class="form-group">
                        <label for="modal_setor">Modal Setor</label>
                        <input type="number" class="form-control" id="modal_setor" name="modal_setor" required>
                    </div>
                    
                    <!-- Nilai Nominal per Saham -->
                    <div class="form-group">
                        <label for="nilai_nominal_per_saham">Nilai Nominal per Saham</label>
                        <input type="number" class="form-control" id="nilai_nominal_per_saham" name="nilai_nominal_per_saham" required>
                    </div>
                    
                    <!-- Pemegang Saham Pertama -->
                    <div class="form-group">
                        <label for="pemegang_saham_pertama_persen">Pemegang Saham Pertama (%)</label>
                        <input type="number" class="form-control" id="pemegang_saham_pertama_persen" name="pemegang_saham_pertama_persen" required>
                    </div>
                    
                    <!-- Pemegang Saham Kedua -->
                    <div class="form-group">
                        <label for="pemegang_saham_kedua_persen">Pemegang Saham Kedua (%)</label>
                        <input type="number" class="form-control" id="pemegang_saham_kedua_persen" name="pemegang_saham_kedua_persen" required>
                    </div>
                    
                    <!-- Nama Direktur -->
                    <div class="form-group">
                        <label for="direktur_nama">Nama Direktur</label>
                        <input type="text" class="form-control" id="direktur_nama" name="direktur_nama" required>
                    </div>
                    
                    <!-- Email Direktur -->
                    <div class="form-group">
                        <label for="direktur_email">Email Direktur</label>
                        <input type="email" class="form-control" id="direktur_email" name="direktur_email" required>
                    </div>
                    
                    <!-- Telepon Direktur -->
                    <div class="form-group">
                        <label for="direktur_telp">Telepon Direktur</label>
                        <input type="text" class="form-control" id="direktur_telp" name="direktur_telp" required>
                    </div>
                    
                    <!-- Nama Komisaris -->
                    <div class="form-group">
                        <label for="komisaris_nama">Nama Komisaris</label>
                        <input type="text" class="form-control" id="komisaris_nama" name="komisaris_nama" required>
                    </div>
                    
                    <!-- Email Komisaris -->
                    <div class="form-group">
                        <label for="komisaris_email">Email Komisaris</label>
                        <input type="email" class="form-control" id="komisaris_email" name="komisaris_email" required>
                    </div>
                    
                    <!-- Telepon Komisaris -->
                    <div class="form-group">
                        <label for="komisaris_telp">Telepon Komisaris</label>
                        <input type="text" class="form-control" id="komisaris_telp" name="komisaris_telp" required>
                    </div>
                    
                    <!-- Telepon Kantor -->
                    <div class="form-group">
                        <label for="no_telp_kantor">Telepon Kantor</label>
                        <input type="text" class="form-control" id="no_telp_kantor" name="no_telp_kantor" required>
                    </div>
                    
                    <!-- Email Kantor -->
                    <div class="form-group">
                        <label for="email_kantor">Email Kantor</label>
                        <input type="email" class="form-control" id="email_kantor" name="email_kantor" required>
                    </div>
                    
                    <!-- Alamat PT -->
                    <div class="form-group">
                        <label for="alamat_pt">Alamat PT</label>
                        <textarea class="form-control" id="alamat_pt" name="alamat_pt" required></textarea>
                    </div>
                    
                    <!-- Bidang Usaha -->
                    <div class="form-group">
                        <label for="bidang_usaha">Bidang Usaha</label>
                        <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" required>
                    </div>
                    

                    <!-- Upload Foto KTP -->
                    <div class="form-group">
                        <label for="foto_ktp">Upload Foto KTP</label>
                        <input type="file" class="form-control" id="foto_ktp" name="foto_ktp[]" multiple accept="image/*" onchange="previewImages(event, 'ktp-preview')">
                        <div id="ktp-preview" class="preview-images-zone mt-3"></div>
                    </div>

                    <!-- Upload Foto NPWP --> 
                    <div class="form-group">
                        <label for="foto_npwp">Upload Foto NPWP</label>
                        <input type="file" class="form-control" id="foto_npwp" name="foto_npwp[]" multiple accept="image/*" onchange="previewImages(event, 'npwp-preview')">
                        <div id="npwp-preview" class="preview-images-zone mt-3"></div>
                    </div>
                    <!-- Kategori KBLI -->
                    <div class="form-group">
                        <label for="kbli_category_id">Pilih Kategori KBLI</label>
                        <select name="kbli_category_id" id="kbli_category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori KBLI --</option>
                            @foreach($kbliCategories as $category) 
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Search dan Checkbox KBLI -->
                    <div class="form-group" id="search-container" style="display:none;">
                        <label for="search_kbli">Pencarian KBLI</label>
                        <input type="text" id="search_kbli" class="form-control" placeholder="Cari KBLI...">
                    </div>
                    <div id="selected-kbli" class="mt-3">
                        <h5 class="font-weight-bold text-black">KBLI yang Dipilih:</h5>
                        <ul id="selected-kbli-list"></ul>
                    </div>
                    
                    <div class="form-group" id="kbli-checkbox-container">
                        <label for="kbli_ids">Pilih KBLI</label>
                        <div id="kbli-checkboxes">
                            <!-- Checkbox untuk KBLI akan diisi secara dinamis melalui AJAX -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/pt-biasa.js') }}"></script>
@endpush
