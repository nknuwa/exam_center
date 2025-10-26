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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                class="opacity-5 text-dark" href="{{ route('users.all') }}">All Users</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Create User</h6>
                </nav>
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
                                <h4 class="mb-0">Create User</h4>
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
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Center</label>
                                    <select name="center_no" class="form-control select2" required>
                                        <option value="">-- Select Center --</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center }}">{{ $center }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Role</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">-- Select Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                                        class="form-control" placeholder="+94123456789">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-2">Create User</button>
                                </div>
                            </div>
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
