@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="custom-card">
            <div class="custom-card-header bg-white border-bottom-0 pt-4 pb-0">
                <div class="text-center">
                    <div class="d-inline-flex justify-content-center align-items-center bg-warning text-dark rounded-circle mb-3 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="fas fa-key fa-2x"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark">Ganti Password</h5>
                    <p class="text-muted small">Perbarui password Anda secara berkala</p>
                </div>
            </div>
            <div class="custom-card-body pt-2">
                <form action="{{ route('user.gantipassword') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="password_lama" class="font-weight-bold text-dark">Password Lama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-unlock-alt text-muted"></i></span>
                            </div>
                            <input type="password" class="form-control custom-input border-left-0 pl-0" id="password_lama" placeholder="Masukkan Password Lama" name="password_lama">
                        </div>
                        @error('password_lama')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="password_baru" class="font-weight-bold text-dark">Password Baru</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                            </div>
                            <input type="password" class="form-control custom-input border-left-0 pl-0" id="password_baru" placeholder="Masukkan Password Baru" name="password_baru">
                        </div>
                        @error('password_baru')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="password_baru_confirmation" class="font-weight-bold text-dark">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-check-circle text-muted"></i></span>
                            </div>
                            <input type="password" class="form-control custom-input border-left-0 pl-0" id="password_baru_confirmation" placeholder="Masukkan Kembali Password Baru" name="password_baru_confirmation">
                        </div>
                        @error('password_baru_confirmation')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold rounded-pill shadow">
                        <i class="fas fa-save mr-2"></i> SIMPAN PERUBAHAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
