@extends('admin.layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <h5 class="mb-0">Detail PT Biasa</h5>
            </div>
            <div class="card-body px-4 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nama PT</th>
                            <td>{{ $FormPTBiasa->nama_pt }}</td>
                        </tr>
                        <tr>
                            <th>Modal Dasar</th>
                            <td>{{ $FormPTBiasa->modal_dasar }}</td>
                        </tr>
                        <tr>
                            <th>Modal Setor</th>
                            <td>{{ $FormPTBiasa->modal_setor }}</td>
                        </tr>
                        <tr>
                            <th>Nilai Nominal per Saham</th>
                            <td>{{ $FormPTBiasa->nilai_nominal_per_saham }}</td>
                        </tr>
                        <tr>
                            <th>Pemegang Saham Pertama (%)</th>
                            <td>{{ $FormPTBiasa->pemegang_saham_pertama_persen }}</td>
                        </tr>
                        <tr>
                            <th>Pemegang Saham Kedua (%)</th>
                            <td>{{ $FormPTBiasa->pemegang_saham_kedua_persen }}</td>
                        </tr>
                        <tr>
                            <th>Nama Direktur</th>
                            <td>{{ $FormPTBiasa->direktur_nama }}</td>
                        </tr>
                        <tr>
                            <th>Email Direktur</th>
                            <td>{{ $FormPTBiasa->direktur_email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon Direktur</th>
                            <td>{{ $FormPTBiasa->direktur_telp }}</td>
                        </tr>
                        <tr>
                            <th>Nama Komisaris</th>
                            <td>{{ $FormPTBiasa->komisaris_nama }}</td>
                        </tr>
                        <tr>
                            <th>Email Komisaris</th>
                            <td>{{ $FormPTBiasa->komisaris_email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon Komisaris</th>
                            <td>{{ $FormPTBiasa->komisaris_telp }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon Kantor</th>
                            <td>{{ $FormPTBiasa->no_telp_kantor }}</td>
                        </tr>
                        <tr>
                            <th>Email Kantor</th>
                            <td>{{ $FormPTBiasa->email_kantor }}</td>
                        </tr>
                        <tr>
                            <th>Bidang Usaha</th>
                            <td>{{ $FormPTBiasa->bidang_usaha }}</td>
                        </tr>
                        <tr>
                            <th>Alamat PT</th>
                            <td>{{ $FormPTBiasa->alamat_pt }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.pt-biasa.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
