<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Catatan Kehadiran Pegawai BMKG Kotim">
    <meta name="author" content="Febrian Yudhistira">

    <title>{{ $judul }} - {{ env('APP_NAME') }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/all.min.css') }}">
    <link href="{{ asset('vendor/app/css/redesign.css') }}" rel="stylesheet">
</head>

<body class="auth-page">
    @include('sweetalert::alert')
    
    <div class="auth-card">
        <div class="row g-0 h-100">
            <div class="col-md-5 d-none d-md-block">
                <div class="auth-logo-container">
                    <div class="text-center">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Cakep Logo" class="img-fluid mb-4" style="max-height: 120px;">
                        <h4 class="text-white font-weight-bold">{{ env('APP_NAME', 'Aplikasi Presensi') }}</h4>
                        <p class="text-white-50 small mb-0">Aplikasi Catatan Kehadiran Pegawai<br>BMKG Kotim</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 d-flex align-items-center">
                <div class="auth-form-container w-100">
                    <div class="text-center d-block d-md-none mb-4">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Cakep Logo" class="img-fluid" style="max-height: 80px;">
                    </div>
                    @yield('konten')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
