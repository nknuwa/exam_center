@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mr-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Permission Details</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">All User Permissions</h6>
                </nav>
            </div>
            <div class="col-lg-1">
                <a href="{{ route('roles.all') }}" class="btn btn-info mb-0 mt-2 float-end">Roles</a>
            </div>
            <div class="col-lg-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#addPermissionModal"
                    class="btn btn-success mb-0 mt-2 float-end">Create Permission</button>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center mt-3">
                <div class="card" style="width: 60rem;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="permission_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->created_at->format('Y-m-d') }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#editPermissionModal" data-id="{{ $permission->id }}"
                                                    data-name="{{ $permission->name }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <a href="javascript:void(0)"
                                                    onclick="confirmDelete('{{ route('permissions.delete', $permission->id) }}',
                                            'Do you want to delete this permission - {{ $permission->name }}?')"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3 float-end">
                                {{-- {{ $permissions->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== ADD MODAL ===================== --}}
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Enter permission name" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===================== EDIT MODAL ===================== --}}
        <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editPermissionForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Permission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit_permission_id">
                            <div class="mb-3">
                                <label class="form-label">Permission Name</label>
                                <input type="text" name="name" id="edit_permission_name" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editPermissionModal');

            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');

                // Set values in the modal
                document.getElementById('edit_permission_id').value = id;
                document.getElementById('edit_permission_name').value = name;

                // Set form action dynamically
                const form = document.getElementById('editPermissionForm');
                form.action = '/permissions/' + id;
            });
        });
    </script>
@endsection
