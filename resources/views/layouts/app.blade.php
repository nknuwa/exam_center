<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Exam Center Management</title>

    @php
        $curr_url = Route::currentRouteName();
    @endphp

    @include('libraries.styles')
</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        <!-- ! Sidebar -->
        {{--  @include('components.side')  --}}
        <div class="main-wrapper">
            <!-- ! Main nav -->
            @include('components.nav')
            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                 @yield('content')
            </main>
            <!-- ! Footer -->
            @include('components.footer')
        </div>
    </div>
     @stack('modals')

   @include('libraries.scripts')
</body>

</html>
