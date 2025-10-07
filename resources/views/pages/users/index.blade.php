@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="card mt-5">
                                    {{--  <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2 float-end mt-2"><a href="{{ route('users.new') }}" class="btn btn-sm btn-primary">Add User</a></div>
                </div>  --}}
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
                                                            {{--  <th>
                                            User Status
                                        </th>  --}}
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
                                                                        {{--  @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge bg-primary mx-1 rolename">{{ $rolename }}</label>

                                                    @endforeach
                                                    @endif  --}}
                                                                    </td>
                                                                    <td class="text-center">


                                                                        {{--  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDelete('{{ route('users.delete', $user->id) }}','Do you want to delete this user- {{ $user->name }}?')"
                                                        class="btn btn-sm btn-danger delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>  --}}
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

                </div>
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
