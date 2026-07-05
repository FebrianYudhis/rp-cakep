@extends('layouts.auth')

@section('konten')
<div class="px-md-4">
    <div class="text-center mb-4">
        <h3 class="font-weight-bold text-dark mb-1">Admin Panel</h3>
        <p class="text-muted">Login sebagai administrator</p>
    </div>

    <form method="POST" action="{{ route('admin.masuk') }}">
        @csrf
        
        <div class="form-group mb-3">
            <label class="form-label text-dark font-weight-bold">Username Admin</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-shield text-muted"></i></span>
                </div>
                <input type="text" class="form-control custom-input border-left-0 pl-0" id="username" placeholder="Masukkan Username" name="username" value="{{ old('username') }}">
            </div>
            @error('username')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mb-3">
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

        <div class="form-group mb-4 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label text-muted" for="remember">
                Ingat Saya
            </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block py-2 mt-2 font-weight-bold">MASUK ADMIN</button>
    </form>
</div>
@endsection
