@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mr-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Permission Details</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">All User Permissions</h6>
                </nav>
            </div>
            <div class="col-lg-1">
                <a href="" class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end role">Roles</a>
            </div>
            <div class="col-lg-2">
                {{--  <a href=""
                    class="btn btn-success mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end permission">Permission</a>  --}}
                <button type="button" data-bs-toggle="modal" data-bs-target="#addPermissionModal"
                    class="btn btn-success mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end permission">Create
                    Permission</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{--  @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif  --}}
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
                                                Created Date
                                            </th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                        </thead>

                                        <tbody>
                                            @foreach ($permissions as $key => $permission)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $permission->name }}
                                                </td>
                                                <td>
                                                    {{ $permission->created_at }}
                                                </td>
                                                <td class="text-center">
                                                    {{--  @can('read_permissions')
                                                    <a href="#edit{{$permission->id}}"
                                                        class="btn btn-sm btn-info edit" data-bs-toggle="modal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    @endcan
                                                    @can('delete_permissions')
                                                    <a href="javascript:void(0)"
                                                    onclick="confirmDelete('{{ route('permissions.delete', $permission->id) }}','Do you want to delete this permission- {{ $permission->name }}?')"
                                                    class="btn btn-sm btn-danger delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>  --}}
                                                    {{--  @endcan  --}}
                                                    {{--  @include('pages.admin.permissions.edit')  --}}
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="mt-3 float-end">
                                        {{--  {{ $permissions->links() }}  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 @include('pages.admin.permissions.modal')
                </div>
            </div>
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
