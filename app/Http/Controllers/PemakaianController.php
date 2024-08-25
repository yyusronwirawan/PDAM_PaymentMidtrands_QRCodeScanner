<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\periode;
use App\Models\Tarif;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PemakaianController extends Controller
{
    public function index()
    {
        return view('catat-pemakaian.index', [
            'users'        => User::where('role_id', '3')->get(),
            'periodes'     => Periode::where('status', 'Aktif')->get(),
        ]);
    }

    public function getData($user_id)
    {
        $dataPenggunaan = Pemakaian::where('user_id', $user_id)
            ->latest('created_at')
            ->first();
        return response()->json($dataPenggunaan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penggunaan_awal'   => 'required',
            'penggunaan_akhir'  => 'required',
            'jumlah_penggunaan' => 'required',
            'user_id'           => 'required',
            'periode_id'        => 'required',
        ], [
            'penggunaan_awal.required'  => 'Form wajib diisi !',
            'penggunaan_akhir.required' => 'Form wajib diisi !',
            'jumlah_penggunaan.required' => 'Form wajib diisi !',
            'user_id.required'          => 'Form wajib diisi !',
            'periode_id.required'       => 'Form wajib diisi !',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $existingEntry = Pemakaian::where('periode_id', $request->periode_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($existingEntry) {
            return back()->with('error', 'Pemakaian sudah dicatat untuk pengguna ini dalam periode yang sama.');
        }

        $tarif              = Tarif::first();
        $jumlah_penggunaan  = $request->jumlah_penggunaan;
        $m3                 = $tarif->m3;
        $beban              = $tarif->beban;
        $jumlah_pembayaran  = ($jumlah_penggunaan * $m3) + $beban;

        $data = $request->all();

        $data['jumlah_pembayaran']  = $jumlah_pembayaran;

        Pemakaian::create($data);

        return redirect()->back()->with('success', 'Data pemakaian berhasil di simpan !');
    }

    /**
     * Get Data Pelanggan From Scanner Qr Code
     */
    public function getDataPelanggan(Request $request)
    {
        $qrCode     = $request->input('result');
        $pelanggan  = User::where('no_pelanggan', $qrCode)->first();

        $dataPelanggan = [
            'id'                => null,
            'user_id'           => null,
            'penggunaan_akhir'  => null
        ];

        if ($pelanggan) {
            $pemakaian = Pemakaian::where('user_id', $pelanggan->id)
                ->orderBy('created_at', 'desc')
                ->first();
            $penggunaan_akhir = ($pemakaian) ? $pemakaian->penggunaan_akhir : 0;
            $dataPelanggan = [
                'id'                  => $pelanggan->id,
                'user_id'             => $pelanggan->id,
                'penggunaan_akhir'    => $penggunaan_akhir
            ];
        }


        return response()->json($dataPelanggan);
    }
}
