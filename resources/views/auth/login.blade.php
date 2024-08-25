@extends('layouts.auth')

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card mb-0">
        <div class="card-body">
            <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="assets/images/logos/dark-logo.svg" width="180" alt="">
            </a>

            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus>
                </div>

                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" required
                        autocomplete="password">
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            Ingat perangkat ini ?
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection