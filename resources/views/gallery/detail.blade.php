@extends('layouts.main')
@section('content')
@include('partials.modal-edit')
{{-- Alert --}}
@if (session('success'))
<x-alert :message="session('success')" :icon="session('success')" />
@elseif(session('fail'))
<x-alert :message="session('fail')" :icon="session('fail')" />
@endif
<div class="container">
    <a class="btn btn-dark m-0 mb-3" href="{{ route('home') }}"><i class='bx bx-left-arrow-alt m-0'></i></a>
    <div class="bg-white rounded-5 border shadow-lg">
        <div class="row">
            <div class="col-12 col-md-6">
                <img src="{{ asset('storage/gallery') . '/' . $gallery->image }}" alt="{{ $gallery->title }}" class="rounded-detail img-fluid">
            </div>
            <div class="col-12 col-md-6 pt-3 position-relative">
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="dropdown me-3">
                            <button class="nav-link dropdown-toggle dropdown-toggle-nocaret" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bx-dots-vertical-rounded m-0 fs-3'></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class='bx bxs-download align-middle'></i> Download</a></li>
                                <li><button class="dropdown-item" data-clipboard-text="{{ route('gallery.show', ['gallery' => $gallery->slug]) }}" id="btnSharePost"><i class='bx bxs-share-alt align-middle'></i> Copy URL</button></li>
                                @if(Auth::user()->id == $gallery->user_id)
                                <li><button class="dropdown-item" type="button" id="buttonEditPost" data-id="{{ $gallery->id }}"><i class='bx bxs-edit-alt align-middle'></i> Edit</button></li>
                                <li><a class="dropdown-item text-danger" type="button" id="btnDeletePhoto" data-id="{{ $gallery->id }}"><i class='bx bxs-trash-alt align-middle'></i> Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Form Delete --}}
                <form action="{{ route('gallery.destroy', ['gallery' => $gallery->id]) }}" method="post" hidden class="deletePostForm" data-id="{{ $gallery->id }}">
                    @csrf
                    @method('DELETE')
                </form>
                {{-- End Form Delete --}}

                <h1 class="text-dark">{{ $gallery->title }}</h1>
                <p class="m-0 fs-5">{{ $gallery->description }}</p>
                <small class="text-secondary mb-3">{{ $gallery->created_at->diffForHumans() }}</small>

                <a href="{{ route('profile') }}" class="text-decoration-none">
                    <div class="row p-3 flex-row">
                        <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img">
                        <div class="col">
                            <p class="fw-bold text-dark m-0">{{ $gallery->user->username }}</p>
                            <p class="m-0 text-dark">{{ $post_count }} Post</p>
                        </div>
                    </div>
                </a>

                <div class="row mt-3">
                    <p class="text-dark mb-1 fw-bold">Comment</p>
                    <small>5 Comment</small>
                    <div class="col overflow-y-scroll mx-3" style="max-height: 300px;" id="commentSection">
                        <div class="row g-2 mt-2">
                            <div class="col-12 col-md-6">
                                <div class="row flex-row align-items-center">
                                    <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img img-fluid">
                                    <div class="col">
                                        <small class="fw-bold text-dark m-0">{{ $gallery->user->username }}</small>
                                        <p class="m-0">Kerenn</p>
                                        <small class="m-0">3 Jam yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 mt-2">
                            <div class="col-12 col-md-6">
                                <div class="row flex-row align-items-center">
                                    <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img img-fluid">
                                    <div class="col">
                                        <small class="fw-bold text-dark m-0">{{ $gallery->user->username }}</small>
                                        <p class="m-0">Kerenn</p>
                                        <small class="m-0">3 Jam yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 mt-2">
                            <div class="col-12 col-md-6">
                                <div class="row flex-row align-items-center">
                                    <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img img-fluid">
                                    <div class="col">
                                        <small class="fw-bold text-dark m-0">{{ $gallery->user->username }}</small>
                                        <p class="m-0">Kerenn</p>
                                        <small class="m-0">3 Jam yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 mt-2">
                            <div class="col-12 col-md-6">
                                <div class="row flex-row align-items-center">
                                    <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img img-fluid">
                                    <div class="col">
                                        <small class="fw-bold text-dark m-0">{{ $gallery->user->username }}</small>
                                        <p class="m-0">Kerenn</p>
                                        <small class="m-0">3 Jam yang lalu</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 bottom-0 sticky-bottom bg-white w-100">
                    <div class="border-top">
                        <div class="row mt-2">
                            <div class="col-6 d-flex align-items-center">
                                <p class="m-0"><i class='bx bxs-like'></i> 5 Like</p>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <button class="btn btn-danger btn-sm">
                                    <i class='bx bx-heart m-0'></i>
                                </button>
                            </div>
                            <div class="row flex-row align-items-center mt-3">
                                <div class="col-auto">
                                    <img src="{{ asset('storage/avatar') . '/' . @Auth::user()->profile->avatar }}" class="user-img">
                                </div>
                                <div class="col align-items-center">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="commentInput" placeholder=" ">
                                        <label for="commentInput">Tulis komentar...</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-sm btn-warning rounded-pill text-white" type="submit">
                                        <i class='bx bxs-send m-0'></i>
                                    </button>
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
        new ClipboardJS('#btnSharePost');

        $('#btnSharePost').click(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Link copied to your clipboard"
            });
        });

        $('#buttonEditPost').click(function() {
            let galleryId = $(this).data('id');
            $.ajax({
                url: window.location.origin + '/gallery/' + galleryId + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#modalEdit #title').val(data.title);
                    $('#modalEdit #description').val(data.description);

                    $('#modalEdit').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });

        $('#btnDeletePhoto').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?'
                , text: "You can't revert this action!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete!'
                , cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteForm = $(`.deletePostForm[data-id="${id}"]`);
                    deleteForm.submit();
                }
            });
        });
    });

</script>
@endsection
