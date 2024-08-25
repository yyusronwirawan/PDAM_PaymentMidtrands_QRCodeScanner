<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <style>
        .container {
            text-align: center;
            margin: auto;
        }

        .column {
            text-align: center;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            margin: auto;
            width: 100%;
        }

        tr {
            text-align: left;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }

        th {
            background-color: gainsboro;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column">
                <h2>BUMDES Ngudi Makmur</h2>
                <p>Desa Wonorejo Rt.06, Rw.02, Kecamatan Jepara <br> Kabupaten Jepara, Jawa
                    Tengah 59431</p>
                <hr style="width: 85%; text-align: center;">
                <h3 style="text-align: center;">Laporan Penjualan
                    {{ $tanggalMulai && $tanggalSelesai
                    ? date('d-m-Y', strtotime($tanggalMulai)) . ' - ' . date('d-m-Y', strtotime($tanggalSelesai))
                    : 'Semua Range Tanggal' }}
                </h3>
            </div>
            <div class="col">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tgl. Pembayaran</th>
                            <th>Pelanggan</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pembayaran)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $pembayaran->kd_pembayaran }}</td>
                            <td>{{ date('d-m-Y', strtotime($pembayaran->tgl_bayar)) }}</td>
                            <td>{{ $pembayaran->pemakaian->user->name }}</td>
                            <td>Rp. {{ number_format($pembayaran->subTotal, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>