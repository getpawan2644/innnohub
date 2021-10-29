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
{{--{{dd(Session::has('success'))}}--}}
@if (session('error'))
    <script>toastr.error("{{ session('error') }}", "{{ ( session('title') ? session('title') : __('messages.action_failed') ) }}"); </script>
@elseif (session('success'))
    <script>toastr.success("{{ session('success') }}", "{{ ( session('title') ? session('title') : __('messages.success') ) }}"); </script>
@elseif (session('info'))
    <script>toastr.info("{{ session('info') }}","{{ ( session('title') ? session('title') : '' ) }}"); </script>
@endif
