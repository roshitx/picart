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
                        <h4 class="m-0 fw-bold">Data User</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-user-plus mr-1"></i> Add User
                        </a>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-bordered" id="table">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ ucfirst($item->role) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex items-center justify-content-center">
                                            <div class="btn-group">
                                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning text-light">
                                                    <i class='bx bxs-edit'></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger btnDelete" data-id="{{ $item->id }}">
                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                                <form action="{{ route('users.destroy', ['user' => $item->id]) }}" method="post" hidden class="deleteForm" data-id="{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
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
