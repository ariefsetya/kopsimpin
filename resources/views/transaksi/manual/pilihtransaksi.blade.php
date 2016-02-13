@extends('app')


@section('header')  
  <link rel="stylesheet" href="{{ url('plugins/datatables/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{url('plugins/jQueryUI/jquery-ui.min.css')}}">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembayaran Angsuran
        <small>Baru</small>
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
                   <h3 class="box-title">Cetak Bukti Pembayaran Manual</h3>
                 </div>
                 <div class="box-header with-border">
                   <div class="form-group">
                     <label class="col-sm-2 control-label">Nama *)</label>

                     <div class="col-sm-10">
                       <input type="text" id="nama" required class="form-control" name="nama" placeholder="Nama">
                       <input type="hidden" id="id_anggota" required class="form-control" name="id_anggota" value="0">
                     </div>
                   </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Pilihan Pembayaran</label>

                     <div class="col-sm-10">
                       <select type="text" id="id_induk" required class="form-control" name="id_induk">
                         <option readonly value="">-- pilihan pembayaran --</option>
                       </select>
                     </div>
                   </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Pilihan Angsuran</label>

                     <div class="col-sm-10">
                       <select type="text" id="id_angsuran" required class="form-control" name="id_angsuran">
                         <option readonly value="">-- pilihan angsuran --</option>
                       </select>
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="col-sm-2 control-label">Transaksi</label>

                     <div class="col-sm-10">
                        <div id="open_datatables">

                        </div>
                     </div>
                  </div>
                  <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" class="form-control" name="id_transaksi">
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Cetak</button>
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
  <script>
  var table;
    $(function() {
      $("#id_jenis").on('change',function () {
        if($("#id_jenis option:selected").val()!=""){
          $.ajax({
            url:"{{url('ajax/get_simpanan')}}/"+$("#id_jenis option:selected").val(),
            success:function (data) {
              $("#jumlah").val(data);
            }
          });
        }else{
          $("#jumlah").val('0');
        }
      });
      $("#nama").autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: "{{url('ajax/get_anggota')}}/"+$("#nama").val(),
            dataType: "json",
            success: function( data ) {
              response( data );
            }
          });
        },
        minLength: 1,
        select: function( event, ui ) {
          $("#nama").val(ui.item.label);
          $("#id_anggota").val(ui.item.id);

          $.ajax({
            url:"{{url('ajax/get_pinjaman/all')}}/"+ui.item.id,
            dataType:'json',
            success:function (data) {
              //var data = jQuery.parseJSON(data);
              $("#id_induk").html('<option value="">-- pilihan pembayaran --</option>');
              
              $.each(data, function(i, item) {
                $("#id_induk").append('<option value="'+item.id+'">'+item.no_transaksi+' (Rp. '+item.jumlah_asli+')</option>');
              })              
            }
          });
            table = null;
            $('#open_datatables').html('<table id="example" class="display select" cellspacing="0" width="100%">'+
                              '<thead>'+
                                 '<tr>'+
                                    '<th class="text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>'+
                                    '<th>Tanggal</th>'+
                                    '<th>Nota</th>'+
                                    '<th>Keterangan</th>'+
                                    '<th>Total</th>'+
                                 '</tr>'+
                              '</thead>'+
                           '</table>');
            table = $('#example').DataTable({
                  'ajax': {
                     'url': '{{url("ajax/get_keuangan")}}/'+ui.item.id
                  },
                  'columnDefs': [{
                     'targets': 0,
                     'searchable': false,
                     'orderable': false,
                     'className': 'dt-body-center',
                     'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                     }
                  }],
                  'order': [[1, 'desc']]
               });

               // Handle click on "Select all" control
               $('#example-select-all').on('click', function(){
                  // Get all rows with search applied
                  var rows = table.rows({ 'search': 'applied' }).nodes();
                  // Check/uncheck checkboxes for all rows in the table
                  $('input[type="checkbox"]', rows).prop('checked', this.checked);
               });

               // Handle click on checkbox to set state of "Select all" control
               $('#example tbody').on('change', 'input[type="checkbox"]', function(){
                  // If checkbox is not checked
                  if(!this.checked){
                     var el = $('#example-select-all').get(0);
                     // If "Select all" control is checked and has 'indeterminate' property
                     if(el && el.checked && ('indeterminate' in el)){
                        // Set visual state of "Select all" control 
                        // as 'indeterminate'
                        el.indeterminate = true;
                     }
                  }
               });

      $("#id_induk").on('change',function () {
          $.ajax({
            url:"{{url('ajax/get_angsuran/all')}}/"+$("#id_induk option:selected").val(),
            dataType:'json',
            success:function (data) {
              //var data = jQuery.parseJSON(data);
              $("#id_angsuran").html('<option value="">-- pilihan angsuran --</option>');
              
              $.each(data, function(i, item) {
                var add = "disabled";
                if(i==0){add="";}
                $("#id_angsuran").append('<option '+add+' value="'+item.id+'">Angsuran ke-'+item.info_ke+' (Rp. '+item.jumlah_asli+')</option>');
              })              
            }
          });
      });

               // Handle form submission event
               // $('#frm-example').on('submit', function(e){
               //    var form = this;

               //    // Iterate over all checkboxes in the table
               //    table.$('input[type="checkbox"]').each(function(){
               //       // If checkbox doesn't exist in DOM
               //       if(!$.contains(document, this)){
               //          // If checkbox is checked
               //          if(this.checked){
               //             // Create a hidden element 
               //             $(form).append(
               //                $('<input>')
               //                   .attr('type', 'hidden')
               //                   .attr('name', this.name)
               //                   .val(this.value)
               //             );
               //          }
               //       } 
               //    });
               // });

          // $.ajax({
          //   url:"{{url('ajax/get_pinjaman/belum_lunas')}}/"+ui.item.id,
          //   dataType:'json',
          //   success:function (data) {
          //     //var data = jQuery.parseJSON(data);
          //     $("#id_induk").html('<option value="">-- pilihan pembayaran --</option>');
              
          //     $.each(data, function(i, item) {
          //       $("#id_induk").append('<option value="'+item.id+'">'+item.no_transaksi+' (Rp. '+item.jumlah_asli+')</option>');
          //     })              
          //   }
          // });

        }
      });

});
</script>

@endsection