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
            @include('cars.features.form')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-hover">
                <thead>
                <tr>
                  @foreach($heading as $head)
                  <th>{{ucfirst($head)}}</th>
                  @endforeach
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
    width: 500px;
    margin: 30px auto;
}
}
</style>
        @stop


@section('js')

<script src="{{url('/admin')}}/js/bootbox.min.js"></script>

<script>
    $(document).ready(function(){



           $('#modal-add-open').on('click', function() {
           $('.modal-title').html('<h4><b>Add Car Features</b></h4>');
         });



          $('.table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{$page['table_url']}}',
              columns:{!!$table!!}
          });

    $('#add-data').submit(function(e){
               e.preventDefault();       
             var url = "{{$page['save_url']}}";
            var mydata = new FormData(this);
             AddData(url,mydata);
    });

      $('body').on('click', '[data-act=ajax-modal]', function (e) {
            var id = $(this).data('id');
              getData(id); 
      });  

      $('body').on('click', '[data-act=ajax-modal-del]', function (e) {
            var id = $(this).data('id');
                bootbox.confirm("Are you sure want to delete?", function(result) {
                  if(result){
            $.ajax({
              type:'GET',
              url:"{{$page['delete_url']}}/" + id,
              success: function(data)
              {
                bootbox.alert(data.success, )
                    $('.alert').show();
                    $('.alert-danger').html('<p>'+data.success+'</p>');
                    $('.table').DataTable().ajax.reload();
              }
            });
          }
            });
      });


var imageurl ="{{url('/images/features')}}/";

function getData(id){
   $('.modal-footer .btn-primary').show();
           $(".msg").hide();
           $("#form").show();
           $('.alert-success').hide();
           $("#add-data").show();
           $('.modal-title').html('<h4><b>Edit Car Features</b></h4>');
            $.ajax({
              type:'GET',
              url:"{{$page['view_url']}}/" + id,
              success: function(data)
              {
                $('#add-data')[0].reset();
            $.each(data.html, function(key, value)
             {
              $('[name='+key+']').val(value);
             }
     );
     
    if(data.html.images){


              var appendimg = '';
              
                appendimg += '<a data-act="ajax-del-id" href ="#"> <img class="img" src="'+imageurl+data.html.images+'" width="50px;"/></a>';
            
                 $('.images').empty().append(''+appendimg);
                $('.image').empty().append('<input type="hidden" name="img" value="'+data.html.images+'"/>');
              }
          
                $('#modal-add').modal('show');
             }
            });
}


$('body').on('click', '[data-act=ajax-del-id]', function (e) {
             var id = $(this).data('id');
             var pid = $('[name=id]').val();
              bootbox.confirm("Are you sure want to delete?", function(result) {
              if(result){
              delimages(id,pid);
             $('.table').DataTable().ajax.reload();
            }
        });
         //alert(pid);
      });

function delimages(i,p){
     $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
   $.ajax({
    type: "POST",
    url: "{{url('/admin/features/images/del')}}",
    data:{

      "p":p,
      "i":i,
      "_token": "{{ csrf_token() }}",

    },
    success: function(data){
     // alert(data);
                      bootbox.alert(data.success, )

                           //  var id = $(i).data('id').hide();

                 $('.images').hide();
                 
             $('.table').DataTable().ajax.reload();

                            
                                


    }
    });


}
});
</script>

@stop
