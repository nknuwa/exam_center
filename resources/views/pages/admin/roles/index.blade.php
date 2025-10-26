@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('home') }}">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Role Details</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">All User Roles</h6>
            </nav>
        </div>
        <div class="col-lg-1">
            {{--  @can('read_permissions')  --}}
                <a href="{{ route('permissions.all') }}"
                    class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end role">Permissions</a>
            {{--  @endcan  --}}

        </div>
        <div class="col-lg-1 user">
            {{--  @can('read_users')  --}}
                <a href="{{ route('users.all') }}"
                    class="btn btn-warning mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end user">Users</a>
            {{--  @endcan  --}}

        </div>
        <div class="col-lg-2 role">
            {{--  @can('create_roles')  --}}
            <button type="button" data-bs-toggle="modal" data-bs-target="#addRoleModal"
            class="btn btn-success mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end user-role">Create User Role</button>
            {{--  @endcan  --}}

        </div>
    </div>
         <div class="row">
        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card mt-5">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">

                            <div class="dataTable-container">
                                <table class="table align-items-center table-flush" id="user_table">
                                    <thead class="thead-light">
                                        <th>

                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Create Date
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>

                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>
                                                    {{--  {{ ++$key }}  --}}
                                                </td>
                                                <td>
                                                    {{ $role->name }}
                                                </td>
                                                <td>
                                                    {{ $role->created_at }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('roles.permissions', $role->id) }}"
                                                        class="btn btn-sm btn-info role-permission">
                                                        Add / Edit Role Permissions
                                                    </a>
                                                    {{--  @can('edit_roles')
                                                        <a href="#edit{{$role->id}}"
                                                            class="btn btn-sm btn-info edit" data-bs-toggle="modal">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete_roles')
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmDelete('{{ route('roles.delete', $role->id) }}','Do you want to delete this role- {{ $role->name }}?')"
                                                            class="btn btn-sm btn-danger delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>
                                                    @endcan  --}}
                                                    {{--  @include('pages.admin.roles.edit')  --}}
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
        @include('pages.admin.roles.modal')
    </div>


    @endsection

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
