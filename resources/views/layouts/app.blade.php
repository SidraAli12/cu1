<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('build/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('build/app-BszSi1Uc.css') }}">
</head>

<body class="bg-gray-100 text-gray-900">
    {{-- Header --}}
    @include('layouts.header')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <main class="p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- JS --}}
    <script src="{{ asset('build/assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('build/app-CvgioS1y.js') }}"></script>
</body>
</html>
