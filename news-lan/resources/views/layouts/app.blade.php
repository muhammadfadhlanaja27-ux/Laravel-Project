<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lannn-News') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/asset/img">
    <!-- Font Awesome untuk ikon sosial media dan lainnya -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js untuk sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased">
    
    <!-- Cek apakah halaman admin (dengan sidebar) atau halaman public (dengan header biasa) -->
    @if(request()->is('admin/*') || request()->is('dashboard') || request()->is('profile'))
        
        <!-- LAYOUT ADMIN dengan Sidebar -->
        <div class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: true }">
            
            <!-- Include Navigation Sidebar - PERBAIKAN PATH -->
            @if(View::exists('layouts.navigation'))
                @include('layouts.navigation')
            @elseif(View::exists('components.admin-navigation'))
                @include('components.admin-navigation')
            @else
                <div class="bg-red-500 text-white p-4">
                    ERROR: Navigation file not found! Expected: resources/views/layouts/navigation.blade.php or resources/views/components/admin-navigation.blade.php
                </div>
            @endif

            <!-- Main Content dengan spacing untuk sidebar -->
            <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="transition-all duration-300 ease-in-out pt-16">
                @yield('content')
            </main>
        </div>

    @else
        
        <!-- LAYOUT PUBLIC dengan Header & Footer normal -->
        <div class="min-h-screen bg-gray-100">

            <!-- Header Component untuk halaman public -->
            @hasSection('no-header')
                {{-- Jangan tampilkan header --}}
            @else
                <header class="bg-white shadow">
                    <div>
                        <x-header /> 
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer Component untuk halaman public -->
            @hasSection('no-footer')
                {{-- Jangan tampilkan footer --}}
            @else
                <x-footer /> 
            @endif

        </div>

    @endif
    
</body>

</html>