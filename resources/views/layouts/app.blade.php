<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Ruang Kreasi' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite([
        'resources/css/guest.css',
        'resources/js/guest.js'
    ])

    @stack('styles')

</head>

<body>

    @include('guest.components.navbar')

    <main>

        @yield('content')

    </main>

    @include('guest.components.footer')

    @stack('scripts')

</body>

</html>