<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use App\Models\Pemakaian;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagihanTerbayarController extends Controller
{
    public function index()
    {
        return view('tagihan-terbayar.index');
    }

    public function getRiwayatPembayaran(Request $request)
    {
        $tanggalMulai   = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $user = auth()->user();

        $pembayaran = Pembayaran::with(['pemakaian.user']);

        if ($tanggalMulai && $tanggalSelesai) {
            $pembayaran->whereBetween('tgl_bayar', [$tanggalMulai, $tanggalSelesai]);
        }

        $data = $pembayaran->whereHas('pemakaian', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orderBy('id', 'DESC')->get();

        if (empty($tanggalMulai) && empty($tanggalSelesai)) {
            $data = Pembayaran::with(['pemakaian.user'])
                ->whereHas('pemakaian', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy('id', 'DESC')
                ->get();
        }

        return response()->json($data);
    }

    public function print(Pembayaran $id)
    {
        $pembayaran = Pembayaran::with('user')->find($id);
        $tarif      = Tarif::first();


        $pdf = PDF::loadView('tagihan-terbayar.print', [
            'pembayaran'    => $pembayaran->first(),
            'tarif'         => $tarif
        ]);

        return $pdf->stream('print.pdf');
    }
}
