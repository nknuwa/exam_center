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
                        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Select Excel/CSV File</label>

                                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                            </div>

                            <button class="btn btn-primary">
                                Upload Users
                            </button>
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
