@extends('layouts.app')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="custom-card">
            <div class="custom-card-header text-center border-bottom-0 pb-0">
                <div class="d-inline-flex justify-content-center align-items-center bg-primary text-white rounded-circle mb-3 shadow" style="width: 70px; height: 70px;">
                    <i class="fas fa-sign-in-alt fa-2x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Presensi Datang</h4>
                <p class="text-muted small">Catat kehadiran Anda hari ini</p>
            </div>
            <div class="custom-card-body pt-2">
                <form action="{{ route('user.presensi.datang') }}" method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="form-group mb-3">
                        <label for="tanggal" class="font-weight-bold text-dark mb-2">Tanggal Shift</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="far fa-calendar-alt text-muted"></i></span>
                            </div>
                            <input type="date" class="form-control custom-input border-left-0 pl-0" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $tanggal }}">
                        </div>
                        @error('tanggal')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="card border border-warning shadow-sm mb-4" style="border-radius: 12px; background-color: #fffdf5;">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div class="mr-3">
                                <h6 class="font-weight-bold text-dark mb-1"><i class="fas fa-exclamation-triangle text-warning mr-2"></i>Tetap Presensi</h6>
                                <small class="text-muted">Aktifkan ini jika Anda ingin memaksa presensi di luar jadwal shift.</small>
                            </div>
                            <div class="custom-control custom-switch" style="transform: scale(1.3); margin-right: 10px;">
                                <input type="checkbox" class="custom-control-input" id="tetapPresensi" name="tetapPresensi">
                                <label class="custom-control-label" style="cursor: pointer;" for="tetapPresensi"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4">
                        <i class="fas fa-clock fa-2x text-info mr-3"></i>
                        <div>
                            Anda akan presensi pada:<br>
                            <span class="font-weight-bold text-dark h5 mb-0" id="jamServer">{{ $jam }}</span><br>
                            <small class="text-muted">Untuk Shift Tanggal: <span id="tanggalshift" class="font-weight-bold text-primary">{{ $tanggal }}</span></small>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold rounded-pill konfirmasi shadow">
                        <i class="fas fa-fingerprint mr-2"></i> Rekam Presensi Datang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/app/js/time.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sw2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.konfirmasi').on('click', function(e) {
            let tulisan = $(this).text().trim();
            e.preventDefault();
            var form = $(this).parents('form');

            Swal.fire({
                icon: 'warning',
                title: tulisan,
                text: "Apakah anda yakin?",
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

        var jamServer = $('#jamServer').text();
        // Fallback robust date parsing in case Date.parse fails
        var jamClient = new Date(jamServer.replace(/-/g, "/"));
        if(isNaN(jamClient.getTime())) {
             jamClient = new Date();
        }

        setInterval(() => {
            jamClient.setSeconds(jamClient.getSeconds() + 1);
            displayTime(jamClient);
        }, 1000);

        function displayTime(date) {
            // Keep local formatting based on input
            var yyyy = date.getFullYear();
            var MM = String(date.getMonth() + 1).padStart(2, '0');
            var dd = String(date.getDate()).padStart(2, '0');
            var hh = String(date.getHours()).padStart(2, '0');
            var mm = String(date.getMinutes()).padStart(2, '0');
            var ss = String(date.getSeconds()).padStart(2, '0');
            
            $('#jamServer').text(`${yyyy}-${MM}-${dd} ${hh}:${mm}:${ss}`);
        }
    });
</script>
@endsection
