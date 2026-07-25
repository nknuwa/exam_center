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

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-header bg-primary text-white rounded-top-4">

                <h5 class="mb-0">
                    <i class="fa fa-user-minus"></i>
                    Add Absent Candidate
                </h5>

            </div>
            <div class="card-body p-4">
                <div class="row gy-4">
                    <!-- Left Form Section -->
                    <div class="col-lg-5 col-md-6 col-12">


                        <form action="{{ route('absentees.store') }}" method="POST">
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
                                <label for="exam_date" class="form-label">Date *</label>
                                <input type="text" name="date" id="date" class="form-control form-control-sm"
                                    placeholder="Select Date" autocomplete="off" value="{{ old('date') }}">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label for="session" class="form-label">Session *</label>
                                <select id="session" name="session" class="form-select form-select-sm">
                                    <option value="">Select Session</option>
                                    <option value="SESSION-I" {{ old('session') == 'SESSION-I' ? 'selected' : '' }}>
                                        SESSION-I</option>
                                    <option value="SESSION-II" {{ old('session') == 'SESSION-II' ? 'selected' : '' }}>
                                        SESSION-II</option>
                                </select>
                                @error('session')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subject_code" class="form-label">Subject Code *</label>
                                <select id="subject_code" name="subject_code" class="form-control">
                                    <option value="">Select Subject</option>
                                </select>
                                {{--  <input type="text" id="subject_code" name="subject_code"
                                    class="form-control form-control-sm" readonly value="{{ old('subject_code') }}">  --}}
                                @error('subject_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="paper_code" class="form-label">Paper Code *</label>
                                <input type="text" id="paper_code" name="paper_code" class="form-control form-control-sm"
                                    readonly value="{{ old('paper_code') }}">
                                @error('paper_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="index_no" class="form-label">Index Number *</label>
                                <input type="text" id="index_no" name="index_no" class="form-control form-control-sm"
                                    value="{{ old('index_no') }}">
                                @error('index_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-primary px-4">

                                    <i class="fa fa-save"></i>

                                    Save Candidate

                                </button>

                                <button type="reset" class="btn btn-light border px-4">

                                    <i class="fa fa-rotate-left"></i>

                                    Reset

                                </button>
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
                                    {{-- <td colspan="6" class="text-center text-muted">No Exams Found</td> --}}
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    {{-- <a href="{{ route('exams.download.csv') }}" class="btn btn-sm btn-primary">
                        Download <i class="fa-solid fa-file-csv ms-1"></i>
                    </a> --}}
                    <a href="{{ route('exams.download.excel') }}" class="btn btn-sm btn-success">
                        Download <i class="fa-solid fa-file-excel ms-1"></i>
                    </a>
                    <a href="{{ route('exams.download.pdf') }}" class="btn btn-sm btn-danger">
                        Download <i class="fa-solid fa-file-pdf ms-1"></i>
                    </a>
                </div>
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
                background: '#3cf8a0ac',
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
