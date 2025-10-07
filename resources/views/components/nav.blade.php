 <nav class="main-nav--bg">
     <div class="container main-nav p-2">
         <div class="main-nav-start">
             {{--  <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" alt="main_logo" style="width: 15%">  --}}
             <div class="logo-text">
                 <span class="logo-title">Exam Center Management System</span>
             </div>
         </div>

         <div class="main-nav-end navbar">
             <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                 <span class="sr-only">Toggle menu</span>
                 <span class="icon menu-toggle--gray" aria-hidden="true"></span>
             </button>
             <div class="lang-switcher-wrapper">
                 <button class="lang-switcher1 transparent-btn" type="button">
                     <a href="{{ route('home') }}">Home</a>
                 </button>
             </div>
             <div class="lang-switcher-wrapper">
                 <button class="lang-switcher transparent-btn" type="button">
                     Absents Entry
                 </button>
                 <ul class="lang-menu dropdown">
                     <li><a href="{{ route('absentees.all') }}">Absentees</a></li>
                 </ul>
             </div>
             <div class="lang-switcher-wrapper">
                 <button class="lang-switcher transparent-btn" type="button">
                     Center Change
                 </button>
             </div>
             <div class="lang-switcher-wrapper">
                 <button class="lang-switcher transparent-btn" type="button">
                     Medium Change
                 </button>
             </div>

             {{--  <h6 class="font-weight-bolder mb-0">Hi!, {{ Auth::user()->name }}</h6>  --}}
             <div class="nav-user-wrapper">

                 <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                     <span class="sr-only">My profile</span>
                     <span class="nav-user-img">
                         <picture>
                             <i class="fa-solid fa-user-tie"></i>
                         </picture>
                     </span>
                 </button>
                 <ul class="users-item-dropdown nav-user-dropdown dropdown">
                     <li><a href="{{ route('profile.show') }}">
                             <i data-feather="user" aria-hidden="true"></i>
                             <span>Profile</span>
                         </a></li>
                     <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                             <i data-feather="log-out" aria-hidden="true"></i>
                             <span>Log out</span>
                         </a></li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>



 <!-- Modal -->
 <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- modal-sm = reduced width -->
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Ready To Leave</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body">
                 <p>Select "Logout" below if you are ready to end your current session.</p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit" class="btn btn-primary">Logout</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
