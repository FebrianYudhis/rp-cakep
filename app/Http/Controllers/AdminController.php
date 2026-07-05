<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard Admin',
            'aktif' => 'dashboard',
            'akun' => Auth::guard('admin')->user(),
            'jumlahakun' => User::count(),
            'jumlahpresensi' => Presensi::count(),
            'presensidatang' => Presensi::whereNull('jam_masuk')->count(),
            'presensipulang' => Presensi::whereNull('jam_keluar')->count(),
        ];
        return view('admin.dashboard', $data);
    }

    public function gantipassword()
    {
        $data = [
            'judul' => 'Ganti Password',
            'aktif' => '',
            'akun' => Auth::guard('admin')->user()
        ];
        return view('admin.gantipassword', $data);
    }

    public function gantipasswordpost()
    {
        request()->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $akun = Admin::find(Auth::guard('admin')->user()->id);

        if (Hash::check(request('password_lama'), $akun->password)) {
            $akun->password = Hash::make(request('password_baru'));
            $akun->save();

            Alert::success('Berhasil', 'Password Berhasil Diganti');
            return redirect()->route('admin.gantipassword');
        } else {
            Alert::error('Gagal', 'Password Lama Salah');
            return redirect()->route('admin.gantipassword');
        }
    }

    public function akun()
    {
        $data = [
            'judul' => 'List Akun',
            'aktif' => 'akun',
            'akun' => Auth::guard('admin')->user(),
            'data' => User::get()
        ];
        return view('admin.akun', $data);
    }

    public function resetmasuk(User $user)
    {
        $user->is_login = null;
        $user->user_agent = null;
        $user->save();

        Alert::success('Berhasil', 'Reset Masuk Akun Berhasil Dilakukan');
        return redirect()->route('admin.akun');
    }

    public function aktifkanakun(User $user)
    {
        $user->status = 1;
        $user->save();

        Alert::success('Berhasil', 'Akun Berhasil Diaktifkan');
        return redirect()->route('admin.akun');
    }

    public function matikanakun(User $user)
    {
        $user->status = 0;
        $user->save();

        Alert::success('Berhasil', 'Akun Berhasil Dimatikan');
        return redirect()->route('admin.akun');
    }

    public function hapusakun(User $user)
    {
        $user->delete();

        Alert::success('Berhasil', 'Akun Berhasil Dihapus');
        return redirect()->route('admin.akun');
    }

    public function presensi()
    {
        if (request('mulai') && request('sampai') && request('nama')) {
            $query = Presensi::with('user')->where('tanggal', '>=', request('mulai'))->where('tanggal', '<=', request('sampai'))->where('user_id', request('nama'))->get();
        } elseif (request('mulai') && request('sampai')) {
            $query = Presensi::with('user')->where('tanggal', '>=', request('mulai'))->where('tanggal', '<=', request('sampai'))->get();
        } elseif (request('mulai')) {
            $query = Presensi::with('user')->where('tanggal', request('mulai'))->get();
        } elseif (request('nama')) {
            $query = Presensi::with('user')->where('user_id', request('nama'))->get();
        } else {
            $query = Presensi::with('user')->limit(40)->get();
        }

        $data = [
            'judul' => 'List Presensi',
            'aktif' => 'presensi',
            'akun' => Auth::guard('admin')->user(),
            'data' => $query,
            'nama' => User::where('status', 1)->get()
        ];
        return view('admin.presensi', $data);
    }

    public function editpresensi(Presensi $presensi)
    {
        if ($presensi->jam_masuk == null) {
            $presensi->jam_masuk = null;
        } else {
            $presensi->jam_masuk = Carbon::parse($presensi->jam_masuk)->format("Y-m-d\TH:i");
        }

        if ($presensi->jam_keluar == null) {
            $presensi->jam_keluar = null;
        } else {
            $presensi->jam_keluar = Carbon::parse($presensi->jam_keluar)->format("Y-m-d\TH:i");
        }

        $data = [
            'judul' => 'Edit Presensi',
            'aktif' => 'presensi',
            'akun' => Auth::guard('admin')->user(),
            'data' => $presensi->load('user'),
        ];
        return view('admin.editpresensi', $data);
        dd($presensi->jam_keluar);
    }

    public function updatepresensi(Presensi $presensi)
    {
        if (request('jam_masuk') == null) {
            $presensi->jam_masuk = null;
        } else {
            $presensi->jam_masuk = Carbon::parse(request('jam_masuk'))->toDateTime();
        }

        if (request('jam_keluar') == null) {
            $presensi->jam_keluar = null;
        } else {
            $presensi->jam_keluar = Carbon::parse(request('jam_keluar'))->toDateTime();
        }

        $presensi->save();
        Alert::success('Berhasil', 'Berhasil Mengubah Presensi ' . '\'' . $presensi->user->username . '\'' . ' Pada Tanggal ' . $presensi->tanggal);
        return redirect()->route('admin.presensi');
    }

    public function formulir()
    {
        $data = [
            'judul' => 'Generate Formulir Presensi',
            'aktif' => 'formulir',
            'akun' => Auth::guard('admin')->user(),
            'user' => User::all()
        ];
        return view('admin.formulir', $data);
    }

    public function generateformulir()
    {
        $id =  Request::post('id');
        $nama = User::find($id);

        $tanggalAwal = Carbon::parse(Request::post('tanggalAwal'));
        $tanggalAkhir = Carbon::parse(Request::post('tanggalAkhir'));
        $perbedaan = $tanggalAwal->diffInDays($tanggalAkhir->addDay());

        $period = CarbonPeriod::create($tanggalAwal, $tanggalAkhir);
        foreach ($period as $p) {
            $dates[] = $p->format('Y-m-d');
        }

        $isi = [];
        for ($i = 1; $i <= $perbedaan; $i++) {
            $tanggal = $dates[$i - 1];
            $cari = User::find($id)->presensi->where('tanggal', $tanggal)->toArray();

            if ($cari != NULL) {
                foreach ($cari as $data) {

                    if ($data['jam_masuk'] == NULL) {
                        $jam_masuk = '-';
                    } else {
                        $jam_masuk = Carbon::parse($data['jam_masuk'])->format('H:i');
                    }

                    if ($data['jam_keluar'] == NULL) {
                        $jam_keluar = '-';
                    } else {
                        $jam_keluar = Carbon::parse($data['jam_keluar'])->format('H:i');
                    }

                    $tambah = [
                        'i' => $i,
                        'tanggal' => Carbon::parse($tanggal)->format('d-m-Y'),
                        'datang' => $jam_masuk,
                        'ttdd' => '',
                        'pulang' => $jam_keluar,
                        'ttdp' => '',
                        'keterangan' => ''
                    ];
                    array_push($isi, $tambah);
                }
            } else {
                $tambah = [
                    'i' => $i,
                    'tanggal' => Carbon::parse($tanggal)->format('d-m-Y'),
                    'datang' => '-',
                    'ttdd' => '-',
                    'pulang' => '-',
                    'ttdp' => '-',
                    'keterangan' => 'LIBUR'
                ];
                array_push($isi, $tambah);
            }
        }
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Presensi.docx');
        $templateProcessor->setValue('nama', $nama->nama);
        $templateProcessor->setValue('nrp', $nama->no_identity);
        $templateProcessor->cloneRowAndSetValues('i', $isi);

        header("Content-Disposition: attachment; filename=" . $nama->nama . ".docx");
        $templateProcessor->saveAs('php://output');
    }
}
