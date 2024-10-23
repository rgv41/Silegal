@extends('layouts.app')

@section('title', 'Pendirian PT Biasa')

@section('content')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendirian PT Biasa</h4>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <form action="{{ route('pt_biasa.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_pt" class="form-label"><b>Nama PT</b></label>
                                    <input type="text" class="form-control" id="nama_pt" name="nama_pt" placeholder="Masukkan Nama PT" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="modal_dasar" class="form-label"><b>Modal Dasar</b></label>
                                    <input type="number" class="form-control" id="modal_dasar" name="modal_dasar" placeholder="Masukkan Modal Dasar" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="modal_setor" class="form-label"><b>Modal Setor</b></label>
                                    <input type="number" class="form-control" id="modal_setor" name="modal_setor" placeholder="Masukkan Modal Setor" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nilai_nominal_per_saham" class="form-label"><b>Nilai Nominal Per Saham</b></label>
                                    <input type="number" class="form-control" id="nilai_nominal_per_saham" name="nilai_nominal_per_saham" placeholder="Masukkan Nilai Nominal Per Saham" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pemegang_saham_pertama_persen" class="form-label"><b>Pemegang Saham Pertama (%)</b></label>
                                    <input type="number" class="form-control" id="pemegang_saham_pertama_persen" name="pemegang_saham_pertama_persen" placeholder="Masukkan Persentase Saham Pertama" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pemegang_saham_kedua_persen" class="form-label"><b>Pemegang Saham Kedua (%)</b></label>
                                    <input type="number" class="form-control" id="pemegang_saham_kedua_persen" name="pemegang_saham_kedua_persen" placeholder="Masukkan Persentase Saham Kedua" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="direktur_nama" class="form-label"><b>Nama Direktur</b></label>
                                    <input type="text" class="form-control" id="direktur_nama" name="direktur_nama" placeholder="Masukkan Nama Direktur" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="direktur_telp" class="form-label"><b>No Telepon Direktur</b></label>
                                    <input type="text" class="form-control" id="direktur_telp" name="direktur_telp" placeholder="Masukkan No Telepon Direktur" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="direktur_email" class="form-label"><b>Email Direktur</b></label>
                                    <input type="email" class="form-control" id="direktur_email" name="direktur_email" placeholder="Masukkan Email Direktur" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="komisaris_nama" class="form-label"><b>Nama Komisaris</b></label>
                                    <input type="text" class="form-control" id="komisaris_nama" name="komisaris_nama" placeholder="Masukkan Nama Komisaris" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="komisaris_telp" class="form-label"><b>No Telepon Komisaris</b></label>
                                    <input type="text" class="form-control" id="komisaris_telp" name="komisaris_telp" placeholder="Masukkan No Telepon Komisaris" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="komisaris_email" class="form-label"><b>Email Komisaris</b></label>
                                    <input type="email" class="form-control" id="komisaris_email" name="komisaris_email" placeholder="Masukkan Email Komisaris" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_telp_kantor" class="form-label"><b>No Telepon Kantor</b></label>
                                    <input type="text" class="form-control" id="no_telp_kantor" name="no_telp_kantor" placeholder="Masukkan No Telepon Kantor" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_kantor" class="form-label"><b>Email Kantor</b></label>
                                    <input type="email" class="form-control" id="email_kantor" name="email_kantor" placeholder="Masukkan Email Kantor" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="bidang_usaha" class="form-label"><b>Bidang Usaha</b></label>
                                    <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" placeholder="Masukkan Bidang Usaha" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="alamat_pt" class="form-label"><b>Alamat PT</b></label>
                                    <input type="text" class="form-control" id="alamat_pt" name="alamat_pt" placeholder="Masukkan Alamat PT" required>
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
        <a href="https://wa.me/6281292304422" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" class="whatsapp-icon">
        </a>
    </div>
    <a href="https://www.instagram.com/silegal_com" target="_blank" class="instagram-popup">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="instagram-icon">
    </a>
@endsection
