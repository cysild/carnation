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
                <button type="button" class="btn btn-default" style="float:right;" data-toggle="modal" id="modal-add-open">
                Add {{$page['content']}}
              </button>
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
 
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="add-blog" data-parsley-validate>
               <div class="form-group">
                    <label for="name_en" class=" col-md-2">First Name:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="first_name" value="" placeholder="First Name">
                       <input type="hidden" name="id" value="{{$page['id']}}">
                    </div>
                    {{csrf_field()}}
                </div>

                <div class="form-group">
                    <label for="name_en" class=" col-md-2">Last Name:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="last_name" value="" placeholder="Last Name">
                    </div>
                    
                </div>


  				<div class="form-group">
                    <label for="name_en" class=" col-md-2">Email:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <input type="text" class="form-control" name="email" value="" placeholder="Email">
                    </div>
                </div>


                <div class="form-group">
                    <label for="company_name" class=" col-md-2">Phone1:<span class="red">*</span></label>
                    <div class=" col-md-4">
                     <input type="text" class="form-control" name="phone1" value="" placeholder="Phone1">                 
                     </div>

                    <label for="company_name" class=" col-md-2">Phone2:</label>
                    <div class=" col-md-4">
                      <input type="text" class="form-control" name="phone2" value="" placeholder="Phone2">    
                    </div>
                </div> 



                 <div class="form-group">
                    <label for="name_en" class=" col-md-2">Address:<span class="red">*</span></label>
                    <div class=" col-md-10">
                       <textarea class="form-control" name="address" value="" placeholder="Address"></textarea>
                    </div>
                </div>

                  <div class="form-group">                  

                    <label for="company_name" class=" col-md-2">State:<span class="red">*</span></label>
                    <div class=" col-md-4">
                         <select name="state" class="form-control" id="state">
                       <option value="">-- Select State --</option>
                       @foreach ($states as $state)
                        <option value="{{ $state->id }}" @if($state->id == 31)selected @endif>{{ ucfirst($state->name) }}</option>
                       @endforeach
                      </select>   
                    </div>

                     <label for="company_name" class=" col-md-2">City:<span class="red">*</span></label>
                    <div class=" col-md-4">
                     <select name="city" class="form-control city" id="city"></select>                
                     </div>
                </div> 


                   <div class="form-group">
                    <label for="company_name" class=" col-md-2">Zipcode:<span class="red">*</span></label>
                    <div class=" col-md-4">
                     <input type="text" class="form-control" name="zipcode" value="" placeholder="Zipcode">                
                     </div>

                   
                </div> 


                    <div class="modal-footer">

                     <div class="alert alert-danger" style="display:none"></div>
                      <button type="button" class="btn btn-close pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
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
                  <th>First Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Action</th>
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

<script src="{{url('/')}}/vendor/ckeditor/ckeditor.js"></script>
<script src="{{url('/')}}/vendor/ckeditor/adapters/jquery.js"></script>
<script src="{{url('/')}}/js/bootbox.min.js"></script>

<script>

   $(document).ready(function(){
var stateID=$('#state').val();
var sel ='639';
city(stateID,sel);


	 $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("admin/clientcontent")}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'first_name', name: 'first_name' },
            { data: 'email', name: 'email' },
             { data: 'phone1', name: 'phone1' },
            { data: 'address', name: 'address' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
            return data.substr( 0, 10 );
        }
    } ]
    });


   /*For State Dropdown*/

   


 /*For City Dropdown*/
 $('#state').on('change', function() {
    
var stateID=$('#state').val();

city(stateID);
        });




	$('#modal-add-open').on('click', function (e) {    
            $('#modal-add').modal('show'); 
            $('#add-blog').trigger("reset");
            $('[name=id]').val('');
            $('.img').remove();
            $('.alert-danger').hide();
            $(".msg").hide();
            $("#add-blog").show();
            $(".modal-footer .btn-primary").show();
            $(".cat").empty().trigger('change');
            $('.modal-title').html('<h4><b>Add Client</b></h4>');
          });

} );



    $('#add-blog').submit(function(e){
    $(".succ").remove();
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });

              var baseurl = '{{url("/images")}}/';
               $.ajax({
                  url: "{{ url('/admin/client/store') }}",
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
                    $('#add-blog')[0].reset();  
                    $('.table').DataTable().ajax.reload();
                    $(".modal-footer .btn-primary").hide();
                    $("#add-blog").hide();
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

                 if(data.error)
                  {
                      $('.old').remove();
                      $('.alert-danger').show();
                      $('.alert-success').hide();
                      $('.alert-danger').append('<p class="old">'+data.error+'</p>');
                      $('.old').focus();
                 }
                 } 

                  });
    });



       $('body').on('click', '[data-act=ajax-modal]', function (e) {
            var id = $(this).data('id');
            var Select = $('.state');
            var Select1=$('.city');

            $.ajax({
              type:'GET',
              url:"{{url('/admin')}}/client/get/" + id,
              success: function(data)
              {  
                $(".modal-footer .btn-primary").show();                           
                $("#add-blog").show();
                $('.alert').hide();
                $('.modal-title').html('<h4><b>Edit Client</b></h4>');
                $('#add-blog')[0].reset();
    city(data.html.state_id,data.html.city_id);

         $('#state').val(data.html.state_id);       
                $('[name=first_name]').val(data.html.first_name);
                $('[name=last_name]').val(data.html.last_name);
                $('[name=email]').val(data.html.email);
                $('[name=phone1]').val(data.html.phone1);
                $('[name=phone2]').val(data.html.phone2);
                $('[name=address]').val(data.html.address);
                $('[name=zipcode]').val(data.html.zipcode);
                $('[name=id]').val(data.html.id);
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
              url:"{{url('/admin')}}/client/del/" + id,
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



function city(stateID,sel){

var set ="";
                $.ajax({
                    url: "{{url('/admin/city/list')}}/"+stateID,
                    success:function(data) {
                        //console.log(data);
                      if(data){
                        $('.city').empty();
                        $('.city').focus;
                        $('.city').append('<option value="">-- Select City --</option>'); 
                        $.each(data, function(key, value){

                          if(sel == value.id){
                              set = "selected";
                          }
                          else{
                            set ="";
                          }

                        $('select[name="city"]').append('<option '+set+' value="'+ value.id +'">' + value.name+ '</option>');
                    });
                  }else{
                    $('.city').empty();
                  }
                  }
                });
}

      </script>

  @endsection
