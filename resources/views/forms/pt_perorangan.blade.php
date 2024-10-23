@extends('layouts.app')

@section('title', 'Pendirian PT Perorangan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendirian PT Perorangan</h4>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <!-- Form Pendirian PT Perorangan -->
                        <form action="{{ route('pt_perorangan.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Tambahkan field yang diperlukan untuk PT Perorangan -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_pt" class="form-label"><b>Nama PT</b></label>
                                    <input type="text" class="form-control" id="nama_pt" name="nama_pt" placeholder="Masukkan Nama PT" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat_pt" class="form-label"><b>Alamat PT</b></label>
                                    <input type="text" class="form-control" id="alamat_pt" name="alamat_pt" placeholder="Masukkan Alamat PT" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_telp" class="form-label"><b>Nomor Telepon</b></label>
                                    <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="modal_usaha" class="form-label"><b>Modal Usaha</b></label>
                                    <input type="number" class="form-control" id="modal_usaha" name="modal_usaha" placeholder="Masukkan Modal Usaha" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="foto_ktp" class="form-label"><b>Upload Foto KTP</b></label>
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp[]" multiple required onchange="previewKtpFiles()">
                                    <div id="ktp-preview" class="row mt-2">
                                        <!-- Preview Gambar KTP akan muncul di sini -->
                                    </div>
                                </div>
    
                                <!-- Upload NPWP -->
                                <div class="col-md-6">
                                    <label for="foto_npwp" class="form-label"><b>Upload Foto NPWP</b></label>
                                    <input type="file" class="form-control" id="foto_npwp" name="foto_npwp[]" multiple required onchange="previewNpwpFiles()">
                                    <div id="npwp-preview" class="row mt-2">
                                        <!-- Preview Gambar NPWP akan muncul di sini -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kbli_category_id">Pilih Kategori KBLI</label>
                                <select name="kbli_category_id" id="kbli_category_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori KBLI --</option>
                                    @foreach($kbliCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="search-container" style="display:none;">
                                <label for="search_kbli">Pencarian KBLI</label>
                                <input type="text" id="search_kbli" class="form-control" placeholder="Cari KBLI...">
                            </div>
                                                <!-- Area untuk Menampilkan KBLI yang Dipilih --> 
                            <div id="selected-kbli" class="mt-3">
                                <h5 class="font-weight-bold text-black">KBLI yang Dipilih:</h5>
                                <ul id="selected-kbli-list"></ul>
                            </div>
                            <!-- Pilihan KBLI -->
                            <div class="form-group" id="kbli-checkbox-container">
                                <label for="kbli_ids">Pilih KBLI</label>
                                <div id="kbli-checkboxes">
                                    <!-- Checkbox akan diisi di sini -->
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WhatsApp Popup -->
    <div class="whatsapp-popup">
        <a href="https://wa.me/6281292304422?text=Halo!%20Bisakah%20saya%20mendapatkan%20info%20selengkapnya%20tentang%20ini?" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" class="whatsapp-icon">
        </a>
        <a href="https://www.instagram.com/silegal_com" target="_blank" class="instagram-popup">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="instagram-icon">
        </a>
    </div>    
@endsection
