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
        /* background-color: #660303 !important; */
        background:
            linear-gradient(140deg,
                #0c053a 20%,
                #345191 45%,
                #0c053a 100%);
    }



    .main-nav--bg {
        /* background-color: #660303 !important; */
        background:
            linear-gradient(140deg,
                #0c053a 20%,
                #345191 45%,
                #0c053a 100%);

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

    /* =====================================
   MODERN GRADIENT NAVBAR
===================================== */

    .modern-navbar {

        background: linear-gradient(135deg,
                #1d1d1e 0%,
                #3a3a3a 50%,
                #696969 100%);

        /* background:linear-gradient(135deg,#111827,#374151,#4b5563); */
        /* background:linear-gradient(135deg,#065f46,#10b981,#34d399); */

        min-height: 70px;

        box-shadow:
            0 8px 25px rgba(0, 0, 0, .15);

    }


    /* Logo */

    .navbar-brand {

        letter-spacing: .3px;
        font-size: 17px;

    }

    .navbar-brand img {

        filter: drop-shadow(0 3px 5px rgba(0, 0, 0, .3));

    }



    /* Navbar Links */

    .modern-navbar .nav-link {

        color: rgba(255, 255, 255, .9) !important;

        font-weight: 500;

        padding: 10px 16px !important;

        border-radius: 12px;

        margin: 0 3px;

        transition: .3s ease;

    }



    /* Hover */

    .modern-navbar .nav-link:hover {

        color: white !important;

        background:
            rgba(255, 255, 255, .15);

        transform: translateY(-2px);

    }



    /* Active Menu */

    .modern-navbar .nav-link.active {

        background:
            rgba(255, 255, 255, .22);

        color: white !important;

        font-weight: 700;

        box-shadow:
            inset 0 0 0 1px rgba(255, 255, 255, .15);

    }



    /* User Icon */

    .modern-navbar .fa-user-tie {

        width: 38px;

        height: 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background:
            rgba(255, 255, 255, .18);

    }



    /* Dropdown */

    .dropdown-menu {

        border: none;

        border-radius: 16px;

        padding: 10px;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, .15);

    }



    .dropdown-item {

        border-radius: 10px;

        padding: 10px 15px;

        transition: .3s;

    }


    .dropdown-item:hover {

        background: #eff6ff;

        color: #2563eb;

    }



    /* Mobile Toggle */

    .navbar-toggler {

        background:
            rgba(255, 255, 255, .15);

        padding: 8px 10px;

        border-radius: 10px;

    }


    .navbar-toggler-icon {

        filter: brightness(0) invert(1);

    }



    /* Mobile Menu */

    @media(max-width:991px) {

        .navbar-collapse {

            background:
                rgba(30, 58, 138, .95);

            margin-top: 15px;

            padding: 15px;

            border-radius: 18px;

            backdrop-filter: blur(10px);

        }


        .modern-navbar .nav-link {

            margin: 5px 0;

        }

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

    .navbar .nav-link.active {
        background: rgba(255, 255, 255, 0.089);
        color: #fff !important;
        border-bottom: 1px solid #ffc107;
        border-radius: 8px;
        font-weight: 600;
    }

    .navbar .nav-link:hover {
        background: rgba(255, 255, 255, 0.051);
        border-radius: 8px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .menu-card {
        color: #fff;
        border-radius: 22px;
        padding: 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        min-height: 150px;
        position: relative;
        overflow: hidden;
        transition: all .35s ease;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .15);
    }

    .menu-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .22);
    }

    .menu-card::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .15);
    }

    .menu-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
    }

    .menu-card .icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(255, 255, 255, .18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        backdrop-filter: blur(8px);
    }

    .menu-card h5 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .menu-card small {
        opacity: .9;
    }

    .menu-card .arrow {
        position: absolute;
        right: 25px;
        bottom: 20px;
        font-size: 22px;
        opacity: .8;
    }

    .stats-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        transition: .3s;
    }

    .stats-card:hover {
        transform: translateY(-4px);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }

    .stats-card h2 {
        font-size: 34px;
        font-weight: 700;
        margin: 0;
    }

    .stats-card p {
        color: #6c757d;
        margin: 0;
        font-size: 15px;
    }

    /* Blue */
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4F8CFF 0%, #3358FF 100%);
    }

    /* Green */
    .bg-success-gradient {
        background: linear-gradient(135deg, #2DD4BF 0%, #0F9D58 100%);
    }

    /* Orange */
    .bg-warning-gradient {
        background: linear-gradient(135deg, #FFB75E 0%, #ED8F03 100%);
    }

    /* Red */
    .bg-danger-gradient {
        background: linear-gradient(135deg, #FF6B6B 0%, #D7263D 100%);
    }

    .bg-secondary-gradient {
        background: linear-gradient(135deg, #616161 0%, #353535 100%);
    }

    .exam-card {

        background: white;
        border-radius: 22px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);

    }


    .exam-header {

        display: flex;
        justify-content: space-between;
        align-items: center;

    }


    .exam-header h4 {

        font-weight: 700;
        margin: 0;

    }


    .exam-header p {

        color: #64748b;
        margin: 5px 0 0;

    }


    .exam-badge {

        background: linear-gradient(135deg,
                #10b981,
                #059669);

        color: white;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;

    }



    .exam-item {

        display: flex;
        align-items: center;
        gap: 15px;

        background: #f8fafc;
        border-radius: 15px;

        padding: 18px;

        height: 100%;

    }


    .exam-item i {

        width: 45px;
        height: 45px;

        border-radius: 12px;

        display: flex;
        justify-content: center;
        align-items: center;

        background: #2563eb;
        color: white;

        font-size: 20px;

    }


    .exam-item small {

        color: #64748b;

    }


    .exam-item h6 {

        margin: 4px 0 0;

        font-weight: 700;

    }



    /* Status Card */
    .exam-status-card {

        background: white;

        border-radius: 22px;

        padding: 25px;

        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);

    }

    .exam-status-card h5 {

        font-weight: 700;

    }

    .status-row {

        display: flex;
        justify-content: space-between;

        padding: 12px 0;

        border-bottom: 1px solid #eee;

    }

    .status-row strong {

        font-size: 18px;

    }

    .chart-card {

        background: white;

        border-radius: 22px;

        padding: 25px;

        box-shadow:
            0 10px 30px rgba(0, 0, 0, .08);

    }



    .chart-header {

        display: flex;

        justify-content: space-between;

        align-items: center;

    }


    .chart-header h5 {

        font-weight: 700;

        margin: 0;

    }



    .today-badge {

        background: #eff6ff;

        color: #2563eb;

        padding: 6px 15px;

        border-radius: 50px;

        font-size: 13px;

        font-weight: 600;

    }



    .chart-container {

        height: 250px;

        margin: 20px auto;

    }



    .attendance-summary {

        display: flex;

        justify-content: center;

        gap: 30px;

    }


    .attendance-summary div {

        display: flex;

        align-items: center;

        gap: 8px;

        font-size: 14px;

    }


    .attendance-summary strong {

        margin-left: 5px;

    }



    .dot {

        width: 12px;

        height: 12px;

        border-radius: 50%;

    }


    .dot.present {

        background: #10b981;

    }


    .dot.absent {

        background: #ef4444;

    }

    /* ==============================
   QUICK REPORT CARD
============================== */

    .report-card {

        background: #fff;
        border-radius: 22px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);

    }



    .report-header {

        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;

    }


    .report-header h5 {

        font-weight: 700;
        margin: 0;

    }



    .report-badge {

        background: #eff6ff;
        color: #2563eb;
        padding: 7px 15px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;

    }




    /* Report Item */

    .report-item {

        display: flex;
        align-items: center;
        gap: 15px;

        padding: 15px;

        border-radius: 16px;

        margin-bottom: 12px;

        background: #f8fafc;

        color: #1e293b;

        transition: .3s;

    }



    .report-item:hover {

        background: #eef2ff;

        transform: translateX(5px);

    }



    .report-item h6 {

        margin: 0;

        font-weight: 700;

    }



    .report-item small {

        color: #64748b;

    }



    .report-item>i {

        margin-left: auto;

        color: #64748b;

    }



    /* Report Icons */

    .report-icon {

        width: 50px;
        height: 50px;

        border-radius: 14px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: white;

        font-size: 20px;

    }

    /* Modern User Table */

    .modern-card {
        border-radius: 18px;
    }


    .modern-table {
        border-collapse: separate;
        border-spacing: 0 12px;
    }


    .modern-table thead th {
        background: #f8f9fa;
        border: 0;
        color: #6c757d;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
    }


    .modern-table tbody tr {
        background: #fff;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .05);
        transition: .25s ease;
    }


    .modern-table tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, .10);
    }


    .modern-table td {
        padding: 16px;
        border: 0;
    }


    .modern-table tbody tr td:first-child {
        border-radius: 15px 0 0 15px;
    }


    .modern-table tbody tr td:last-child {
        border-radius: 0 15px 15px 0;
    }



    /* Avatar */

    .user-avatar {

        width: 42px;
        height: 42px;
        border-radius: 50%;

        background: linear-gradient(135deg, #667eea, #764ba2);

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 700;
    }



    /* Role Badge */

    /* .role-badge {

        background: #dcfce7;
    color: #15803d;

        padding: 7px 14px;
        border-radius: 20px;

        font-size: 12px;
        margin-right: 5px;

    } */

    .role-badge {
    padding: 7px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}


/* Super Admin */
.role-danger {
    background:#fee2e2;
    color:#dc2626;
}


/* Admin */
.role-primary {
    background:#dbeafe;
    color:#2563eb;
}


/* Teacher */
.role-success {
    background:#dcfce7;
    color:#16a34a;
}


/* Normal User */
.role-secondary {
    background:#f1f5f9;
    color:#475569;
}


/* Other Roles */
.role-default {
    background:#fef3c7;
    color:#b45309;
}



    /* Action button */

    .action-btn {

        width: 38px;
        height: 38px;

        border-radius: 12px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: #e0f2fe;
        color: #0284c7;

        transition: .2s;

    }


    .action-btn:hover {

        background: #0284c7;
        color: white;

    }

    .input-group .form-control{
    border-left:none;
}

.input-group-text{
    border-right:none;
    background:#fff;
}

.pagination{
    margin-bottom:0;
}

.page-link{
    border-radius:8px;
    margin:0 2px;
}

.page-item.active .page-link{
    background:#0d6efd;
    border-color:#0d6efd;
}
</style>
