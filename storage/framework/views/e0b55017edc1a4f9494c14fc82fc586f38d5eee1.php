<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-full-width",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "6000",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

<?php if(session('error')): ?>
    <script>toastr.error("<?php echo e(session('error')); ?>", "<?php echo e(( session('title') ? session('title') : __('messages.action_failed') )); ?>"); </script>
<?php elseif(session('success')): ?>
    <script>toastr.success("<?php echo e(session('success')); ?>", "<?php echo e(( session('title') ? session('title') : __('messages.success') )); ?>"); </script>
<?php elseif(session('info')): ?>
    <script>toastr.info("<?php echo e(session('info')); ?>","<?php echo e(( session('title') ? session('title') : '' )); ?>"); </script>
<?php endif; ?>
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/elements/flash.blade.php ENDPATH**/ ?>