<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koperasi Online</title>

  <link href="{{url('favicon.png')}}" rel="shortcut icon">
  <link href="{{url('favicon.png')}}" rel="favicon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/fa/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker-bs3.css') }}">
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

<script src="{{ url('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script src="{{ url('plugins/moment/moment.js') }}"></script>
<script src="{{ url('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ url('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ url('dist/js/app.min.js') }}"></script>
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $("input").attr('autocomplete','off');
  $(".for_dttbls").dataTable();
</script>
@yield('footer')

</body>
</html>
