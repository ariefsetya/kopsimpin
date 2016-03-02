<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tanda Terima Angsuran</title>
  <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">
</head>
<body>
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header" style="font-size:15pt !important;">
          <img class="print_img" src="{{url('images/'.$koperasi->logo)}}"> {{$koperasi->nama}}<br>
          <span style="font-size:9pt !important;">Badan Hukum : {{\App\Koperasi::find(Auth::user()->assigned_koperasi)['badan_hukum']}}</span>
          <small class="text-right">{{date_format(date_create($transaksi->updated_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->updated_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->updated_at),"Y H:i:s") }}</small>
        </h2>
      </div>

      <div class="text-center">
          <b>Tanda Terima Angsuran</b>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <table class="table">
      <tr>
        <td colspan="3"></td>
        <td colspan="3"></td>
      </tr>
      <tr>
        <td>No. Transaksi</td><td></td><td>{{$transaksi->no_transaksi}}</td>
        <td>Jangka Waktu</td><td>:</td><td>{{$induk->info_ke}} bulan</td>
      </tr>
      <tr>
        <td>No. Rekening</td><td>:</td><td>{{$anggota->no_anggota}}</td>
        <td>Sisa Angsuran</td><td>:</td><td>{{sizeof(\App\Transaksi::where('id_induk',$transaksi->id_induk)->where('status','Belum Lunas')->get())}} bulan</td>
      </tr>
      <tr>
        <td>Jatuh Tempo</td><td>:</td><td>{{date_format(date_create($transaksi->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->created_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->created_at),"Y") }}</td>
        <td></td><td></td><td></td>
      </tr>
    </table>

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table">
          <tr>
            <td colspan="4"></td>
          </tr>
          <tr>
            <td class="text-center">Nota</td>
            <td class="text-center">Keterangan</td>
            <td class="text-center"></td>
            <td class="text-center">Total</td>
          </tr>
          @foreach($keuangan as $key)
          <?php 
          $info = explode(" Rp.", $key->info);
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
        </table>
      </div>
    </div>
    <div class="row">

      <div class="col-xs-12">
        <table style="width:100%">
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td style="width:290px" class="text-center"><b>Penyetor</b></td>
            <td style="width:290px" class="text-center"><b>{{$koperasi->kabkota}}, {{date_format(date_create($transaksi->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->created_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->created_at),"Y") }}</b></td>
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="text-center">{{$anggota->nama}}</td>
            <td class="text-center">{{$koperasi->nama}}</td>
          </tr>
        </table>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12">
        Catatan : {{(\App\Koperasi::find(Auth::user()->assigned_koperasi)['catatan'])}} 
      </div>
    </div>
</body>
</html>