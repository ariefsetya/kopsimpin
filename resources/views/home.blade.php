@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Koperasi Simpan Pinjam Online</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <h1>Selamat Datang, {{Auth::user()->name}}</h1>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{sizeof(\App\Anggota::where('id_koperasi',Auth::user()->assigned_koperasi)->get())}}</h3>

              <p>Anggota</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('anggota/baru')}}" class="small-box-footer">Tambah baru <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{sizeof(\App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('jenis_transaksi','Pinjaman')->get())}}</h3>

              <p>Seluruh Pinjaman</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('transaksi/pinjaman/baru')}}" class="small-box-footer">Buat baru <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{sizeof(\App\Transaksi::where('id_koperasi',Auth::user()->assigned_koperasi)->where('jenis_transaksi','Pinjaman')->where('status','Lunas')->get())}}</h3>

              <p>Pinjaman Lunas</p>
            </div>
            <div class="icon">
              <i class="fa fa-area-chart"></i>
            </div>
            <a href="{{url('transaksi/pinjaman')}}" class="small-box-footer">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <?php
        $data_pinjaman = \App\Pinjaman::all();
        ?>
        @foreach($data_pinjaman as $key)
        <div class="col-lg-6 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>Rp. {{number_format(DB::select("select sum(a.jumlah_total) as saldo from transaksis a left join transaksis b on a.id_induk=b.id where b.id_jenis=".$key->id." and a.id_koperasi=".Auth::user()->assigned_koperasi." and a.status='Belum Lunas'")[0]->saldo,2,",",".")}}</h3>

              <p>Saldo {{$key->nama}} di Lapangan</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('transaksi/pembayaran/all')}}" class="small-box-footer">Cek Data Pembayaran <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach
        <div class="col-lg-12 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Rp. {{number_format(\App\Keuangan::selectRaw('(sum(masuk)-sum(keluar)) as saldo')->where('id_koperasi',Auth::user()->assigned_koperasi)->first()['saldo'],2,",",".")}}</h3>

              <p>Saldo Koperasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('keuangan/rekap')}}" class="small-box-footer">Cek Rekap Keuangan <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection