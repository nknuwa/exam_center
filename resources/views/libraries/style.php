/* Modern Navbar */
    .modern-navbar {
        background: linear-gradient(135deg, #111827, #1f2937);
        padding: 12px 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

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
