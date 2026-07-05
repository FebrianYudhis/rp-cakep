@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endsection

@section('konten')
<div class="alert alert-info border-0 shadow-sm rounded mb-4 pb-2 pt-3 px-4 d-flex align-items-center">
    <i class="fas fa-info-circle fa-2x text-info mr-3"></i>
    <div>
        <h6 class="font-weight-bold mb-1">Informasi Penting</h6>
        <p class="mb-0 small text-muted">Mohon perhatikan kembali tanggal shift sebelum Presensi. Jika ada kendala dengan aplikasi, silahkan hubungi administrator.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="stat-card stat-primary">
            <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <div class="number">{{ $presensidatang }}</div>
            <div class="desc">Belum Presensi Datang (Bulan Ini)</div>
            <a href="{{ route('user.presensi.datang') }}" class="btn btn-light btn-sm mt-3 w-100 font-weight-bold rounded-pill text-primary" style="position: relative; z-index: 2;">
                <i class="fas fa-fingerprint mr-2"></i> Presensi Datang
            </a>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="stat-card stat-success">
            <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="number">{{ $presensipulang }}</div>
            <div class="desc">Belum Presensi Pulang (Bulan Ini)</div>
            <a href="{{ route('user.presensi.pulang') }}" class="btn btn-light btn-sm mt-3 w-100 font-weight-bold rounded-pill text-success" style="position: relative; z-index: 2;">
                <i class="fas fa-fingerprint mr-2"></i> Presensi Pulang
            </a>
        </div>
    </div>
</div>

<div class="custom-card mt-2">
    <div class="custom-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold"><i class="fas fa-history mr-2 text-primary"></i>Daftar Presensi Anda</h5>
    </div>
    <div class="custom-card-body">
        <div class="table-responsive">
            <table class="table custom-table table-hover table-striped w-100" id="presensi">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
       $('#presensi').DataTable({
            paging: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('data.presensi.pribadi') }}',
            columns: [
                { data: 'tanggal', name: 'tanggal' },
                { data: 'jam_masuk', name: 'jam_masuk' },
                { data: 'jam_keluar', name: 'jam_keluar' }
            ],
            order: [[ 0, 'desc' ]],
            "columnDefs": [
                { "searchable": false, "targets": [1,2] }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari data...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
     });
</script>
@endsection
