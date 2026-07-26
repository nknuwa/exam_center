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


        <!-- Modern Exam Table -->
        <div class="card mt-4 border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 px-4 pt-4">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            <i class="fa-solid fa-comment-dots text-danger me-2"></i>
                            Special Notes List
                        </h5>
                        <small class="text-muted">
                            Examination Special Notes
                        </small>
                    </div>

                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                        Total : {{ count($comments) }}
                    </span>

                </div>
            </div>


            <div class="card-body px-4 pb-4">

                <div class="table-responsive">

                    <table id="noteTable" class="table modern-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>Center No</th>
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

                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">
                                            {{ $comment->center_no }}
                                        </span>
                                    </td>


                                    <td>
                                        <i class="fa-regular fa-calendar text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($comment->date)->format('d M Y') }}
                                    </td>


                                    <td>
                                        @if ($comment->session == 'SESSION-I')
                                            <span class="badge bg-success-subtle text-success">
                                                {{ $comment->session }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">
                                                {{ $comment->session }}
                                            </span>
                                        @endif
                                    </td>


                                    <td>
                                        <strong>
                                            {{ $comment->subject_code }}
                                        </strong>
                                    </td>


                                    <td>
                                        <span class="paper-badge">
                                            {{ $comment->paper_code }}
                                        </span>
                                    </td>


                                    <td>
                                        <span class="fw-bold text-dark">
                                            {{ $comment->message }}
                                        </span>
                                    </td>




                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="fa-solid fa-folder-open fa-2x mb-3"></i>

                                            <h6>No Messages Found</h6>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="{{ route('note.download.excel') }}" class="btn btn-success rounded-pill px-4">

                        <i class="fa-solid fa-file-excel me-1"></i>
                        Excel

                    </a>


                    <a href="{{ route('note.download.pdf') }}" class="btn btn-danger rounded-pill px-4">

                        <i class="fa-solid fa-file-pdf me-1"></i>
                        PDF

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

