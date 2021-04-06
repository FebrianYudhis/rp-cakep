<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'jumlahabsen' => Absent::count(),
            'absendatang' => Absent::whereNull('jam_masuk')->count(),
            'absenpulang' => Absent::whereNull('jam_keluar')->count(),
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

    public function absen()
    {
        if (request('mulai') && request('sampai') && request('nama')) {
            $query = Absent::with('user')->where('tanggal', '>=', request('mulai'))->where('tanggal', '<=', request('sampai'))->where('user_id', request('nama'))->get();
        } elseif (request('mulai') && request('sampai')) {
            $query = Absent::with('user')->where('tanggal', '>=', request('mulai'))->where('tanggal', '<=', request('sampai'))->get();
        } elseif (request('mulai')) {
            $query = Absent::with('user')->where('tanggal', request('mulai'))->get();
        } elseif (request('nama')) {
            $query = Absent::with('user')->where('user_id', request('nama'))->get();
        } else {
            $query = Absent::with('user')->limit(40)->get();
        }

        $data = [
            'judul' => 'Absen',
            'aktif' => 'absen',
            'akun' => Auth::guard('admin')->user(),
            'data' => $query,
            'nama' => User::where('status', 1)->get()
        ];
        return view('admin.absen', $data);
    }

    public function editabsen(Absent $absent)
    {
        dd($absent);
    }
}
