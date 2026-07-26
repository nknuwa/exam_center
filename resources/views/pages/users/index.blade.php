@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">User Details</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">All Users</h6>
                </nav>
            </div>
            <div class="col-lg-2">
                <a href="{{ route('users.new') }}"
                    class="btn btn-warning mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end user-role">Create
                    Users</a>
            </div>
            <div class="col-lg-2">
                <a href="{{ route('user_bulk.new') }}"
                    class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end user-role">Create
                    Multiple accounts</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-4">
                <div class="card border-0 shadow-sm mt-4 modern-card p-2">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="fa-solid fa-users text-primary me-2"></i>
                                User List
                            </h5>
                            <small class="text-muted">Manage system users and permissions</small>
                        </div>
                    </div>

                    <div class="card-body px-3">

                        <div class="table-responsive">
                            <table class="table modern-table align-middle" id="user_table">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($users as $key => $user)
                                        <tr>

                                            <td>
                                                <span class="fw-semibold text-muted">
                                                    {{ sprintf('%02d', ++$key) }}
                                                </span>
                                            </td>


                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div class="user-avatar me-3">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            {{ $user->name }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            User Account
                                                        </small>
                                                    </div>

                                                </div>
                                            </td>


                                            <td>
                                                <span class="text-secondary">
                                                    <i class="fa-regular fa-envelope me-1"></i>
                                                    {{ $user->email }}
                                                </span>
                                            </td>


                                            <td>

                                                @foreach ($user->getRoleNames() as $rolename)
                                                    @php
                                                        if ($rolename == 'Super Admin') {
                                                            $roleClass = 'role-danger';
                                                        } elseif ($rolename == 'Admin') {
                                                            $roleClass = 'role-primary';
                                                        } elseif ($rolename == 'User') {
                                                            $roleClass = 'role-success';
                                                        } else {
                                                            $roleClass = 'role-default';
                                                        }
                                                    @endphp

                                                    <span class="badge role-badge {{ $roleClass }}">
                                                        {{ $rolename }}
                                                    </span>
                                                @endforeach

                                                {{-- @foreach ($user->getRoleNames() as $rolename)
                                                    <span class="badge role-badge ">
                                                        {{ $rolename }}
                                                    </span>
                                                @endforeach --}}

                                            </td>


                                            <td class="text-center">

                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm action-btn"
                                                    title="Edit User">

                                                    <i class="fa-solid fa-pen-to-square"></i>

                                                </a>

                                            </td>


                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
                {{-- <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="card mt-5">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div
                                                class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                                                <div class="dataTable-container">
                                                    <table class="table align-items-center table-flush" id="user_table">
                                                        <thead class="thead-light">
                                                            <th>
                                                                #No
                                                            </th>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Email
                                                            </th>
                                                            <th>
                                                                User Roles
                                                            </th>
                                                            <th class="text-center">
                                                                Action
                                                            </th>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($users as $key => $user)
                                                                <tr>
                                                                    <td>
                                                                        {{ ++$key }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $user->name }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $user->email }}
                                                                    </td>
                                                                    <td>
                                                                        @if (!empty($user->getRoleNames()))
                                                                            @foreach ($user->getRoleNames() as $rolename)
                                                                                <label
                                                                                    class="badge bg-primary mx-1 rolename">{{ $rolename }}</label>
                                                                            @endforeach
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">


                                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                                            class="btn btn-sm btn-info edit">
                                                                        </a>

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
                        </div>

                    </div>

                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Export User Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label>Start Date</label>
                                <input class="form-control" type="date" name="start_date" placeholder="Enter Start Date"
                                    id="start_date">
                            </div>
                            <div class="col-md-12">
                                <label>End Date</label>
                                <input class="form-control" type="date" name="end_date" placeholder="Enter End Date"
                                    id="end_date">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="submit" id="submit-btn" class="btn btn-primary">Export</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
                "language": {
                    "emptyTable": "No data available in the table",
                    "paginate": {
                        "previous": '<i class="fa-solid fa-angles-left"></i>',
                        "next": '<i class="fa-solid fa-angles-right"></i>'
                    },
                    "sEmptyTable": "No data available in the table"
                },
                pageLength: 10,
                lengthMenu: [10, 50, 100]

            });
        });
    </script>
@endpush
