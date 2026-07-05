<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AppController extends Controller
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard User',
            'aktif' => 'dashboard',
            'akun' => Auth::guard('user')->user(),
            'presensidatang' => Presensi::where('user_id', Auth::guard('user')->user()->id)->where('tanggal', '>=', Carbon::now()->subMonth()->lastOfMonth())->whereNull('jam_masuk')->count(),
            'presensipulang' => Presensi::where('user_id', Auth::guard('user')->user()->id)->where('tanggal', '>=', Carbon::now()->subMonth()->lastOfMonth())->whereNull('jam_keluar')->count(),
        ];
        return view('app.dashboard', $data);
    }

    public function terkunci()
    {
        if (Auth::guard('user')->user()->status == 1) {
            return redirect()->route('user.dashboard');
        }
        $data = [
            'judul' => 'Terkunci',
            'aktif' => '',
            'akun' => Auth::guard('user')->user(),
            'tanggal' => Carbon::parse(Auth::guard('user')->user()->created_at)->format('l,d M Y - H:i'),
        ];
        return view('app.status', $data);
    }

    public function gantipassword()
    {
        $data = [
            'judul' => 'Ganti Password',
            'aktif' => '',
            'akun' => Auth::guard('user')->user()
        ];
        return view('app.gantipassword', $data);
    }

    public function gantipasswordpost()
    {
        request()->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $akun = User::find(Auth::guard('user')->user()->id);

        if (Hash::check(request('password_lama'), $akun->password)) {
            $akun->password = Hash::make(request('password_baru'));
            $akun->save();

            Alert::success('Berhasil', 'Password Berhasil Diganti');
            return redirect()->route('user.gantipassword');
        } else {
            Alert::error('Gagal', 'Password Lama Salah');
            return redirect()->route('user.gantipassword');
        }
    }

    public function presensidatang()
    {
        $data = [
            'judul' => 'Presensi Datang',
            'aktif' => 'presensi',
            'akun' => Auth::guard('user')->user(),
            'jam' => Carbon::now(),
            'tanggal' => Carbon::now()->format('Y-m-d')
        ];
        return view('app.presensi.datang', $data);
    }

    public function catatpresensidatang(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|before:' . Carbon::now()->addDay()->toDateString() . '|after:' . Carbon::now()->subDays(2)->toDateString()
        ]);

        $cek = Presensi::where('tanggal', request('tanggal'))->where('user_id', Auth::guard('user')->user()->id);

        if ($cek->count() > 0) {
            $presensi = $cek->where('jam_masuk', null)->first();

            if ($presensi != null) {
                $presensi->jam_masuk = Carbon::now();
                $presensi->save();
                Alert::success('Berhasil', 'Presensi Masuk Berhasil');
                return redirect()->route('user.dashboard');
            } else {
                if ($request->tetapPresensi) {
                    Presensi::create([
                        'user_id' => Auth::guard('user')->user()->id,
                        'tanggal' => request('tanggal'),
                        'jam_masuk' => Carbon::now(),
                    ]);
                    Alert::success('Berhasil', 'Presensi Masuk Berhasil');
                    return redirect()->route('user.dashboard');
                } else {
                    return redirect()->back()->with('presensi_sudah_ada', true);
                }
            }
        } else {
            Presensi::create([
                'user_id' => Auth::guard('user')->user()->id,
                'tanggal' => request('tanggal'),
                'jam_masuk' => Carbon::now()
            ]);
            Alert::success('Berhasil', 'Presensi Masuk Berhasil');
            return redirect()->route('user.dashboard');
        }
    }

    public function presensipulang()
    {
        $data = [
            'judul' => 'Presensi Pulang',
            'aktif' => 'presensi',
            'akun' => Auth::guard('user')->user(),
            'jam' => Carbon::now(),
            'tanggal' => Carbon::now()->format('Y-m-d')
        ];
        return view('app.presensi.pulang', $data);
    }

    public function catatpresensipulang(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|before:' . Carbon::now()->addDay()->toDateString() . '|after:' . Carbon::now()->subDays(2)->toDateString()
        ]);

        $cek = Presensi::where('tanggal', request('tanggal'))->where('user_id', Auth::guard('user')->user()->id);

        if ($cek->count() > 0) {
            $presensi = $cek->where('jam_keluar', null)->first();

            if ($presensi != null) {
                $presensi->jam_keluar = Carbon::now();
                $presensi->save();
                Alert::success('Berhasil', 'Presensi Pulang Berhasil');
                return redirect()->route('user.dashboard');
            } else {
                if ($request->tetapPresensi) {
                    Presensi::create([
                        'user_id' => Auth::guard('user')->user()->id,
                        'tanggal' => request('tanggal'),
                        'jam_keluar' => Carbon::now(),
                    ]);
                    Alert::success('Berhasil', 'Presensi Pulang Berhasil');
                    return redirect()->route('user.dashboard');
                } else {
                    return redirect()->back()->with('presensi_sudah_ada', true);
                }
            }
        } else {
            Presensi::create([
                'user_id' => Auth::guard('user')->user()->id,
                'tanggal' => request('tanggal'),
                'jam_keluar' => Carbon::now()
            ]);
            Alert::success('Berhasil', 'Presensi Pulang Berhasil');
            return redirect()->route('user.dashboard');
        }
    }
}
