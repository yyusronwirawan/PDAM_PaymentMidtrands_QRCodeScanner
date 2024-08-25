@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Periode Pemakaian</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/periode/create" type="button" class="btn btn-warning float-end">Tambah Periode</a>
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
                                <th>Periode</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $periode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periode->periode }}</td>
                                <td>{{ $periode->bulan->bulan }}</td>
                                <td>{{ $periode->tahun->tahun }}</td>
                                <td>
                                    @if ($periode->status == 'tidak aktif')
                                    <span class="badge text-bg-warning p-2">{{ $periode->status }}
                                </td></span>
                                @else
                                <span class="badge text-bg-success p-2">{{ $periode->status }}</td></span>
                                @endif
                                <td>
                                    <a href="/periode/{{ $periode->id }}/edit" type="button"
                                        class="btn btn-warning mb-1"><i class="ti ti-edit"></i></a>
                                    <form id="{{ $periode->id }}" action="/periode/{{ $periode->id }}" method="POST"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger swal-confirm mb-1"
                                            data-form="{{ $periode->id }}"><i class="ti ti-trash"></i></button>
                                    </form>
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
    $(document).ready( function () {
            $('#table_id').DataTable();
        });
</script>


@endsection