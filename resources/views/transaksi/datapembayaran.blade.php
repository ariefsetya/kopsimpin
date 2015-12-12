@extends('app')


@section('header')
  <link rel="stylesheet" href="{{url('plugins/jQueryUI/jquery-ui.min.css')}}">
@endsection

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Pembayaran 
        <small>Angsuran</small>
      </h1>
    </section>
    <section class="content">
    <div class="box">
      <div class="box-body no-padding">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pembayaran Angsuran</h3>
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
            <label class="col-sm-2 control-label">Pilihan Peminjaman</label>

            <div class="col-sm-10">
              <select type="text" id="id_induk" required class="form-control" name="id_induk">
                <option readonly value="">-- pilihan peminjaman --</option>
              </select>
            </div>
          </div>
        </div>

      </form>


      </div>
    </div>
    <div id="data_detail"></div>
      

    </section>

  </div>


@endsection

@section('footer')
  <script>

  var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
  "Juli", "Augustus", "September", "Oktober", "November", "Desember"];
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
              $("#id_induk").html('<option value="">-- pilihan peminjaman --</option>');
              
              $.each(data, function(i, item) {
                $("#id_induk").append('<option value="'+item.id+'">'+item.no_transaksi+' (Rp. '+item.jumlah_asli+')</option>');
              })              
            }
          });

        }
      });
      $("#id_induk").on('change',function () {
          $.ajax({
            url:"{{url('ajax/get_angsuran/all')}}/"+$("#id_induk option:selected").val(),
            dataType:'json',
            success:function (data) {
              
              $("#data_detail").html('');
              $("#data_detail").html('');
              $("#data_detail").html('');
              var ulang = '<div class="box">'+
                          '<div class="box-body no-padding">'+
                            '<div class="box-header with-border">'+
                              '<h3 class="box-title">Detail Pembayaran Angsuran</h3>'+
                            '</div>'+
                            '<div class="box-header with-border">'+
                            '<table class="table table-striped">'+
                              '<thead>'+
                                '<th>Nota</th>'+
                                '<th>Jatuh Tempo</th>'+
                                '<th>Ke-</th>'+
                                '<th>Jumlah</th>'+
                                '<th>Status</th>'+
                              '</thead>'+
                              '<tbody>';

              $.each(data, function(i, item) {
                var date = new Date(item.created_at);
                  ulang += '<tr>'+
                            '<td>'+item.no_transaksi+'</td>'+
                            '<td>'+(date.getDate()+" "+(monthNames[date.getMonth()])+" "+date.getFullYear())+'</td>'+
                            '<td>'+item.info_ke+'</td>'+
                            '<td>'+item.jumlah_total+'</td>'+
                            '<td>'+item.status+'</td>'+
                          '</tr>';

              })

              ulang += '</tbody>'+
                      '</table>'+
                      '</div>'+
                      '</div>'+
                    '</div>';

              $("#data_detail").html(ulang);
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