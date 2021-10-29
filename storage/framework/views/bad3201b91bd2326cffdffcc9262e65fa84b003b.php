<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-multiselect.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/icofont.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/slick.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('css/developer.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/media.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendor/toastr/build/toastr.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/intlTelInput.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/jquery.timepicker.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.css')); ?>">
       
         <link rel="stylesheet" href="<?php echo e(asset('css/wickedpicker.css')); ?>">

        
        
        <link rel="stylesheet" href="<?php echo e(asset('css/daterangepicker.css')); ?>">
        <!--username autocomplete on product -->
	    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"  />
        <link rel="stylesheet" href="<?php echo e(asset('css/jquery.ez-plus.css')); ?>">

        <!-- Styles -->
        <link rel="shortcut icon" href="<?php echo e(asset('img/admin/favIcon.png')); ?>" />
        <!-- Scripts -->
        <!--script src="<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"></script-->
        <script src="<?php echo e(asset('js/new/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/new/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
              <script src="<?php echo e(asset('js/fullcalendar-init.js')); ?>"></script>
        <!-- <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> -->
        <!-- <script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>" type="text/javascript"></script> -->

        <script src="<?php echo e(asset('js/new/daterangepicker.js')); ?>"></script>
         
          <script src="<?php echo e(asset('js/new/bootstrap-date-range-picker-init.js')); ?>"></script>
        
        <script src="<?php echo e(asset('vendor/toastr/build/toastr.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
        <script src="<?php echo e(asset('js/intlTelInput.js')); ?>"></script>
        <script src="<?php echo e(asset('js/fontawesome.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery.timepicker.min.js')); ?>"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
        <script src="<?php echo e(asset('js/slick.js')); ?>"></script>

        <script src="<?php echo e(asset('js/jquery.ez-plus.js')); ?>"></script>

        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/gh/igorlino/fancybox-plus@1.3.6/src/jquery.fancybox-plus.js"></script>
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/gh/igorlino/fancybox-plus@1.3.6/css/jquery.fancybox-plus.css" media="screen"/>
               <script src="<?php echo e(asset('js/new/wickedpicker.min.js')); ?>"></script>
              
              
              
        <title><?php echo $__env->yieldContent("title","SABQ | Home"); ?></title>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        

    </head>
    <body dir="<?php echo e(getAlignment()); ?>" class="alignment-<?php echo e(getAlignment()); ?>">
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <?php echo $__env->make('elements.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- header -->
        <?php echo $__env->make('elements.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- header end -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- footer -->
        <?php echo $__env->make('elements.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- footer end-->

        <?php echo $__env->make('elements.popup.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('elements.popup.forgot_password', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('elements.loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>

    <!-- Optional JavaScript -->

    <script src="<?php echo e(asset('js/umd/popper.min.js')); ?>"></script>
     <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> 
    <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>

    <!--script src="<?php echo e(asset('js/jquery-3.5.1.min.js')); ?>"></script-->
    <script src="<?php echo e(asset('js/bootstrap-multiselect.js')); ?>"></script>

    <script src="<?php echo e(asset('js/developer.js')); ?>"></script>

<script>
    var search_open = false;
    function openSearch(){
      document.querySelector(".top_search").classList.toggle("openSearch");
      search_open = !search_open;
    }
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
          nonSelectedText: 'Please select sub category',
          numberDisplayed: 1,
          includeSelectAllOption: true
        });
    });
  </script>
</html>
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/layouts/default.blade.php ENDPATH**/ ?>