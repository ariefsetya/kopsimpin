@extends('app')

@section('content')
<div class="content-wrapper">
  <section class="invoice" style="margin:0">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <img class="print_img" src="{{url('images/'.$koperasi->logo)}}"> {{$koperasi->nama}}<br>
          <span style="font-size:11pt;">Badan Hukum : {{\App\Koperasi::find(Auth::user()->assigned_koperasi)['badan_hukum']}}</span>
          <small class="pull-right">{{date_format(date_create($transaksi->updated_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->updated_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->updated_at),"Y H:i:s") }}</small>
        </h2>
      </div>

      <div class="">
        <h4 class="text-center">
          <b>Tanda Terima Angsuran</b>
        </h4>
      </div>
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <b>No. Transaksi {{$transaksi->no_transaksi}}</b><br>
        <b>No. Rekening :</b> {{$anggota->no_anggota}}<br>
      </div>
      <div class="col-sm-4 invoice-col">
      </div>
      <div class="col-sm-4 invoice-col">
        <b>Jangka Waktu :</b> {{$induk->info_ke}} bulan<br>
        <b>Jatuh Tempo :</b> {{date_format(date_create($transaksi->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($transaksi->created_at),"m"))->first()['nama'])." ".date_format(date_create($transaksi->created_at),"Y") }}<br>
      </div>
    </div>
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
          <tr>
            <td>{{$key->no_nota}}</td>
            <td>{{$key->info}}</td>
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
    </div>

    <a href="{{url('transaksi/pembayaran/baru/')}}" class="btn btn-warning">Pembayaran Baru</a>
    <a target="_blank" href="{{url('transaksi/pembayaran/print/'.$transaksi->no_transaksi)}}" class="btn btn-primary">Print Bukti</a>
  </section>
</div>
@endsection