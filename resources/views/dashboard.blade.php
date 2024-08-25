@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="card overflow-hidden bg-primary text-white">
            <div class="card-body p-4 bg-primary">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="card-title my-5 fw-semibold text-white">Selamat Datang {{ auth()->user()->name }}
                        </h2>
                    </div>
                    <div class="col-lg-6">
                        <img src="/assets/images/dashboard/money.svg" alt="Selamat Datang"
                            style="width: 300px; height: 200px" class="float-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (auth()->user()->role->role == 'pelanggan')
<div class="row">
    <div class="col-lg-6">
        <div class="card overflow-hidden bg-danger text-white">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold text-white">Tagihan Belum Dibayar</h5>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="text-white">{{ $tagihanBelumDibayar }}</h3>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <i class="ti ti-cash-off" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card overflow-hidden bg-success text-white">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold text-white">Tagihan Lunas</h5>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="text-white">{{ $tagihanLunas }}</h3>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <i class="ti ti-cash" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-white">Pemakaian Air</h5>
                        </div>
                        <div class="col-6">
                            <a href="/cek-tagihan" type="button" class="btn btn-warning float-end">Menu Tagihan</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Periode</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Pemakaian m³</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status Pembayaran</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemakaians as $pemakaian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pemakaian->periode->periode }}</td>
                                    <td>{{ $pemakaian->jumlah_penggunaan }} m³</td>
                                    <td>
                                        @if ($pemakaian->status == 'lunas')
                                        <span class="badge text-bg-success p-2">{{ $pemakaian->status }}</span>
                                        @else
                                        <span class="badge text-bg-warning p-2">{{ $pemakaian->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-lg-4">
            <div class="card overflow-hidden bg-danger text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Tagihan Belum Dibayar</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white">{{ $tagihanBelumLunas }} Pelanggan</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-cash-off" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card overflow-hidden bg-success text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Tagihan Lunas</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white">{{ $tagihanSudahLunas }} Pelanggan</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-cash" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card overflow-hidden bg-warning text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Jumlah Pelanggan</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white">{{ $totalPengguna }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-user" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-white">Riwayat Pembayaran</h5>
                        </div>
                        <div class="col-6">
                            <a href="/riwayat-pembayaran" type="button" class="btn btn-warning float-end">Menu
                                Pembayaran</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0" style="text-align: center">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0" style="text-align: center">Kode Pembayaran</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0" style="text-align: center">Pelanggan</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0" style="text-align: center">Sub-Total</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPembayarans as $pembayaran)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $pembayaran->kd_pembayaran }}</td>
                                    <td>{{ $pembayaran->pemakaian->user->name }}</td>
                                    <td>Rp. {{ number_format($pembayaran->subTotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection