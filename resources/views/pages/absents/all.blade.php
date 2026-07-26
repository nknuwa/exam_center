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
                        Total : {{ count($absentees) }}
                    </span>

                </div>
            </div>


            <div class="card-body px-4 pb-4">

                <div class="table-responsive">

                    <table id="examTable" class="table modern-table align-middle mb-0">

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

                                    <td colspan="6" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fa-solid fa-folder-open fa-2x mb-3"></i>

                                            <h6>No Absent Candidates Found</h6>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

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
    </div>
@endsection
