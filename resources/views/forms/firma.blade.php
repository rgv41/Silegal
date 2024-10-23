@extends('layouts.app')

@section('title', 'Pendirian Firma')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendirian Firma</h4>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <!-- Pesan Sukses atau Error -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form untuk pengisian data -->
                        <form action="{{ route('firma.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Isi form sesuai dengan data Firma -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_firma" class="form-label"><b>Nama Firma</b></label>
                                    <input type="text" class="form-control" id="nama_firma" name="nama_firma" placeholder="Masukkan Nama Firma" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="modal" class="form-label"><b>Modal</b></label>
                                    <input type="number" class="form-control" id="modal" name="modal" placeholder="Masukkan Modal Firma" required>
                                </div>
                            </div>

                            <!-- Tambahkan field lainnya -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="managing_partner" class="form-label"><b>Managing Partner</b></label>
                                    <input type="text" class="form-control" id="managing_partner" name="managing_partner" placeholder="Masukkan Nama Managing Partner" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="managing_partner_telp" class="form-label"><b>No Telp Managing Partner</b></label>
                                    <input type="text" class="form-control" id="managing_partner_telp" name="managing_partner_telp" placeholder="Masukkan No Telp" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="managing_partner_email" class="form-label"><b>Email Managing Partner</b></label>
                                    <input type="email" class="form-control" id="managing_partner_email" name="managing_partner_email" placeholder="Masukkan Email Managing Partner" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_telp_kantor" class="form-label"><b>No Telp Kantor</b></label>
                                    <input type="text" class="form-control" id="no_telp_kantor" name="no_telp_kantor" placeholder="Masukkan No Telp Kantor" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_kantor" class="form-label"><b>Email Kantor</b></label>
                                    <input type="email" class="form-control" id="email_kantor" name="email_kantor" placeholder="Masukkan Email Kantor" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="partner_telp" class="form-label"><b>No Telp Partner (Optional)</b></label>
                                    <input type="text" class="form-control" id="partner_telp" name="partner_telp" placeholder="Masukkan No Telp Partner">
                                </div>
                                <div class="col-md-6">
                                    <label for="partner_email" class="form-label"><b>Email Partner (Optional)</b></label>
                                    <input type="email" class="form-control" id="partner_email" name="partner_email" placeholder="Masukkan Email Partner">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_firma" class="form-label"><b>Alamat Firma</b></label>
                                <textarea class="form-control" id="alamat_firma" name="alamat_firma" rows="3" placeholder="Masukkan Alamat Firma" required></textarea>
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

                            {{-- <div class="mb-3">
                                <label for="password" class="form-label"><b>Password (Optional)</b></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password jika diperlukan">
                            </div> --}}

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
    <!-- WhatsApp & Instagram Popup -->
    <div class="whatsapp-popup">
        <a href="https://wa.me/6281292304422" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" class="whatsapp-icon">
        </a>
    </div>
    <a href="https://www.instagram.com/silegal_com" target="_blank" class="instagram-popup">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="instagram-icon">
    </a>
@endsection
