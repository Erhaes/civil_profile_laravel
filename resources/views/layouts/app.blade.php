<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- CSRF Token for AJAX requests --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title & Meta Description --}}
    <title>@yield('title', 'Teknik Sipil Unsoed')</title>
    <meta name="description" content="@yield('description', 'Website Resmi Teknik Sipil Universitas Jenderal Soedirman')">
    
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('unsoed.png') }}">
    
    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    {{-- Compiled CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Inline style to apply font --}}
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="antialiased bg-light-base dark:bg-dark-base text-dark-base dark:text-light-base">
    
    {{-- Include Navbar Component --}}
    @include('components.navbar')

    {{-- Main Content Area --}}
    <main>
        @yield('content')
    </main>

    {{-- Include Footer Component --}}
    @include('components.footer')
    
    {{-- Additional scripts for specific pages --}}
    @stack('scripts')
</body>
</html>