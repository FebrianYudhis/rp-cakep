@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 mt-4">
        <div class="custom-card shadow-lg text-center border-danger" style="border-top: 5px solid #dc3545;">
            <div class="custom-card-body pt-5 pb-4">
                <div class="d-inline-flex justify-content-center align-items-center bg-danger text-white rounded-circle mb-4 shadow" style="width: 80px; height: 80px;">
                    <i class="fas fa-lock fa-3x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Akun Anda Terkunci</h4>
                
                <p class="mt-4 mb-2 text-muted">
                    Halo, <span class="font-italic font-weight-bold text-dark">{{ auth()->user()->nama ?? 'Pengguna' }}</span>! 
                    Maaf, akses Anda ke aplikasi telah dikunci.
                </p>
                <div class="alert alert-danger mt-4 mb-0 text-left border-0 shadow-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i> <strong>Alasan:</strong> Status akun Anda saat ini tidak aktif atau telah dinonaktifkan oleh administrator.
                    <br><br>
                    <i class="fas fa-info-circle mr-2"></i> Silahkan hubungi <strong>Administrator</strong> untuk membuka kembali akses akun Anda.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
