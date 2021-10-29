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
	<link rel="stylesheet" href="<?php echo e(asset('vendor/metismenu/dist/metisMenu.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/switchery-npm/index.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')); ?>">

	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
	<!-- ======================= LINE AWESOME ICONS ===========================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/icons/line-awesome.min.css')); ?>">
	<!-- ======================= DRIP ICONS ===================================-->
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/icons/dripicons.min.css')); ?>">
	<!-- ======================= TOASTR =================-->
	<link rel="stylesheet" href="<?php echo e(asset('vendor/toastr/build/toastr.min.css')); ?>">
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
	
	<link rel="stylesheet" href="<?php echo e(asset('css/admin/custom.css')); ?>">
    <!-- Styles -->
    <link rel="shortcut icon" href="<?php echo e(asset('img/admin/favicon.jpg')); ?>" />
    <!-- Scripts -->
	<script src="<?php echo e(asset('vendor/jquery/dist/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendor/toastr/build/toastr.min.js')); ?>"></script>

	
</head>
<body>
<div class="container">
    <?php echo $__env->make('admin.elements.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>
<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="<?php echo e(asset('vendor/modernizr/modernizr.custom.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js-storage/js.storage.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/js-cookie/src/js.cookie.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/pace/pace.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/metismenu/dist/metisMenu.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/switchery-npm/index.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="<?php echo e(asset('js/admin/global/app.js')); ?>"></script>
</body>
</html><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/layouts/admin/app.blade.php ENDPATH**/ ?>