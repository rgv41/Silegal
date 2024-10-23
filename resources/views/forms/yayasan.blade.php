@extends('layouts.app')

@section('title', 'Pendirian Yayasan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendirian Yayasan</h4>
                    </div>
                    <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                        <form action="{{ route('yayasan.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama_yayasan" class="form-label"><b>Nama Yayasan</b></label>
                                    <input type="text" class="form-control" id="nama_yayasan" name="nama_yayasan" placeholder="Masukkan Nama Yayasan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="modal" class="form-label"><b>Modal</b></label>
                                    <input type="number" class="form-control" id="modal" name="modal" placeholder="Masukkan Modal" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pendiri" class="form-label"><b>Pendiri</b></label>
                                    <input type="text" class="form-control" id="pendiri" name="pendiri" placeholder="Masukkan Nama Pendiri" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pembina" class="form-label"><b>Pembina</b></label>
                                    <input type="text" class="form-control" id="pembina" name="pembina" placeholder="Masukkan Nama Pembina" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_hp_pembina" class="form-label"><b>No Telepon Pembina</b></label>
                                    <input type="text" class="form-control" id="no_hp_pembina" name="no_hp_pembina" placeholder="Masukkan No Telepon Pembina" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_pembina" class="form-label"><b>Email Pembina</b></label>
                                    <input type="email" class="form-control" id="email_pembina" name="email_pembina" placeholder="Masukkan Email Pembina" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="ketua_pengurus" class="form-label"><b>Ketua Pengurus</b></label>
                                    <input type="text" class="form-control" id="ketua_pengurus" name="ketua_pengurus" placeholder="Masukkan Nama Ketua Pengurus" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp_ketua_pengurus" class="form-label"><b>No Telepon Ketua Pengurus</b></label>
                                    <input type="text" class="form-control" id="no_hp_ketua_pengurus" name="no_hp_ketua_pengurus" placeholder="Masukkan No Telepon Ketua Pengurus" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email_ketua_pengurus" class="form-label"><b>Email Ketua Pengurus</b></label>
                                    <input type="email" class="form-control" id="email_ketua_pengurus" name="email_ketua_pengurus" placeholder="Masukkan Email Ketua Pengurus" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sekretaris" class="form-label"><b>Sekretaris</b></label>
                                    <input type="text" class="form-control" id="sekretaris" name="sekretaris" placeholder="Masukkan Nama Sekretaris" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_hp_sekretaris" class="form-label"><b>No Telepon Sekretaris</b></label>
                                    <input type="text" class="form-control" id="no_hp_sekretaris" name="no_hp_sekretaris" placeholder="Masukkan No Telepon Sekretaris" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_sekretaris" class="form-label"><b>Email Sekretaris</b></label>
                                    <input type="email" class="form-control" id="email_sekretaris" name="email_sekretaris" placeholder="Masukkan Email Sekretaris" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="bendahara" class="form-label"><b>Bendahara</b></label>
                                    <input type="text" class="form-control" id="bendahara" name="bendahara" placeholder="Masukkan Nama Bendahara" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp_bendahara" class="form-label"><b>No Telepon Bendahara</b></label>
                                    <input type="text" class="form-control" id="no_hp_bendahara" name="no_hp_bendahara" placeholder="Masukkan No Telepon Bendahara" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email_bendahara" class="form-label"><b>Email Bendahara</b></label>
                                    <input type="email" class="form-control" id="email_bendahara" name="email_bendahara" placeholder="Masukkan Email Bendahara" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pengawas" class="form-label"><b>Pengawas</b></label>
                                    <input type="text" class="form-control" id="pengawas" name="pengawas" placeholder="Masukkan Nama Pengawas" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_hp_pengawas" class="form-label"><b>No Telepon Pengawas</b></label>
                                    <input type="text" class="form-control" id="no_hp_pengawas" name="no_hp_pengawas" placeholder="Masukkan No Telepon Pengawas" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_pengawas" class="form-label"><b>Email Pengawas</b></label>
                                    <input type="email" class="form-control" id="email_pengawas" name="email_pengawas" placeholder="Masukkan Email Pengawas" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="alamat_lengkap" class="form-label"><b>Alamat Lengkap</b></label>
                                    <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" placeholder="Masukkan Alamat Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="rt_rw" class="form-label"><b>RT/RW</b></label>
                                    <input type="text" class="form-control" id="rt_rw" name="rt_rw" placeholder="Masukkan RT/RW" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kode_pos" class="form-label"><b>Kode Pos</b></label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Masukkan Kode Pos" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kelurahan" class="form-label"><b>Kelurahan</b></label>
                                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Masukkan Kelurahan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kecamatan" class="form-label"><b>Kecamatan</b></label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kabupaten" class="form-label"><b>Kabupaten</b></label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan Kabupaten" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_telp_hk_kantor" class="form-label"><b>No Telepon/hp Kantor</b></label>
                                    <input type="text" class="form-control" id="no_telp_hk_kantor" name="no_telp_hk_kantor" placeholder="Masukkan No Telepon HK Kantor" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_kantor" class="form-label"><b>Email Kantor</b></label>
                                    <input type="email" class="form-control" id="email_kantor" name="email_kantor" placeholder="Masukkan Email Kantor" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="bidang_yayasan" class="form-label"><b>Bidang Yayasan</b></label>
                                    <input type="text" class="form-control" id="bidang_yayasan" name="bidang_yayasan" placeholder="Masukkan Bidang Yayasan" required>
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
                                <label for="tambah_kbli">Apakah Anda ingin menambahkan KBLI?</label>
                                <select id="tambah_kbli" class="form-control">
                                    <option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
                                </select>
                            </div>
                            
                            <div id="kbli-section" style="display:none;">
                                <div class="form-group">
                                    <label for="kbli_category_id">Pilih Kategori KBLI</label>
                                    <select name="kbli_category_id" id="kbli_category_id" class="form-control">
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
