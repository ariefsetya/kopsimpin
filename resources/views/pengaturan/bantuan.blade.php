@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panduan Penggunaan
        <small>Koperasi Online</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            <!-- /.box-header -->
      <iframe style="width:100%;height:550px;" src="{{url('doc/Koperasi_Simpan_Pinjam_Online.pdf')}}"></iframe>
            <!-- /.box-body -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection