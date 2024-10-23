<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="{{ asset('./css/login.css') }}">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>
<body>
<div class="container">
    <div class="screen">
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
        <div class="screen__content">
            <img src="{{ asset('images/logo_silegal_1_no.png') }}" 
            alt="Logo" 
            class="header-logo" 
            style="max-width: 300px; max-height: 300px; margin-bottom: 0px; margin-top: -10px; filter: drop-shadow(0px 20px 30px rgba(0, 0, 0, 0.2));">
        <form class="login" role="form" method="POST" action="/session">
               
                @csrf
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="email" class="login__input" name="email" id="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" required>
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="login__input" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                </div>
                <button type="submit" class="button login__submit">
                    <span class="button__text">Log In</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
           
        </div>
    </div>
</div>
<!-- SweetAlert JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Cek untuk notifikasi sukses -->
@if(session('success'))
    <script>
        swal({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif

<!-- Cek untuk notifikasi error -->
@if(session('error'))
    <script>
        swal({
            title: "Gagal!",
            text: "{{ session('error') }}",
            icon: "error",
            button: "OK",
        });
    </script>
@endif

</body>
</html>
