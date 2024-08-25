<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bulan;
use App\Models\Periode;
use App\Models\Pemakaian;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user       = auth()->user()->id;
        return view('dashboard', [
            'tagihanBelumLunas'     => Pemakaian::where('status', 'belum dibayar')->count(),
            'tagihanSudahLunas'          => Pemakaian::where('status', 'lunas')->count(),
            'totalPengguna'         => User::where('role_id', '3')->count(),
            'riwayatPembayarans'    => Pembayaran::orderBy('id', 'DESC')->take(10)->get(),

            'tagihanBelumDibayar'   => Pemakaian::where('user_id', $user)
                ->where('status', 'belum dibayar')
                ->count(),
            'tagihanLunas'          => Pemakaian::where('user_id', $user)
                ->where('status', 'lunas')
                ->count(),
            'pemakaians'            => Pemakaian::where('user_id', $user)->take(10)->get()
        ]);
    }
}
