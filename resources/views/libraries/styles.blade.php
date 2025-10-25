@livewireStyles

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/img/svg/logo.svg') }}" type="image/x-icon">
<!-- Custom styles -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
    justify-content: space-between; /* Left and right columns */
    align-items: center;
    max-width: 900px;              /* Adjust as needed */
    width: 100%;
    gap: 50px;                     /* Space between columns */
}

.login-left {
    flex: 1;
    text-align: left;
    color: #fff;                   /* Optional: make text visible on image */
}

.sign-up__title {
    color: #fff;
    font-weight: 600;
    font-size: 2rem;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
}

.sign-up__subtitle {
    color: #dddadaff;
    font-size: 1.2rem;
    font-weight: 200;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
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

    .login-left, .login-right {
        flex: unset;
        width: 100%;
        text-align: center; /* optional for mobile */
    }
}



@media (max-width: 576px) {
    .navbar-brand span {
        font-size: 0.9rem;   /* smaller text for phones */
    }
}


    {{--  article {
        position: relative;
        top: 50px;
        left: 50px;
    }  --}}

    label {
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
</style>
