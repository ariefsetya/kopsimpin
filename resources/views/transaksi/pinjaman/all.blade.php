@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-primary" href="{{url('transaksi/pinjaman/baru')}}">Tambah Baru</a></span>
      <h1>
        Transaksi
        <small>Pinjaman</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Transaksi Pinjaman</h3>
              </div>
              <div class="box-header with-border">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jenis Pinjaman</th>
                      <th>Jumlah</th>
                      <th>Janga Waktu</th>
                      <th>Bunga</th>
                      <th>Status</th>
                      <!-- <th>Tindakan</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{\App\Anggota::find($key->id_anggota)['nama']}}</td>
                      <td>{{\App\Pinjaman::find($key->id_jenis)['nama']}}</td>
                      <td>Rp. {{$key->jumlah_total}}</td>
                      <td>{{$key->info_ke}} bulan</td>
                      <td>{{$key->bunga}}%</td>
                      <td>{{$key->status}}</td>
                      <!-- <td><a onclick="return confirm('Apakah Anda yakin akan menghapus transaksi pinjaman ini?')" href="{{url('transaksi/pinjaman/destroy/'.$key->id)}}">Hapus</a></td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$data->render()}}
              </div>
            </div>
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection