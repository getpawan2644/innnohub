<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title","Admin")</title>
	<!-- ================== GOOGLE FONTS ==================-->
	<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<!-- ======================= GLOBAL VENDOR STYLES ========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/vendor/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/metismenu/dist/metisMenu.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/switchery-npm/index.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<!-- ======================= LINE AWESOME ICONS ===========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/icons/line-awesome.min.css') }}">
	<!-- ======================= DRIP ICONS ===================================-->
	<link rel="stylesheet" href="{{ asset('css/admin/icons/dripicons.min.css') }}">
	<!-- ======================= TOASTR =================-->
	<link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
	<!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
	<link rel="stylesheet" href="{{ asset('css/admin/icons/material-design-iconic-font.min.css') }}">
	<!-- ======================= GLOBAL COMMON STYLES ============================-->
	<link rel="stylesheet" href="{{ asset('css/admin/common/main.bundle.css') }}">
	<!-- ======================= LAYOUT TYPE ===========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/layouts/vertical/core/main.css') }}">
	<!-- ======================= MENU TYPE ===========================================-->
	<link rel="stylesheet" href="{{ asset('css/admin/layouts/vertical/menu-type/default.css') }}">
	<!-- ======================= THEME COLOR STYLES ===========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/layouts/vertical/themes/theme-a.css') }}">
	
	<link rel="stylesheet" href="{{ asset('css/admin/custom.css') }}">
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('img/admin/favicon.jpg') }}" />
    <!-- Scripts -->
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>

	
</head>
<body>
<div class="container">
    @include('admin.elements.flash')
    @yield('content')
</div>
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="{{ asset('vendor/modernizr/modernizr.custom.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/js-storage/js.storage.js') }}"></script>
<script src="{{ asset('vendor/js-cookie/src/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/pace/pace.js') }}"></script>
<script src="{{ asset('vendor/metismenu/dist/metisMenu.js') }}"></script>
<script src="{{ asset('vendor/switchery-npm/index.js') }}"></script>
<script src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="{{ asset('js/admin/global/app.js') }}"></script>
</body>
</html>