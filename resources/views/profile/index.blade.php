@extends('layouts.main')
@section('content')
<div class="container">
    {{-- Sweetalert --}}
    @if (session('success'))
    <x-sweetalert :message="session('success')" />
    @endif
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @php
                            $avatar = Avatar::create($user->fullname)->toBase64();
                            $userAva = $user->profile->avatar ?? null;
                            @endphp
                            <div class="rounded-circle border overflow-hidden" style="width: 200px; height: 200px;">
                                <img src="{{ $userAva ? asset('storage/avatar/' . $user->profile->avatar) : $avatar }}" alt="{{ $user->fullname }}" class="img-fluid object-fit-cover p-1 bg-secondary" style="height: 100%; width: 100%;">
                            </div>
                            <div class="mt-3">
                                <h4>{{ $user->fullname }}</h4>
                                <h6 class="text-secondary mb-1">{{ $user->profile->bio ?? '' }}</h6>
                                <p class="text-muted font-size-sm">{{ $user->profile->description ?? '' }}</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#social_link"><i class='bx bx-link m-0'></i></button>
                            </div>
                        </div>
                        @if ($user->social_links)
                        <hr class="my-4" />
                        @foreach ($user->social_links as $social_link)
                        <a href="{{ $social_link->link }}" target="_blank">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">{{ ucfirst($social_link->social_network) }}</h6>
                                    <span class="text-secondary link-underline-primary">{{ $social_link->username ? $social_link->username : $social_link->link }}</span>
                                </li>
                            </ul>
                        </a>
                        @endforeach
                        @endif
                    </div>

                    <div class="modal fade" id="social_link" tabindex="-1" aria-labelledby="social_linkLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="social_linkLabel">Add Social Link</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('add.social-link') }}" method="POST">
                                    <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4 col-12 mt-3">
                                                    <label for="social_network">Social Media Type <span class="text-danger">*</span></label>
                                                    <select name="social_network" id="social_network" class="form-select">
                                                        @foreach ($socmed as $title => $value)
                                                            <option value="{{ $value }}">{{ $title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 col-12 mt-3">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control">
                                                </div>
                                                <div class="col-lg-4 col-12 mt-3">
                                                    <label for="social_network">URL <span class="text-danger">*</span></label>
                                                    <input type="text" name="link" id="link" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <div class="card-body">
                            <div class="row mb-3 items-center d-flex">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $user->fullname }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" />
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->profile->phone ?? '' }}" />
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Bio</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control @error('bio') is-invalid @enderror" value="{{ $user->profile->bio ?? '' }}" name="bio" />
                                    @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Description</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $user->profile->description ?? '' }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Birthdate</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" value="{{ $user->profile->birthdate ?? '' }}" name="birthdate" />
                                    @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                                        <option value="male" {{ @$user->profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Photo Profile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <div class="outputImage mb-3 rounded-circle">
                                    </div>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar" accept="image/jpeg, image/png, image/jpg">
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary text-end">
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Project Status</h5>
                                <p>Web Design</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Website Markup</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>One Page</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Mobile Template</p>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Backend API</p>
                                <div class="progress" style="height: 5px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#social_network').select2({
            theme: "bootstrap-5",
        });

        let outputImage = $('.outputImage');
        @if($user->profile->avatar ?? null)
        outputImage.html(`
    <div class="rounded-circle border overflow-hidden" style="width: 110px; height: 110px;">
        <img src="{{ asset('storage/avatar/' . $user->profile->avatar) }}" alt="{{ $user->fullname }}" class="img-fluid object-fit-cover" style="height: 100%; width: 100%;">
      </div>
    `);
        @else
        outputImage.html(`
      <div class="rounded-circle">
        <img src="{{ $avatar }}" alt="{{ $user->fullname }}" width="110" height="110">
      </div>
    `);
        @endif

        $('input[type="file"]').change(function() {
            let avatar = this.files[0];
            outputImage.html(`
            <div class="rounded-circle border overflow-hidden" style="width: 110px; height: 110px;">
                <img src="${URL.createObjectURL(avatar)}" alt="{{ $user->fullname }}" class="img-fluid object-fit-cover" style="height: 100%; width: 100%;">
            </div>
        `);
        });
    });

</script>
@endsection
