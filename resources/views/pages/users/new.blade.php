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
                    <form class="form" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Name:</label>

                            <div class="col-sm-8">
                                 <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-sm-4 col-form-label">Email Address:<span class="text-danger">*</span></label>

                            <div class="col-sm-8">
                               <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email"
                        value="{{ old('email') }}" required autocomplete="username">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label class="col-sm-4 col-form-label">Password:<span class="text-danger">*</span></label>

                            <div class="col-sm-8">
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password"
                        required autocomplete="new-password">

                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label class="col-sm-4 col-form-label"> Confirm Password:<span
                                    class="text-danger">*</span></label>

                            <div class="col-sm-8">
                               <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                        name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-info btn-round float-end mt-3">Create</button>
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
