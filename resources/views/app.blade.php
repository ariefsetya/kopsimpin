<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koperasi Online</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ ('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ ('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/datatables/dataTables.bootstrap.css') }}">
  @yield('header')
</head>
<body class="hold-transition skin-green sidebar-mini fixed" style="background:lightgray;">

<div class="wrapper">
  @include('utils.header')

  @include('utils.aside')


  @yield('content')

</div>



<script src="{{ url('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

<script src="{{ ('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') }}"></script>

<script src="{{ url('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ url('plugins/knob/jquery.knob.js') }}"></script>

<script src="{{ ('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}"></script>
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ url('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ url('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('dist/js/app.min.js') }}"></script>
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

@yield('footer')

</body>
</html>
