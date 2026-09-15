<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Authentication' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/auth.css',
        'resources/js/auth.js'
    ])

</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-left">

            <div class="brand">

                <img src="{{ asset('assets/logo/logo.png') }}" alt="Logo">

                <h2>Sistem Informasi Ruang Kreasi</h2>

                <p>
                    Dinas Kebudayaan dan Pariwisata
                    Kabupaten Cirebon
                </p>

            </div>

            <div class="illustration">

                <img src="{{ asset('assets/logo/login-illustration.png') }}" alt="Illustration">

            </div>

        </div>

        <div class="auth-right">

            <div class="auth-card">

                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>