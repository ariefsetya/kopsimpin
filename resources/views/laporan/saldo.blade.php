@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Pinjaman
        <small>Anggota</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-money"></i> Saldo Global Koperasi</h4>
        <hr>
        <h1>Rp. {{number_format($saldo->jumlah,2,",",".")}}</h1>
      </div>
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="box-header with-border">
            <h3 class="box-title">Data Saldo Detail</h3>
          </div>
          <div class="box-header with-border">
            <h4>Saldo Bulan Lalu</h4>
            @if($saldo_bulan_lalu->jumlah!=NULL)
              Rp. {{number_format($saldo_bulan_lalu->jumlah,2,",",".")}}
            @else
              Tidak ada data
            @endif
            <h4>Saldo Tahun Lalu</h4>
            @if($saldo_tahun_lalu->jumlah!=NULL)
              Rp. {{number_format($saldo_tahun_lalu->jumlah,2,",",".")}}
            @else
              Tidak ada data
            @endif
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection