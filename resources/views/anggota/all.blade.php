@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-primary" href="{{url('anggota/baru')}}">Tambah Baru</a></span>
      <h1>
        Anggota
        <small>Koperasi</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Anggota</h3>
              </div>
              <div class="box-header with-border">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No. Anggota</th>
                      <th>Nama</th>
                      <th>No. Telp</th>
                      <th>Alamat</th>
                      <th>Perusahaan</th>
                      <th colspan="2">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{$key->no_anggota}}</td>
                      <td>{{$key->nama}}</td>
                      <td>{{$key->no_telp}}</td>
                      <td>{{$key->alamat}}</td>
                      <td>{{$key->email}}</td>
                      <td><a href="{{url('anggota/edit/'.$key->id)}}">Ubah</a></td>
                      <td><a onclick="return confirm('Apakah Anda yakin akan menghapus anggota dengan nama {{$key->nama}}')" href="{{url('anggota/destroy/'.$key->id)}}">Hapus</a></td>
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