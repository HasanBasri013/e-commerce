<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ADMIN KASIR</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) <!-- Recommended if using Vite -->
    <link href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" rel="stylesheet"> <!-- If using asset() -->
    <!-- Optional: Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper mt-2">
        @include('admin.component.navbar')

        @include('admin.component.sidebar')

        <main class="content-wrapper" style="margin-top:60px">
            <div class="content">
                @yield('content') <!-- This will insert the content from the child view -->
            </div>
        </main>

        <!-- jQuery (Pastikan jQuery dimuat) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
        
        <!-- Popper.js (Untuk Bootstrap 4 ke atas) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- AdminLTE JS -->
        <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script> <!-- AdminLTE JS -->
        
        <!-- Optional Custom Script -->
        <script>
            $(document).ready(function() {
                // AdminLTE Push Menu Functionality
                $('[data-widget="pushmenu"]').pushMenu();

                // Toggle the dropdown menu for Master when clicked
                $('.nav-item.has-treeview').click(function() {
                    $(this).children('.nav-treeview').slideToggle();
                    $(this).children('a').children('.fas').toggleClass('fa-angle-left fa-angle-down');
                });
            });
        </script>
        
        @yield('scripts')

    </body>
</html>
