@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-primary" href="{{url('transaksi/simpanan/baru')}}">Tambah Baru</a></span>
      <h1>
        Transaksi
        <small>Simpanan</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Transaksi Simpanan</h3>
              </div>
              <div class="box-header with-border">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jenis Simpanan</th>
                      <th>Jumlah</th>
                      <th>Bulan</th>
                      <!-- <th>Tindakan</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{\App\Anggota::find($key->id_anggota)['nama']}}</td>
                      <td>{{\App\Simpanan::find($key->id_jenis)['nama']}}</td>
                      <td>Rp. {{$key->jumlah_total}}</td>
                      <td>{{\App\Bulan::where('bulan',$key->bulan)->first()['nama']." ".$key->tahun}}</td>
                      <!-- <td><a onclick="return confirm('Apakah Anda yakin akan menghapus transaksi simpanan ini?')" href="{{url('transaksi/simpanan/destroy/'.$key->id)}}">Hapus</a></td> -->
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {!!$data->render()!!}
              </div>
            </div>
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection