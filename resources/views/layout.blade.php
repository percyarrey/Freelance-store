<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" type="" href="{{ asset('asset/logo/favicon.png') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- bootstrap core css -->
        <link type="text/css" href="{{ asset('asset/css/bootstrap.css') }}" rel="stylesheet">
        <!-- font awesome style -->
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link type="text/css" href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
        <!-- responsive style -->
        <link type="text/css" href="{{ asset('asset/css/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <body>
      @php
            if (!isset($cartcount) || $cartcount == 'undefined') {
               $cartcount = -1;
            }
      @endphp
        <x-home.header :cartcount="$cartcount"/>
        <div  class="text-center">
            @if(session('message'))
               <script>
                  document.addEventListener('DOMContentLoaded', function() {
                     toastr.options = {
                           "positionClass": "toast-center",
                     };
                     toastr.success('{{ session('message') }}');
                  });
               </script>
            @endif
            @if(session('warning'))
               <script>
                  document.addEventListener('DOMContentLoaded', function() {
                     toastr.options = {
                           "positionClass": "toast-center",
                     };
                     toastr.error('{{ session('warning') }}');
                  });
               </script>
            @endif
        </div>

        @yield('content')
        <x-home.footer />
      <!-- jQery -->
      <script src="{{ asset('asset/js/jquery-3.4.1.min.js') }}"></script>
      <!-- popper js -->
      <script src="{{ asset('asset/js/popper.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{ asset('asset/js/bootstrap.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('asset/js/custom.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </body>
</html>
