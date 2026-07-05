<li class="nav-item {{ $aktif == 'dashboard' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
</li>
<li class="nav-item {{ $aktif == 'akun' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.akun') }}">
        <i class="fas fa-user"></i> Akun
    </a>
</li>
<li class="nav-item {{ $aktif == 'presensi' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.presensi') }}">
        <i class="fas fa-address-book"></i> Presensi
    </a>
</li>
<li class="nav-item {{ $aktif == 'formulir' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.formulir') }}">
        <i class="fas fa-id-card"></i> Formulir Presensi
    </a>
</li>
