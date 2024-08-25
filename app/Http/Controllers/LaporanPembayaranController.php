<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Periode;
use App\Models\Pemakaian;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanPembayaranController extends Controller
{
    public function index()
    {
        return view('laporan-pembayaran.index', [
            'periodes'   => Periode::with('user')
        ]);
    }

    public function getLaporanPembayaran(Request $request)
    {
        $tanggalMulai   = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $pembayaran = Pembayaran::query();

        if ($tanggalMulai && $tanggalSelesai) {
            $pembayaran->whereBetween('tgl_bayar', [$tanggalMulai, $tanggalSelesai])
                ->orderBy('id', 'DESC');
        }

        $data = $pembayaran->with('pemakaian.user')->get();

        if (empty($tanggalMulai) && empty($tanggalSelesai)) {
            $data = Pembayaran::with('pemakaian.user')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return response()->json($data);
    }

    public function printLaporanPembayaran(Request $request)
    {
        $tanggalMulai   = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $pembayaran = Pembayaran::query();

        if ($tanggalMulai && $tanggalSelesai) {
            $pembayaran->whereBetween('tgl_bayar', [$tanggalMulai, $tanggalSelesai])
                ->orderBy('id', 'DESC');
        }

        $data = $pembayaran->with('pemakaian.user')->get();

        if (empty($tanggalMulai) && empty($tanggalSelesai)) {
            $data = Pembayaran::with('pemakaian.user')
                ->orderBy('id', 'DESC')
                ->get();
        }

        $pdf  = new Dompdf();
        $html = view('laporan-pembayaran/print-pembayaran', compact('data', 'tanggalMulai', 'tanggalSelesai'));
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('print-pembayaran.pdf', ['Attachment' => false]);
    }
}
