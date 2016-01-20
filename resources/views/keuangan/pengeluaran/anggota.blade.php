@extends('app')

@section('header')
  <link rel="stylesheet" href="{{url('plugins/jQueryUI/jquery-ui.min.css')}}">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Koreksi Pengeluaran
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

            @if(session('data')!="")
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Berhasil</h4>
                Koreksi berhasil diinput dengan nomor nota {{session('data')}}
              </div>
            @endif
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Koreksi Pengeluaran Koperasi ke Anggota</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>

                  <div class="col-sm-10">
                    <input type="text" id="created_at" readonly required class="form-control" name="created_at" value="{{date("d/m/Y H:i:s")}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" id="nama" required class="form-control" name="nama" placeholder="Nama">
                    <input autocomplete="off" type="hidden" id="id_anggota" required class="form-control" name="id_anggota" value="0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Uang Keluar</label>

                  <div class="col-sm-10">
                    <div id="jumlah_div" class="form-control for_numberinput"></div>
                    <input type="hidden" value="0" id="jumlah" required class="form-control" name="jumlah" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                  </div>
                </div>
                <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
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

@section('footer')
  @include('utils.number_input')

  <script>
    $(function() {
      $("#nama").autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: "{{url('ajax/get_anggota')}}/"+$("#nama").val(),
            dataType: "json",
            success: function( data ) {
              response( data );
            }
          });
        },
        minLength: 1,
        select: function( event, ui ) {
          $("#nama").val(ui.item.label);
          $("#id_anggota").val(ui.item.id);
        }
      });



    });
    $('#jumlah_div').on('valueChanged', function (event) {$('#jumlah').val(event.args.value);}); 

  </script>
@endsection