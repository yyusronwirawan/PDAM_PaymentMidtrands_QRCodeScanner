<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemakaianPelangganController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        return view('pemakaian-pelanggan.index', [
            'pemakaians'    => Pemakaian::where('user_id', $user)
                                ->orderBy('id', 'DESC')
                                ->get()
        ]);
    }
}
