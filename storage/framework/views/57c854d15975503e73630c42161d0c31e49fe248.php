<?php if(request()->ajax()): ?>
	<header class="page-header">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h1 class="separator"><?php echo $__env->yieldContent("header","Heading Text"); ?></h1>
				<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<?php $__env->startSection('breadcrumb'); ?>
						<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard.index')); ?>"><i class="icon dripicons-home"></i></a></li>
						<?php echo $__env->yieldSection(); ?>
					</ol>

				</nav>
			</div>
			<div>
				<?php echo $__env->yieldContent('addbutton'); ?>
			</div>
		</div>
	</header>
	<div >
		<?php echo $__env->yieldContent('content'); ?>
	</div>
<?php else: ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent("title","Admin"); ?></title>
	<!-- ================== GOOGLE FONTS ==================-->
	<!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<!-- ======================= GLOBAL VENDOR STYLES ========================-->

	<link rel="stylesheet" href="<?php echo e(asset('css/admin/vendor/bootstrap.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/nprogress.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/metismenu/dist/metisMenu.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/switchery-npm/index.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/developer.css')); ?>">

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>


	<!-- ======================= LINE AWESOME ICONS ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/icons/line-awesome.min.css')); ?>">
	<!-- ======================= DRIP ICONS ===================================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/icons/dripicons.min.css')); ?>">
	<!-- ======================= TOASTR =================-->
	<link rel="stylesheet" href="<?php echo e(asset('vendor/toastr/build/toastr.min.css')); ?>">
	<!-- ======================= select2 =================-->
	<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">
	<!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/icons/material-design-iconic-font.min.css')); ?>">
	<!-- ======================= GLOBAL COMMON STYLES ============================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/common/main.bundle.css')); ?>">
	<!-- ======================= LAYOUT TYPE ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/layouts/vertical/core/main.css')); ?>">
	<!-- ======================= MENU TYPE ===========================================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/layouts/vertical/menu-type/default.css')); ?>">
	<!-- ======================= THEME COLOR STYLES ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/layouts/vertical/themes/theme-a.css')); ?>">
	<?php if(!empty($_COOKIE['theme-url-css'])): ?>
	<link id="autoloaded-stylesheet" rel="stylesheet" href="<?php echo e($_COOKIE['theme-url-css']); ?>">
	<?php endif; ?>
	<!-- ======================= JQUERY CONFIRM STYLES ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/jquery-confirm.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/intl-inputs/css/intlTelInput.css')); ?>">
	<!-- ======================= CUSTOM STYLES ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/custom.css?v=1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/bootstrap-tagsinput.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/app.css?v=1')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/jquery.timepicker.min.css')); ?>">
	<!-- Styles -->
    <link rel="shortcut icon" href="<?php echo e(asset('img/admin/favIcon.png')); ?>" />
    <!-- Scripts -->


	<script src="<?php echo e(asset('vendor/jquery/dist/jquery-2.2.4.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendor/intl-inputs/js/intlTelInput.js')); ?>"></script>

	<!--script src="<?php echo e(asset('vendor/intl-inputs/js/intlTelInput-jquery.js')); ?>"></script-->
	<!-- TOASTR -->
	<script src="<?php echo e(asset('vendor/toastr/build/toastr.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery-confirm.min.js')); ?>"></script>
	<!-- Custom -->
	<script src="<?php echo e(asset('js/admin/nprogress.js')); ?>"></script>

	<script src="<?php echo e(asset('js/admin/custom.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.timepicker.min.js')); ?>"></script>
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
    <script src="<?php echo e(asset('js/umd/popper.min.js')); ?>"></script>
     <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> 
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

    <!--phone with country code -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/intlTelInput.css')); ?>">
    <!-- <script src="<?php echo e(asset('js/admin/intlTelInput.js')); ?>"></script>
    <script src="<?php echo e(asset('js/admin/utils.js')); ?>"></script>
 -->

    <script src="<?php echo e(asset('js/jquery.tagsinput-revisited.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.tagsinput-revisited.css')); ?>">

    <!--Profile image crop -->
	<script src="<?php echo e(asset('js/croppie.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/croppie.min.css')); ?>">

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
	<link rel="stylesheet" href="<?php echo e(asset('css/toastr.min.css')); ?>">

	<link rel="stylesheet" href="<?php echo e(asset('icofont/icofont.min.css')); ?>">

	<!-- jquery spline chart for users-->
	<!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> -->




</head>
<body class="<?php echo e(( !empty($_COOKIE['layout-mode']) ? $_COOKIE['layout-mode']: '')); ?>">
<script>
	var APP_URL = '<?php echo e(env("APP_URL")); ?>';
</script>

<!-- Loader -->
<!-- <div class="loader-bg" id="loader">
	<div class="loader"></div>
</div> -->


<div id="app">
	<?php echo $__env->make('admin.elements.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('admin.elements.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="content-wrapper">
		<?php echo $__env->make('admin.elements.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div id="container" class="content">
			<header class="page-header">
				<div class="d-flex align-items-center">
					<div class="mr-auto">
						<h1 class="separator"><?php echo $__env->yieldContent("header","Heading Text"); ?></h1>
						<nav class="breadcrumb-wrapper" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<?php $__env->startSection('breadcrumb'); ?>
								<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard.index')); ?>"><i class="icon dripicons-home"></i></a></li>
								<?php echo $__env->yieldSection(); ?>
							</ol>

						</nav>
					</div>
					<div>
						<?php echo $__env->yieldContent('addbutton'); ?>
					</div>
				</div>
			</header>
			<div >
				<?php echo $__env->yieldContent('content'); ?>
			</div>
		</div>
		<?php echo $__env->make('admin.elements.layouts.right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="<?php echo e(asset('vendor/modernizr/modernizr.custom.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js-storage/js.storage.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js-cookie/src/js.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/metismenu/dist/metisMenu.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/switchery-npm/index.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->

<script src="<?php echo e(asset('vendor/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-validation/additional-methods.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-steps/jquery.steps.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="<?php echo e(asset('js/admin/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('js/admin/app.js')); ?>"></script>



<script src="<?php echo e(asset('js/admin/global/app.js')); ?>"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
<?php endif; ?>
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/layouts/admin/default.blade.php ENDPATH**/ ?>