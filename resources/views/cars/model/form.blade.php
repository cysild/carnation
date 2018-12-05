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
               <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="add-data" >
                <div class="form-group">
                    <label for="name_en" class=" col-md-3">Car Model :</label>
                    <div class=" col-md-9">
                       <input type="text" class="form-control" name="model" value="" placeholder="Ex (Audi,Bmw...)" >
                    </div>           
                    {{csrf_field()}}
                </div>

                <div class="form-group">
                    <label for="name_en" class=" col-md-3">Car Make :</label>
                    <div class=" col-md-9">
                      <select class="form-control" name="make" id="make"> 
                        <option value="0">Select Make</option>
                      </select>
                    </div>           
                </div>

                    <div class="form-group">
                    <div class="center-block col-lg-12">
                      <div class="images"></div>
                    </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="id" value="">
                                            <input type="hidden" name="model_id" value="">

                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                 </form> 
                    <!-- end form --> 

                  </div>

                  

                  </div>
                      

            <!-- /.modal-content -->
                  </div>
          <!-- /.modal-dialog -->



