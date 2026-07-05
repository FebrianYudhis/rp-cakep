@extends('layouts.auth')

@section('konten')
<div class="px-md-4">
    <h3 class="font-weight-bold text-dark mb-1">Daftar Akun Baru</h3>
    <p class="text-muted mb-4">Lengkapi formulir di bawah ini</p>

    <form method="POST" action="{{ route('user.daftar') }}">
        @csrf
        
        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Nama Lengkap</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-id-badge text-muted"></i></span>
                </div>
                <input type="text" class="form-control custom-input border-left-0 pl-0" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" value="{{ old('nama') }}" required>
            </div>
            @error('nama')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span>
                </div>
                <input type="text" class="form-control custom-input border-left-0 pl-0" id="username" placeholder="Masukkan Username" name="username" value="{{ old('username') }}" required>
            </div>
            @error('username')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Nomor Identitas (NIP/NIK)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-id-card text-muted"></i></span>
                </div>
                <input type="text" class="form-control custom-input border-left-0 pl-0" id="noidentity" placeholder="Masukkan Nomor Identitas" name="noidentity" value="{{ old('noidentity') }}" required>
            </div>
            @error('noidentity')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                </div>
                <input type="password" class="form-control custom-input border-left-0 pl-0" id="password" placeholder="Buat Password" name="password" required>
            </div>
            @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label class="form-label text-dark font-weight-bold">Konfirmasi Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-key text-muted"></i></span>
                </div>
                <input type="password" class="form-control custom-input border-left-0 pl-0" id="password_confirmation" placeholder="Ulangi Password" name="password_confirmation" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block py-2 mt-2 font-weight-bold">DAFTAR SEKARANG</button>
        
        <div class="text-center mt-4">
            <p class="text-muted mb-0">Sudah punya akun? <a href="{{ route('user.masuk') }}" class="text-primary font-weight-bold text-decoration-none">Masuk di sini</a></p>
        </div>
    </form>
</div>
@endsection
