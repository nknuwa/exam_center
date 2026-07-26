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
                    <h6 class="fw-bold mb-0 text-dark">Change Medium</h6>
                </nav>
            </div>
            <div class="col-md-4 float-end">
                <button class="btn btn-danger float-end" onclick="window.location='{{ route('home') }}'">Back</button>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-4 mt-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">
                            <i class="fa-solid fa-language text-danger me-2"></i>
                            Change Medium
                        </h3>
                        <small class="text-muted">
                            Examination Center Management
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


                        <form action="{{ route('medium.store') }}" method="POST" id="mediumForm">
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
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control"
                                        value="{{ old('date') }}">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
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
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-lg-4 col-md-6">
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

                                <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">Paper Code <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="paper_code"
                                        id="paper_code" value="{{ old('paper_code') }}" readonly>
                                    @error('paper_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="row g-3 mt-1">

                                <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">Index <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="index_no"
                                        value="{{ old('index') }}" id="index_no">
                                    <small id="index-error" class="text-danger"></small>
                                    @error('index')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">
                                        Old Medium <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-select-sm" name="medium_no" id="medium_no">
                                        <option value="">Select Medium</option>
                                        <option value="2">SINHALA</option>
                                        <option value="3">TAMIL</option>
                                        <option value="4">ENGLISH</option>
                                    </select>

                                    @error('medium_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">Old Medium <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="medium_no"
                                        id="medium_no" value="{{ old('medium_no') }}" readonly>
                                    @foreach ($mediumChanges as $medium)
                                        <input type="text" class="form-control form-control-sm"
                                            value="{{ $medium->medium_no == 2 ? 'SINHALA' : ($medium->medium_no == 3 ? 'TAMIL' : ($medium->medium_no == 4 ? 'ENGLISH' : '')) }}"
                                            readonly>
                                    @endforeach
                                    @error('medium_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}

                                <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">New Medium <span class="text-danger">*</span></label>

                                    <select class="form-select form-select-sm" name="new_medium_no" id="new_medium_no">
                                        <option value="">Select Medium</option>
                                        <option value="2">SINHALA</option>
                                        <option value="3">TAMIL</option>
                                        <option value="4">ENGLISH</option>
                                    </select>

                                    @error('new_medium_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- <div class="col-lg-4 col-md-6">
                                    <label class="form-label mb-1">New Medium <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="new_medium_no"
                                        value="{{ old('new_medium_no') }}" id="new_medium_no">
                                    @error('new_medium_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
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
                    {{-- <div class="col-lg-7 col-md-6 col-12">
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
                                    <i class="fa-solid fa-language me-1"></i>
                                </div>
                                <div class="stat-cards-success">
                                    <p class="stat-cards-info__num">2</p>
                                    <p class="stat-cards-info__title">Medium Changes</p>
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
                            <i class="fa-solid fa-language text-danger me-2"></i>
                            Medium Changes List
                        </h5>
                        <small class="text-muted">
                            Examination Medium Changes Records
                        </small>
                    </div>

                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                        Total : {{ count($mediumChanges) }}
                    </span>

                </div>
            </div>


            <div class="card-body px-4 pb-4">

                <div class="table-responsive">

                    <table id="examTable" class="table modern-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="text-center">Center No</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Session</th>
                                <th class="text-center">Subject No</th>
                                <th class="text-center">Paper Code</th>
                                <th class="text-center">Index No</th>
                                <th class="text-center">Old Medium</th>
                                <th class="text-center">New Medium</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse($mediumChanges as $medium)
                                <tr>

                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $medium->center_no }}
                                        </span>
                                    </td>


                                    <td class="text-center">
                                        <i class="fa-regular fa-calendar text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($medium->date)->format('d M Y') }}
                                    </td>


                                    <td class="text-center">
                                        @if ($medium->session == 'SESSION-I')
                                            <span class="badge bg-success-subtle text-success">
                                                {{ $medium->session }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">
                                                {{ $medium->session }}
                                            </span>
                                        @endif
                                    </td>


                                    <td class="text-center">
                                        <strong>
                                            {{ $medium->subject_code }}
                                        </strong>
                                    </td>


                                    <td class="text-center">
                                        <span class="paper-badge">
                                            {{ $medium->paper_code }}
                                        </span>
                                    </td>


                                    <td class="text-center">
                                        <span class="fw-bold text-dark">
                                            {{ $medium->index_no }}
                                        </span>
                                    </td>

                                    @php
                                        $mediumNames = [
                                            2 => 'SINHALA',
                                            3 => 'TAMIL',
                                            4 => 'ENGLISH',
                                        ];
                                    @endphp

                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $mediumNames[$medium->medium_no] ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger">
                                            {{ $mediumNames[$medium->new_medium_no] ?? 'Unknown' }}
                                        </span>
                                    </td>

                                    <!-- Action Column -->
                                    <td class="text-center">

                                        {{-- <form action="{{ route('absentees.destroy', $absent->id) }}" method="POST"
                                            class="d-inline remove-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Remove Candidate">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form> --}}

                                    </td>


                                </tr>


                            @empty

                                <tr>

                                    <td colspan="9" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fa-solid fa-folder-open fa-2x mb-3"></i>

                                            <h6>No Medium Changes Found</h6>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('medium.download.excel') }}" class="btn btn-success rounded-pill px-4">

                        <i class="fa-solid fa-file-excel me-1"></i>
                        Excel

                    </a>


                    <a href="{{ route('medium.download.pdf') }}" class="btn btn-danger rounded-pill px-4">

                        <i class="fa-solid fa-file-pdf me-1"></i>
                        PDF

                    </a>

                </div>


            </div>

        </div>
        {{--
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
                                <th>Old Medium</th>
                                <th>New Medium</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mediumChanges as $medium)
                                <tr>
                                    <td>{{ $medium->center_no }}</td>
                                    <td>{{ $medium->date }}</td>
                                    <td>{{ $medium->session }}</td>
                                    <td>{{ $medium->subject_code }}</td>
                                    <td>{{ $medium->paper_code }}</td>
                                    <td>{{ $medium->index_no }}</td>
                                    <td>{{ $medium->medium_no }}</td>
                                    <td>{{ $medium->new_medium_no }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No Exams Found</td>
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
