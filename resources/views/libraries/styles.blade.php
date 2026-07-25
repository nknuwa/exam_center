@livewireStyles

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/img/svg/logo.svg') }}" type="image/x-icon">
<!-- Custom styles -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stack ('styles')
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;

    }



    .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    .card-header i {
        transition: transform 0.3s ease;
    }

    .card:hover .card-header i {
        transform: scale(1.15);
    }

    .page-right {
        width: 100%;
        min-height: 100vh;
        background-image: url(assets/img/login1.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px;
        box-sizing: border-box;
    }

    .login-container {
        display: flex;
        justify-content: space-between;
        /* Left and right columns */
        align-items: center;
        max-width: 900px;
        /* Adjust as needed */
        width: 100%;
        gap: 50px;
        /* Space between columns */
    }

    .login-left {
        flex: 1;
        text-align: left;
        color: #fff;
        /* Optional: make text visible on image */
    }

    .sign-up__title {
        color: #fff;
        font-weight: 600;
        font-size: 2rem;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    .sign-up__subtitle {
        color: #dddadaff;
        font-size: 1.2rem;
        font-weight: 200;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    .login-right {
        flex: 1;
        max-width: 400px;
    }

    .sign-up {
        margin-top: 0;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .login-left,
        .login-right {
            flex: unset;
            width: 100%;
            text-align: center;
            /* optional for mobile */
        }
    }



    @media (max-width: 576px) {
        .navbar-brand span {
            font-size: 0.9rem;
            /* smaller text for phones */
        }
    }


    {{--  article {
        position: relative;
        top: 50px;
        left: 50px;
    }  --}} label {
        font-size: 0.8rem;
    }

    h6 {
        font-size: 0.8rem;
    }

    .breadcrumb-item+.breadcrumb-item {
        font-size: 1rem;
        padding-left: .5rem;
    }

    .sidebar {
        background-color: #660303 !important;
    }

    .main-nav--bg {
        background-color: #660303 !important;

    }

    input {
        border: solid #9b9a9a 1px !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #aaa;
        border-radius: 3px;
        padding: 5px;
        background-color: transparent;
        color: inherit;
        margin-left: 3px;
        margin-bottom: 10px !important;
    }

    table.dataTable.no-footer {
        FONT-WEIGHT: 200;
        border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        border-top: 1px solid rgba(0, 0, 0, 0.3);
    }

    .w3-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);

        display: flex;
        align-items: center;
        /* vertical center */
        justify-content: center;
        /* horizontal center */
    }

    .w3-modal-content {
        width: 30%;
        /* shrink */
        border-radius: 10px;
        background-color: #ebebeb;
    }

    .card-footer {
        padding: .5rem 1rem;
        background-color: #fff !important;
        border-top: 1px solid rgba(0, 0, 0, .125);
    }

    .form-control,
    .form-select {

        border-radius: 12px;
        height: 46px;

        border: 1px solid #d5d5d5;

        transition: .3s;

    }

    .form-control:focus,
    .form-select:focus {

        border-color: #0d6efd;

        box-shadow: 0 0 10px rgba(13, 110, 253, .2);

    }

    .form-label {

        font-weight: 600;

        color: #555;

    }

    .reset:hover {
        background: #000;
        color: #fff;
    }


    .modern-table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }


    .modern-table thead th {

        background: #f8f9fa;
        color: #495057;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 15px;
        border: none;

    }


    .modern-table tbody tr {

        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: 0.3s;

    }


    .modern-table tbody tr:hover {

        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);

    }


    .modern-table tbody td {

        padding: 15px;
        border: none;

    }


    .modern-table tbody tr td:first-child {

        border-radius: 12px 0 0 12px;

    }


    .modern-table tbody tr td:last-child {

        border-radius: 0 12px 12px 0;

    }


    .paper-badge {

        background: #eef2ff;
        color: #4338ca;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;

    }


    .bg-danger-subtle {

        background: #ffe5e5;

    }


    .bg-primary-subtle {

        background: #e7f0ff;

    }


    .bg-success-subtle {

        background: #dcfce7;

    }


    .bg-warning-subtle {

        background: #fff7d6;

    }

    /* Modern Navbar */
    .modern-navbar {
        background: linear-gradient(135deg, #111827, #1f2937);
        padding: 12px 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }


    /* Logo */
    .navbar-brand {
        font-size: 17px;
        letter-spacing: .3px;
    }

    .navbar-brand img {
        width: 38px !important;
        height: 38px;
        object-fit: contain;
        background: rgba(255, 255, 255, .1);
        padding: 5px;
        border-radius: 10px;
    }


    /* Menu Items */
    .modern-navbar .nav-link {
        color: #d1d5db !important;
        font-size: 14px;
        font-weight: 500;
        padding: 10px 15px !important;
        margin: 0 3px;
        border-radius: 10px;
        transition: all .3s ease;
    }


    /* Hover */
    .modern-navbar .nav-link:hover {
        background: rgba(255, 255, 255, .12);
        color: #ffffff !important;
        transform: translateY(-2px);
    }


    /* Active menu */
    .modern-navbar .nav-link.active {
        background: #2563eb;
        color: white !important;
    }


    /* User Icon */
    #userDropdown {
        background: rgba(255, 255, 255, .12);
        width: 40px;
        height: 40px;
        justify-content: center;
        border-radius: 50%;
        padding: 0 !important;
    }


    #userDropdown:hover {
        background: #2563eb;
    }


    /* Dropdown */
    .dropdown-menu {
        border: none;
        border-radius: 14px;
        padding: 8px;
        margin-top: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, .15);
    }


    .dropdown-item {
        border-radius: 10px;
        padding: 10px 15px;
        font-size: 14px;
    }


    .dropdown-item:hover {
        background: #f1f5f9;
    }


    /* Mobile */
    @media(max-width:991px) {

        .navbar-collapse {
            margin-top: 15px;
            background: rgba(255, 254, 254, 0.08);
            padding: 15px;
            border-radius: 15px;
        }


        .modern-navbar .nav-link {
            margin-bottom: 5px;
        }

    }
</style>
