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
                            <li class="breadcrumb-item text-sm text-dark">
                                <a class="opacity-5 text-dark" href="{{ route('roles.all') }}">Permission Details</a>
                            </li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Assign Permission to Role</h6>
                    </nav>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-2">
                        <a href="{{ route('roles.all') }}"
                            class="btn btn-danger mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end">Back</a>
                </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mt-3">
                <div class="card" style="width: 70rem;">
                    <div class="card-body">
                        <h5 class="card-title">Role : {{ $role->name }}</h5>
                        <form action="{{ route('roles.give-permissions', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                                <div class="row">
                                    <label class="col-md-12 col-form-label">Permissions</label>
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-3 mt-2">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="permission[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}>
                                            </label>
                                            {{ $permission->name }}
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="card-footer ">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-info btn-round">Assign Permission</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-8">

                {{--  @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card mt-5 ml-7 mr-7">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="mb-0">Role : {{ $role->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <form action="{{ route('roles.give-permissions', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>

                            @enderror
                            <div class="row">
                                <label class="col-md-12 col-form-label">Permissions</label>
                                @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="permission[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}>
                                        </label>
                                        {{ $permission->name }}
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">Role Permission</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>  --}}
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
