@extends('layouts.main')
@section('content')
@include('partials.modal-edit')
{{-- Alert --}}
@if (session('success'))
<x-alert :message="session('success')" :icon="'success'" />
@elseif(session('fail'))
<x-alert :message="session('fail')" :icon="session('fail')" />
@endif
<div class="container">
    <a class="btn btn-dark m-0 mb-3" href="{{ route('home') }}"><i class='bx bx-left-arrow-alt m-0'></i></a>
    <div class="bg-white rounded-5 border shadow-lg">
        @if($gallery->isBan == 0)
        <div class="row">
            {{-- The image --}}
            <div class="col-12 col-md-6">
                <img src="{{ asset('storage/gallery') . '/' . $gallery->image }}" alt="{{ $gallery->title }}" class="rounded-detail img-fluid">
            </div>
            {{-- End the image --}}
            <div class="col-12 col-md-6 pt-3 position-relative">
                {{-- Three dots (dropdown) --}}
                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="dropdown me-3">
                            <button class="nav-link dropdown-toggle dropdown-toggle-nocaret" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bx-dots-vertical-rounded m-0 fs-3'></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('gallery.download', ['slug' => $gallery->slug]) }}" target="_blank"><i class='bx bxs-download align-middle'></i> Download</a></li>

                                <li><button class="dropdown-item" data-clipboard-text="{{ route('gallery.show', ['gallery' => $gallery->slug]) }}" id="btnSharePost"><i class='bx bxs-share-alt align-middle'></i> Copy URL</button></li>
                                @if(Auth::user()->id == $gallery->user_id || Auth::user()->role == 'admin')
                                <hr class="m-2">
                                <li><button class="dropdown-item" type="button" id="buttonEditPost" data-id="{{ $gallery->id }}"><i class='bx bxs-edit-alt align-middle'></i> Edit</button></li>
                                <li><a class="dropdown-item text-danger" type="button" id="btnDeletePhoto" data-id="{{ $gallery->id }}"><i class='bx bxs-trash-alt align-middle'></i> Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- End three dots (dropdown) --}}

                {{-- Form Delete --}}
                <form action="{{ route('gallery.destroy', ['gallery' => $gallery->id]) }}" method="post" hidden class="deletePostForm" data-id="{{ $gallery->id }}">
                    @csrf
                    @method('DELETE')
                </form>
                {{-- End Form Delete --}}

                {{-- Title, description and user who uploaded --}}
                <h1 class="text-dark m-0">{{ $gallery->title }}</h1>
                <p class="m-0 fs-5">{{ $gallery->description }}</p>
                <small class="text-secondary mb-3">
                    @if ($gallery->updated_at != $gallery->created_at)
                    {{ $gallery->updated_at->diffForHumans() }}
                    <span class="text-danger">(Updated)</span>
                    @else
                    {{ $gallery->created_at->diffForHumans() }}
                    @endif
                </small>

                <a href="{{ route('profile', ['username' => $gallery->user->username]) }}" class="text-decoration-none">
                    <div class="row p-3 flex-row">
                        <img src="{{ @$gallery->user->profile->avatar ? asset('storage/avatar') . '/' . @$gallery->user->profile->avatar : $avatar }}" class="user-img">
                        <div class="col">
                            <p class="fw-bold text-dark m-0">{{ $gallery->user->username }}</p>
                            <p class="m-0 text-dark">{{ $post_count }} Post</p>
                        </div>
                    </div>
                </a>
                {{-- End title, description and user who uploaded --}}

                {{-- Comment Section --}}
                <div class="row mt-3">
                    <p class="text-dark mb-1 fw-bold">Comment</p>
                    <small>{{ $gallery->comments->count() }} Comments</small>
                    @if($gallery->comments->count() > 0)
                    <div class="col overflow-y-scroll mx-3" style="max-height: 300px;" id="commentSection">
                        @foreach ($gallery->comments as $comment)
                        <div class="row g-2 mt-2">
                            <div class="col-6">
                                <div class="row flex-row align-items-center">
                                    <img src="{{ @$comment->user->profile->avatar ? asset('storage/avatar') . '/' . @$comment->user->profile->avatar :  Avatar::create($comment->user->fullname) }}" class="user-img img-fluid">
                                    <div class="col">
                                        <small class="fw-bold text-dark m-0">{{ $comment->user->username }}</small>
                                        <p class="m-0 text-dark">{{ $comment->content }}</p>
                                        <small class="m-0">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->id == $comment->user->id)
                            <div class="col-6 justify-content-end d-flex align-items-center">
                                <a class="fs-6 text-danger cursor-pointer btnDeleteComment" data-id="{{ $comment->id }}"><i class='bx bxs-trash-alt'></i></a>
                            </div>
                            @endif
                        </div>
                        <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="post" hidden class="deleteCommentForm-{{ $comment->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        @endforeach
                    </div>
                    @else
                    <p class="text-center text-secondary mt-5">This post has no comments yet.</p>
                    @endif

                </div>
                {{-- End Comment Section --}}

                {{-- Like and comment input --}}
                <div class="row mt-3 bottom-0 sticky-bottom bg-white w-100">
                    <div class="border-top d-flex justify-content-center">
                        <div class="row mt-2 justify-content-center">
                            <div class="row flex-row justify-content-between align-items-center">
                                <a href="#" class="col-auto fs-6 text-dark" id="detailLikes" data-bs-toggle="modal" data-bs-target="#modalLikes" data-bs-hover="tooltip" data-bs-title="See who already liked">
                                    <p class="m-0" id="likeCount"><i class='bx bxs-like'></i> {{ $gallery->likes->count() }} Likes</p>
                                </a>
                                <div class="col-auto fs-4">
                                    <a href="#" class="text-decoration-none text-danger" id="likeButton" data-id="{{ $gallery->slug }}" data-user="{{ auth()->user()->id }}" data-bs-hover="tooltip" data-bs-title="Like">
                                        @if($isLiked == true)
                                        <i class='bx bxs-heart m-0'></i>
                                        @else
                                        <i class='bx bx-heart m-0'></i>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="row flex-row align-items-center mt-3 mb-3">
                                <div class="col-auto">
                                    <img src="{{ @Auth::user()->profile->avatar ? asset('storage/avatar') . '/' . Auth::user()->profile->avatar : $avatar }}" class="user-img">
                                </div>
                                <div class="col align-items-center">
                                    <form action="{{ route('comment.store') }}" method="POST" class="d-flex">
                                        @csrf
                                        <div class="form-group flex-grow-1 mb-0">
                                            <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                                            <input type="text" class="form-control" name="content" id="commentInput" placeholder="Tulis komentar..." required>
                                        </div>
                                        <button class="btn btn-sm btn-dark rounded-pill text-white ms-2" type="submit">
                                            <i class='bx bxs-send m-0 p-0'></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End like and comment input --}}
            </div>
        </div>
        @else
        <div class="col d-flex align-items-center justify-content-center" style="height: 200px;">
            <h4 class="text-danger m-2 d-flex align-items-center"><i class='bx bxs-error-circle'></i> <span>Post has been banned by admin.</span></h4>
        </div>
        @endif
    </div>
