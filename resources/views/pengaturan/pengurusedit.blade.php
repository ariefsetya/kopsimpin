@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Preferensi
        <small>Simpanan</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Preferensi Simpanan</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->nama}}" required class="form-control" name="nama" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jangka Waktu</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->jangka_waktu}}" required class="form-control" name="jangka_waktu" placeholder="Jangka Waktu">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bunga</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->bunga}}" required class="form-control" name="bunga" placeholder="Bunga">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->jumlah}}" required class="form-control" name="jumlah" placeholder="Jumlah Default">
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('preferensi/simpanan')}}" class="btn btn-default">Batal</a>
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