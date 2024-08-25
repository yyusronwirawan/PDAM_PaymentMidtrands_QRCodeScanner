@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Detail Pelanggan</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/pelanggan" type="button" class="btn btn-warning float-end">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <div class="row" style="justify-content: center">
                    {{-- <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="qrCode" class="mb-2"><b>Qr Code Pelanggan</b></label>
                            <img src="{{ asset('storage/qrcode/' . $pelanggan->no_pelanggan . '.png') }}" alt="qr-code"
                                style="width: 250px; height: 250px; display: block; margin: 0 auto;">
                        </div>
                    </div> --}}
                    <div class="col-lg-11">
                        <div class="mb-3">
                            <label for="no_pelanggan" class="form-label">Nomor Pelanggan</label>
                            <input type="text" class="form-control" name="no_pelanggan"
                                value="{{ old('no_pelanggan', $pelanggan->no_pelanggan) }}" disabled>
                            @error('no_pelanggan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $pelanggan->name) }}" disabled>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $pelanggan->email) }}" disabled>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="number" class="form-control" name="no_hp"
                                value="{{ old('no_hp', $pelanggan->no_hp) }}" disabled>
                            @error('no_hp')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_pasang" class="form-label">Tanggal Pasang</label>
                            <input type="date" class="form-control" name="tgl_pasang"
                                value="{{ old('tgl_pasang', $pelanggan->tgl_pasang) }}" disabled>
                            @error('tgl_pasang')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                $('#table_id').DataTable();
            });
    </script>
    @endsection