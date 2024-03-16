<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    window.Toast = Toast;
    @if(Session::has('success'))
    Toast.fire({icon: 'success', title: `{{Session::get('success')}}`});
    @elseif(Session::has('warning'))
    Toast.fire({icon: 'warning', title: `{{Session::get('warning')}}`});
    @elseif(Session::has('error'))
    Toast.fire({icon: 'error', title: `{{Session::get('error')}}`});
    @elseif(Session::has('info'))
    Toast.fire({icon: 'info', title: `{{Session::get('info')}}`});
    @elseif(Session::has('failed'))
    Toast.fire({icon: 'error', title: `{{Session::get('failed')}}`});
    @endif
</script>
</body>
</html>
