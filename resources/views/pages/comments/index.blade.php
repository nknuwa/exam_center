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
                    <h6 class="fw-bold mb-0 text-dark">Special Note</h6>
                </nav>
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-danger float-end" onclick="window.location='{{ route('home') }}'">Back</button>
            </div>
        </div>

        <div class="card mt-3 shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="row gy-4">
                    <!-- Left Form Section -->
                    <div class="col-lg-5 col-md-6 col-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show py-2">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('message.store') }}" method="POST">
                            @csrf
                             @php
                                $user = Auth::user(); // get full user object, not just ID
                            @endphp

                            @if ($user->hasRole('super-admin'))
                                {{-- Super Admin: show all centers --}}
                                <div class="mb-3">
                                    <label for="center_no" class="form-label">Center</label>
                                    <select id="center_no" name="center_no" class="form-select form-select-sm select2">
                                        <option value="">Select Center</option>
                                        @foreach ($exam_db as $center)
                                            <option value="{{ $center->center_no }}">{{ $center->center_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                {{-- Normal User: show only assigned center --}}
                                <div class="mb-3">
                                    <label for="center_no" class="form-label">Center</label>
                                    <select id="center_no" name="center_no" class="form-select form-select-sm select2"
                                        readonly>
                                        @if ($user->center_no)
                                            <option value="{{ $user->center_no }}" selected>{{ $user->center_no }}</option>
                                        @else
                                            <option value="">No Center Assigned</option>
                                        @endif
                                    </select>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label mb-1">Date <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="date" class="form-control"
                                    value="{{ old('date') }}">
                                {{--  <input class="form-control form-control-sm" type="date" name="date"
                               value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">  --}}
                                @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Session <span class="text-danger">*</span></label>
                                <select id="session" name="session" class="form-select form-select-sm">
                                    <option value="">Select Session</option>
                                    <option value="SESSION-I" {{ old('session') == 'SESSION-I' ? 'selected' : '' }}>
                                        SESSION-I</option>
                                    <option value="SESSION-II" {{ old('session') == 'SESSION-II' ? 'selected' : '' }}>
                                        SESSION-II</option>
                                </select>
                                @error('session')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Subject Code <span class="text-danger">*</span></label>
                                <select id="subject_code" name="subject_code" class="form-control">
                                    <option value="">Select Subject</option>
                                </select>
                                {{--  <input class="form-control form-control-sm" type="text" name="subject_code"
                                    id="subject_code" value="{{ old('subject_code') }}" readonly>  --}}
                                @error('subject_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Paper Code <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="text" name="paper_code" id="paper_code"
                                    value="{{ old('paper_code') }}" readonly>
                                @error('paper_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Special Note <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary btn-sm px-3">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary btn-sm px-3">Clear</button>
                            </div>
                        </form>
                    </div>

                    <!-- Right Section -->
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="text-center text-muted small mt-4 mt-md-0">
                            <article class="stat-cards-item mx-5 mt-5" style="border:1px solid">
                                <div class="stat-cards-icon primary">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="stat-cards-primary">
                                    <p class="stat-cards-info__num">150</p>
                                    <p class="stat-cards-info__title">Total Applicants for subject - General English</p>
                                </div>
                            </article>

                            <article class="stat-cards-item mt-3 mx-5" style="border:1px solid">
                                <div class="stat-cards-icon success">
                                    <i class="fa-solid fa-user-minus"></i>
                                </div>
                                <div class="stat-cards-success">
                                    <p class="stat-cards-info__num">2</p>
                                    <p class="stat-cards-info__title">Absentees for subject - General English</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Exam Table -->
        <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="examTable" class="table table-bordered table-striped table-sm align-middle mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>Index No</th>
                                <th>Date</th>
                                <th>Session</th>
                                <th>Subject No</th>
                                <th>Paper Code</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                            <tr>
                                <td>{{ $comment->center_no }}</td>
                                <td>{{ $comment->date }}</td>
                                <td>{{ $comment->session }}</td>
                                <td>{{ $comment->subject_code }}</td>
                                <td>{{ $comment->paper_code }}</td>
                                <td>{{ $comment->message }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Exams Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    {{-- <a href="{{ route('exams.download.csv') }}" class="btn btn-sm btn-primary">
                        Download <i class="fa-solid fa-file-csv ms-1"></i>
                    </a>
                    <a href="{{ route('exams.download.excel') }}" class="btn btn-sm btn-success">
                        Download <i class="fa-solid fa-file-excel ms-1"></i>
                    </a>
                    <a href="{{ route('exams.download.pdf') }}" class="btn btn-sm btn-danger">
                        Download <i class="fa-solid fa-file-pdf ms-1"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
