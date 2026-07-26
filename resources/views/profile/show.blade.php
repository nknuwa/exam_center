@extends('layouts.app')

@section('content')
    <div class="container-fluid px-3 px-md-5">
        <div class="row align-items-center">
            <div class="col-md-8 col-12">
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-75 text-dark" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Exam Details</li>
                    </ol>
                    <h6 class="fw-bold mb-0 text-dark">Profile</h6>
                </nav>
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-danger float-end" onclick="window.location='{{ route('home') }}'">Back</button>
            </div>
        </div>

        <div class="card border-0 shadow-lg rounded-4 mt-3">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-lg-3 text-center">

                        <div class="profile-avatar mx-auto">

                            <i class="fa-solid fa-user"></i>

                        </div>

                        <h4 class="fw-bold mt-3 mb-1">
                            {{ Auth::user()->name }}
                        </h4>

                        <span class="badge bg-primary px-3 py-2">
                            {{ Auth::user()->getRoleNames()->first() }}
                        </span>

                    </div>

                    <div class="col-lg-9">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="text-muted small">
                                    Email Address
                                </label>

                                <h6>{{ Auth::user()->email }}</h6>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="text-muted small">
                                    Center Number
                                </label>

                                <h6>{{ Auth::user()->center_no }}</h6>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="text-muted small">
                                    Account Created
                                </label>

                                <h6>{{ Auth::user()->created_at->format('d M Y') }}</h6>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="text-muted small">
                                    User ID
                                </label>

                                <h6>#{{ Auth::user()->id }}</h6>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="card border-0 shadow-lg rounded-4 mt-5">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold">
                    <i class="fa-solid fa-user-pen text-primary me-2"></i>
                    Edit Profile
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('profile.update') }}" method="POST" id="profileUpdate">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Name</label>

                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Center No</label>

                            <input type="text" class="form-control" value="{{ Auth::user()->center_no }}" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Role</label>

                            <input type="text" class="form-control" value="{{ Auth::user()->getRoleNames()->first() }}"
                                readonly>

                        </div>

                    </div>

                    <div class="text-end">

                        <button class="btn btn-primary px-4">

                            <i class="fa-solid fa-floppy-disk me-1"></i>

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <div class="card border-0 shadow-lg rounded-4 mt-4">

            <div class="card-header bg-white border-0 pt-4">
                <h5 class="fw-bold">
                    <i class="fa-solid fa-lock text-warning me-2"></i>
                    Change Password
                </h5>
            </div>

            <div class="card-body">

                <form action="{{ route('profile.password') }}" method="POST" id="passwordUpdate">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Current Password</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password">

                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="current_password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>

                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">New Password</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">

                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Confirm Password</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">

                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="password_confirmation">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="text-end">

                        <button class="btn btn-warning px-4">
                            <i class="fa-solid fa-key me-1"></i>
                            Change Password
                        </button>

                    </div>

                </form>

            </div>

        </div>


    </div>
@endsection

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: '#198754', // Green
                color: '#ffffff',
                timerProgressBar: true
            });

            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });

        });
    </script>
@endif
@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });

        });
    </script>
@endif

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Swal.fire({

                icon: 'error',

                title: 'Validation Error',

                html: `{!! implode('<br>', $errors->all()) !!}`

            });

        });
    </script>
@endif
