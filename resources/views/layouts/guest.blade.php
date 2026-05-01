<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <header style="width:100%; background:#fff; border-bottom:1px solid #e5e7eb;">
            <div style="max-width:1120px; margin:0 auto; padding:1rem; display:flex; align-items:center; justify-content:space-between;">
                <a href="/" style="font-weight:700; color:#1d4ed8; font-size:1.5rem;">IT Store</a>
                <nav style="display:flex; gap:1rem; align-items:center;">
                    <a href="/products" style="color:#374151; font-weight:600;">Products</a>
                    <a href="/login" style="color:#1d4ed8; font-weight:700;">Login</a>
                </nav>
            </div>
        </header>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
