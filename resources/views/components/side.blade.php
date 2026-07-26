<aside class="sidebar">
      <div class="sidebar-start">
        <div class="sidebar-head">
          <a href="/" class="logo-wrapper" title="Home">
            <span class="sr-only">Home</span>
            {{--  <span class="icon logo" aria-hidden="true"></span>  --}}
            <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" alt="main_logo" style="width: 15%">
            <div class="logo-text">
              <span class="logo-title">Exam Center Management System</span>
              {{--  <span class="logo-subtitle">Advance Level</span>  --}}
            </div>

          </a>
          <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle" aria-hidden="true"></span>
          </button>
        </div>
        <div class="sidebar-body">
          <ul class="sidebar-body-menu">
            <li>
              <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="/"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
            </li>
            <li>
              <a class="show-cat-btn {{ request()->routeIs('absentees.*') ? 'active' : '' }}" href="{{ route('absentees.all') }}">
                <span class="icon document" aria-hidden="true"></span>Absents Entry
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="{{route('absentees.all')}}">Absentees</a>
                </li>
                <li>
                  <a href="{{route('absentees.allData')}}">All Absent Candidates</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="show-cat-btn {{ request()->routeIs('center.*') ? 'active' : '' }}" href="{{route('center.all')}}">
                <span class="icon folder" aria-hidden="true"></span>Center Entry
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                   <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
               <ul class="cat-sub-menu">
                <li>
                  <a href="{{route('center.all')}}">Center Change</a>
                </li>
                <li>
                  <a href="{{route('center.allData')}}">All Center Changes</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="show-cat-btn {{ request()->routeIs('medium.*') ? 'active' : '' }}" href="{{route('medium.all')}}">
                <span class="icon image" aria-hidden="true"></span>Medium Entry
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Medium Change</span>
                   <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>

              <ul class="cat-sub-menu">
                <li>
                  <a href="{{route('medium.all')}}">Medium Change</a>
                </li>
                <li>
                  <a href="{{route('medium.allData')}}">All Medium Changes</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="show-cat-btn {{ request()->routeIs('message.*') ? 'active' : '' }}" href="{{route('message.all')}}">
                <span class="icon image" aria-hidden="true"></span>Note Entry
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                   <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>

              <ul class="cat-sub-menu">
                <li>
                  <a href="{{route('message.all')}}">Special Notes</a>
                </li>
                <li>
                  <a href="{{route('message.allData')}}">All Notes</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="show-cat-btn {{ request()->routeIs('nic.*') ? 'active' : '' }}" href="{{route('nic.all')}}">
                <span class="icon image" aria-hidden="true"></span>NIC Entry
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                   <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>

              <ul class="cat-sub-menu">
                <li>
                  <a href="{{route('nic.all')}}">NIC Change</a>
                </li>
                <li>
                  <a href="{{route('nic.allData')}}">All NIC Changes</a>
                </li>
              </ul>
            </li>
          </ul>
          <span class="system-menu__title">system</span>
          <ul class="sidebar-body-menu">
            {{--  <li>
              <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Appearance</a>
            </li>  --}}
            {{--  <li>
              <a class="show-cat-btn" href="##">
                <span class="icon category" aria-hidden="true"></span>
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="extention-01.html">Extentions-01</a>
                </li>
                <li>
                  <a href="extention-02.html">Extentions-02</a>
                </li>
              </ul>
            </li>  --}}
            <li>
              <a class="show-cat-btn {{ request()->routeIs('users.*') || request()->routeIs('roles.*') || request()->routeIs('permissions.*') ? 'active' : '' }}" href="##">
                <span class="icon user-3" aria-hidden="true"></span>Users
                <span class="category__btn transparent-btn" title="Open list">
                  <span class="sr-only">Open list</span>
                  <span class="icon arrow-down" aria-hidden="true"></span>
                </span>
              </a>
              <ul class="cat-sub-menu">
                <li>
                  <a href="{{ route('users.all') }}">Users</a>
                </li>
                <li>
                  <a href="{{ route('permissions.all') }}">Assign Permission</a>
                </li>
                <li>
                  <a href="{{ route('roles.all') }}">Assign Role</a>
                </li>

              </ul>
            </li>
            {{--  <li>
              <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
            </li>  --}}
          </ul>
        </div>
      </div>
      {{--  <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
          <span class="sidebar-user-img">
            <picture>
              <source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img
                src="./img/avatar/avatar-illustrated-01.png" alt="User name">
            </picture>
          </span>
          <div class="sidebar-user-info">
            <span class="sidebar-user__title">Nafisa Sh.</span>
            <span class="sidebar-user__subtitle">Support manager</span>
          </div>
        </a>
      </div>  --}}
    </aside>
