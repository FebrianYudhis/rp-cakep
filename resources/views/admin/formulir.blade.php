@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="custom-card">
            <div class="custom-card-header bg-white border-bottom-0 pb-0 pt-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-file-invoice fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold text-dark">Generate Formulir Presensi</h5>
                        <p class="text-muted small mb-0">Buat laporan presensi berdasarkan rentang tanggal dan pegawai</p>
                    </div>
                </div>
            </div>
            <div class="custom-card-body pt-3">
                <form action="{{ route('admin.formulir') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggalAwal" class="font-weight-bold text-dark small">Tanggal Awal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="far fa-calendar-alt text-muted"></i></span>
                                </div>
                                <input type="date" class="form-control custom-input border-left-0 pl-0" id="tanggalAwal" name="tanggalAwal" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tanggalAkhir" class="font-weight-bold text-dark small">Tanggal Akhir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="far fa-calendar-alt text-muted"></i></span>
                                </div>
                                <input type="date" class="form-control custom-input border-left-0 pl-0" id="tanggalAkhir" name="tanggalAkhir" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="nama" class="font-weight-bold text-dark small">Pilih Pegawai</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-tie text-muted"></i></span>
                            </div>
                            <select class="custom-select custom-input border-left-0 pl-0" id="nama" name="id" required>
                                <option value="" disabled selected>-- Pilih Pegawai --</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold rounded-pill shadow">
                        <i class="fas fa-print mr-2"></i> Buat Laporan Presensi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
