@extends('app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Anggota
        <small>Koperasi</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    @if(sizeof($errors)>0)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Error Validation!</h4>
    @foreach($errors->all() as $message)
      <p>{{$message}}</p>
    @endforeach
      </div>
    @endif

    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Identitas Anggota</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nomor Anggota *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" required name="no_anggota" class="form-control" placeholder="Nomor Anggota">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" required class="form-control" name="nama" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin *)</label>

                  <div class="col-sm-10">
                    <select type="text" required class="form-control" name="gender">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">E-Mail</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="email" class="form-control" name="email" placeholder="E-Mail">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. Telp</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="no_telp" placeholder="No. Telp">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. HP *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" required class="form-control" name="no_hp" placeholder="No. HP">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. KTP *)</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" required class="form-control" name="no_ktp" placeholder="No. KTP">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Scan KTP</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="file" class="form-control" name="scan_ktp" placeholder="Scan KTP">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="file" class="form-control" name="foto" placeholder="Foto">
                  </div>
                </div>
              </div>
              <div class="box-header with-border">
                <h3 class="box-title">Domisili Anggota</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat *)</label>

                  <div class="col-sm-10">
                    <textarea type="text" required name="alamat" class="form-control" placeholder="Alamat"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">RT/RW</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="rtrw" placeholder="RT/RW">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kelurahan</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="kel" placeholder="Kelurahan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kecamatan</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="kec" placeholder="Kecamatan">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kabupaten/Kota</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="kabkota" placeholder="Kabupaten/Kota">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Provinsi</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="prov" placeholder="Provinsi">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kode Pos</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control" name="kodepos" placeholder="Kode Pos">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Negara</label>

                  <div class="col-sm-10">
                    <input autocomplete="off" type="text" class="form-control disabled" readonly name="negara" placeholder="Negara" value="Indonesia">
                  </div>
                </div>
                    <input autocomplete="off" type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
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