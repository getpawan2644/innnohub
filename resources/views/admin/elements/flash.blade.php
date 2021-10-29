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
@if (session('error'))
    <script>toastr.error("{{ session('error') }}", "{{ ( session('title') ? session('title') : 'Action failed!' ) }}"); </script>
@elseif (session('success'))
    <script>toastr.success("{{ session('success') }}", "{{ ( session('title') ? session('title') : 'Success' ) }}"); </script>
@elseif (session('info'))
    <script>toastr.info("{{ session('info') }}","{{ ( session('title') ? session('title') : '' ) }}"); </script>
@endif