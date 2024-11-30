<form   class="stepy-validation" role="form" action="<?=$url?>" method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">Identification Details</legend>
                                {{csrf_field()}}

                                <div class="row" style="margin-top: 5%;">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('legal_name') ? ' has-error' : '' }}">
                                    <label>Legal Name</label>

                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-newspaper"></i></span>
                                             <input type="text" name="legal_name" class="form-control" value="<?=(isset($model->legal_name))? $model->legal_name:old('legal_name');?>" placeholder="Legal Name" required />
                                           </div>
                                    
                                  
                                     @if ($errors->has('legal_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('legal_name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('trading_name') ? ' has-error' : '' }}">
                                    <label>Supplier Trading Name(Optional)</label>
                                          <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-newspaper"></i></span>
                                             <input type="text" class="form-control" name="trading_name" placeholder="Trading Name" value="<?=(isset($model->trading_name))?$model->trading_name:old('trading_name');?>"  />
                                           </div>
                                     @if ($errors->has('trading_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('trading_name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                  
                                </div>

                                <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('reg_number') ? ' has-error' : '' }}">
                                    <label>CC Registartion Number</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-cc"></i></span>
                                             <input type="text" class="form-control" name="reg_number" placeholder="Registration Number"  value="<?=(isset($model->reg_number))? $model->reg_number:old('reg_number');?>" required />
                                           </div>
                                     
                                  
                                     @if ($errors->has('reg_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('reg_number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('country_of_origin') ? ' has-error' : '' }}">
                                    <label>Country of Origin</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-map"></i></span>
                                             <input type="text" class="form-control" name="country_of_origin" placeholder="Country of Origin"  value="<?=(isset($model->country_of_origin))? $model->country_of_origin:old('country_of_origin');?>"  required />
                                           </div>
                                     
                                  
                                     @if ($errors->has('country_of_origin'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('country_of_origin') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                </div>

                                <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('service_type') ? ' has-error' : '' }}">
                                    <label>SERVICE TYPE</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-chip"></i></span>
                                             <select class="form-control" name="service_type"  id="service_type" required>
                                     <option value="">----Select One ----</option>
                                     <option <?php if($model->service_type=="Distributor"):?> selected   <?php endif;?> >Distributor</option>
                                     <option <?php if($model->service_type=="Manufacturer and distributor"):?> selected   <?php endif;?> >Manufacturer and distributor</option>
                                     <option <?php if($model->service_type=="Services supplier"):?> selected   <?php endif;?> >Services supplier</option>
                                     <option <?php if($model->service_type=="Commodity retailer"):?> selected   <?php endif;?> >Commodity retailer</option>
                                     <option <?php if($model->service_type=="Professional service provider"):?> selected   <?php endif;?> >Professional service provider</option>
                                     <option <?php if($model->service_type=="Goods supplier"):?> selected   <?php endif;?> >Goods supplier</option>
                                     
                                        </select>
                                           </div>
                                     
                                     
                                  
                                     @if ($errors->has('service_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('service_type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>VAT Number:</label>


                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-certificate"></i></span>
                                             <input type="text" name="vat" class="form-control" placeholder="VAT Number"  value="<?=(isset($model->vat))?$model->vat:old('vat');?>">
                                           </div>


                                            

                                             @if ($errors->has('vat'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('vat') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                   
                                </div>
                                <div class="row">
                                
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Core Commodity</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-certificate"></i></span>
                                              <input type="text" class="form-control" name="core_commodity" placeholder="Core Commodity" value="<?=(isset($model->core_commodity)) ? $model->core_commodity:old('core_commodity');?>" />

                                           </div>


                                     
                                  
                                     @if ($errors->has('core_commodity'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('core_commodity') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('supplier_type') ? ' has-error' : '' }}">
                                    <label>Suppier Type</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class=" icon-direction"></i></span>
                                             <select class="form-control" name="supplier_type"  id="supplier_type">
                                     <option value="">----Select One ----</option>
                                     <option <?php if($model->supplier_type=="Public Limited Company"): ?> selected  <?php endif;?>
                                      >Public Limited Company</option>
                                     <option <?php if($model->supplier_type=="Private Limited Company"): ?> selected  <?php endif;?> >Private Limited Company</option>
                                     <option <?php if($model->supplier_type=="Joint Venture"): ?> selected  <?php endif;?>>Joint Venture</option>
                                     <option <?php if($model->supplier_type=="Sole Propriotor"): ?> selected  <?php endif;?>>Sole Propriotor</option>
                                     <option <?php if($model->supplier_type=="Patnership"): ?> selected  <?php endif;?> >Patnership</option>
                                     <option <?php if($model->supplier_type=="Close Corporation (CC)"): ?> selected  <?php endif;?> >Close Corporation (CC)</option>
                                     <option <?php if($model->supplier_type=="Foreign Company"): ?> selected  <?php endif;?> >Foreign Company</option>
                                     <option <?php if($model->supplier_type=="Trust"): ?> selected  <?php endif;?> >Trust</option>
                                        

                                    </select>
                                           </div>
                                    
                                  
                                     @if ($errors->has('supplier_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('supplier_type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                             
                               </div>
                                
                                <div class="clearfix"></div>

                                
                            </fieldset>

                             <fieldset title="2">

                                <legend class="text-semibold">Address Details</legend>
                                     
                                <div class="row">
                                <legend><b>Supplier Address Details:</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Physical Address: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-location4"></i></span>
                                             <input type="text" name="address_line" placeholder="Address Line" class="form-control" value="<?=(isset($model->address_line)) ? $model->address_line:old('address_line');?>">
                                              </div>
                                            </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Supplier Email:</label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-envelop"></i></span>
                                             <input type="text" name="email" placeholder="Supplier Email" class="form-control"  value="<?=(isset($model->email))?$model->email:old('email');?>">

                                              </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Supplier Telephone: <span class="text-danger">*</span></label>

                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-phone"></i></span>
                                             <input type="text" name="telephone" placeholder="Supplier Telephone" class="form-control" value="<?=(isset($model->telephone))? $model->telephone:old('telephone');?>" >

                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Altenate Telephone: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-phone-plus2"></i></span>
                                              <input type="text" name="alt_phone" placeholder="Altenate Phone" class="form-control" value="<?=(isset($model->alt_phone))? $model->alt_phone:old('alt_phone');?>" >

                                              </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City: <span class="text-danger">*</span></label>

                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-city"></i></span>
                                              <input type="text" name="city" placeholder="City" class="form-control" value="<?=(isset($model->city))?$model->city:old('city');?>" >

                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Street: <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-road"></i></span>
                                               <input type="text" name="street" placeholder="Street" class="form-control" value="<?=(isset($model->street))?$model->street:old('street');?>" >

                                              </div>
                                           
                                        </div>
                                    </div>

                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-location3"></i></span>
                                                <input type="text" name="location"   placeholder="Location" class="form-control "  id="autocomplete1" value="<?=(isset($model->location))? $model->location:old('location');?>">

                                              </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bulding: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-office"></i></span>
                                                 <input type="text" name="bulding" placeholder="Bulding" class="form-control" value="<?=(isset($model->bulding))?$model->bulding:old('bulding')?>" >

                                              </div>
                                           
                                        </div>
                                    </div>

                                   
                                </div>

                                


                               
                            </fieldset>

                            <fieldset title="3">

                                <legend class="text-semibold">Contact Detail</legend>
                                     
                                <div class="row">
                                <legend><b>Supplier Contact Details:</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>
                                              <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-user"></i></span>
                                                 <input type="text" name="contact_name" placeholder="Full Name" class="form-control" value="<?=(isset($model->contact_name))? $model->contact_name:old('contact_name');?>" required>

                                              </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Position:</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-user"></i></span>
                                                 <select name="contact_position" data-placeholder="Choose a Position" class="form-control" required>
                                                <option value=""></option> 
                                                <option <?php if($model->contact_position=="C.E.O"):?>selected<?php endif;?> value="C.E.O">C.E.O</option> 
                                                <option <?php if($model->contact_position=="Manager"):?>selected<?php endif;?> value="Manager">Manager</option> 
                                                <option <?php if($model->contact_position=="Supervisor"):?>selected<?php endif;?> value="Supervisor">Supervisor</option> 
                                                <option <?php if($model->contact_position=="Accountant"):?>selected<?php endif;?>  value="Accountant">Accountant</option> 
                                                <option <?php if($model->contact_position=="Clerk"):?>selected<?php endif;?>  value="Clerk">Clerk</option>
                                                <option <?php if($model->contact_position=="Others"):?>selected<?php endif;?> >Others</option>
                                            </select>

                                              </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Address: <span class="text-danger">*</span></label>

                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-address-book3"></i></span>
                                                 <input type="text" name="contact_postal_address" placeholder="Postal Address" class="form-control" value="<?=(isset($model->contact_postal_address))? $model->contact_postal_address:old('contact_postal_address');?>">

                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email  Address: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-envelop"></i></span>
                                                 <input type="text" name="contact_email" placeholder="Email Address" class="form-control" value="<?=(isset($model->contact_email)? $model->contact_email:old('contact_email'))?>">

                                              </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Telephone:</label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-phone-plus2"></i></span>
                                                 <input type="text" name="contact_phone" class="form-control" placeholder="Mobile Number" data-mask="+99-99-9999-9999" required value="<?=(isset($model->contact_phone))? $model->contact_phone:old('contact_phone');?>">

                                              </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Website:</label>
                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-dribbble3"></i></span>
                                                 <input type="text" name="website" class="form-control" placeholder="Website" value="<?=(isset($model->website))? $model->website:old('website');?>" >

                                              </div>
                                             
                                             

                                            
                                        </div>
                                    </div>


                                   
                                </div>


                               
                            </fieldset>

                            <fieldset title="4">
                                <legend class="text-semibold">Bank and Tax Details</legend>

                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bank Name: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-blogger"></i></span>
                                                 <input type="text" name="bank_name" placeholder="Bank Name" class="form-control " value="<?=(isset($model->bank_name))? $model->bank_name:old('bank_name');?>">

                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Branch: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-git-branch"></i></span>
                                                 <input type="text" name="branch" placeholder="Branch" class="form-control" value="<?=(isset($model->branch))?$model->branch:old('branch');?>" >

                                              </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Account Name: <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-git-commit"></i></span>
                                                 <input type="text" name="account_name" placeholder="Account Name" class="form-control" value="<?=(isset($model->account_name))? $model->account_name:old('account_name')?>" >

                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Account Number: <span class="text-danger">*</span></label>

                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-three-bars"></i></span>
                                                 <input type="text" name="account_number" placeholder="Account Number" class="form-control" value="<?=(isset($model->account_number))?$model->account_number:old('account_number');?>" >

                                              </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>
                                    
               </fieldset>

                            <fieldset title="5">
                                <legend class="text-semibold">Director Details</legend>

                                 <div class="row">
                                 <legend><b>List of Directors:</b></legend>
                                   <div class="col-md-12">
                                   <button class="btn btn-primary" id="add-director"><span class="glyphicon glyphicon-plus"></span>Add New Director Row</button>
                                       
                                   </div>
                                    <div class="clearfix"></div>
                                   <div id="director-container">
                                   <?php if(sizeof($model->directors)>0):?>

                                     <?php foreach($model->directors as $director):?>


                                   <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Director Name: <span class="text-danger">*</span></label>
                                            <input type="text" name="direct_name[]" placeholder="Account Name" class="form-control"  value="<?=$director->name?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Identification: <span class="text-danger">*</span></label>
                                            <select class="form-control" name="identification[]">
                                            <option  <?php if($director->identification=="National ID"):?>selected  <?php endif; ?> >National ID</option>
                                            <option <?php if($director->identification=="Passport Number"):?> selected <?php endif; ?> 
                                            >Passport Number</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Identification No: <span class="text-danger">*</span></label>
                                            <input type="text" name="identification_number[]" placeholder="Identification Number" class="form-control"  value="<?=$director->identifaction_number;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country of Origin: <span class="text-danger">*</span></label>
                                            <input type="text" name="country[]" placeholder="Country  of Orgin" class="form-control"  value="<?=$director->country;?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                           <br>
                                            <button class="btn btn-xs btn-danger direct-remove" style="margin-top:4%;">
                                            <span class="glyphicon glyphicon-remove"></span>Remove Row</button>
                                        </div>
                                    </div>
                                    </div>
                                <?php endforeach; else:?>
                                    <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Director Name: <span class="text-danger">*</span></label>
                                            <input type="text" name="direct_name[]" placeholder="Account Name" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Identification: <span class="text-danger">*</span></label>
                                            <select class="form-control" name="identification[]">
                                            <option>National ID</option>
                                            <option>Passport Number</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Identification No: <span class="text-danger">*</span></label>
                                            <input type="text" name="identification_number[]" placeholder="Identification Number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country of Origin: <span class="text-danger">*</span></label>
                                            <input type="text" name="country[]" placeholder="Country  of Orgin" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                           <br>
                                            <button class="btn btn-xs btn-danger new-remove" style="margin-top:4%;">
                                            <span class="glyphicon glyphicon-remove"></span>Remove Row</button>
                                        </div>
                                    </div>
                                    </div>



                                <?php endif;?>
                                    </div>

                                   
                                </div>

                                
                               
                                 


                                
                                 
                                



                                


                            </fieldset>
                           

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
                        </form>


                         
           @push('scripts')
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa4Wp4RyCZUBHDTpHZZJ4hrpAnGA0ojJc&v=3.exp&libraries=places"></script>
           <script>
             var count=0;
              $("#add-director").on('click',function(e){
                 e.preventDefault();
                 count=count+1;
                  if(count<=2){
                    var html='<div class="col-md-12">'
                         +'<div class="col-md-3">'
                         +'<div class="form-group">'
                         +'<label>Director Name: <span class="text-danger">*</span></label>'
                         +'<input type="text" name="direct_name[]" placeholder="Director Name" class="form-control" >'
                        +'</div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                         +'<div class="form-group">'
                        +'<label>Identification: <span class="text-danger">*</span></label>'
                        +'<select class="form-control" name="identification[]">'
                                    +'<option>National ID</option>'
                                     +'<option>Passport Number</option>'
                                                
                                   +'</select>'
                        +'</div>'
                        +'</div>'
                        +'<div class="col-md-3">'
                        +'<div class="form-group">'
                        +'<label>Identification No: <span class="text-danger">*</span></label>'
                        +'<input type="text" name="identification_number[]" placeholder="Identification Number" class="form-control" >'
                        +'</div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                        +'<div class="form-group">'
                        +'<label>Country of Origin: <span class="text-danger">*</span></label>'
                        +'<input type="text" name="country[]" placeholder="Country  of Orgin" class="form-control" >'
                        +'</div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                        +'<div class="form-group">'
                        +'<br>'
                        +'<button class="btn btn-xs btn-danger remove-director" style="margin-top:4%;">'
                        +'<span class="glyphicon glyphicon-remove"></span>Remove Row</button>'
                        +'</div>'
                        +'</div>'
                        +'</div>';


             $("#director-container").append(html); 

                  }
                  

                


                  $('body').on('click','.remove-director',function(e){
                     e.preventDefault();
                      count=count-1;
                      var son=$(this).parent().parent().parent();
                       $(son).remove();
                      
                  });
                                

          

              });

                $('body').on('click','.direct-remove',function(e){
                      e.preventDefault();
                       var son=$(this).parent().parent().parent();
                       $(son).remove();
                      
                  });


                $('body').on('click','.new-remove',function(e){
                      e.preventDefault();
                       
                      
                  });

           </script>

          
           @endpush