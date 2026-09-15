<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Kontributor' }}</title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite([
        'resources/css/app.css',
        'resources/css/kontributor.css',
        'resources/js/app.js',
        'resources/js/kontributor.js'
    ])
    @stack('styles')

</head>

<body>

<div class="layout-wrapper">

    {{-- Sidebar --}}
    @include('kontributor.components.sidebar')

    <div class="main-wrapper">

        {{-- Navbar --}}
        @include('kontributor.components.navbar')

        {{-- Content --}}
        <main class="content">

            @yield('content')

        </main>

        {{-- Footer --}}
        @include('kontributor.components.footer')

    </div>

</div>

@stack('scripts')

</body>

</html>