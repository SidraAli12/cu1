<!DOCTYPE html>
<html lang="en" class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">  <!-- ✅ Important for AJAX POST -->
    <title>@yield('title', 'Authentication')</title>

    {{-- Favicon & Fonts --}}
    <link rel="icon" href="{{ asset('assets/media/app/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

    {{-- Vendor & Theme Styles --}}
    <link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">

    {{-- Page Content --}}
    <div class="grid lg:grid-cols-2 grow">
        @yield('content')
    </div>

    {{-- JS --}}
    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/ktui/ktui.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

    {{-- Page-specific scripts (e.g., AJAX handlers) --}}
    @yield('scripts')
</body>
</html>
