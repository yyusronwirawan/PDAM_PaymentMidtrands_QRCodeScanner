@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title fw-semibold text-white">Data Tahun</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="/tahun" type="button" class="btn btn-warning float-end">Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/tahun/{{ $tahun->id }}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun <span style="color: red">*</span></label>
                            <input type="number" class="form-control" name="tahun"
                                value="{{ old('tahun', $tahun->tahun) }}">
                            @error('tahun')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
