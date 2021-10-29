<script>
toastr.options = {
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-full-width",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "400",
    "hideDuration": "4000",
    "timeOut": "4000",
    "extendedTimeOut": "4000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
</script>
<?php if(session('error')): ?>
    <script>toastr.error("<?php echo e(session('error')); ?>", "<?php echo e(( session('title') ? session('title') : 'Action failed!' )); ?>"); </script>
<?php elseif(session('success')): ?>
    <script>toastr.success("<?php echo e(session('success')); ?>", "<?php echo e(( session('title') ? session('title') : 'Success' )); ?>"); </script>
<?php elseif(session('info')): ?>
    <script>toastr.info("<?php echo e(session('info')); ?>","<?php echo e(( session('title') ? session('title') : '' )); ?>"); </script>
<?php endif; ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/elements/flash.blade.php ENDPATH**/ ?>