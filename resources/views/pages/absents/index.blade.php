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
                    <h6 class="fw-bold mb-0 text-dark">Absent Candidate</h6>
                </nav>
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-danger float-end" onclick="window.location='{{ route('home') }}'">Back</button>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-4 mt-2">

            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">
                            <i class="fa-solid fa-user-xmark text-danger me-2"></i>
                            Absent Candidate
                        </h3>
                        <small class="text-muted">
                            Examination Attendance Management
                        </small>
                    </div>

                    <span class="badge bg-primary px-3 py-2">
                        <i class="fa-solid fa-calendar-days me-1"></i>
                        {{ date('d M Y') }}
                    </span>
                </div>
                <div class="row gy-4">
                    <!-- Left Form Section -->
                    <div class="col-lg-12 col-md-12 col-12">


                        <form action="{{ route('absentees.store') }}" method="POST" id="candidateForm">
                            @csrf
                            @php
                                $user = Auth::user(); // get full user object, not just ID
                            @endphp

                            <div class="row g-3">
                                @if ($user->hasRole('super-admin'))
                                    {{-- Super Admin: show all centers --}}
                                    <div class="col-lg-4 col-md-6">
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
                                    <div class="col-lg-4 col-md-6">
                                        <label for="center_no" class="form-label">Center</label>
                                        <input type="text" id="center_no" name="center_no"
                                            class="form-control form-control-sm" value="{{ $user->center_no }}" readonly>
                                        {{-- <select id="center_no" name="center_no" class="form-select form-select-sm select2"
                                            readonly>
                                            @if ($user->center_no)
                                                <option value="{{ $user->center_no }}" selected>{{ $user->center_no }}
                                                </option>
                                            @else
                                                <option value="">No Center Assigned</option>
                                            @endif
                                        </select> --}}
                                    </div>
                                @endif


                                <div class="col-lg-4 col-md-6">
                                    <label for="exam_date" class="form-label">Date *</label>
                                    <input type="text" name="date" id="date" class="form-control form-control-sm"
                                        placeholder="Select Date" autocomplete="off"
                                        value="{{ old('date', now()->format('Y-m-d')) }}">
                                    @error('date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label for="session" class="form-label">Session *</label>
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
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-lg-4 col-md-6">
                                    <label for="subject_code" class="form-label">Subject Code *</label>
                                    <select id="subject_code" name="subject_code" class="form-control">
                                        <option value="">Select Subject</option>
                                    </select>
                                    {{--  <input type="text" id="subject_code" name="subject_code"
                                    class="form-control form-control-sm" readonly value="{{ old('subject_code') }}">  --}}
                                    @error('subject_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label for="paper_code" class="form-label">Paper Code *</label>
                                    <input type="text" id="paper_code" name="paper_code"
                                        class="form-control form-control-sm" readonly value="{{ old('paper_code') }}">
                                    @error('paper_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label for="index_no" class="form-label">Index Number *</label>
                                    <input type="text" id="index_no" name="index_no"
                                        class="form-control form-control-sm" value="{{ old('index_no') }}">
                                    <input type="text" id="exam_id" name="exam_id" class="form-control form-control-sm"
                                        readonly>
                                    @error('index_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-end gap-2">
                                    <button class="btn btn-primary px-4">

                                        <i class="fa fa-save"></i>

                                        Save Candidate

                                    </button>

                                    <button type="reset" class="btn btn-light border px-4 reset">

                                        <i class="fa fa-rotate-left"></i>

                                        Reset

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Right Section -->
                    {{-- <div class="col-lg-3 col-md-3 col-12">
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
                    </div> --}}
                </div>
            </div>
        </div>


        <!-- Exam Table -->
        <!-- Modern Exam Table -->
        <div class="card mt-4 border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 px-4 pt-4">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-user-xmark text-danger me-2"></i>
                            Absent Candidates List
                        </h5>
                        <small class="text-muted">
                            Examination Attendance Records
                        </small>
                    </div>

                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                        Total : {{ $absentees->total() }}
                    </span>

                </div>
            </div>


            <div class="card-body px-4 pb-4">

                <div class="table-responsive">
                    <div class="row mb-4 mx-2 align-items-center g-3">

                        <div class="col-md-8 col-12">

                            <form method="GET" action="{{ route('absentees.all') }}"
                                class="d-flex align-items-center">

                                <label class="me-2 fw-semibold">
                                    Show
                                </label>

                                <select name="per_page" class="form-select form-select-sm w-auto me-2"
                                    onchange="this.form.submit()">

                                    @foreach ([10, 25, 50, 100] as $size)
                                        <option value="{{ $size }}"
                                            {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach

                                </select>

                                <span>entries</span>

                                <input type="hidden" name="search" value="{{ request('search') }}">

                            </form>

                        </div>


                        <div class="col-md-4 col-12 justify-content-end">

                            <form method="GET" action="{{ route('absentees.all') }}"
                                class="d-flex justify-content-end">

                                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">

                                <div class="input-group w-100">

                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-search"></i>
                                    </span>

                                    <input type="text" class="form-control" name="search"
                                        placeholder="Search candidate..." value="{{ request('search') }}">

                                    <button class="btn btn-primary">
                                        Search
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>
                    <table id="absenteesTable" class="table modern-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>Center No</th>
                                <th>Date</th>
                                <th>Session</th>
                                <th>Subject</th>
                                <th>Paper</th>
                                <th>Index No</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse($absentees as $absent)
                                <tr>

                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $absent->center_no }}
                                        </span>
                                    </td>


                                    <td>
                                        <i class="fa-regular fa-calendar text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($absent->date)->format('d M Y') }}
                                    </td>


                                    <td>
                                        @if ($absent->session == 'SESSION-I')
                                            <span class="badge bg-success-subtle text-success">
                                                {{ $absent->session }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">
                                                {{ $absent->session }}
                                            </span>
                                        @endif
                                    </td>


                                    <td>
                                        <strong>
                                            {{ $absent->subject_code }}
                                        </strong>
                                    </td>


                                    <td>
                                        <span class="paper-badge">
                                            {{ $absent->paper_code }}
                                        </span>
                                    </td>


                                    <td>
                                        <span class="fw-bold text-dark">
                                            {{ $absent->index_no }}
                                        </span>
                                    </td>

                                    <!-- Action Column -->
                                    <td class="text-center">

                                        <form action="{{ route('absentees.destroy', $absent->id) }}" method="POST"
                                            class="d-inline remove-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Remove Candidate">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>


                                </tr>


                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fa-solid fa-folder-open fa-2x mb-3"></i>

                                            <h6>No Absent Candidates Found</h6>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="row align-items-center mt-3 mx-2">

                        <div class="col-md-6">

                            @if ($absentees->count())
                                Showing {{ $absentees->firstItem() }} to {{ $absentees->lastItem() }}
                                of {{ $absentees->total() }} entries
                            @else
                                Showing 0 to 0 of 0 entries
                            @endif

                        </div>

                        <div class="col-md-6 d-flex justify-content-end">

                            {{ $absentees->appends(request()->query())->links() }}

                        </div>

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('absentees.download.excel') }}" class="btn btn-success rounded-pill px-4">

                        <i class="fa-solid fa-file-excel me-1"></i>
                        Excel

                    </a>


                    <a href="{{ route('absentees.download.pdf') }}" class="btn btn-danger rounded-pill px-4">

                        <i class="fa-solid fa-file-pdf me-1"></i>
                        PDF

                    </a>

                </div>


            </div>

        </div>
        {{-- <div class="card mt-4 shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="examTable" class="table table-bordered table-striped table-sm align-middle mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>Center No</th>
                                <th>Date</th>
                                <th>Session</th>
                                <th>Subject No</th>
                                <th>Paper Code</th>
                                <th>Index No</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absentees as $absent)
                                <tr>
                                    <td>{{ $absent->center_no }}</td>
                                    <td>{{ $absent->date }}</td>
                                    <td>{{ $absent->session }}</td>
                                    <td>{{ $absent->subject_code }}</td>
                                    <td>{{ $absent->paper_code }}</td>
                                    <td>{{ $absent->index_no }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <a href="{{ route('exams.download.csv') }}" class="btn btn-sm btn-primary">
                        Download <i class="fa-solid fa-file-csv ms-1"></i>
                    </a>
                    <a href="{{ route('exams.download.excel') }}" class="btn btn-sm btn-success">
                        Download <i class="fa-solid fa-file-excel ms-1"></i>
                    </a>
                    <a href="{{ route('exams.download.pdf') }}" class="btn btn-sm btn-danger">
                        Download <i class="fa-solid fa-file-pdf ms-1"></i>
                    </a>
                </div>
            </div>
        </div> --}}
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
{{-- @if (session('success'))

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#0d6efd'
    });

});

</script>

@endif --}}
{{-- @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc3545'
            });

        });
    </script>
@endif --}}
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
