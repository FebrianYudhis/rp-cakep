<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function masukuser()
    {
        $data = [
            'judul' => "Masuk"
        ];

        return view('auth.user.masuk', $data);
    }

    public function masukuserpost()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('user')->attempt(request()->only('username', 'password'), true)) {
            $user = Auth::guard('user')->user();
            if ($user->is_login == 1) {
                if ($user->user_agent == null or ($user->user_agent == request()->userAgent())) {
                    $user->user_agent = request()->userAgent();
                    $user->save();
                    request()->session()->regenerate();
                    return redirect()->intended(route('user.dashboard'));
                } else {
                    Auth::guard('user')->logout();
                    Alert::error('Gagal', 'Anda Sudah Masuk, Silahkan Hubungi Administrator !');
                    return redirect()->route('user.masuk');
                }
            } else {
                $user->user_agent = request()->userAgent();
                $user->is_login = 1;
                $user->save();
                request()->session()->regenerate();
                return redirect()->intended(route('user.dashboard'));
            }
        } elseif (User::whereUsername(request('username'))->count() == 0) {
            Alert::error('Salah', 'Username Tidak Ada !');
            return redirect()->route('user.masuk');
        } else {
            Alert::error('Salah', 'Password Salah !');
            return redirect()->route('user.masuk');
        }
    }

    public function daftaruser()
    {
        $data = [
            'judul' => "Daftar"
        ];

        return view('auth.user.daftar', $data);
    }

    public function daftaruserpost()
    {
        request()->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|alpha_dash|min:5|unique:users',
            'noidentity' => 'required|max:20',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'username' => request('username'),
            'nama' => request('nama'),
            'no_identity' => request('noidentity'),
            'password' => Hash::make(request('password')),
        ]);

        Alert::success('Berhasil', 'Akun Berhasil Dibuat, Silahkan Masuk !');
        return redirect()->route('user.masuk');
    }

    public function masukadmin()
    {
        $data = [
            'judul' => "Masuk"
        ];

        return view('auth.admin.masuk', $data);
    }

    public function masukadminpost()
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(request()->only('username', 'password'), request()->filled('remember'))) {
            request()->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        } elseif (Admin::whereUsername(request('username'))->count() == 0) {
            Alert::error('Salah', 'Username Tidak Ada !');
            return redirect()->route('admin.masuk');
        } else {
            Alert::error('Salah', 'Password Salah !');
            return redirect()->route('admin.masuk');
        }
    }

    public function keluar()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            Alert::success('Berhasil', 'Berhasil Keluar');
            return redirect()->route('user.masuk');
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            Alert::success('Berhasil', 'Berhasil Keluar');
            return redirect()->route('admin.masuk');
        }
    }
}
