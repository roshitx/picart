@extends('layouts.main')
@section('content')

{{-- Alert --}}
@if (session('success'))
<x-alert :message="session('success')" :icon="'success'" />
@elseif(session('fail'))
<x-alert :message="session('fail')" :icon="'error'" />
@endif

<div class="d-flex justify-content-center">
    <div class="container-gallery">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
        @foreach ($gallery as $item)
        <a class="grid-item" href="{{ route('gallery.show', $item->slug) }}">
            <img src="{{ asset('storage/gallery') . '/' . $item->image }}" alt="{{ $item->title }}" class="rounded-4">
        </a>
        @endforeach
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
