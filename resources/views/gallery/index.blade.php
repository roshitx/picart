@extends('layouts.main')
@section('content')
<div class="container">
    {{-- Sweetalert --}}
    @if (session('success'))
    <x-sweetalert :message="session('success')" />
    @endif
    <div class="main-body">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mt-3">
                        <h4 class="m-0 fw-bold">Data Gallery Photo</h4>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-bordered table-striped" id="table">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Owner</th>
                                    <th class="text-center">Uploaded At</th>
                                    <th class="text-center">Status | Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gallery as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <img data-src="{{ asset('storage/gallery') . '/' . $item->image }}" alt="{{ $item->title }}" src="{{ asset('placeholder-image.png') }}" class="lazy" width="80px">
                                    </td>
                                    <td class="text-center">{{ $item->title }}</td>
                                    <td class="text-center">{{ $item->description }}</td>
                                    <td class="text-center">{{ $item->user->username }}</td>
                                    <td class="text-center">{{ $item->created_at->format('H:i, d F Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <form action="{{ route('gallery.banned', ['slug' => $item->slug]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if($item->isBan == 0)
                                                <button type="submit" class="btn btn-sm btn-success btnBanned">
                                                    Active
                                                </button>
                                                @else
                                                <button type="submit" class="btn btn-sm btn-danger btnBanned">
                                                    Banned
                                                </button>
                                                @endif
                                            </form>
                                            <span>|</span>
                                            <button class="btn btn-sm btn-danger btnDelete" data-id="{{ $item->id }}">
                                                Delete
                                            </button>
                                            <form action="{{ route('gallery.destroy', $item->id) }}" method="post" hidden class="deleteForm" data-id="{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
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
</div>
<script>
    $(document).ready(function() {
        // Lazy load
        var lazyLoadInstance = new LazyLoad({
            // Your custom settings go here
        });

        $('.btnDelete').click(function() {
            const itemId = $(this).data('id');
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
                    const deleteForm = $(`.deleteForm[data-id="${itemId}"]`);
                    deleteForm.submit();
                }
            });
        });
    });

</script>
@endsection
