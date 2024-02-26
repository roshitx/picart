@extends('layouts.main')
@section('content')

{{-- Alert --}}
@if (session('success'))
<x-alert :message="session('success')" :icon="'success'" />
@elseif(session('fail'))
<x-alert :message="session('fail')" :icon="'error'" />
@endif

<div class="container">
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        @php
                        $avatar = Avatar::create($user->fullname)->toBase64();
                        $userAva = $user->profile->avatar ?? null;
                        @endphp
                        <div class="rounded-circle border overflow-hidden" style="width: 150px; height: 150px;">
                            <img src="{{ $userAva ? asset('storage/avatar/' . $user->profile->avatar) : $avatar }}" alt="{{ $user->fullname }}" class="img-fluid object-fit-cover p-1 bg-secondary" style="height: 100%; width: 100%;">
                        </div>
                        <div class="mt-3">
                            <h4>{{ $user->fullname }}</h4>
                            <h6 class="text-secondary mb-1">{{ $user->profile->bio ?? '' }}</h6>
                            <div class="row">
                            </div>
                            <p class="text-muted font-size-sm">{{ $user->profile->description ?? '' }}</p>
                            <small>{{ $user->galleries->count() }} Post</small>
                        </div>
                    </div>
                    @if ($user->social_links && count($user->social_links) > 0)
                    <hr class="my-4" />
                    @foreach ($user->social_links as $social_link)
                    <a href="{{ $social_link->link }}" target="_blank" data-bs-hover="tooltip" data-bs-title="{{ $social_link->link }}">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">{{ ucfirst($social_link->social_network) }}</h6>
                                <span class="text-primary text-decoration-underline">{{ $social_link->username ? $social_link->username : $social_link->link }}</span>
                            </li>
                        </ul>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="container-gallery rounded-4 p-2 bg-white w-80 d-flex justify-content-center">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
            @foreach ($gallery as $item)
            <a class="grid-item" href="{{ route('gallery.show', $item->slug) }}">
                <img src="{{ asset('storage/gallery') . '/' . $item->image }}" alt="{{ $item->title }}" class="rounded-4">
            </a>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var elem = document.querySelector('.container-gallery');
        let $grid = $(elem);

        $grid.masonry({
            itemSelector: '.grid-item'
            , gutter: '.gutter-sizer'
            , columnWidth: '.grid-sizer'
            , fitWidth: true
        , });

        // get Masonry instance
        let msnry = $grid.data('masonry');

        $(elem).infiniteScroll({
                // options
                path: '?page=@{{#}}'
                , append: '.grid-item'
                , history: false
                , outlayer: msnry
                , status: '.page-load-status'
            , }
            , function(newElements) {
                var $newElems = $(newElements).hide().imagesLoaded(function() {
                    $newElems.show();
                    $grid.masonry('appended', $newElems);
                });
            }
        );
    });

</script>
@endsection
