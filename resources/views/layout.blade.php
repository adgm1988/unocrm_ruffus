<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'UNOUNO.UNO') }}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

    <!--CALENDAR-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    
  </head>

  <body id="page-top">

    @include('layout.navtop')

    <div id="wrapper">

      @include('layout.sidebar')

      <div id="content-wrapper">
        <!--<div class="container-fluid" style="max-height:500px;">-->
        <div class="container-fluid">
          @yield('content')
        </div>
        @include('components/footer')
      </div>

    </div>

    @include('components/scrolltop')

    @include('components/logoutmodal')

    <!-- Bootstrap core JavaScript-->
    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}" ></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}" ></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}" ></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}" ></script>
    <!-- Demo scripts for this page-->
    <script src="{{ asset('js/demo/datatables-demo.js') }}" ></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}" ></script>
    
  </body>
</html>
