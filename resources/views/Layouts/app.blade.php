<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/img/logo_silegal_1_no.png">
    <title>@yield('title', 'Silegal')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/choose_service.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <script src="{{ asset('js/sb-admin-2.js') }}" defer></script>
    <script src="{{ asset('js/forms.js') }}" defer></script>
    <script src="{{ asset('js/preview_ktp_npwp.js') }}" defer></script>
    <script src="{{ asset('js/formyayasan.js') }}" defer></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}" defer></script>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')

    <div class="main-container">
        <!-- Sidebar -->
        {{-- @include('components.sidebar') --}}

        <div class="content">
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    {{-- @include('components.footer') --}}

    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        function showAlert(type, title, text) {
            swal({
                title: title,
                text: text,
                icon: type,
                button: "OK",
            });
        }

        @if(session('success'))
            showAlert('success', 'Berhasil!', "{{ session('success') }}");
        @endif

        @if(session('error'))
            showAlert('error', 'Gagal!', "{{ session('error') }}");
        @endif
    </script>
</body>
</html>
