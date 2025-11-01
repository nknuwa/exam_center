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
                    <h6 class="fw-bold mb-0 text-dark">Change Exam Center</h6>
                </nav>
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-danger float-end" href="{{ route('home') }}">Back</button>
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

                        <form action="{{ route('centers.store') }}" method="POST">
                            @csrf

                            {{--  <div class="mb-3">
                                <label class="form-label mb-1">Date <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="date" name="date"
                                    value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>  --}}

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
                                            <option value="{{ $user->center_no }}" selected>{{ $user->center_no }}
                                            </option>
                                        @else
                                            <option value="">No Center Assigned</option>
                                        @endif
                                    </select>
                                </div>
                            @endif




                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="session" class="form-label">Session *</label>
                                <select id="session" name="session" class="form-select">
                                    <option value="">Select Session</option>
                                    <option value="SESSION-I" {{ old('session') == 'SESSION-I' ? 'selected' : '' }}>
                                        SESSION-I</option>
                                    <option value="SESSION-II" {{ old('session') == 'SESSION-II' ? 'selected' : '' }}>
                                        SESSION-II</option>
                                </select>
                                @error('session')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Subject Code</label>
                                
                                {{--  <input id="subject_code" type="text" name="subject_code" class="form-control" readonly>  --}}
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Paper Code</label>
                                <input id="paper_code" type="text" name="paper_code" class="form-control" readonly>
                            </div>


                            <div class="mb-3">
                                <label class="form-label mb-1">Index <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="text" name="index_no" id="index_no"
                                    value="{{ old('index_no') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label mb-1">Current Center <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="text" name="current_center_no"
                                    id="current_center_no" value="{{ old('center_no') }}" readonly>
                            </div>


                            @php
                                $user = Auth::user(); // get full user object, not just ID
                            @endphp

                            @if ($user->hasRole('super-admin'))
                                {{-- Super Admin: show all centers --}}
                                <div class="mb-3">
                                    <label for="center_no" class="form-label">Center</label>
                                    <select id="new_center_no" name="new_center_no"
                                        class="form-select form-select-sm select2">
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
                                    <select id="new_center_no" name="new_center_no"
                                        class="form-select form-select-sm select2" readonly>
                                        @if ($user->center_no)
                                            <option value="{{ $user->center_no }}" selected>{{ $user->center_no }}
                                            </option>
                                        @else
                                            <option value="">No Center Assigned</option>
                                        @endif
                                    </select>
                                </div>
                            @endif

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
                                <th>Date</th>
                                <th>Session</th>
                                <th>Subject No</th>
                                <th>Paper Code</th>
                                <th>Index No</th>
                                <th>Current Center</th>
                                <th>New Center</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($centers as $center)
                                <tr>
                                    <td>{{ $center->date }}</td>
                                    <td>{{ $center->session }}</td>
                                    <td>{{ $center->subject_code }}</td>
                                    <td>{{ $center->paper_code }}</td>
                                    <td>{{ $center->index_no }}</td>
                                    <td>{{ $center->current_center_no }}</td>
                                    <td>{{ $center->new_center_no }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No center changes Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{--  <div class="d-flex flex-wrap gap-2 mt-3">
                <a href="{{ route('exams.download.csv') }}" class="btn btn-sm btn-primary">
                    Download <i class="fa-solid fa-file-csv ms-1"></i>
                </a>
                <a href="{{ route('exams.download.excel') }}" class="btn btn-sm btn-success">
                    Download <i class="fa-solid fa-file-excel ms-1"></i>
                </a>
                <a href="{{ route('exams.download.pdf') }}" class="btn btn-sm btn-danger">
                    Download <i class="fa-solid fa-file-pdf ms-1"></i>
                </a>
            </div>  --}}
            </div>
        </div>
    </div>
@endsection
