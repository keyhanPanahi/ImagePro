<!DOCTYPE html>
<html lang="fa" class="light-style customizer-hide" dir="rtl" data-theme="theme-default" data-assets-path="{{ asset('admin-assets').'/' }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset(env('AVATAR_FAVA')) }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css') }}">


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/rtl/rtl.css') }}">

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}">

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/pages/page-auth.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('admin-assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('admin-assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('admin-assets/js/config.js') }}"></script>

    @yield('title')
</head>

<body>

@yield('content')

<!-- Core JS -->
<script src="{{ asset('admin-assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/js/bootstrap.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('admin-assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('admin-assets/js/main.js') }}"></script>

<!-- Page JS -->
</body>
</html>