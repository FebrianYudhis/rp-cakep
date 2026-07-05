@extends('layouts.app')

@section('konten')
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stat-card stat-danger">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="number">{{ $jumlahakun }}</div>
            <div class="desc">Jumlah Akun</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stat-card stat-warning">
            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
            <div class="number">{{ $jumlahpresensi }}</div>
            <div class="desc">Jumlah Data Presensi</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stat-card stat-primary">
            <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="number">{{ $presensidatang }}</div>
            <div class="desc">Belum Presensi Datang</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stat-card stat-success">
            <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="number">{{ $presensipulang }}</div>
            <div class="desc">Belum Presensi Pulang</div>
        </div>
    </div>
</div>

<div class="custom-card mt-2">
    <div class="custom-card-header">
        <h5 class="mb-0 font-weight-bold"><i class="fas fa-info-circle mr-2 text-primary"></i>Informasi Admin</h5>
    </div>
    <div class="custom-card-body">
        <p class="text-muted mb-0">Selamat datang di Panel Admin {{ env('APP_NAME', 'Aplikasi Presensi') }}. Dari sini Anda dapat mengelola data pegawai, memantau presensi secara real-time, dan mengatur formulir presensi.</p>
    </div>
</div>
@endsection
