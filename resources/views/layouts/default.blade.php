<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
{{--        <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('css/developer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/media.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
       
         <link rel="stylesheet" href="{{ asset('css/wickedpicker.css') }}">

        
        
        <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
        <!--username autocomplete on product -->
	    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"  />
        <link rel="stylesheet" href="{{ asset('css/jquery.ez-plus.css') }}">
{{--        <link rel="stylesheet" href="{{ asset('css/jquery.exzoom.css') }}">--}}
        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('img/admin/favIcon.png') }}" />
        <!-- Scripts -->
        <!--script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script-->
        <script src="{{ asset('js/new/jquery.min.js') }}"></script>
        <script src="{{ asset('js/new/moment.min.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
              <script src="{{ asset('js/fullcalendar-init.js') }}"></script>
        <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
        <!-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script> -->

        <script src="{{ asset('js/new/daterangepicker.js') }}"></script>
         
          <script src="{{ asset('js/new/bootstrap-date-range-picker-init.js') }}"></script>
        
        <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/intlTelInput.js') }}"></script>
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
        <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
        <script src="{{ asset('js/slick.js') }}"></script>
{{--        <script src="{{ asset('js/wow.js') }}"></script>--}}
        <script src="{{ asset('js/jquery.ez-plus.js') }}"></script>
{{--        <script src="{{ asset('js/jquery.exzoom.js') }}"></script>--}}
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/gh/igorlino/fancybox-plus@1.3.6/src/jquery.fancybox-plus.js"></script>
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/gh/igorlino/fancybox-plus@1.3.6/css/jquery.fancybox-plus.css" media="screen"/>
               <script src="{{ asset('js/new/wickedpicker.min.js') }}"></script>
              
              
              
        <title>@yield("title","SABQ | Home")</title>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179800360-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-179800360-1');
        </script> --}}

    </head>
    <body dir="{{getAlignment()}}" class="alignment-{{getAlignment()}}">
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @include('elements.flash')
        <!-- header -->
        @include('elements.layout.header')
        <!-- header end -->
        @yield('content')
        <!-- footer -->
        @include('elements.layout.footer')
        <!-- footer end-->

        @include('elements.popup.login')
        @include('elements.popup.forgot_password')
        {{-- @include('elements.popup.request_product') --}}
        @include('elements.loader')
    </body>

    <!-- Optional JavaScript -->

    <script src="{{ asset('js/umd/popper.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!--script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script-->
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>

    <script src="{{ asset('js/developer.js') }}"></script>

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
