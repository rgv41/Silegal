@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="font-weight-bold text-white">Pilih Jasa Yang Ingin Anda Ajukan</h2>
    <div class="row mt-4">
        <div class="col-md-12">
            <h4 class="font-weight-bold text-white">Daftar Jasa</h4>
            <div class="jasa-scroll-container">
                <div class="row mt-3">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary jasa-card">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold text-black">{{ $product->name }}</h5>
                                <h6 class="card-subtitle mb-2 font-weight-bold text-black">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
                                <p class="card-text font-weight-bold text-black">{{ $product->description }}</p>
                                <ul class="list-unstyled">
                                    @foreach($product->letters as $letter)
                                        <li><i class="fas fa-check-circle"></i> {{ $letter->name }}</li>
                                    @endforeach
                                </ul>
                                <form action="{{ route($product->form_route) }}" method="GET">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">Ajukan</button>
                                </form>
                                <a href="https://wa.me/6281292304422?text=Halo!%20Saya%20tertarik%20dengan%20layanan%20{{ $product->name }}." class="btn btn-success mt-2" target="_blank">Hubungi Kami di WhatsApp</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- WhatsApp Popup -->
<div class="whatsapp-popup">
    <a href="https://wa.me/6281292304422?text=Halo!%20Saya%20tertarik%20dengan%20layanan." target="_blank">
        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/WhatsApp_icon.png" alt="WhatsApp" class="whatsapp-icon">
    </a>
    <a href="https://www.instagram.com/silegal_com" target="_blank" class="instagram-popup">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="instagram-icon">
    </a>
</div>
@endsection
