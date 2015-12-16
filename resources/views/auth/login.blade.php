<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koperasi Online | Log in</title>
  <link href="{{url('favicon.png')}}" rel="shortcut icon">
  <link href="{{url('favicon.png')}}" rel="favicon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo url('bootstrap/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo url('plugins/fa/css/font-awesome.min.css');?>">
  <link rel="stylesheet" href="<?php echo url('dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?php echo url('dist/css/skins/_all-skins.min.css');?>">

<script src="<?php echo url('plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
<script src="<?php echo url('plugins/jQueryUI/jquery-ui.min.js');?>"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo url();?>"><b>Koperasi</b>Online</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo url("auth/login");?>" method="post">
      <div class="form-group has-feedback">
        <input type="hidden" class="form-control" required name="_token" value="{{csrf_token()}}">
        <input type="email" class="form-control" required name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" required name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>

</div>

</body>
</html>
