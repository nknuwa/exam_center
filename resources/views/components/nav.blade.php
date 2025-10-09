<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid px-3 px-md-4">
        {{-- Logo / Title --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="me-2" style="width: 30px;">
            <span class="fw-semibold text-white">Exam Center Management System</span>
        </a>

        {{-- Toggler (hamburger icon) --}}
        <button class="navbar-toggler border-0 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--  <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>  --}}

        {{-- Navbar content --}}
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                {{-- Home --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">
                        {{--  <i class="fa-solid fa-house me-1"></i>   --}}
                        Home
                    </a>
                </li>

                {{-- Absentees --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('absentees.all') }}">
                        {{--  <i class="fa-solid fa-building-columns me-1"></i>   --}}
                        Absentees
                    </a>
                </li>

               {{-- Center Change --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        {{--  <i class="fa-solid fa-building-columns me-1"></i>   --}}
                        Center Change
                    </a>
                </li>

                {{-- Medium Change --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        {{--  <i class="fa-solid fa-language me-1"></i>  --}}
                         Medium Change
                    </a>
                </li>

                {{-- Profile / User Dropdown --}}
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                        id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-tie me-1"></i>
                        {{-- <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'User' }}</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fa-solid fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ready To Leave</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Select "Logout" below if you are ready to end your current session.</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
