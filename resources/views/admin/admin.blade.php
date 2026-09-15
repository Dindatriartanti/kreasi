<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- =============================================== -->
    <!-- STYLE/CSS AREA                                  -->
    <!-- =============================================== -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- Menambahkan CSS untuk Tom-select --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
    @stack('style')
    {{-- <style>
        body {
            overflow-x: hidden;
            background-color: #f0f2f5; /* A slightly different background for contrast */
        }

        /* Main layout wrapper */
        .main-layout {
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar Styles --- */
        #sidebar {
            width: 260px; /* Sidebar width */
            height: 100vh;
            background-color: #ffffff; /* White sidebar */
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: fixed; /* Fixed position */
            top: 0;
            left: 0;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
            transform: translateX(0); /* Visible by default on desktop */
            overflow-y: auto;
        }

        /* --- Main Content Styles --- */
        #main-content {
            flex-grow: 1;
            padding: 1.5rem;
            margin-left: 260px; /* Default margin for DESKTOP */
            transition: margin-left 0.3s ease-in-out, transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* This wrapper will contain the flexible content */
        .content-wrapper {
            flex-grow: 1;
        }

        /* --- STYLED HEADER AND FOOTER --- */
        .main-header {
            background-color: #ffffff;
            /* Use negative margin to span full width of the main-content padding */
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            padding: 1rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .main-footer {
            background-color: #ffffff;
            /* Use negative margin to span full width */
            margin: 1.5rem -1.5rem -1.5rem -1.5rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        /* --- Collapsed State --- */
        .sidebar-collapsed #sidebar {
            transform: translateX(-100%); /* Hide sidebar to the left */
        }

        .sidebar-collapsed #main-content {
            margin-left: 0; /* Expand content to full width on DESKTOP */
        }

        /* --- Universal Toggle Button --- */
        #universal-toggler {
            font-size: 1.5rem;
            cursor: pointer;
            color: #6c757d;
        }

        /* Minor adjustments for nav links */
        #sidebar .nav-link {
            color: #333;
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        #sidebar .nav-link.active,
        #sidebar .nav-link:hover {
            background-color: #e9ecef;
            color: #000;
        }
        #sidebar .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* --- Profile Section in Sidebar --- */
        .profile-section {
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .profile-section img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
        
        .profile-role {
            font-size: 0.8rem;
            line-height: 1;
        }
        
        .logout-link {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .logout-link:hover {
            color: #dc3545;
        }

        /* --- RESPONSIVE OVERRIDES --- */
        @media (max-width: 991.98px) {
            .main-layout {
                overflow-x: hidden;
            }

            #main-content {
                margin-left: 0 !important;
                transform: translateX(0);
                /* On mobile, content width is always 100% */
                width: 100%; 
            }

            .main-layout:not(.sidebar-collapsed) #main-content {
                transform: translateX(260px);
            }
        }

        /* --- FIX FOR TABLE SCROLL --- */
        /* This ensures the table container can scroll horizontally */
        /* even if its parents have overflow hidden. */
        .table-responsive {
        overflow-x: auto;
        }
        .stat-card-icon {
            font-size: 2.5rem;
            opacity: 0.3;
            margin-right: 1rem;
        }
        
    </style> --}}
</head>
<body>
    <div class="main-layout">
        <!-- =============================================== -->
        <!-- SIDEBAR                                         -->
        <!-- =============================================== -->
        @include('admin.partials._sidebar')


        <!-- =============================================== -->
        <!-- MAIN CONTENT AREA                               -->
        <!-- =============================================== -->
        <div id="main-content">
            @include('admin.partials._header')
            @yield('content')
            @include('admin.partials._footer')
        </div> 
    </div>
    @stack('modals')

    <!-- =============================================== -->
    <!-- JS AREA                                         -->
    <!-- =============================================== -->
    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Menambahkan JavaScript untuk Tom-select --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @if($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "{{ $message }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                background: '#ffffff',
            }); 
        </script>
    @endif
    @if($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "{{ $message }}",
                icon: "error",
                showConfirmButton: false,
                timer: 2000,
                background: '#ffffff',
            });
        </script>
    @endif
    <script src="{{ asset('js/admin-script.js') }}"></script>
    @stack('scripts')
</body>
</html>
