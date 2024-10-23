@extends('admin.layouts.user_type.auth')

@section('content')
<div class="container">
    <h4>Detail KBLI</h4>

    <!-- Tampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Detail KBLI -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Kode KBLI: {{ $kbli->kode_kbli }}</h5>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $kbli->deskripsi_kbli }}</p>
            <p class="card-text"><strong>Kategori:</strong> {{ $kbli->category->category_name }}</p>
        </div>
    </div>

    <!-- Tombol kembali ke halaman daftar KBLI -->
    <a href="{{ route('admin.kbli.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar KBLI</a>
</div>
@endsection
