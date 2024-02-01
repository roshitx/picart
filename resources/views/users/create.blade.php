@extends('layouts.main')
@section('content')
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <h5 class="m-0 fw-bold">Form Create User</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="fullname" class="form-label">Fullname <span class="text-danger">*</span></label>
                                <input type="text" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" required>
                                @error('fullname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                                    <option value="0" selected disabled hidden>- Pilih role -</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class='bx bxs-arrow-to-left'></i> Back</a>
                            <button type="submit" class="btn btn-primary"><i class='bx bxs-save'></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
