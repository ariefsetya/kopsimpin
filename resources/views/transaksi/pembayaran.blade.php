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
        Pembayaran Angsuran
        <small>Baru</small>
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
                <h3 class="box-title">Buat Pembayaran Angsuran Baru</h3>
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
                  <label class="col-sm-2 control-label">Pilihan Pembayaran</label>

                  <div class="col-sm-10">
                    <select type="text" id="id_induk" required class="form-control" name="id_induk">
                      <option readonly value="">-- pilihan pembayaran --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pilihan Angsuran</label>

                  <div class="col-sm-10">
                    <select type="text" id="id_angsuran" required class="form-control" name="id_angsuran">
                      <option readonly value="">-- pilihan angsuran --</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>

                  <div class="col-sm-10">
                    <input type="text" value="0" tabindex="-1" readonly id="jatuh_tempo" required class="form-control" name="jatuh_tempo" placeholder="Jatuh Tempo">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Angsuran</label>

                  <div class="col-sm-10">
                    <input type="text" value="0" tabindex="-1" readonly id="jumlah_angsuran" required class="form-control" name="jumlah_angsuran" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Tabungan</label>

                  <div class="col-sm-10">
                    <input type="text" value="0" tabindex="-1" readonly id="jumlah_tabungan" required class="form-control" name="jumlah_tabungan" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Denda</label>

                  <div class="col-sm-1">
                    <input type="text" value="0" tabindex="-1" readonly id="jumlah_denda" required class="form-control" name="jumlah_denda" placeholder="Jumlah">
                  </div>
                  <div class="col-sm-9">
                    <input type="text" value="0" tabindex="-1" readonly id="total_denda" required class="form-control" name="total_denda" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Total Pembayaran</label>

                  <div class="col-sm-10">
                    <input type="text" value="0" tabindex="-1" readonly id="total_pembayaran" required class="form-control" name="total_pembayaran" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" class="form-control" name="id_transaksi">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a tabindex="-1" href="{{url('transaksi/pembayaran/all')}}" class="btn btn-default">Batal</a>
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
          $.ajax({
            url:"{{url('ajax/get_pinjaman/belum_lunas')}}/"+ui.item.id,
            dataType:'json',
            success:function (data) {
              //var data = jQuery.parseJSON(data);
              $("#id_induk").html('<option value="">-- pilihan pembayaran --</option>');
              
              $.each(data, function(i, item) {
                $("#id_induk").append('<option value="'+item.id+'">'+item.no_transaksi+' (Rp. '+item.jumlah_asli+')</option>');
              })              
            }
          });

        }
      });
      $("#id_induk").on('change',function () {
          $.ajax({
            url:"{{url('ajax/get_angsuran/belum_lunas')}}/"+$("#id_induk option:selected").val(),
            dataType:'json',
            success:function (data) {
              //var data = jQuery.parseJSON(data);
              $("#id_angsuran").html('<option value="">-- pilihan angsuran --</option>');
              
              $.each(data, function(i, item) {
                var add = "disabled";
                if(i==0){add="";}
                $("#id_angsuran").append('<option '+add+' value="'+item.id+'">Angsuran ke-'+item.info_ke+' (Rp. '+item.jumlah_asli+')</option>');
              })              
            }
          });
      });
      $("#id_angsuran").on('change',function () {
        if($("#id_angsuran option:selected").val()!=""){
          $.ajax({
            url:"{{url('ajax/get_angsuran/data/')}}/"+$("#id_angsuran option:selected").val(),
            dataType:'json',
            success:function (data) {
              $("#jatuh_tempo").val(data.jatuh_tempo);
              $("#jumlah_denda").val(data.terlambat);
              $("#total_denda").val(data.denda);
              $("#jumlah_angsuran").val(data.jumlah_asli);
              $("#jumlah_tabungan").val(data.total_tabungan);
              $("#total_pembayaran").val(data.total_pembayaran);
            }
          });
        }
      });
    });
  </script>
@endsection