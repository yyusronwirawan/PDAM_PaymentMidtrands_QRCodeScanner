<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Pelanggan</title>
</head>
<style>
    .container {
        border: 1px solid black;
        height: 450px;
    }

    .header {
        text-align: center;
    }

    .h3 {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .column {
        float: left;
        text-align: left;
        width: 50%;
        margin-bottom: 15px;
    }

    .row {
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 30px;
    }

    table {
        width: 100%;
        text-align: center;
        padding: 20px;
    }

    table,
    th,
    td {
        border: 0 px;
        padding-bottom: 15px;
    }

    tr {
        text-align: left;
        padding: 20px;
    }
</style>

<body>
    <div class="container">
        <div class="header">
            <h2>Kartu Pelanggan Air Pamsimas</h2>
            <p>Desa Wonorejo, Kecamatan Jepara, Kabupaten Jepara, Jawa Tengah 59431</p>
        </div>

        <hr>

        <div class="row">
            <div class="column" style="float: left">
                <img src="data:image/png;base64, {{ $qrCode }}" alt="Qr Code" width="260px" ; height="260px">
            </div>

            <div class="column" style="float: right">
                <table>
                    <tr>
                        <td><b>Nomor Pelanggan</b></td>
                        <td>:</td>
                        <td>{{ $pelanggan->no_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td><b>Nama Pelanggan</b></td>
                        <td>:</td>
                        <td>{{ $pelanggan->name }}
                    <tr>
                        <td><b>Email</b></td>
                        <td>:</td>
                        <td>{{ $pelanggan->email }}</td>
                        <hr>
                    </tr>
                    <tr>
                        <td><b>Nomor HP</b></td>
                        <td>:</td>
                        <td>{{ $pelanggan->no_hp }}</td>
                        <hr>
                    </tr>
                    <tr>
                        <td><b>Tanggal Pasang</b></td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggan->tgl_pasang)->format('d-m-Y') }}</td>

                        <hr>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</body>

</html>