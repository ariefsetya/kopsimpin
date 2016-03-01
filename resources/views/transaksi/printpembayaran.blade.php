<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tanda Terima Angsuran</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/fa/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <img class="print_img" src="{{url('images/'.$koperasi->logo)}}"> {{$koperasi->nama}}<br>
          <span style="font-size:11pt;">Badan Hukum : {{\App\Koperasi::find(Auth::user()->assigned_koperasi)['badan_hukum']}}</span>
          <small class="pull-right">{{date_format(date_create($transaksi->updated_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->updated_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->updated_at),"Y H:i:s") }}</small>
        </h2>
      </div>

      <div class="text-center">
          <b>Tanda Terima Angsuran</b>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-7 invoice-col">
        <b>No. Transaksi {{$transaksi->no_transaksi}}</b><br>
        <b>No. Rekening :</b> {{$anggota->no_anggota}}<br>
      </div>
      <div class="col-sm-1 invoice-col">
      </div>
      <div class="col-sm-4 invoice-col">
        <b>Jangka Waktu :</b> {{$induk->info_ke}} bulan<br>
        <b>Sisa Angsuran :</b> {{sizeof(\App\Transaksi::where('id_induk',$transaksi->id_induk)->where('status','Belum Lunas')->get())}} bulan<br>
        <b>Jatuh Tempo :</b> {{date_format(date_create($transaksi->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->created_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->created_at),"Y") }}<br>
      </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th class="text-center">Nota</th>
            <th class="text-center">Keterangan</th>
            <th colspan="2" class="text-center">Total</th>
          </tr>
          </thead>
          <tbody>
          @foreach($keuangan as $key)
          <?php 
          $info = explode(" (", $key->info);
          $info = $info[0];
          ?>
          <tr>
            <td>{{$key->no_nota}}</td>
            <td>{{$info}}</td>
            <td>Rp.</td>
            <td class="text-right">{{number_format($key->masuk,2,",",".")}}</td>
          </tr>
          @endforeach
          <tr>
            <td></td>
            <td><b>Total</b></td>
            <td>Rp.</td>
            <td class="text-right">{{number_format($total,2,",",".")}}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">

        <table class="text-center" style="width:100%">
        <thead>
          <tr>
            <th>Penyetor</th>
            <th>{{$koperasi->kabkota}}, {{date_format(date_create($transaksi->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->created_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->created_at),"Y") }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>{{$anggota->nama}}</td>
            <td>{{$koperasi->nama}}</td>
          </tr>
          </tbody>
        </table>
    </div>
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-12">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Catatan : {{(\App\Koperasi::find(Auth::user()->assigned_koperasi)['catatan'])}} 
        </p>
      </div>
      <!-- /.col -->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>