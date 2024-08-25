<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran</title>
</head>
<style>
    .container{
        border: 1px solid black;
    }

    .header{
        text-align: center;
    }

    .h3{
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .column {
        float: left;
        text-align: left;
        width: 33.33%;
        margin-bottom: 15px;
    }

    .detail{
        margin-top: 15px;
        padding-left: 10px;
    }

    .row{
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 30px;
    }

    table{
        width: 100%;
        text-align: center;
        padding: 20px;
    }

    table, th, td {
        border: 0 px;
    }

    tr{
        text-align: left;
    }
</style>
<body>
    <div class="container">
        <div class="header">
            <h2>Bukti Pembayaran Tagihan Air Pamsimas</h2>
            <p>Desa Karangmulyo, Kecamatan Purwodadi, Kabupaten Purworejo, jawa Tengah 54173</p>
        </div>

        <hr>

        <div class="row">
            <div class="column" style="float: left">
                Tgl. Bayar    : {{ $pembayaran->tgl_bayar }} <br>
                No Pembayaran : {{ $pembayaran->kd_pembayaran }}
            </div>
            <div class="column">

            </div>
            <div class="column" style="float: right">
                No. Pelanggan   : {{ $pembayaran->pemakaian->user->no_pelanggan }} <br>
                Nama Pelanggan  : {{ $pembayaran->pemakaian->user->name }}
            </div>
        </div>

        <div class="detail">
            <table>
                <tr>
                    <td><b>Penggunaan Awal</b></td>
                    <td>:</td>
                    <td>{{ $pembayaran->pemakaian->penggunaan_awal }} m³</td>
                </tr>
                <tr>
                    <td><b>Penggunaan Akhir</b></td>
                    <td>:</td>
                    <td>{{ $pembayaran->pemakaian->penggunaan_akhir }} m³</td>
                </tr>
                <tr>
                    <td><b>Penggunaan m³</b></td>
                    <td>:</td>
                    <td>{{ $pembayaran->pemakaian->jumlah_penggunaan  }} m³</td>
                    <hr>
                </tr>

                <tr>
                    <hr style="text-align: center;">
                </tr>

                <tr>
                    <td><strong>Biaya per-m³</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($tarif->m3, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Biaya Beban</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($tarif->beban, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Denda</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($pembayaran->denda, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Sub-Total</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($pembayaran->subTotal, 2, ',', '.') }}</td>
                </tr>

                <tr>
                    <hr style="text-align: center;">
                </tr>

                <tr>
                    <td><strong>Uang Pelanggan</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($pembayaran->uang_cash, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Uang Kembalian</strong></td>
                    <td>:</td>
                    <td>Rp. {{ number_format($pembayaran->kembalian, 2, ',', '.') }}</td>
                </tr>
            </table>
            <p class="lunas" style="text-align: center">Periode {{ $pembayaran->pemakaian->periode->periode }} <b>LUNAS !!!</b></p>
        </div>
    </div>
</body>
</html>