@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="justify-content-center mb-2 d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SMK N 1 Bantul" width="60">
                <span class="fs-4 fw-bold">Pic.Art</span>
            </div>
            <div class="card mb-3">
                @if (session()->has('registration'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('registration') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4 fw-2">Login </h5>
                        <p class="text-center small">Insert email and password to login</p>
                    </div>

                    <form class="row g-3 " action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3 col-12">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder=" " name="email">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating col-12">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder=" " name="password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                        <div class="col-12">
                            <p class="small mb-0 text-center">Don't have an account?</p>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('register') }}" class="btn btn-secondary w-100" type="btn">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
