@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Data tarif</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/tarif" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/tarif/{{ $tarif->id }}">
                        @method('put')
                        @csrf

                        <label for="m3" class="mb-2">Biaya Per m³<span style="color: red">*</span></label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="m3" value="{{ old('m3', $tarif->m3) }}">
                            @error('m3')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="beban" class="mb-2">Biaya Beban <span style="color: red">*</span></label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="beban"
                                value="{{ old('beban', $tarif->beban) }}">
                            @error('beban')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="denda" class="mb-2">Biaya Denda <span style="color: red">*</span></label><br>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="denda"
                                value="{{ old('denda', $tarif->denda) }}">
                            @error('denda')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary m-1 float-end">Perbarui</button>
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
