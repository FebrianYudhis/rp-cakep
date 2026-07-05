@extends('layouts.auth')

@section('konten')
<div class="px-md-4">
    <h3 class="font-weight-bold text-dark mb-1">Selamat Datang!</h3>
    <p class="text-muted mb-4">Silahkan masuk ke akun Anda</p>

    <form method="POST" action="{{ route('user.masuk') }}">
        @csrf
        
        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span>
                </div>
                <input type="text" class="form-control custom-input border-left-0 pl-0" id="username" placeholder="Masukkan Username" name="username" value="{{ old('username') }}">
            </div>
            @error('username')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-4">
            <label class="form-label text-dark font-weight-bold">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                </div>
                <input type="password" class="form-control custom-input border-left-0 pl-0" id="password" placeholder="Masukkan Password" name="password" value="{{ old('password') }}">
            </div>
            @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="alert alert-warning small py-2">
            <i class="fas fa-info-circle mr-1"></i> Hanya dapat masuk pada satu perangkat.
        </div>

        <button type="submit" class="btn btn-primary btn-block py-2 mt-4 font-weight-bold">MASUK</button>
        
        <div class="text-center mt-4">
            <p class="text-muted mb-0">Belum punya akun? <a href="{{ route('user.daftar') }}" class="text-primary font-weight-bold text-decoration-none">Daftar sekarang</a></p>
        </div>
    </form>
</div>
@endsection
