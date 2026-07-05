<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Catatan Kehadiran Pegawai BMKG Kotim">
    <meta name="author" content="Febrian Yudhistira">

    <title>{{ $judul }} - {{ env('APP_NAME') }}</title>

    <link href="{{ asset('vendor/fontawesome/all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/app/css/redesign.css') }}" rel="stylesheet" media="all">

    @yield('css')
</head>

<body class="app-body">
    @include('sweetalert::alert')
    
    @php
        $activeUser = null;
        $activeRole = 'Pengguna';
        if (request()->is('admin*') && auth()->guard('admin')->check()) {
            $activeUser = auth()->guard('admin')->user();
            $activeRole = 'Administrator';
        } elseif (auth()->guard('user')->check()) {
            $activeUser = auth()->guard('user')->user();
            $activeRole = 'Pegawai';
        }
        
        if (!$activeUser) {
            $activeUser = (object)[
                'nama' => 'Guest',
                'username' => 'guest'
            ];
        }
    @endphp

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-glass fixed-top">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand navbar-brand-text d-flex align-items-center" href="{{ $activeRole == 'Admin' ? route('admin.dashboard') : route('user.dashboard') }}">
                <i class="fas fa-clock text-primary mr-2"></i> {{ env('APP_NAME', 'Aplikasi Presensi') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-dark"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @include('layouts.partials.navbar')
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle text-primary mr-2" style="font-size: 32px;"></i>
                            <span class="font-weight-bold">{{ explode(' ', trim($activeUser->nama))[0] }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-item-text">
                                <h6 class="mb-0 font-weight-bold">{{ $activeUser->nama }}</h6>
                                <small class="text-muted">{{ $activeRole }}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            @if(request()->is('admin*'))
                                <a class="dropdown-item" href="{{ route('admin.gantipassword') }}"><i class="fas fa-key mr-2"></i> Ganti Password</a>
                            @else
                                <a class="dropdown-item" href="{{ route('user.gantipassword') }}"><i class="fas fa-key mr-2"></i> Ganti Password</a>
                            @endif
                            <form action="{{ route('keluar') }}" method="post" class="px-2 mt-2">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger rounded font-weight-bold">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="content-wrapper">
        <div class="container">
            @yield('konten')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <div class="text-muted">
                App created by <a href="https://github.com/febrianyudhis" target="_blank" rel="noopener noreferrer">Febrian Yudhis</a>
            </div>
        </div>
    </footer>

    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle logic
            $('#sidebarToggleBtn, #closeSidebarBtn').on('click', function(e) {
                e.preventDefault();
                $('.sidebar').toggleClass('active');
            });
            
            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() < 768) {
                    if (!$(e.target).closest('.sidebar').length && 
                        !$(e.target).closest('#sidebarToggleBtn').length && 
                        $('.sidebar').hasClass('active')) {
                        $('.sidebar').removeClass('active');
                    }
                }
            });
        });
    </script>

    @yield('js')
</body>
</html>
