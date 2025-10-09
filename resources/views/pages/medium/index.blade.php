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

                <form action="#" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label mb-1">Date <span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="date" name="date"
                               value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                        @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1">Session <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" name="session" required>
                            <option value="" disabled selected>Select Session</option>
                            <option value="Morning" {{ old('session') == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Afternoon" {{ old('session') == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                            <option value="Evening" {{ old('session') == 'Evening' ? 'selected' : '' }}>Evening</option>
                        </select>
                        @error('session') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1">Subject Code <span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="subject_code"
                               value="{{ old('subject_code') }}">
                        @error('subject_code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1">Paper Code <span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="paper_code"
                               value="{{ old('paper_code') }}">
                        @error('paper_code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1">Index <span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="index"
                               value="{{ old('index') }}">
                        @error('index') <small class="text-danger">{{ $message }}</small> @enderror
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
                            <th>Center No</th>
                            <th>Subject No</th>
                            <th>Paper Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse($exams as $exam)
                            <tr>
                                <td>{{ $exam->index_no }}</td>
                                <td>{{ $exam->center_no }}</td>
                                <td>{{ $exam->subject_no }}</td>
                                <td>{{ $exam->paper_code }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No Exams Found</td>
                            </tr>
                        @endforelse --}}
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
    </div>
</div>
@endsection
