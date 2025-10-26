 <nav class="main-nav--bg">
     <div class="container main-nav p-2">
         <div class="main-nav-start">
             <div class="search-wrapper">
                 {{--  <i data-feather="search" aria-hidden="true"></i>
              <input type="text" placeholder="Enter keywords ..." required>  --}}
             </div>
         </div>
         <div class="main-nav-end">
             {{--  <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
              <span class="sr-only">Toggle menu</span>
              <span class="icon menu-toggle--gray" aria-hidden="true"></span>
            </button>
            <div class="lang-switcher-wrapper">
              <button class="lang-switcher transparent-btn" type="button">
                EN
                <i data-feather="chevron-down" aria-hidden="true"></i>
              </button>
              <ul class="lang-menu dropdown">
                <li><a href="##">English</a></li>
                <li><a href="##">French</a></li>
                <li><a href="##">Uzbek</a></li>
              </ul>
            </div>  --}}
             {{--  <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>  --}}
             {{--  <div class="notification-wrapper">
                 <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
                     <span class="sr-only">To messages</span>
                     <span class="icon notification active" aria-hidden="true"></span>
                 </button>
                 <ul class="users-item-dropdown notification-dropdown dropdown">
                     <li>
                         <a href="##">
                             <div class="notification-dropdown-icon info">
                                 <i data-feather="check"></i>
                             </div>
                             <div class="notification-dropdown-text">
                                 <span class="notification-dropdown__title">System just updated</span>
                                 <span class="notification-dropdown__subtitle">The system has been successfully
                                     upgraded. Read more
                                     here.</span>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="##">
                             <div class="notification-dropdown-icon danger">
                                 <i data-feather="info" aria-hidden="true"></i>
                             </div>
                             <div class="notification-dropdown-text">
                                 <span class="notification-dropdown__title">The cache is full!</span>
                                 <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of
                                     memory space and
                                     interfere ...</span>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a href="##">
                             <div class="notification-dropdown-icon info">
                                 <i data-feather="check" aria-hidden="true"></i>
                             </div>
                             <div class="notification-dropdown-text">
                                 <span class="notification-dropdown__title">New Subscriber here!</span>
                                 <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a class="link-to-page" href="##">Go to Notifications page</a>
                     </li>
                 </ul>
             </div>  --}}
             <h6 class="font-weight-bolder mb-0 text-white">Hi!, {{ Auth::user()->name }}</h6>
             @if (Auth::check())
                 <script>
                     // Session lifetime from config/session.php (in minutes)
                     let timeout = {{ config('session.lifetime') }} * 60 * 1000;

                     setTimeout(function() {
                         window.location.href = "{{ route('login') }}";
                     }, timeout);
                 </script>
             @endif

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
                     {{--  <li><a href="##">
                             <i data-feather="settings" aria-hidden="true"></i>
                             <span>Account settings</span>
                         </a></li>  --}}
                     <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                             <i data-feather="log-out" aria-hidden="true"></i>
                             <span>Log out</span>
                         </a></li>

                     {{--  <li><!-- Trigger -->
                        <i data-feather="log-out" aria-hidden="true"></i>
<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
    Logout
</a></li>  --}}
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
