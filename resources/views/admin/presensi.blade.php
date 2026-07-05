@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endsection

@section('konten')
<div class="custom-card mb-4">
    <div class="custom-card-header bg-white border-bottom-0 pb-0">
        <h5 class="mb-0 font-weight-bold"><i class="fas fa-filter mr-2 text-primary"></i>Filter Data Presensi</h5>
    </div>
    <div class="custom-card-body">
        <form action="{{ route('admin.presensi') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-3 mb-3 mb-md-0">
                    <label for="mulai" class="font-weight-bold text-dark small">Tanggal Mulai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="far fa-calendar-alt text-muted"></i></span>
                        </div>
                        <input type="date" class="form-control border-left-0 pl-0" id="mulai" name="mulai">
                    </div>
                </div>
                <div class="form-group col-md-3 mb-3 mb-md-0">
                    <label for="sampai" class="font-weight-bold text-dark small">Tanggal Sampai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="far fa-calendar-alt text-muted"></i></span>
                        </div>
                        <input type="date" class="form-control border-left-0 pl-0" id="sampai" name="sampai">
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3 mb-md-0">
                    <label for="nama" class="font-weight-bold text-dark small">Pengguna</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-user text-muted"></i></span>
                        </div>
                        <select id="nama" class="custom-select border-left-0 pl-0" name="nama">
                            <option disabled selected>-- Pilih Pengguna --</option>
                            @foreach ($nama as $n)
                            <option value="{{ $n->id }}">{{ $n->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-2 mb-0 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 font-weight-bold">
                        <i class="fas fa-search mr-1"></i> Terapkan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="custom-card">
    <div class="custom-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold"><i class="fas fa-list-alt mr-2 text-primary"></i>Daftar Presensi Pegawai</h5>
    </div>
    <div class="custom-card-body">
        <div class="table-responsive">
            <table id="akun" class="table custom-table table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr>
                        <td><span class="font-weight-bold text-dark">{{ $d->user->username }}</span></td>
                        <td>{{ $d->tanggal }}</td>
                        <td>
                            @if($d->jam_masuk == null)
                                <span class="badge badge-warning px-2 py-1">Belum Presensi</span>
                            @else
                                <span class="text-success font-weight-bold"><i class="fas fa-sign-in-alt mr-1"></i> {{ $d->jam_masuk }}</span>
                            @endif
                        </td>
                        <td>
                            @if($d->jam_keluar == null)
                                <span class="badge badge-warning px-2 py-1">Belum Presensi</span>
                            @else
                                <span class="text-danger font-weight-bold"><i class="fas fa-sign-out-alt mr-1"></i> {{ $d->jam_keluar }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.presensi.edit',$d) }}" class="btn btn-sm btn-warning w-100 konfirmasi-edit" title="Edit Data Presensi"><i class="fas fa-edit mr-1"></i> Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sw2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#akun').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"lBf>rtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-sm btn-light border',
                    exportOptions: { columns: ':visible' }   
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-light border',
                    exportOptions: { columns: ':visible' }   
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-sm btn-light border'
                }
            ],
            order: [[ 1, 'desc' ]],
            "columnDefs": [
                { "searchable": false, "targets": [2,3] }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari data...",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 s/d 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    } );
</script>
@endsection
