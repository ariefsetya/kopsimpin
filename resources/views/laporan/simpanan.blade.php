@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Simpanan
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
              <a href="{{url('laporan/simpanan')}}" class="btn btn-warning">Reset</a>
              <button type="submit" class="btn btn-info">Cari</button>
              <a href="{{url('laporan/simpanan/export/'.$kirimanbulan."/".$kirimantahun)}}" class="btn btn-primary">Export</a>
            </div>
          </div>
      </form>
    </div>
    <div class="box">
      <div class="box-body no-padding">
        <div class="box-header with-border">
          <h3 class="box-title">Data Simpanan Anggota</h3>
        </div>
        <div class="box-header with-border">
          <table class="table for_dttbls">
            <thead>
              <tr>
                <th class="text-center" >Tanggal</th>
                <th class="text-center" >Nama</th>
                <th class="text-center" >Jenis</th>
                <th class="text-center"  colspan="2">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key)
              <tr>
                <td>{{date_format(date_create($key->created_at),"d")." ".(\App\Bulan::where('bulan',date_format(date_create($key->created_at),"m"))->first()['nama'])." ".date_format(date_create($key->created_at),"Y") }}</td>
                <td>{{\App\Anggota::find($key->id_anggota)['nama']}}</td>
                <td>{{\App\Simpanan::find($key->id_jenis)['nama']}}</td>
                <td>Rp. </td>
                <td class="text-right">{{$key->jumlah_total}}</td>
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