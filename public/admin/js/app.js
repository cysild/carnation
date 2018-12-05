function Tables(){

	
}


function AddData(sendurl,mydata){
	     
           //   var  mydata  =  $(this).serialize();
           
            $('#old').remove();
               $.ajax({
                  url: sendurl,
                  method: 'post',
                  data: mydata,
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
                    $("#form").hide();
                    $(".msg").show();
                    var imageurl = "/images/";
                    $(".msg").append('<img class="img-responsive succ center-block" src="images/check-circle.gif">');
                    $('.modal-footer .btn-primary').hide();
                    setTimeout(function() { $('#modal-add').modal('hide'); }, 1000);
                    $('.nav-tabs').hide();
                  }
                  if(data.errors)
                  {
                      $('.alert').show();
                      $('.alert-danger').show();
                      $('#old').remove()
                      $(".succ").remove();
                      $(".msg").show();
                      $('.alert').show();
                      $('.alert-success').hide();
                      $.each(data.errors, function(key, value){
                      $('.alert-danger').append('<p id="old">'+value+'</p>');
                      });
                 }
                 } 
                  });
}


        //modal Add //
          $('#modal-add-open').on('click', function (e) {    
          $('#modal-add').modal('show'); 
          $('#add-data')[0].reset();  
          $('#form').show();
          $('[name=id]').val("");
          $('.images').empty();
           $(".msg").hide();
           $('.alert-success').hide();
           $('.modal-footer .btn-primary').show();
          });



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
            toAppend += '<option '+sele+' value='+o.id+'>'+o.make+'</option>';
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


    function getType(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#type option").remove();
      var toAppend = '';

              toAppend += '<option value="" selected>Select Car Type</option>';
           $.each(data.type,function(i,o){
            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";
            }
            toAppend += '<option '+sele+' value='+o.id+'>'+o.type+'</option>';
            });
      $('#type').append(toAppend);
    }
    });
}


    function getTransmission(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#transmission option").remove();
      var toAppend = '';

              toAppend += '<option value="0" selected>Select Car Transmission</option>';
           $.each(data.transmission,function(i,o){
            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";
            }
            toAppend += '<option '+sele+' value='+o.id+'>'+o.transmission+'</option>';
            });
      $('#transmission').append(toAppend);
    }
    });
}


    function getFuel(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#fuel option").remove();
      var toAppend = '';

              toAppend += '<option value="0" selected>Select Car Fuel</option>';
           $.each(data.fuel,function(i,o){
            if(sel == o.id){
              var sele = "selected";
            }
            else{
              sele = "";
            }
            toAppend += '<option '+sele+' value='+o.id+'>'+o.fuel+'</option>';
            });
      $('#fuel').append(toAppend);
    }
    });
}


function getFlist(url,val, sel) {
    $.ajax({
    type: "GET",
    url: url,
    data:'set='+val,
    success: function(data){
    $("#flist option").remove();
      var toAppend = '';

 var sele = '';

 var  mydata = data.features;
           $.each(mydata,function(i,o){
          toAppend += '<div class="checkbox col-md-2"><label><input type="checkbox" '+sele+' value='+o.id+' name="features[]">'+o.features+'</label></div>';
            });
      $('#flist').empty().append(toAppend);
           var initValues = sel;
          $('#flist').find(':checkbox[name^="features"]').each(function () {
                    $(this).prop("checked", ($.inArray($(this).val(), initValues) != -1));
                });
    }
    });
       

}


function checekWithValue(val) {
    $(":checkbox").filter(function() {
        return this.value == val;
    }).prop("checked", "true");
}

function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL + "/";
    }

}



              
         function DataDel(url,id){


  bootbox.confirm("Are you sure want to delete?", function(result) {
                  if(result){
            $.ajax({
              type:'GET',
              url: url+"/"+id,
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
}




  /* == Check All == */
   $('#masterCheckbox').click(function (e) {
      var parent = $(this).data('parent'); 
      var $checkBoxes = $(parent + " input[type=checkbox]");
      $($checkBoxes).prop("checked",$(this).prop("checked"));
    });
  

 