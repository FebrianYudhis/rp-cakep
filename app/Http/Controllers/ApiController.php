<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function presensipribadi()
    {
        $query = Presensi::where('user_id', Auth::guard('user')->user()->id)->get();
        return datatables($query)
            ->editColumn('jam_masuk', function ($data) {
                if ($data->jam_masuk == null) {
                    return 'Belum Presensi';
                } else {
                    return $data->jam_masuk;
                }
            })
            ->editColumn('jam_keluar', function ($data) {
                if ($data->jam_keluar == null) {
                    return 'Belum Presensi';
                } else {
                    return $data->jam_keluar;
                }
            })
            ->rawColumns(['jam_masuk', 'jam_keluar'])
            ->toJson();
    }
}
