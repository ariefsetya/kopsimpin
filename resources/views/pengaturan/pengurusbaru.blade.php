@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Pengurus
        <small>Koperasi</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            @if(sizeof($errors)>0)
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Error Validation!</h4>
        @foreach($errors->all() as $message)
          <p>{{$message}}</p>
        @endforeach
          </div>
        @endif
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Pengurus Koperasi</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input type="text" required class="form-control" name="name" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">E-Mail</label>

                  <div class="col-sm-10">
                    <input type="email" value="" required class="form-control" name="email" placeholder="E-Mail">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" required class="form-control" value="0" name="password" placeholder="Password">
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('pengaturan/pengurus')}}" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('footer')

<link rel="stylesheet" href="<?php echo base_url('assets/jqwidgets/styles/jqx.base.css');?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxcore.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxdata.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxtree.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxcheckbox.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxnumberinput.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/jqwidgets/jqxbuttons.js');?>"></script>