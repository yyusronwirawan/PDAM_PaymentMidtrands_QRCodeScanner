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
                    </div>
                </div>

                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="table_id" class="table display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Biaya Per m³</th>
                                    <th>Biaya Beban</th>
                                    <th>Biaya Denda</th>
                                    <th>Perbarui Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarifs as $tarif)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Rp. {{ $tarif->m3 }}</td>
                                        <td>Rp. {{ $tarif->beban }}</td>
                                        <td>Rp. {{ $tarif->denda }} / Bulan</td>
                                        <td>
                                            <a href="/tarif/{{ $tarif->id }}/edit" type="button"
                                                class="btn btn-warning mb-1"><i class="ti ti-edit"></i></a>
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

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
