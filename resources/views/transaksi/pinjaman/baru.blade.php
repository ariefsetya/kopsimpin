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
        Pinjaman
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
                <h3 class="box-title">Buat Pinjaman Baru</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" id="nama" required class="form-control" name="nama" placeholder="Nama">
                    <input autocomplete="off" type="hidden" id="id_anggota" required class="form-control" name="id_anggota" value="0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Pinjaman</label>

                  <div class="col-sm-10">
                    <select type="text" id="id_jenis" required class="form-control" name="id_jenis">
                      <option readonly value="">-- jenis pinjaman --</option>
                      @foreach($pinjaman as $key)
                      <option value="{{$key->id}}">{{$key->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="jumlah" required class="form-control" name="jumlah" placeholder="Jumlah">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jangka Waktu</label>

                  <div class="col-sm-1">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="jangka_waktu" required class="form-control" name="jangka_waktu" placeholder="12">
                  </div>
                  <label class="col-sm-1 control-label pull-left">bulan</label>
                  <label class="col-sm-2 control-label"></label>
                  <label class="col-sm-2 control-label">Bunga (%)</label>
                
                  <div class="col-sm-1">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="persen_bunga" required class="form-control" name="persen_bunga" placeholder="Bunga">
                  </div>
                  <div class="col-sm-3">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" tabindex="-1" readonly id="bunga" required class="form-control" name="bunga" placeholder="Bunga">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Biaya Admin (%)</label>

                  <div class="col-sm-1">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="persen_biaya_admin" required class="form-control" name="persen_biaya_admin" placeholder="Biaya Admin">
                  </div>
                  <div class="col-sm-3">
                    <input autocomplete="off" type="text" value="0" readonly tabindex="-1" onchange="cek_biaya()" id="biaya_admin" required class="form-control" name="biaya_admin" placeholder="Biaya Admin">
                  </div>
                  <label class="col-sm-2 control-label">Biaya Materai</label>

                  <div class="col-sm-4">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="biaya_materai" required class="form-control" name="biaya_materai" placeholder="Biaya Materai">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Biaya Asuransi (%)</label>

                  <div class="col-sm-1">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="persen_biaya_asuransi" required class="form-control" name="persen_biaya_asuransi" placeholder="Biaya Lain">
                  </div>
                  <div class="col-sm-3">
                    <input autocomplete="off" type="text" value="0" readonly tabindex="-1" onchange="cek_biaya()" id="biaya_asuransi" required class="form-control" name="biaya_asuransi" placeholder="Biaya Lain">
                  </div>
                  <label class="col-sm-2 control-label">Tabungan</label>

                  <div class="col-sm-1">
                    <input autocomplete="off" type="text" value="0" onchange="cek_biaya()" id="persen_tabungan" required class="form-control" name="persen_tabungan" placeholder="Tabungan">
                  </div>
                  <div class="col-sm-3">
                    <input autocomplete="off" type="text" value="0" readonly tabindex="-1" onchange="cek_biaya()" id="tabungan" required class="form-control" name="tabungan" placeholder="Tabungan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Total Pengembalian</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" value="0" tabindex="-1" onchange="cek_biaya()" id="jumlah_total" readonly required class="form-control" name="jumlah_total" placeholder="Total Pengembalian">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Total Peminjaman</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" value="0" tabindex="-1" onchange="cek_biaya()" id="total_peminjaman" readonly required class="form-control" name="total_peminjaman" placeholder="Total Peminjaman">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Angsuran per bulan</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" value="0" tabindex="-1" onchange="cek_biaya()" id="angsuran" readonly required class="form-control" name="angsuran" placeholder="Angsuran per bulan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Keterangan</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                  </div>
                </div>
                    <input autocomplete="off" type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                    <input autocomplete="off" type="hidden" class="form-control" name="jumlah_bunga" id="jumlah_bunga" value="0">
                    <input autocomplete="off" type="hidden" class="form-control" name="bunga_per_bulan" id="bunga_per_bulan" value="0">
                    <input autocomplete="off" type="hidden" class="form-control" name="tabungan_per_bulan" id="tabungan_per_bulan" value="0">
                    <input autocomplete="off" type="hidden" class="form-control" name="total_per_bulan" id="total_per_bulan" value="0">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a tabindex="-1" href="{{url('transaksi/pinjaman')}}" class="btn btn-default">Batal</a>
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
            url:"{{url('ajax/get_pinjaman')}}/"+$("#id_jenis option:selected").val(),
            success:function (data) {
              var obj = jQuery.parseJSON(data);
              $("#jumlah").val(obj.jumlah);
              $("#jangka_waktu").val(obj.jangka_waktu);
              $("#persen_bunga").val(obj.bunga);
              cek_biaya();
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
    function cek_biaya () {
      var jumlah = $("#jumlah").val();
      var jangka_waktu = $("#jangka_waktu").val();
      var persen_bunga = $("#persen_bunga").val();
      var persen_tabungan = $("#persen_tabungan").val();
      var persen_biaya_admin = $("#persen_biaya_admin").val();
      var persen_biaya_asuransi = $("#persen_biaya_asuransi").val();
      var persen_biaya_materai = $("#persen_biaya_materai").val();

      if(jumlah!="" && jangka_waktu!="" && persen_bunga !="" && persen_tabungan!="" && 
          persen_biaya_materai!="" && persen_biaya_asuransi!="" && persen_biaya_admin!=""){
        var bunga = (parseFloat(jumlah)*(parseFloat(persen_bunga)/100));
        $("#bunga").val(bunga.toFixed(2));
        var bunga_per_bulan = parseFloat(bunga)/parseInt(jangka_waktu);
        $("#bunga_per_bulan").val(bunga_per_bulan.toFixed(2));
        var biaya_materai = $("#biaya_materai").val();
        var biaya_admin = (parseFloat(jumlah)*(parseFloat(persen_biaya_admin)/100));
        $("#biaya_admin").val(biaya_admin.toFixed(2));
        var biaya_asuransi = (parseFloat(jumlah)*(parseFloat(persen_biaya_asuransi)/100));
        $("#biaya_asuransi").val(biaya_asuransi.toFixed(2));
        var tabungan = (parseFloat(jumlah)*(parseFloat(persen_tabungan)/100) /**parseInt(jangka_waktu)*/);
        $("#tabungan").val(tabungan.toFixed(2));
        var total_tabungan = parseFloat(tabungan);
        var tabungan_per_bulan = parseFloat(total_tabungan)/(parseInt(jangka_waktu));
        var total_pengembalian = parseFloat(jumlah)+parseFloat(bunga)+(parseFloat(total_tabungan));
        var total_per_bulan = parseFloat(total_pengembalian)/parseInt(jangka_waktu);
        $("#total_per_bulan").val(total_per_bulan.toFixed(2));
        $("#tabungan_per_bulan").val(tabungan_per_bulan.toFixed(2));
        $("#jumlah_total").val(total_pengembalian.toFixed(2));
        var total_peminjaman = parseFloat(jumlah)-parseFloat(biaya_admin)-parseFloat(biaya_materai)-parseFloat(biaya_asuransi)-parseFloat(tabungan_per_bulan);
        $("#total_peminjaman").val(total_peminjaman.toFixed(2));
        var angsuran_per_bulan = (parseFloat(jumlah)+parseFloat(bunga))/parseInt(jangka_waktu);
        $("#angsuran").val(angsuran_per_bulan.toFixed(2));
      }


      // var jumlah = $("#jumlah").val();
      // var jangka_waktu = $("#jangka_waktu").val();
      // var bunga = $("#bunga").val();
      // var biaya_materai = $("#biaya_materai").val();
      // var tabungan = $("#tabungan").val();
      // var biaya_admin = $("#biaya_admin").val();
      // var biaya_asuransi = $("#biaya_asuransi").val();
      // var total_peminjaman = 0;
      // var jumlah_total = 0;
      // var angsuran = 0;
      // if(jumlah!="" && jangka_waktu !="" && bunga!="" && biaya_admin!="" && biaya_asuransi!="" && parseInt(jangka_waktu)>0){
      //   var jumlah_bunga = parseFloat(jumlah)*(parseFloat(bunga)/100);
      //   $("#jumlah_total").val((parseFloat(jumlah)+parseFloat(jumlah_bunga)).toFixed(2));
      //   var angsuran = parseFloat(jumlah)/parseInt(jangka_waktu);
      //   var bunga_per_bulan = parseFloat(angsuran)*(parseFloat(bunga)/100);
      //   var angsuran_per_bulan = parseFloat(angsuran)+parseFloat(bunga_per_bulan);
      //   $("#angsuran").val(parseFloat(angsuran_per_bulan).toFixed(2));
      //   var total_peminjaman = parseFloat(jumlah)-parseFloat(biaya_admin)-parseFloat(biaya_asuransi)-parseFloat(biaya_materai)-parseFloat(tabungan);
      //   $("#total_peminjaman").val(total_peminjaman.toFixed(2));
      //   $("#jumlah_bunga").val(jumlah_bunga);
      //   $("#bunga_per_bulan").val(bunga_per_bulan);
      //   $("#total_per_bulan").val(angsuran_per_bulan);
      // }else{
      //   $("#total_peminjaman").val(0);
      //   $("#angsuran").val(0);
      //   $("#jumlah_total").val(0);
      //   $("#jumlah_bunga").val(0);
      //   $("#bunga_per_bulan").val(0);
      //   $("#total_per_bulan").val(0);
      // }
    }
  </script>
@endsection