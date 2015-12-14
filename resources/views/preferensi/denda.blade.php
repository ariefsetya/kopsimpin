@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Preferensi Denda
        <small>per hari</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            @if(session('pesan')=="tersimpan")
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Info</h4>
                Denda berhasil disimpan
              </div>
            @endif
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST">
              <div class="box-header with-border">
                <h3 class="box-title">Preferensi Denda</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Denda per hari</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" id="denda" required class="form-control" name="denda" placeholder="Denda" value="{{(\App\Koperasi::find(Auth::user()->assigned_koperasi)['denda'])}}">
                  </div>
                </div>
                    <input autocomplete="off" type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
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