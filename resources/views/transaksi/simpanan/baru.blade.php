@extends('app')

@section('header')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simpanan
        <small>Baru</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            @if(session('pesan')=="sudah_ada")
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Error</h4>
                Data sudah pernah diinput, simpan dibatalkan
              </div>
            @endif
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Buat Simpanan Baru</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input type="text" id="nama" required class="form-control" name="nama" placeholder="Nama">
                    <input type="hidden" id="id_anggota" required class="form-control" name="id_anggota" value="0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Simpanan</label>

                  <div class="col-sm-10">
                    <select type="text" id="id_jenis" required class="form-control" name="id_jenis">
                      <option readonly value="">-- jenis simpanan --</option>
                      @foreach($simpanan as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bulan</label>

                  <div class="col-sm-6">
                    <select type="text" id="bulan" required class="col-sm-6 form-control" name="bulan">
                      <option readonly value="">-- bulan --</option>
                      @foreach($bulan as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                  <label class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-2">
                    <input class="col-sm-2 form-control" name="tahun" maxlength="4" type="number" value="{{date("Y")}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah</label>

                  <div class="col-sm-10">
                    <input type="text" value="0" id="jumlah" required class="form-control" name="jumlah" placeholder="Jumlah">
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
                <a href="{{url('transaksi/simpanan')}}" class="btn btn-default">Batal</a>
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
  <script>
    $(function() {
      $("#id_jenis").on('change',function () {
        if($("#id_jenis option:selected").val()!=""){
          $.ajax({
            url:"{{url('ajax/get_simpanan')}}/"+$("#id_jenis option:selected").val(),
            success:function (data) {
              $("#jumlah").val(data);
            }
          });
        }else{
          $("#jumlah").val('0');
        }
      });
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
  </script>
@endsection