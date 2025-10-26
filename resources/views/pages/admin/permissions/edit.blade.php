<div class="modal fade" id="edit{{$permission->id}}" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label">Permission</label>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                           @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{--  @can('update_permissions')  --}}
                    <button type="submit" class="btn btn-primary">Update</button>
                    {{--  @endcan  --}}
                </div>
            </form>
        </div>
    </div>
</div>