<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tarif;
use App\Models\Periode;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\pdf as PDF;


class PembayaranController extends Controller
{
    public function index()
    {
        return view('pembayaran.index', [
            'users'     => User::where('role_id', '3')->get(),
            'periodes'  => Periode::where('status', 'Aktif')->get()
        ]);
    }

    public function getData($user_id, $periode_id)
    {
        $dataPemakaian = Pemakaian::where('user_id', $user_id)
            ->where('status', 'belum dibayar')
            ->where('periode_id', $periode_id)
            ->with('bulan')
            ->first();

        return response()->json($dataPemakaian);
    }

    public function getTarifData()
    {
        $tarif = Tarif::first();

        if ($tarif) {
            return response()->json([
                'm3'    => $tarif->m3,
                'beban' => $tarif->beban,
                'denda' => $tarif->denda,
            ]);
        }

        return response()->json(['message' => 'Data tarif tidak ditemukan.']);
    }

    public function bayar(Request $request)
    {
        $kd_pembayaran  = 'INV-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $pemakaian_id   = $request->input('pemakaian_id');
        $tgl_bayar      = $request->input('tgl_bayar');
        $uang_cash      = $request->input('uang_cash');
        $kembalian      = $request->input('kembalian');
        $denda          = $request->input('denda');
        $subTotal       = $request->input('jumlah_pembayaran');

        $pembayaran = new Pembayaran();
        $pembayaran->kd_pembayaran   = $kd_pembayaran;
        $pembayaran->tgl_bayar       = $tgl_bayar;
        $pembayaran->pemakaian_id    = $pemakaian_id;
        $pembayaran->denda           = $denda;
        $pembayaran->subTotal        = $subTotal;
        $pembayaran->uang_cash       = $uang_cash;
        $pembayaran->kembalian       = $kembalian;

        $pembayaran->save();

        $pemakaian = Pemakaian::find($pemakaian_id);
        $pemakaian->status = 'lunas';
        $pemakaian->save();

        return response()->json([
            'message'    => 'Tagihan air berhasil dibayar !'
        ], 200);
    }

    public function printBuktiPembayaran(Request $request, $id)
    {
        $pemakaian  = Pemakaian::find($id);
        $pembayaran = Pembayaran::where('pemakaian_id', $pemakaian->id)->get();

        if (!$pemakaian) {
            return abort(404);
        }

        if (empty($pembayaran)) {
            return abort(404);
        }

        $detailPenggunaan   = $request->query('detail_penggunaan');
        $tarifM3            = $request->query('tarif_m3');
        $tarifBeban         = $request->query('tarif_beban');
        $denda              = $request->query('denda');
        $subTotal           = $request->query('jumlah_pembayaran');

        $pdf = PDF::loadView('pembayaran.bukti-pembayaran', [
            'pemakaian'         => $pemakaian,
            'pembayaran'        => $pembayaran->first(),
            'detail_penggunaan' => $detailPenggunaan,
            'tarif_m3'          => $tarifM3,
            'tarif_beban'       => $tarifBeban,
            'denda'             => $denda,
            'subTotal'          => $subTotal,
        ]);
        return $pdf->stream('bukti-pembayaran.pdf');
    }
}
