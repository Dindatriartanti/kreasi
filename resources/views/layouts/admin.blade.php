<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    @vite([
        'resources/css/app.css',
        'resources/css/admin.css',
        'resources/js/app.js',
        'resources/js/admin.js'
    ])

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

<div class="wrapper">

    @include('admin.components.sidebar')

    <div class="main-content">

        @include('admin.components.navbar')

        <main class="content py-4 px-4">

            @yield('content')

        </main>

        @include('admin.components.footer')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>

</html>