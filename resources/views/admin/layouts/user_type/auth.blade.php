@extends('admin.layouts.app')

@section('auth')

    @if(\Request::is('static-sign-up')) 
        @include('admin.layouts.navbars.guest.nav')
        @yield('content')
        @include('admin.layouts.footers.guest.footer')
    
    @elseif (\Request::is('static-sign-in')) 
        @include('admin.layouts.navbars.guest.nav')
        @yield('content')
        @include('admin.layouts.footers.guest.footer')
    
    @elseif (\Request::is('rtl'))  
        @include('admin.layouts.navbars.auth.sidebar-rtl')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('admin.layouts.navbars.auth.nav-rtl')
            <div class="container-fluid py-4">
                @yield('content')
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    @elseif (\Request::is('profile'))  
        @include('admin.layouts.navbars.auth.sidebar')
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            @include('admin.layouts.navbars.auth.nav')
            @yield('content')
        </div>

    @elseif (\Request::is('virtual-reality')) 
        @include('admin.layouts.navbars.auth.nav')
        <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
            @include('admin.layouts.navbars.auth.sidebar')
            <main class="main-content mt-1 border-radius-lg">
                @yield('content')
            </main>
        </div>
        @include('admin.layouts.footers.auth.footer')

    {{-- Form PT Biasa --}}
    @elseif (\Request::is('pt-biasa')) 
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content')
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    {{-- Form PT Perorangan --}}
    @elseif (\Request::is('pt-perorangan'))
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content') {{-- Menampilkan tabel PT Perorangan --}}
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    {{-- Form Firma --}}
    @elseif (\Request::is('firma'))
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content') {{-- Menampilkan tabel Firma --}}
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    {{-- Form CV --}}
    @elseif (\Request::is('cv'))
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content') {{-- Menampilkan tabel CV --}}
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    {{-- Form Yayasan --}}
    @elseif (\Request::is('yayasan'))
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content') {{-- Menampilkan tabel Yayasan --}}
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>

    @else
        @include('admin.layouts.navbars.auth.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
            @include('admin.layouts.navbars.auth.nav')
            <div class="container-fluid py-4">
                @yield('content')
                @include('admin.layouts.footers.auth.footer')
            </div>
        </main>
    @endif

    @include('admin.components.fixed-plugin')
@endsection
