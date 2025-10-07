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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Exam Details</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Absent Candidates</h6>
                </nav>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h6>Create New Exam</h6>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="#" method="POST">
                            @csrf
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Date<span class="text-danger">*</span>:</label>
                                    <input class="form-control form-control-sm" type="text" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Subject <span class="text-danger">*</span>:</label>
                                    <input class="form-control form-control-sm" type="text" name="year"
                                        value="{{ old('year') }}">
                                    @error('year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Paper Code<span class="text-danger">*</span>:</label>
                                    <input class="form-control form-control-sm" type="text" name="year"
                                        value="{{ old('year') }}">
                                    @error('year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Index <span class="text-danger">*</span>:</label>
                                    <input class="form-control form-control-sm" type="text" name="year"
                                        value="{{ old('year') }}">
                                    @error('year')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save Exam</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table showing exams -->
            <div class="col-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h6>Exam List</h6>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Exam Name</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  @forelse($exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ $exam->year }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Exams Found</td>
                                    </tr>
                                @endforelse  --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
