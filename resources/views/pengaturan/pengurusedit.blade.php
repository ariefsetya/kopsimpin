@extends('app')

@section('header')
<link rel="stylesheet" href="<?php echo url('jqwidz/jqwidgets/styles/jqx.base.css');?>" type="text/css" />
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Pengurus
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
                <h3 class="box-title">Pengurus Koperasi</h3>
              </div>
              <div class="box-header with-border">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama *)</label>

                  <div class="col-sm-10">
                    <input type="text" value="{{$data->name}}" required class="form-control" name="name" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">E-Mail</label>

                  <div class="col-sm-10">
                    <input type="email" value="{{$data->email}}" required class="form-control" name="email" placeholder="E-Mail">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>
                    <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                
              </div>

              <div class="box-header with-border">
                <h3 class="box-title">Pengaturan Menu</h3>
              </div>
              <div class="box-header with-border">
                <div id="select_menu"></div>
              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{url('pengaturan/pengurus')}}" class="btn btn-default">Batal</a>
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

@section('footer')

<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxcore.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxdata.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxtree.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxcheckbox.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxnumberinput.js');?>"></script>
<script type="text/javascript" src="<?php echo url('jqwidz/jqwidgets/jqxbuttons.js');?>"></script>
<script type="text/javascript">
  function get_menus(){
    $.ajax({
      url:'<?php echo url("ajax/get_menu");?>',
      type:'GET',
      dataType:'json',
      success:function(data){

          var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'parentid' },
                        { name: 'text' },
                        { name: 'value' }
                    ],
                    id: 'id',
                    localdata: data
                };
                // create data adapter.
                var dataAdapter = new $.jqx.dataAdapter(source);
                // perform Data Binding.
                dataAdapter.dataBind();
                // get the tree items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents 
                // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter 
                // specifies the mapping between the 'text' and 'label' fields.  
                var records = dataAdapter.getRecordsHierarchy('id', 'parentid', 'items', [{ name: 'text', map: 'label'}]);
                $('#select_menu').jqxTree({ checkboxes:true,source: records, width: '300px'});
                $('#select_menu').jqxTree('expandAll');
                $('#select_menu').jqxTree({ hasThreeStates: true });
                $('#select_menu').on('checkChange',function (event)
                {
                var items = $('#select_menu').jqxTree('getCheckedItems');
                  
                var nilai = "";
                for(var data in items) {
                    nilai += items[data].id+",";
                }
                  $("#id_menu").val(nilai);
                });  
      }
    });
  }
  get_menus();
  </script>

    <script type="text/javascript">
  setTimeout(function () {
  var id_user = "<?php echo $flow['assign_user'];?>";
  var split = id_user.split(",");
    for (data in split){
      $("#user_assign_id").jqxTree('checkItem', $("#"+split[data])[0], true);
    }
  },2000);
  </script>

@endsection