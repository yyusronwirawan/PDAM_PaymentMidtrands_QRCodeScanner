@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Edit Data Periode</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/periode" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/periode/{{ $periode->id }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="periode"
                                value="{{ old('periode', $periode->periode) }}">
                            @error('periode')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bulan_id" class="form-label">Periode Bulan <span style="color: red">*</span></label>
                            <select class="form-select" name="bulan_id" aria-label="Default select example">
                                <option value="" selected>-- Pilih Bulan --</option>
                                @foreach ($bulans as $bulan)
                                    <option value="{{ $bulan->id }}"
                                        {{ $periode->bulan_id == $bulan->id ? 'selected' : '' }}>{{ $bulan->bulan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bulan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun_id" class="form-label">Periode Tahun <span style="color: red">*</span></label>
                            <select class="form-select" name="tahun_id" aria-label="Default select example">
                                <option value="" selected>-- Pilih Tahun --</option>
                                @foreach ($tahuns as $tahun)
                                    @if (old('tahun', $tahun->tahun) == $tahun->tahun)
                                        <option value="{{ $tahun->id }}" selected>{{ $tahun->tahun }}</option>
                                    @else
                                        <option value="{{ $tahun->id }}">{{ $tahun->tahun }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tahun_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="periode" class="form-label">Ubah Status Periode</label>
                            <select class="form-control" name="status" id="status">
                                @foreach (['aktif', 'tidak aktif'] as $status)
                                    <option value="{{ $status }}" @if ($status == $periode->status) selected @endif>
                                        {{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary m-1 float-end">Simpan</button>
                    </form>
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
