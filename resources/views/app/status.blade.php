@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 mt-4">
        <div class="custom-card shadow-lg text-center">
            <div class="custom-card-body pt-5 pb-4">
                @if($akun->status == 1)
                <div class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle mb-4 shadow" style="width: 80px; height: 80px;">
                    <i class="fas fa-check fa-3x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Status Akun: Aktif</h4>
                @else
                <div class="d-inline-flex justify-content-center align-items-center bg-danger text-white rounded-circle mb-4 shadow" style="width: 80px; height: 80px;">
                    <i class="fas fa-times fa-3x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Status Akun: Nonaktif</h4>
                @endif
                
                <p class="mt-4 mb-2 text-muted">
                    Halo, <span class="font-italic font-weight-bold text-dark">{{ $akun->nama }}</span>! Anda terdaftar dalam sistem pada:
                    <br><span class="font-italic font-weight-bold text-primary">{{ $tanggal }}</span>
                </p>
                <div class="alert alert-light mt-4 mb-0 border">
                    <i class="fas fa-info-circle text-info mr-2"></i> Silahkan hubungi administrator untuk informasi lebih lanjut mengenai status akun Anda.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
