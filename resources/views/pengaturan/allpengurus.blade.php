@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <span class="pull-right"><a class="btn btn-primary" href="{{url('pengaturan/pengurus/baru')}}">Tambah Baru</a></span>
      <h1>
        Pengurus
        <small>Koperasi</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Preferensi Pinjaman</h3>
              </div>
              <div class="box-header with-border">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>E-Mail</th>
                      <th>Primary</th>
                      <th colspan="2">Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{$key->name}}</td>
                      <td>{{$key->email}}</td>
                      <td>{{($key->primary==1)?"Yes":"No"}}</td>
                      <td><a href="{{url('pengaturan/pengurus/edit/'.$key->id)}}">Ubah</a></td>
                      <td>@if($key->primary==0)<a onclick="return confirm('Apakah Anda yakin akan menghapus pengurus dengan nama {{$key->name}}')" href="{{url('pengaturan/pengurus/destroy/'.$key->id)}}">Hapus</a>@endif</td>
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