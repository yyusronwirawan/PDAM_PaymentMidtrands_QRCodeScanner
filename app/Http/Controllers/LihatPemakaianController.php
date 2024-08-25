<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LihatPemakaianController extends Controller
{
    public function index()
    {
        return view('lihat-pemakaian.index', [
            'pemakaians'    => Pemakaian::with(['user', 'periode'])->orderBy('id', 'DESC')->get()
        ]);
    }
}
