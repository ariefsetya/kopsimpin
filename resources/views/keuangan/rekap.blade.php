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
        Rekap
        <small>Keuangan</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Rekap Keuangan</h3>
              </div>
              <div class="box-body with-border">
                <div class="alert alert-success alert-dismissible">
                  <h4><i class="icon fa fa-filter"></i> Filter Data</h4>
                  <hr>
                  <form class="form-horizontal" method="POST" action="{{url('keuangan/rekap')}}">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="{{session('nama')}}">
                    <input type="hidden" id="id_anggota" class="form-control" name="id_anggota" value="{{session('id_anggota')}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal</label>

                  <div class="col-sm-10">
                    <input type="text" id="tanggal" class="form-control datepicker" name="tanggal" value="{{(session('tgl0')!="")?date_format(date_create(session('tgl0')),"m/d/Y")." - ".date_format(date_create(session('tgl1')),"m/d/Y"):""}}" placeHolder="Tanggal Awal - Tanggal Akhir">
                  </div>
                </div>
                <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                  <label class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <a href="{{url('keuangan/rekap/clear')}}" class="btn btn-warning">Reset</a>
                    <button type="submit" class="btn btn-info">Cari</button>
                    <a href="{{url('keuangan/rekap/export')}}" class="btn btn-primary">Export</a>
                  </div>
                </div>
            </form>
                </div>
              @if(sizeof($data)>0)
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Nota</th>
                      <th class="text-center">Pemasukan</th>
                      <th class="text-center">Pengeluaran</th>
                      <th class="text-center">Saldo</th>
                      <th class="text-center">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="bg-blue">
                    <?php $sisa = $saldo->debit-$saldo->kredit;?>
                      <td>Sisa Saldo</td>
                      <td></td>
                      <td class="text-right">{{number_format($saldo->debit,2)}}</td>
                      <td class="text-right">{{number_format($saldo->kredit,2)}}</td>
                      <td class="text-right">{{number_format($saldo->debit-$saldo->kredit,2)}}</td>
                      <td></td>
                    </tr>
                    @foreach($data as $key)
                    <tr>
                      <td>{{date_format(date_create($key->created_at),"d/m/Y H:i:s")}}</td>
                      <td>{{$key->no_nota}}</td>
                      <td class="text-right">{{number_format($key->masuk,2)}}</td>
                      <td class="text-right">{{number_format($key->keluar,2)}}</td>
                      <td class="text-right">{{number_format($sisa+$key->masuk-$key->keluar,2)}}</td>
                      <td><a onclick="buka_rekap({{$key->id}})">Info</a></td>
                    </tr>
                    <tr class="bg-gray" style="display:none;" id="rekap_{{$key->id}}">
                      <td colspan="6">{{"[".$key->jenis."] ".$key->info}}</td>
                    </tr>
                    <?php $sisa = $sisa+$key->masuk-$key->keluar;?>
                    @endforeach
                  </tbody>
                </table>
                {!!$data->render()!!}
                @endif
              </div>
            </div>
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('footer')
  <script type="text/javascript">
  $(function() {
    $('.datepicker').daterangepicker();
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
      function buka_rekap (id) {
        if($("#rekap_"+id).css('display')=="none"){
          $("#rekap_"+id).css('display','table-row');
        }else{
          $("#rekap_"+id).css('display','none');
        }
      }
  </script>
@endsection