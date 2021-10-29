@if(request()->ajax())
	<header class="page-header">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h1 class="separator">@yield("header","Heading Text")</h1>
				<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
					<ol class="breadcrumb">
						@section('breadcrumb')
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}"><i class="icon dripicons-home"></i></a></li>
						@show
					</ol>

				</nav>
			</div>
			<div>
				@yield('addbutton')
			</div>
		</div>
	</header>
	<div >
		@yield('content')
	</div>
@else
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
	<link rel="stylesheet" href="{{ asset('css/admin/nprogress.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/metismenu/dist/metisMenu.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/switchery-npm/index.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
	<link rel="stylesheet" href="{{ asset('css/admin/developer.css') }}">

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>


	<!-- ======================= LINE AWESOME ICONS ===========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/icons/line-awesome.min.css') }}">
	<!-- ======================= DRIP ICONS ===================================-->
	<link rel="stylesheet" href="{{ asset('css/admin/icons/dripicons.min.css') }}">
	<!-- ======================= TOASTR =================-->
	<link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
	<!-- ======================= select2 =================-->
	<link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
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
	@if(!empty($_COOKIE['theme-url-css']))
	<link id="autoloaded-stylesheet" rel="stylesheet" href="{{ $_COOKIE['theme-url-css'] }}">
	@endif
	<!-- ======================= JQUERY CONFIRM STYLES ===========================-->
	<link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/intl-inputs/css/intlTelInput.css') }}">
	<!-- ======================= CUSTOM STYLES ===========================-->
	<link rel="stylesheet" href="{{ asset('css/admin/custom.css?v=1') }}">
	<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-tagsinput.css') }}">
	<link rel="stylesheet" href="{{ asset('css/admin/app.css?v=1') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
	<!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('img/admin/favIcon.png') }}" />
    <!-- Scripts -->


	<script src="{{ asset('vendor/jquery/dist/jquery-2.2.4.min.js') }}"></script>
	<script src="{{ asset('vendor/intl-inputs/js/intlTelInput.js') }}"></script>

	<!--script src="{{ asset('vendor/intl-inputs/js/intlTelInput-jquery.js') }}"></script-->
	<!-- TOASTR -->
	<script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
	<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
	<!-- Custom -->
	<script src="{{ asset('js/admin/nprogress.js') }}"></script>

	<script src="{{ asset('js/admin/custom.js') }}"></script>
	<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
	<!--user view spinner-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--username autocomplete on product -->
	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <!-- <script src = "https://code.jquery.com/jquery-1.10.2.js"></script> -->
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  	<!--tag multiselect on product -->
  	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('js/umd/popper.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <!--phone with country code -->
    <link rel="stylesheet" href="{{ asset('css/admin/intlTelInput.css') }}">
    <!-- <script src="{{ asset('js/admin/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/admin/utils.js') }}"></script>
 -->

    <script src="{{ asset('js/jquery.tagsinput-revisited.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery.tagsinput-revisited.css') }}">

    <!--Profile image crop -->
	<script src="{{ asset('js/croppie.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/croppie.min.css') }}">

    <!--Date picker on artical-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
	<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<!-- <script>
	    $( function() {
	        $( "#datepicker" ).datepicker({
		        dateFormat: "yy-mm-dd"
		    });
	    });
	</script>
 -->
	<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

	<link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">

	<!-- jquery spline chart for users-->
	<!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> -->




</head>
<body class="{{ ( !empty($_COOKIE['layout-mode']) ? $_COOKIE['layout-mode']: '') }}">
<script>
	var APP_URL = '{{ env("APP_URL") }}';
</script>

<!-- Loader -->
<!-- <div class="loader-bg" id="loader">
	<div class="loader"></div>
</div> -->


<div id="app">
	@include('admin.elements.flash')
	@include('admin.elements.layouts.sidebar')
	<div class="content-wrapper">
		@include('admin.elements.layouts.nav')
		<div id="container" class="content">
			<header class="page-header">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h1 class="separator">@yield("header","Heading Text")</h1>
						<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
							<ol class="breadcrumb">
								@section('breadcrumb')
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}"><i class="icon dripicons-home"></i></a></li>
								@show
							</ol>

						</nav>
					</div>
					<div>
						@yield('addbutton')
					</div>
				</div>
			</header>
			<div >
				@yield('content')
			</div>
		</div>
		@include('admin.elements.layouts.right')
	</div>
</div>
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="{{ asset('vendor/modernizr/modernizr.custom.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/js-storage/js.storage.js') }}"></script>
<script src="{{ asset('vendor/js-cookie/src/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/metismenu/dist/metisMenu.js') }}"></script>
<script src="{{ asset('vendor/switchery-npm/index.js') }}"></script>
<script src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->

<script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{{ asset('js/admin/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('js/admin/app.js') }}"></script>



<script src="{{ asset('js/admin/global/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
@endif
