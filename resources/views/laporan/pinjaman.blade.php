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
        <h4><i class="icon fa fa-filter"></i> Filter Data</h4>
        <hr>
        <form class="form-horizontal" method="POST">

          <div class="form-group">
            <label class="col-sm-2 control-label">Bulan - Tahun</label>

            <div class="col-sm-2">
              <select name="bulan" class="form-control">
                @foreach($bulan as $key)
                  <option {{($kirimanbulan==$key->bulan)?"selected":""}} value="{{$key->bulan}}">{{$key->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-2">
              <input type="number" class="form-control" name="tahun" value="{{$kirimantahun}}" placeHolder="Tahun">
            </div>
          </div>
          <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>

              <div class="col-sm-10">
                <a href="{{url('laporan/pinjaman')}}" class="btn btn-warning">Reset</a>
                <button type="submit" class="btn btn-info">Cari</button>
                <a href="{{url('laporan/pinjaman/export/'.$kirimanbulan."/".$kirimantahun)}}" class="btn btn-primary">Export</a>
              </div>
            </div>
        </form>
      </div>
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="box-header with-border">
                <h3 class="box-title">Data Pinjaman Anggota</h3>
              </div>
              <div class="box-header with-border">
                <table class="table for_dttbls">
                  <thead>
                    <tr>
                      <th class="text-center" >Nama</th>
                      <th class="text-center" >Jenis</th>
                      <th class="text-center" colspan="2">Angsuran</th>
                      <th class="text-center" colspan="2">Total</th>
                      <th class="text-center" >Status</th>
                      <th class="text-center" >Jatuh Tempo</th>
                      <th class="text-center" >Jangka Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $key)
                    <tr>
                      <td>{{\App\Anggota::find($key->id_anggota)['nama']}}</td>
                      <td>{{\App\Pinjaman::find($key->id_jenis)['nama']}}</td>
                      <td>Rp. </td>
                      <td class="text-right">{{$key->angsuran}}</td>
                       <td>Rp. </td>
                      <td class="text-right">{{$key->jumlah_total}}</td>
                      <td>{{$key->status}}</td>
                      <td>Tanggal {{date_format(date_create($key->created_at),"d") }} setiap bulan</td>
                      <td>{{$key->info_ke}} bulan</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection