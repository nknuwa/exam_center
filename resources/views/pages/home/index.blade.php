@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <div class="dashboard-header mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fa-solid fa-gauge-high me-2 text-secondary"></i>
                    Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Welcome back,
                    <strong>{{ Auth::user()->name }}</strong>
                </p>
            </div>

            <div class="text-end">
                {{-- <span class="badge bg-primary fs-6 px-3 py-2">
                    {{ now()->format('d M Y') }}
                </span> --}}
            </div>
        </div>
        <div class="row g-4 mb-5">

            <!-- Absentees -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <a href="{{ route('absentees.all') }}" class="text-decoration-none">
                    <div class="menu-card bg-primary-gradient">
                        <div class="icon">
                            <i class="fa-solid fa-user-minus"></i>
                        </div>

                        <div>
                            <h5>Mark Absentees</h5>
                            <small>Manage absent candidates</small>
                        </div>

                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </a>
            </div>

            <!-- Medium -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <a href="{{ route('medium.all') }}" class="text-decoration-none">
                    <div class="menu-card bg-success-gradient">
                        <div class="icon">
                            <i class="fa-solid fa-language"></i>
                        </div>

                        <div>
                            <h5>Change Medium</h5>
                            <small>Update medium details</small>
                        </div>

                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </a>
            </div>

            <!-- Center -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <a href="{{ route('center.all') }}" class="text-decoration-none">
                    <div class="menu-card bg-warning-gradient">
                        <div class="icon">
                            <i class="fa-solid fa-building-user"></i>
                        </div>

                        <div>
                            <h5>Change Center</h5>
                            <small>Transfer candidates</small>
                        </div>

                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </a>
            </div>

            <!-- Notes -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <a href="{{ route('message.all') }}" class="text-decoration-none">
                    <div class="menu-card bg-danger-gradient">
                        <div class="icon">
                            <i class="fa-solid fa-comment"></i>
                        </div>

                        <div>
                            <h5>Special Notes</h5>
                            <small>Exam messages</small>
                        </div>

                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </a>
            </div>

            <!-- NIC -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl">
                <a href="{{ route('nic.all') }}" class="text-decoration-none">
                    <div class="menu-card bg-secondary-gradient">
                        <div class="icon">
                            <i class="fa-solid fa-id-card"></i>
                        </div>

                        <div>
                            <h5>NIC Change</h5>
                            <small>Exam messages</small>
                        </div>

                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </a>
            </div>

        </div>

        <div class="row g-4 mt-2">

            <div class="col-md-6 col-xl-3">
                <div class="stats-card border-primary">
                    <div class="stats-icon bg-primary-gradient">
                        <i class="fa-solid fa-user-minus"></i>
                    </div>

                    <div class="stats-content">
                        <h3>{{ $today_absentees ?? 0 }}</h3>
                        <p>Today's Absentees</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stats-card border-warning">
                    <div class="stats-icon bg-warning-gradient">
                        <i class="fa-solid fa-building-user"></i>
                    </div>

                    <div class="stats-content">
                        <h3>{{ $today_centers ?? 0 }}</h3>
                        <p>Center Changes</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stats-card border-success">
                    <div class="stats-icon bg-success-gradient">
                        <i class="fa-solid fa-language"></i>
                    </div>

                    <div class="stats-content">
                        <h3>{{ $today_medium ?? 0 }}</h3>
                        <p>Medium Changes</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="stats-card border-danger">
                    <div class="stats-icon bg-danger-gradient">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>

                    <div class="stats-content">
                        <h3>{{ $notes ?? 0 }}</h3>
                        <p>Special Notes</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-4 mb-4">

            <div class="col-xl-8 col-lg-12">
                <div class="exam-card">

                    <div class="exam-header">
                        <div>
                            <h4>
                                <i class="fa-solid fa-calendar-days me-2"></i>
                                Today's Examination
                            </h4>

                            <p>
                                Current exam information
                            </p>
                        </div>

                        <span class="exam-badge">
                            LIVE
                        </span>
                    </div>


                    <div class="row mt-4">

                        <div class="col-md-3">
                            <div class="exam-item">
                                <i class="fa-solid fa-calendar"></i>
                                <div>
                                    <small>Date</small>
                                    <h6>
                                        {{ now()->format('d M Y') }}
                                    </h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="exam-item">
                                <i class="fa-solid fa-clock"></i>
                                <div>
                                    <small>Session</small>
                                    <h6>
                                        SESSION-I
                                    </h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="exam-item">
                                <i class="fa-solid fa-book"></i>
                                <div>
                                    <small>Subject</small>
                                    <h6>
                                        Mathematics
                                    </h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="exam-item">
                                <i class="fa-solid fa-file-lines"></i>
                                <div>
                                    <small>Paper</small>
                                    <h6>
                                        Paper 02
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <!-- Optional Today's Status -->
            {{-- <div class="col-xl-4 col-lg-12">

                <div class="exam-status-card">

                    <h5>
                        <i class="fa-solid fa-chart-line me-2"></i>
                        Exam Status
                    </h5>


                    <div class="status-row">
                        <span>Total Candidates</span>
                        <strong>2500</strong>
                    </div>


                    <div class="status-row">
                        <span>Present</span>
                        <strong class="text-success">
                            2450
                        </strong>
                    </div>


                    <div class="status-row">
                        <span>Absent</span>
                        <strong class="text-danger">
                            50
                        </strong>
                    </div>


                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" style="width:98%">
                            98%
                        </div>
                    </div>

                </div>

            </div> --}}

        </div>

        <div class="row g-4 mb-4">

            <div class="col-xl-4 col-lg-6">

                <div class="chart-card">

                    <div class="chart-header">
                        <h5>
                            <i class="fa-solid fa-chart-pie me-2"></i>
                            Attendance Status
                        </h5>

                        <span class="today-badge">
                            Today
                        </span>
                    </div>


                    <div class="chart-container">
                        <canvas id="attendanceChart"></canvas>
                    </div>


                    <div class="attendance-summary">

                        <div>
                            <span class="dot present"></span>
                            Present

                            <strong>
                                {{ $present ?? 0 }}
                            </strong>
                        </div>


                        <div>
                            <span class="dot absent"></span>
                            Absent

                            <strong>
                                {{ $absent ?? 0 }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>

             <!-- Optional Today's Status -->
            <div class="col-xl-4 col-lg-12">

                <div class="exam-status-card">

                    <h5>
                        <i class="fa-solid fa-chart-line me-2"></i>
                        Exam Status
                    </h5>


                    <div class="status-row">
                        <span>Total Candidates</span>
                        <strong>2500</strong>
                    </div>


                    <div class="status-row">
                        <span>Present</span>
                        <strong class="text-success">
                            2450
                        </strong>
                    </div>


                    <div class="status-row">
                        <span>Absent</span>
                        <strong class="text-danger">
                            50
                        </strong>
                    </div>


                    <div class="progress mt-3">
                        <div class="progress-bar bg-success" style="width:98%">
                            98%
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-lg-6">

                <div class="report-card">

                    <div class="report-header">
                        <h5>
                            <i class="fa-solid fa-file-arrow-down me-2"></i>
                            Quick Reports
                        </h5>

                        <span class="report-badge">
                            Reports
                        </span>
                    </div>


                    <div class="report-list">


                        <a href="{{ route('absentees.download.pdf') }}" class="report-item">

                            <div class="report-icon bg-danger-gradient">
                                <i class="fa-solid fa-user-minus"></i>
                            </div>

                            <div>
                                <h6>Absentee Report</h6>
                                <small>Download today's absent list</small>
                            </div>

                            <i class="fa-solid fa-download"></i>

                        </a>



                        <a href="{{ route('centers.download.pdf') }}" class="report-item">

                            <div class="report-icon bg-warning-gradient">
                                <i class="fa-solid fa-building-user"></i>
                            </div>

                            <div>
                                <h6>Center Change Report</h6>
                                <small>Candidate center changes</small>
                            </div>

                            <i class="fa-solid fa-download"></i>

                        </a>




                        <a href="{{ route('medium.download.pdf') }}" class="report-item">

                            <div class="report-icon bg-success-gradient">
                                <i class="fa-solid fa-language"></i>
                            </div>

                            <div>
                                <h6>Medium Change Report</h6>
                                <small>Language change details</small>
                            </div>

                            <i class="fa-solid fa-download"></i>

                        </a>




                        <a href="{{ route('note.download.pdf') }}" class="report-item">

                            <div class="report-icon bg-primary-gradient">
                                <i class="fa-solid fa-comment"></i>
                            </div>

                            <div>
                                <h6>Special Notes Report</h6>
                                <small>Exam notes summary</small>
                            </div>

                            <i class="fa-solid fa-download"></i>

                        </a>


                    </div>


                </div>

            </div>

        </div>
    </div>
@endsection
