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
                    <h6 class="font-weight-bolder mb-0">Absent Candidate</h6>
                </nav>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="">
                                    <div class="card-body">

                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif
                                        <form action="#" method="POST">
                                            @csrf
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label>Date<span class="text-danger">*</span>:</label>
                                                    <input class="form-control form-control-sm" type="date"
                                                        name="date" value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                                    @error('date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label>Subject Code<span class="text-danger">*</span>:</label>
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="subject_code">
                                                    @error('subject_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label>Paper Code<span class="text-danger">*</span>:</label>
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="paper_code" value="{{ old('paper_code') }}">
                                                    @error('paper_code')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label>Index <span class="text-danger">*</span>:</label>
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="index" value="{{ old('index') }}">
                                                    @error('index')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Table showing exams -->
                            <div class="col-7">
                                <div class="">
                                    <div class="card-body">
                                        <table id="examTable" class="table table-bordered table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Index No</th>
                                                    <th>Center No</th>
                                                    <th>Subject No</th>
                                                    <th>Paper code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{--  @forelse($exams as $exam)
                                                    <tr>
                                                        <td>{{ $exam->index_no }}</td>
                                                        <td>{{ $exam->center_no }}</td>
                                                        <td>{{ $exam->subject_no }}</td>
                                                        <td>{{ $exam->paper_code }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Exams Found</td>
                                                    </tr>
                                                @endforelse  --}}
                                            </tbody>
                                        </table>
                                        <div class="mt-3">
                                            <a href="{{ route('exams.download.csv') }}"
                                                class="btn btn-sm btn-primary">Download <i
                                                    class="fa-solid fa-file-csv"></i></a>
                                            <a href="{{ route('exams.download.excel') }}"
                                                class="btn btn-sm btn-success">Download <i
                                                    class="fa-solid fa-file-excel"></i></a>
                                            <a href="{{ route('exams.download.pdf') }}"
                                                class="btn btn-sm btn-danger">Download <i
                                                    class="fa-solid fa-file-pdf"></i></a>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

