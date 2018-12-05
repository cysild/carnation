          
    $(document).ready(function(){

      var host   = window.location.origin+window.location.pathname;


           var val = "get";
          var sel = '';
          var url = APP_URL+"/admin/make/json";
          getMakes(url,val,sel);
                    var url = APP_URL+"/admin/model/json";
          var val = $(this).val();
          getModel(url,val,sel);


        
});


   $('#makea').on('change', function (e) {
               e.preventDefault();   

sel ="";
          var url = APP_URL+"/admin/model/json";
          var val = $(this).val();
          getModel(url,val,sel);


      });


    function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

    function getMakes(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#makea option").remove();
      var toAppend = '';

              toAppend += '<option value="" >Select Make</option>';
           $.each(data.make,function(i,o){
            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";
            }
            toAppend += '<option '+sele+' value='+o.id+'>'+o.make+'</option>';
            });
      $('#makea').append(toAppend);
    }
    });
}

    function getMake(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#make option").remove();
      var toAppend = '';

              toAppend += '<option value="" >Select Make</option>';
           $.each(data.make,function(i,o){
            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";
            }
            toAppend += '<option '+sele+' value='+convertToSlug(o.make)+'>'+o.make+'</option>';
            });
      $('#make').append(toAppend);
    }
    });
}



          function getModel(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#model option").remove();
      var toAppend = '';

  if(data.model.length == 0){
              toAppend += '<option value="" selected>Select Make  / No Model</option>';

  }
           $.each(data.model,function(i,o){




            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";

            }
            toAppend += '<option '+sele+' value='+o.id+'>'+o.model+'</option>';
            });
      $('#model').append(toAppend);
    }
    });
}



 $('#quickform').submit(function (e){
  e.preventDefault();   
          $('.oldx').detach();
     $.ajax({
                  url: APP_URL+"/enquiry/store",
                  method: 'POST',
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
                    $('#quickform')[0].reset();  
               //     $('.table').DataTable().ajax.reload();
                    $("#form").hide();
                    $(".msg").show();
                    var imageurl = APP_URL+"/images/";
                    $(".msg").append('<img class="img-responsive succ center-block" src="'+APP_URL+'/images/check-circle.gif">');
                    $('.modal-footer .btn-primary').hide();
                    setTimeout(function() { $('#enquiry').modal('hide'); }, 1000);

                  }
                  if(data.errors)
                  {
                      $('.alert').show();
                      $('.alert-danger').show();
                      $(".succ").remove();
            
                      $(".msg").show();
                      $('.alert').show();
                      $('.alert-danger').show();
                      $('.alert-success').hide();
                          //      $('#old').empty();
                          

                      $.each(data.errors, function(key, value){
                      $('.alert-danger').append('<p class="oldx">'+value+'</p>');
                      });
                 }
}
                });


  });





  $('#request').submit(function (e){
  e.preventDefault();   
    $('#old').remove();
// alert('x');
     $.ajax({
                  url: APP_URL+"/request/store",
                  method: 'POST',
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
                    $('#request')[0].reset();  
               //     $('.table').DataTable().ajax.reload();
                    $("#form").hide();
                    $(".msg").show();
                    var imageurl = APP_URL+"/images/";
                    $(".msg").append('<img class="img-responsive succ center-block" src="'+APP_URL+'/images/check-circle.gif">');
                    $('.modal-footer .btn-primary').hide();
                    setTimeout(function() { $('#myModal2').modal('hide'); }, 1000);

                  }
                  if(data.errors)
                  {
                      $('.alert').show();
                      $('.alert-danger').show();
                      $(".succ").remove();
            
                      $(".msg").show();
                      $('.alert').show();
                      $('.alert-danger').show();

                                           // $('.alert-danger').remove();


                   //   alert-danger

                      $('.alert-success').hide();
                                $('#old').remove();
                      $.each(data.errors, function(key, value){
                      $('.alert-danger').append('<p id="old">'+value+'</p>');
                      });
                 }
}
                });

        return false;

  });