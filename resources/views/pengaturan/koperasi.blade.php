@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit
        <small>Koperasi</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Identitas Koperasi</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Koperasi *)</label>

                  <div class="col-sm-10">
                    <input type="text" required value="{{$data->nama}}" class="form-control" name="nama" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">E-Mail</label>

                  <div class="col-sm-10">
                    <input type="email"  value="{{$data->email}}" class="form-control" name="email" placeholder="E-Mail">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. Telp</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->no_telp}}" class="form-control" name="no_telp" placeholder="No. Telp">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. Fax</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->no_fax}}" required class="form-control" name="no_fax" placeholder="No. Fax">
                  </div>
                </div>

              </div>
              <div class="box-header with-border">
                <h3 class="box-title">Domisili Koperasi</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat *)</label>

                  <div class="col-sm-10">
                    <textarea type="text" required name="alamat" class="form-control" placeholder="Alamat">{{$data->alamat}}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">RT/RW</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="rtrw" value="{{$data->rtrw}}" placeholder="RT/RW">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kelurahan</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->kel}}" class="form-control" name="kel" placeholder="Kelurahan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->kec}}" class="form-control" name="kec" placeholder="Kecamatan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kabupaten/Kota</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->kabkota}}" class="form-control" name="kabkota" placeholder="Kabupaten/Kota">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->prov}}" class="form-control" name="prov" placeholder="Provinsi">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Pos</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->kodepos}}" class="form-control" name="kodepos" placeholder="Kode Pos">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Negara</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control disabled" readonly name="negara" placeholder="Negara" value="Indonesia">
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('anggota')}}" class="btn btn-default">Batal</a>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection