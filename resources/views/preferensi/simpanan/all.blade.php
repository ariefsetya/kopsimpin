@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-primary" href="{{url('preferensi/simpanan/baru')}}">Tambah Baru</a></span>
      <h1>
        Preferensi
        <small>Simpanan</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Preferensi Simpanan</h3>
              </div>
              <div class="box-header with-border">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah</th>
                      <th colspan="2">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{$key->nama}}</td>
                      <td>Rp. {{$key->jumlah}}</td>
                      <td><a href="{{url('preferensi/simpanan/edit/'.$key->id)}}">Ubah</a></td>
                      <td><a onclick="return confirm('Apakah Anda yakin akan menghapus preferensi simpanan dengan nama {{$key->nama}}')" href="{{url('preferensi/simpanan/destroy/'.$key->id)}}">Hapus</a></td>
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