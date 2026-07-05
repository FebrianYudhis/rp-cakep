<li class="nav-item {{ $aktif == 'dashboard' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item dropdown {{ $aktif == 'presensi' ? 'active' : '' }}">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPresensi" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-book"></i> Presensi
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownPresensi">
        <a class="dropdown-item" href="{{ route('user.presensi.datang') }}">Datang</a>
        <a class="dropdown-item" href="{{ route('user.presensi.pulang') }}">Pulang</a>
    </div>
</li>
