@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
@endsection

@section('konten')
    <div class="custom-card">
        <div class="custom-card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-users-cog mr-2 text-primary"></i>Manajemen Akun</h5>
        </div>
        <div class="custom-card-body">
            <div class="table-responsive">
                <table id="akun" class="table custom-table table-hover table-striped w-100">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td><span class="font-weight-bold text-dark">{{ $d->username }}</span></td>
                                <td>{{ $d->nama }}</td>
                                <td>
                                    @if($d->status == 1)
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Aktif</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> Nonaktif</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $d->created_at }}</small></td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <form action="{{ route('admin.akun.resetmasuk', $d) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-sm btn-info w-100 konfirmasi" title="Reset perangkat login"><i class="fas fa-desktop mr-1"></i> Reset Masuk</button>
                                        </form>
                                        
                                        @if ($d->status == 0)
                                            <form action="{{ route('admin.akun.aktifkan', $d) }}" method="POST" class="mt-1">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-sm btn-success w-100 konfirmasi" title="Aktifkan Akun"><i class="fas fa-user-check mr-1"></i> Aktifkan</button>
                                            </form>
                                        @elseif ($d->status == 1)
                                            <form action="{{ route('admin.akun.matikan', $d) }}" method="POST" class="mt-1">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-sm btn-warning w-100 konfirmasi" title="Nonaktifkan Akun"><i class="fas fa-user-times mr-1"></i> Matikan</button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.akun.hapus', $d) }}" method="POST" class="mt-1">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger w-100 konfirmasi" title="Hapus Akun"><i class="fas fa-trash-alt mr-1"></i> Hapus</button>
                                        </form>
                                    </div>
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
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari akun...",
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

            $('.konfirmasi').on('click', function(e) {
                let tulisan = $(this).text().trim();
                e.preventDefault();
                var form = $(this).parents('form');

                Swal.fire({
                    icon: 'warning',
                    title: tulisan,
                    text: "Apakah anda yakin ingin melakukan tindakan ini?",
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-check mr-1"></i> Ya, Lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
