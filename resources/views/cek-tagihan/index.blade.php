@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title fw-semibold text-white">Data Tagihan</h5>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_id" class="table display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Batas Bayar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihans as $tagihan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tagihan->periode->periode }}</td>
                                        <td>
                                            @if ($tagihan->status == 'belum dibayar')
                                                <span class="badge text-bg-warning p-2">{{ $tagihan->status }}</span>
                                            @else
                                                <span class="badge text-bg-success p-2">{{ $tagihan->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $tagihan->batas_bayar }}</td>
                                        <td><a href="/cek-tagihan/{{ $tagihan->id }}" class="btn btn-success">Detail</a></td>
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
        $(document).ready( function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection