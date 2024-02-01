@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="justify-content-center mb-2 d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SMK N 1 Bantul" width="60">
                <span class="fs-4 fw-bold">Pic.Art</span>
            </div>
            <div class="card mb-3">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}

                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}

                </div>
                @endif
                <div class="card-body">

                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4 fw-2">Register </h5>
                        <p class="text-center small">Please fill all the required field to registration</p>
                    </div>

                    <form class="row g-3 " action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3 col-12 col-md-6">
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder=" " name="fullname" value="{{ old('fullname') }}">
                            <label for="fullname">Fullname <span class="text-danger">*</span></label>
                            @error('fullname')
                                <span class="text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3 col-12 col-md-6">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder=" " name="username" value="{{ old('username') }}">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3 col-12">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder=" " name="email" value="{{ old('email') }}">
                            <label for="email">Email address <span class="text-danger">*</span></label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating col-12 col-md-6">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder=" " name="password">
                            <label for="floatingPassword">Password <span class="text-danger">*</span></label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating col-12 col-md-6">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder=" " name="password_confirmation">
                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Register</button>
                        </div>
                        <div class="col-12">
                            <p class="small mb-0 text-center">Already have an account?</p>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('login') }}" class="btn btn-secondary w-100" type="btn">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
