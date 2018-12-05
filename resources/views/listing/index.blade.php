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
                <button type="button" class="btn btn-default" style="float:right;" id="modal-add-open">
                Add {{$page['content']}}
              </button>
              </div>
            </div>
            @include('listing.form')
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
    width: 1100px;
    margin: 30px auto;
}
}

</style>
@stop


@section('js')

<link rel="stylesheet" type="text/css" href="{{url('/vendor/adminlte/vendor/toggle')}}/bootstrap-toggle.min.css">
<script src="{{url('/vendor/adminlte/vendor/toggle')}}/bootstrap-toggle.min.js"></script>
<script src="{{url('/admin')}}/js/bootbox.min.js"></script>


<script src="{{url('/admin')}}/vendor/ckeditor/ckeditor.js"></script>
<script src="{{url('/admin')}}/vendor/ckeditor/adapters/jquery.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<script>
    $(document).ready(function(){

 var editor = CKEDITOR.replace( 'spec',{
      height:'200px',
                } );

$('#modal-add-open').on('click', function() {
             $('#add-data')[0].reset();
                       var val= '';
          var sel = '';
          var url = "{{url('admin/model/json')}}";
         getModel(url,val,sel);
       $('#modal-add').modal('show');
        $('.modal-title').html('<h4><b>Add Listing</b></h4>');
        $('.bimg').remove();
        $('.iimg').remove();
        $('.eimg').remove();
        editor.setData('');
});


          /*change active tabs when click next and prev button*/

             $('.btnNext').click(function(){
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
      });

        $('.btnPrevious').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
      });




          $('.table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{$page['table_url']}}',
              columns:{!!$table!!}
          });

          var val = "get";
          var sel = '';
          var url = "{{url('admin/make/json')}}";
          getMake(url,val,sel);

          var val = "get";
          var sel = $('[name=type]').val();
          var url = "{{url('admin/cartype/json')}}";
          getType(url,val,sel);




          var val= "get"
          var sel = $('[name=transmission]').val();
          var url = "{{url('admin/transmission')}}";
         getTransmission(url,val,sel);

          var val= "get"
          var sel = $('[name=fuel]').val();
          var url = "{{url('admin/fuel')}}";
          getFuel(url,val,sel);

          var val= "get"
          var sel = [];
          var url = "{{url('admin/features/json')}}";
          var isid = $('[name=id]').val();
          if(!isid)
          {
          getFlist(url,val,sel);
          }
         
      $('#make').on('change', function (e) {
               e.preventDefault();   


          var url = "{{url('admin/model/json')}}";
          var val = $(this).val();
          getModel(url,val,sel);


      });


    $('[name=booked]').on('change', function (e) {
               e.preventDefault();   
               if($(this).val() == 1){
                $(this).val(0)
               }
               else{
               $(this).val(1)
        }

      });

        $('[name=featured]').on('change', function (e) {
               e.preventDefault();   
               if($(this).val() == 1){
                $(this).val(0)
               }
               else{
               $(this).val(1)
        }

      });

             $('[name=status]').on('change', function (e) {
               e.preventDefault();   
               if($(this).val() == 1){
                $(this).val(0)
               }
               else{
               $(this).val(1)
        }


      });

      






    $('#add-data').submit(function(e){


    $('input:invalid').each(function () {
        var $closest = $(this).closest('.tab-pane');
        var id = $closest.attr('id');
        $('.nav a[href="#' + id + '"]').tab('show');
        return false;
    });


        e.preventDefault();       

             for ( instance in CKEDITOR.instances ) {
        CKEDITOR.instances[instance].updateElement();
    }

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
           $('.modal-title').html('<h4><b>Edit Listing</b></h4>');
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

                editor.setData(data.html.spec);
                if(data.html.status == 1){var status = "on";}else{var status = "off";}
                $('[name=status]').bootstrapToggle(status);
                if(data.html.featured == 1){var featured = "on";}else{var featured = "off";}
                $('[name=featured]').bootstrapToggle(featured);
                if(data.html.booked == 1){var booked = "on";}else{var booked = "off";}
                $('[name=booked]').bootstrapToggle(booked);

                var val= data.html.make;
                var sel = data.html.model;
                var url = "{{url('admin/model/json')}}";
                getModel(url,val,sel);
                var val= "get"
                var sel = data.html.features;
                var url = "{{url('admin/features/json')}}";
                getFlist(url,val,sel);
                var burl = "{{url('/images/listing/base')}}/";



                $('.img').remove();
                 $('.bimg').append('<img class="img" src="'+burl+data.html.base+'" name="img" width="50px;"/>');

            var iurl = "{{url('/images/listing/interior')}}/";
            $.each(data.iimg, function(key, value)
             {
                $('.iimg').append('<img class="img" src="'+iurl+value+'" name="img" width="50px;"/>');
             });

            var eurl = "{{url('/images/listing/exterior')}}/";
            $.each(data.eimg, function(key, value)
             {
                $('.eimg').append('<img class="img" src="'+eurl+value+'" name="img" width="50px;"/>');
             });

                $('#modal-add').modal('show');
             }
            });
}
});
</script>




@stop
