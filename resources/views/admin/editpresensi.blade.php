@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="custom-card">
            <div class="custom-card-header bg-white border-bottom-0 pb-0">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning text-dark rounded-circle d-flex justify-content-center align-items-center mr-3 shadow-sm" style="width: 50px; height: 50px;">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold text-dark">Edit Data Presensi</h5>
                        <p class="text-muted small mb-0">Sesuaikan waktu masuk dan keluar pegawai</p>
                    </div>
                </div>
            </div>
            <div class="custom-card-body pt-3">
                <form action="{{ route('admin.presensi.edit', $data) }}" method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="form-row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="font-weight-bold text-dark small">Username Pegawai</label>
                            <div class="bg-light p-2 rounded border text-muted">
                                <i class="fas fa-user mr-2"></i> {{ $data->user->username }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold text-dark small">Tanggal Shift</label>
                            <div class="bg-light p-2 rounded border text-muted">
                                <i class="far fa-calendar-alt mr-2"></i> {{ $data->tanggal }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="jam_masuk" class="font-weight-bold text-dark">Waktu Jam Masuk</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-sign-in-alt text-success"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control custom-input border-left-0 pl-0" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') ?? $data->jam_masuk }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning reset" type="button" title="Kosongkan Jam Masuk"><i class="fas fa-undo"></i></button>
                            </div>
                        </div>
                        @error('jam_masuk')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="jam_keluar" class="font-weight-bold text-dark">Waktu Jam Keluar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-sign-out-alt text-danger"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control custom-input border-left-0 pl-0" id="jam_keluar" name="jam_keluar" value="{{ old('jam_keluar') ?? $data->jam_keluar }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-warning reset" type="button" title="Kosongkan Jam Keluar"><i class="fas fa-undo"></i></button>
                            </div>
                        </div>
                        @error('jam_keluar')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold rounded-pill shadow konfirmasi">
                        <i class="fas fa-save mr-2"></i> SIMPAN PERUBAHAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/sweetalert/sw2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.reset').on('click', function(e) {
            e.preventDefault();
            // Find the closest input within the same input-group
            $(this).closest('.input-group').find('input').val('');
        });

        $('.konfirmasi').on('click', function(e) {
            let tulisan = $(this).text().trim();
            e.preventDefault();
            var form = $(this).parents('form');

            Swal.fire({
                icon: 'warning',
                title: tulisan,
                text: "Apakah anda yakin ingin mengubah data presensi ini?",
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