</div>

{{-- Modal detail likes --}}
<div class="modal fade" id="modalLikes" tabindex="-1" aria-labelledby="modalLikesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLikesLabel"><i class='bx bxs-heart'></i> Liked by</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($gallery->likes->isEmpty())
                    <p class="text-center m-0">This post doesn't have any likes yet.</p>
                @else
                @foreach ($gallery->likes as $like)
                <a href="{{ route('profile', ['username' => $like->user->username]) }}" class="text-decoration-none">
                    <div class="row p-3 flex-row">
                        <img src="{{ @$like->user->profile->avatar ? asset('storage/avatar') . '/' . @$like->user->profile->avatar : Avatar::create($like->user->fullname)->toBase64() }}" class="user-img">
                        <div class="col">
                            <p class="fw-bold text-dark m-0">{{ $like->user->username }}</p>
                            <p class="m-0 text-dark">{{ $like->user->profile->bio ?? $like->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
{{-- End modal detail likes --}}
<script>
    $(document).ready(function() {
        new ClipboardJS('#btnSharePost');

        $('#btnSharePost').click(function() {
            const Toast = Swal.mixin({
                toast: true
                , position: "top-end"
                , showConfirmButton: false
                , timer: 3000
                , timerProgressBar: true
                , didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success"
                , title: "Link copied to your clipboard"
            });
        });

        $('#buttonEditPost').click(function() {
            let galleryId = $(this).data('id');
            $.ajax({
                url: window.location.origin + '/gallery/' + galleryId + '/edit'
                , method: 'GET'
                , success: function(data) {
                    $('#modalEdit #title').val(data.title);
                    $('#modalEdit #description').val(data.description);

                    $('#modalEdit').modal('show');
                }
                , error: function(error) {
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

        $('.btnDeleteComment').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?'
                , text: "You want to delete this comment?"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete!'
                , cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteForm = $(`.deleteCommentForm-${id}`);
                    deleteForm.submit();
                }
            });
        });

        $('#likeButton').click(function(e) {
            e.preventDefault();
            let userId = $(this).data('user');
            let galleryId = $(this).data('id');
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: window.location.origin + '/gallery/' + galleryId + '/like'
                , method: 'POST'
                , data: {
                    'user_id': userId
                    , 'gallery_id': galleryId
                    , '_token': CSRF_TOKEN
                }
                , success: function(response) {
                    $('#likeCount').html(`<i class='bx bxs-like'></i> ${response.likeCount} Likes`);
                    $('#likeButton').html(response.status == true ? `<i class='bx bxs-heart m-0'></i>` : `<i class='bx bx-heart m-0'></i>`);

                    const Toast = Swal.mixin({
                        toast: true
                        , position: "top-end"
                        , showConfirmButton: false
                        , timer: 3000
                        , timerProgressBar: true
                        , didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success"
                        , title: response.message
                    });
                }
                , error: function(e) {
                    console.error(e);
                }
            })
        });
    });

</script>
@endsection
