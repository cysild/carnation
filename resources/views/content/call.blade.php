@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$page['title']}}
        <small>{{ $page['subtitle'] }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="javascript:void(0);">{{$page['basemenu']}}</a></li>
        <li class="active">{{$page['currenmenu']}}</li>
      </ol>
    </section>

    @stop
@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$page['title']}} - {{$page['subtitle']}}</h3>
              <div class="box-body">
              
              </div>
            </div>
             <div class="modal fade" id="modal-add">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><b>{{$page['modal_name']}}</b></h4>
                    </div>
                    <div class="modal-body">

                <div class="center-block msg">
                    <div class="alert alert-success" style="display:none"></div>
                    
                </div>
 
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="add-data" data-parsley-validate>

                <div class="form-group">
                    <label for="company_name" class=" col-md-2">Make:<span class="red">*</span></label>
                    <div class=" col-md-4">
                     <select name="make" id="make" class="form-control make">
                  
                        </select>

                     </div>

                    <label for="company_name" class=" col-md-2"><span id="vt">Model:</span></label>
                    <div class=" col-md-4">
                      <select name="model" id="model" class="form-control model">
                        <option value="0">Select Model</option>
                        <option value="1">A6</option>
                        <option value="2">A4</option></select>    
                    </div>
                </div> 


  				      <div class="form-group">
                    <label for="name_en" class=" col-md-2">First Name:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="first_name" value="" placeholder="First Name">
                    </div>
                    {{csrf_field()}}
                </div>

                <div class="form-group">
                    <label for="name_en" class=" col-md-2">Last Name:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="last_name" value="" placeholder="Last Name">
                       <input type="hidden" name="id" value="{{$page['id']}}">
                    </div>
                    
                </div>


                 <div class="form-group">
                    <label for="name_en" class=" col-md-2">Email:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="email" value="" placeholder="Email">
                    </div>
                </div>


                <div class="form-group">
                    <label for="name_en" class=" col-md-2">Phone:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="phone" value="" placeholder="Phone">
                    </div>
                </div>


                    <div class="modal-footer">

                     <div class="alert alert-danger" style="display:none"></div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="button" class="btn btn-close" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                            </form> 

            <!-- /.modal-content -->
                  </div>
          <!-- /.modal-dialog -->
            </div>
            <!-- /.box-header -->
           </div>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sno</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Date</th>
              
                </tr>
                </thead>
                <tbody>
          
             
                </tbody>
           
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    @stop
    @section('css')

  <style type="text/css">
@media (min-width: 768px){
.modal-dialog {
    width: 800px;
    margin: 30px auto;
}
}
</style>
        @stop

@section('js')


<script src="{{url('/admin')}}/js/bootbox.min.js"></script>

<script>

  $(document).ready(function(){
	





   $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("admin/request/list")}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },

            { data: 'date', name: 'date'  },



        ],
        columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
            return data.substr( 0, 10 );
        }
    } ]
    });

 $('#make').on('change', function (e) {
               e.preventDefault();   

               var sel = "";
          var url = "{{url('admin/model/json')}}";
          var val = $(this).val();
          getModel(url,val,sel);


      });

  $('#add-data').submit(function(e){
    $(".succ").remove();
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
 

              var baseurl = '{{url("/images")}}/';
               $.ajax({
                  url: "{{ url('/admin/enquiry/store') }}",
                  method: 'post',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData:false,
                  success: function(data){
                   if(data.success)
                  {
                    $(".succ").remove();

                    $('.alert').hide();
                    $('.alert-danger').hide();
                    $('.alert-success').show();
                    $('.alert-success').html('<p>'+data.success+'</p>');
                    $('#add-data')[0].reset();  
                    $('.table').DataTable().ajax.reload();
                    $(".modal-footer .btn-primary").hide();
                    $("#add-data").hide();
                    $(".msg").show();
                    $(".msg").append('<img class="img-responsive succ center-block" src='+baseurl+'check-circle.gif>');
                    setTimeout(function() { $('#modal-add').modal('hide'); }, 1500);
                                      }
                  if(data.errors)
                  {
                      $('.old').remove();
                      $('.alert-danger').show();
                      $('.alert-success').hide();
                      $.each(data.errors, function(key, value){
                      $('.alert-danger').append('<p class="old">'+value+'</p>');
                      });
                      $('.old').focus();
                 }
                 } 
                  });
    });




   $('body').on('click', '[data-act=ajax-modal]', function (e) {
            var id = $(this).data('id');
           

            $.ajax({
              type:'GET',
              url:"{{url('/admin')}}/enquiry/get/" + id,
              success: function(data)
              {  
                $(".modal-footer .btn-primary").show();                           
                $("#add-data").show();
                $('.alert').hide();
                $('.modal-title').html('<h4><b>Edit Enquiry</b></h4>');
                $('#add-data')[0].reset();
                $('[name=first_name]').val(data.html.first_name);
                $('[name=last_name]').val(data.html.last_name);
                $('[name=email]').val(data.html.email);
                $('[name=phone]').val(data.html.phone);
                $('[name=id]').val(data.html.id);

                               var val= '';
   var sel = data.html.make;
          var url = "{{url('admin/make/json')}}";
          getMake(url,val,sel);

                          var sel = data.html.model;
          var url = "{{url('admin/model/json')}}";
          var val = data.html.make;
          getModel(url,val,sel);

                var baseurl =  "{{url('/images/blog')}}/";
       
                $(".succ").remove();
                $('#modal-add').modal('show');

             }
            });
      });

   $('body').on('click', '[data-act=ajax-modal-del]', function (e) {
            var id = $(this).data('id');
            var baseurl = '{{url("/images")}}/';
                bootbox.confirm("Are you sure want to delete?", function(result) {
                  if(result){
            $.ajax({
              type:'GET',
              url:"{{url('/admin')}}/enquiry/del/" + id,
              success: function(data)
              {
                bootbox.alert(data.success, )

                 /*   $('.alert').show();
                    $('.alert-danger').html('<p>'+data.success+'</p>');*/
                    $('.table').DataTable().ajax.reload();
                }
            });
          }
            });
      });


});

      </script>

  @endsection
