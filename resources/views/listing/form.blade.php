 <div class="modal fade" id="modal-add">

                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">{{$page['subtitle']}}</h4>
                    </div>
                    <div class="modal-body"> 
                    
                <div class="center-block msg">
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none"></div>
                  </div>
  <div id="form">  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#details">Car Details</a></li>
    <li><a data-toggle="tab" href="#features">Car Features</a></li>
    <li><a data-toggle="tab" href="#specification">Car Specification</a></li>
  </ul>
  <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="add-data" novalidate>
                              {{csrf_field()}}

   <div class="tab-content">
    <div id="details" class="tab-pane fade in active">
      <h3>Car Details</h3>
     
                <div class="form-group">
                    <label for="name_en" class=" col-md-1">Make :</label>
                    <div class=" col-md-3">
                  <select class="form-control" id="make" name="make" required> 
                  </select>
                    </div>           

                    <label for="name_en" class=" col-md-1">Model  :</label>
                    <div class=" col-md-3">
                    <select class="form-control" id="model" name="model" required>
                   </select>
                    </div>           
    
                    <label for="name_en" class=" col-md-1">Type :</label>
                    <div class=" col-md-3">
                    <select class="form-control" id="type" name="type" required>
                   </select>
                    </div>           
                </div>

                <div class="form-group">
                    <label for="name_en" class=" col-md-1">Year :</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="year" value="" placeholder="" required>
                    </div>       

                    <label for="name_en" class=" col-md-1">Transmission :</label>
                    <div class=" col-md-3">
                  <select class="form-control" id="transmission" name="transmission" required></select>
                    </div>          

                    <label for="name_en" class=" col-md-1">Fuel :</label>
                    <div class=" col-md-3">
                       <select class="form-control" id="fuel" name="fuel" required></select>
                    </div>           
                </div>




               <div class="form-group">
                    <label for="name_en" class=" col-md-1">Register year :</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="register_year" value="" placeholder="Ex (2001,2018..)" required="" >
                    </div>           

                     <label for="name_en" class=" col-md-1">Km Driven:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="driven" value="" placeholder="Ex (100000)" required>
                    </div>                  
    
                    <label for="name_en" class=" col-md-1">price :</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="price" value="" placeholder="Ex(100000)" required>
                    </div>           
                </div>
 


                <div class="form-group">
                    <label for="name_en" class=" col-md-1">Color:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="color" value="" placeholder="Ex (Red,Black...)" >
                    </div>    
                           
                    <label for="name_en" class=" col-md-1">Interior:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="interior" value="" placeholder="Ex (Interior color of car)" >
                    </div>         
                    <label for="name_en" class=" col-md-1">Exterior:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="exterior" value="" placeholder="Exterior color of car" >
                    </div>           
                </div>
 


                <div class="form-group">
                    <label for="name_en" class=" col-md-1">Owners:</label>
                    <div class=" col-md-3">
                       <input type="number" class="form-control" name="owners" value="" placeholder="Ex (100000)" required>
                    </div>       
                    <label for="name_en" class=" col-md-1">life time tax:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="life_time_tax" value="" placeholder="life time tax)"  >
                    </div>           
                   
                    <label for="name_en" class=" col-md-1">Insurance:</label>
                    <div class=" col-md-3">
                       <input type="text" class="form-control" name="insurance" value="" placeholder="Insurance Validity" required>
                    </div>           
                </div>

                  <div class="modal-footer">
                               <a class="btn btn-primary btnNext pull-right" data-toggle="tab" href="#features">Next</a>

                    </div>
    </div>

        <div id="features" class="tab-pane fade in">
          <h3>Car Features</h3> 
      

           <div class="form-group">
                        <div class="checkbox col-md-3">
                            <label><input type="checkbox" name="masterCheckbox" data-parent="#features" value="" id="masterCheckbox">Select/Unselect All</label>
                        </div>
            </div>

            <hr>

            <div id="featurescheck"> 
                      <div class="form-group" id="check">
                            <div id="flist"></div>
                      </div>
            </div>

                  <div class="modal-footer">
                                                   <a class="btn btn-primary btnNext pull-right" data-toggle="tab" href="#specification">Next</a>
                                                               <a class="btn btn-primary btnNext pull-right" data-toggle="tab" href="#details">Previous</a>


                    </div>


      </div>


        <div id="specification" class="tab-pane fade in   ">
          <h4>Car Specification</h4>


          <div class="form-group">
                    <label for="name_en" class=" col-md-1">Title :</label>
                    <div class=" col-md-4">
                       <input type="text" class="form-control" name="title" value="" placeholder="" required>
                    </div> 

              <div class=" col-md-1">
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" class="form-control" value="1" name="status" data-toggle="toggle">
                        Status
                        </label>
                      </div>
              </div> 

              <div class=" col-md-1">
                      <div class="checkbox">
                          <label>
                            <input type="checkbox" value="0" class="form-control" class="form-control" name="featured" data-toggle="toggle">
                          Featured
                          </label>
                        </div>
              </div> 

            <div class=" col-md-1">
                <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-control" name="booked" value="0" class="form-control" data-toggle="toggle">
                    Booked
                    </label>
                  </div>
            </div>        
          </div>
          <div class="form-group">
                  <div class=" col-md-7">
                  <label for="name_en" class=" ">Specification :</label>
                  <textarea class="form-control" id="specification" name="spec" ></textarea>
                 </div>       

                  <div class=" col-md-5">
               <label for="name_en" class="">Base Image :</label>
               <div class="bimg"></div>
                  <input type="file" class="form-control" name="baseimage" value=""  >
          
                <label for="name_en" class="">Interior Image :</label>
                               <div class="iimg"></div>

                  <input type="file" class="form-control" name="iimage[]" value="" multiple >
                    <label for="name_en" class="">exterior Image :</label>
                                                   <div class="eimg"></div>

                  <input type="file" class="form-control" name="eimage[]" value="" multiple >
                
                   </div> 

             

        </div>
                   <div class="modal-footer">
                <input type="hidden" name="id">
                               <button class="btn btn-primary btnSave" type="submit">Save</button> 
                  <a class="btn btn-primary btnNext pull-right" data-toggle="tab" href="#specfication">Previous</a>
                    </div>
                  </div>

</div>
  </div>


                
       
            <!--         <div class="modal-footer">
                      <input type="hidden" name="id">
                               <a class="btn btn-primary btnNext pull-right" href="#featurescheck">Next</a>

                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save changes</button> 
                    </div> -->
                 </form> 
                    <!-- end form --> 

                  </div>
                  </div>
            <!-- /.modal-content -->
                  </div>
          <!-- /.modal-dialog -->

