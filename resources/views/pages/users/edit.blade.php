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
                        <li class="breadcrumb-item text-sm text-dark">
                            <a class="opacity-5 text-dark" href="{{ route('users.all') }}">All Users</a>
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Edit User</h6>
                </nav>
            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-2">
                <a href="{{ route('users.all') }}"
                    class="btn btn-danger mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 float-end">Back</a>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mt-5 ml-7 mr-7">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">Edit User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            @if (!$user->hasAnyRole(['super-admin','admin']))

                                <div class="mb-3">
                                    <label class="form-label">Center No</label>
                                    <select name="center_no" class="form-select @error('center_no') is-invalid @enderror">
                                        <option value="">-- Select Center --</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center }}"
                                                {{ $user->center_no == $center ? 'selected' : '' }}>
                                                {{ $center }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('center_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="alert alert-info py-2">
                                    <i class="fa-solid fa-crown me-1"></i> Super Admin — access to all centers.
                                </div>
                            @endif

                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role_id" class="form-control" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Phone No</label>
                                <input type="text" name="phone_no" class="form-control"
                                    value="{{ old('phone_no', $user->phone_no) }}">
                            </div>

                            <div class="mb-3">
                                <label>Password (leave blank if not changing)</label>
                                <input type="password" name="password" class="form-control">
                                <input type="password" name="password_confirmation" class="form-control mt-2"
                                    placeholder="Confirm password">
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection



@push('scripts')
    <script>
        // CKEDITOR.replace('address');
        ClassicEditor
            .create(document.querySelector('#remarks'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
