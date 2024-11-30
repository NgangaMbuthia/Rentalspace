@extends('layout.wizard')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        
        <li><a href="<?=url('/backend/tenants/listView')?>">Tenants List</a></li>
        <li class="active">Edit/<?=$model->id?></li>
  </ul>
  <style type="text/css">
      
.mydate{

        height: 36px;
background-color: #fff;
border: 1px solid #ddd;
border-radius: 3px;
padding: 7px;
      }
  </style>


@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Update Tenants Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=url('/backend/tenants/update/'.$model->id)?>" method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">Personal Details</legend>
                                {{csrf_field()}}

                                <div class="row" style="margin-top: 5%;">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-city"></i></span>
                                            <select class="form-control" name="property_id" id="property">
                                    <option value="">--Select Property--</option>
                                    <?php foreach($properties as $property):?>
                                     <option 
                                      <?php if($model->space->property->id==$property->id):?>
                                        selected
                                      <?php endif;?>

                                     value="<?=$property->id?>">
                                     {{$property->title}}-- {{$property->location}}
                                     </option>

                                    <?php endforeach;?>
                                        

                                    </select>
                                             
                                           </div>
                                    
                                  
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Space Number/Name</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class=" icon-stamp"></i></span>
                                             <select class="form-control" name="space_id"  id="spaces">
                                    <option value="<?=$space->id?>"><?=$space->title?></option>
                                     <option value="">----Select Space Number/Name ----</option>
                                        

                                    </select>
                                             
                                           </div>
                                    
                                  
                                     @if ($errors->has('space_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('space_id') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                                </div>

                                <div class="row">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Full Name</label>
                                    <input type="hidden" name="tenant_id" value="<?=$model->id?>" />
                                     
                                     <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-users2"></i></span>
                                             <input type="text" class="form-control" name="name" placeholder="Full Names"  value="<?=$model->user->name?>"/>
                                           </div>
                                  
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                                    <label>ID Number</label>
                                     

                                     <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-vcard"></i></span>
                                             <input type="text" class="form-control" name="id_number" placeholder="ID Number"  value="<?=$model->user->profile->id_number?>" />
                                           </div>
                                  
                                     @if ($errors->has('id_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('id_number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                </div>

                                <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email Address</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-envelop3"></i></span>
                                            <input type="text" class="form-control" name="email" placeholder="Email Address"  value="<?=$model->user->email?>" />
                                        </div>
                                     
                                  
                                     @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone Number (Start with Country Code eg +254):</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-phone-plus2"></i></span>
                                            <input type="text" name="phone" class="form-control" placeholder="Mobile Number" data-mask="+99-99-9999-9999" value="<?=$model->user->profile->telephone?>">
                                           </div>



                                             @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                   
                                </div>
                                <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Postal Address</label>
                                    
                                         <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-address-book3"></i></span>
                                             <input type="text" class="form-control" name="postal_address" placeholder="Postal Address" value="<?=$model->user->profile->postal_address?>" />
                                           </div>
                                  
                                     @if ($errors->has('postal_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postal_address') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label>Gender</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class=" icon-repo-forked"></i></span>
                                             <select class="form-control" name="gender" >
                                         <option value=" ">--Select Gender---</option>
                                         <option <?php if($model->user->profile->gender=="Male"):?>selected   <?php endif;?>>Male</option>
                                         <option <?php if($model->user->profile->gender=="Female"):?>selected   <?php endif;?>>Female</option>

                                     </select>
                                           </div>
                                     
                                  
                                     @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               </div>
                                <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('entry_date') ? ' has-error' : '' }}">
                                    <label>Lease Start Date</label>
                                     

                                     <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control" name="entry_date" placeholder="Lease Start Date" value="{{$model->entry_date}}"  id="datepicker2" />
                                        </div>
                                  
                                      @if ($errors->has('entry_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('entry_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('expected_end_date') ? ' has-error' : '' }}">
                                    <label> Lease End Date</label>

                                    <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control" name="expected_end_date" placeholder="Lease End Date" value="{{$model->expected_end_date}}" id="datepicker"  />
                                        </div

                                    
                                     
                                  
                                     @if ($errors->has('expected_end_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expected_end_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>





                                </div>
                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Next of Kin Detail</legend>
                                     
                                <div class="row">
                                <legend><b>EMERGENCY CONTACT:</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>

                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-users2"></i></span>
                                             <input type="text" name="kin_name" placeholder="Next of Kin" class="form-control required" value="<?=($model->contact)?$model->contact->name:""?>">
                                           </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship:</label>
                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-users2"></i></span>
                                             <select name="relationship" data-placeholder="Choose a Relationship..." class="form-control" required>
                                                <option value=""></option> 
                                                <option <?php if(@$model->contact->relationship=="Spouse"):?>    selected
                                                   <?php endif;?> value="Spouse">Spouse</option> 
                                                <option 
                                                 <?php if(@$model->contact->relationship=="Child"):?>    selected
                                                   <?php endif;?> 

                                                value="Child">Child</option> 
                                                <option
                                                <?php if(@$model->contact->relationship=="Brother"):?>    selected
                                                <?php endif;?> 
                                                value="Brother">Brother</option>


                                                <option
                                                <?php if(@$model->contact->relationship=="Sister"):?>    selected
                                                <?php endif;?>
                                                 value="Sister">Sister</option> 
                                                <option 
                                                <?php if(@$model->contact->relationship=="Parent"):?>    selected
                                                <?php endif;?>
                                                value="Parent">Parent</option>
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
                                            <span class="input-group-addon"><i class="icon-phone"></i></span>
                                             <input type="text" name="conatct_postal_address" placeholder="Postal Address" class="form-control required" value="<?=@$model->contact->postal_address?>">
                                           </div>


                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Postal Code:</label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-address-book3"></i></span>
                                             <input type="text" name="conatct_postal_code" placeholder="Postal Code." class="form-control"
                                             value="<?=@$model->contact->postal_code?>"
                                            >
                                           </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email  Address: <span class="text-danger">*</span></label>

                                             <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-envelop3"></i></span>
                                            <input type="text" name="kin_email" placeholder="Email Address" class="form-control" value="<?=@$model->contact->email;?>">
                                        </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Telephone: <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-phone-plus2"></i></span>
                                           <input type="text" name="tel" class="form-control" placeholder="Mobile Number" data-mask="+99-99-9999-9999" required value="<?=@$model->contact->phone?>">
                                           </div>
                                            
                                        </div>
                                    </div>

                                   
                                </div>


                                <div class="row">
                                <legend><b>Other Tenants :</b></legend>
                                <strong>Hint:Those who will also be using the premises with you</strong>
                                <div id="button-holder " class="col-md-12">

                                <button class="btn btn-info pull-right" style="margin-bottom:1%" id="add-person">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add Person
                                </button>
                                    
                                </div>
                                <?php  if(sizeof($model->occupants)>0): 

                                foreach($model->occupants as $occupant):?>
                                <div id="persons-container">
                                <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="person_name[]" placeholder="Full Name" class="form-control " value="<?=$occupant->name?>">
                                    
                                </div>
                                <div class="form-group col-md-2">
                                <label>Identification</label>
                                <select class="form-control" name="identification[]">
                                <option <?php if($occupant->identification=="National ID"): ?> selected<?php endif;?> value="National ID">National ID</option>
                                <option <?php if($occupant->identification=="Birth Certificate"): ?> selected<?php endif;?> value="Birth Certificate">Birth Certificate</option>
                                <option <?php if($occupant->identification=="Passport Number"): ?> selected<?php endif;?> value="Passport">Passport Number</option>
                                <option

                                <?php if($occupant->identification=="Allien Card"): ?> selected<?php endif;?> 

                                   value="Allien Card">Allien Card</option>
                                    

                                </select>
                                    
                                </div>
                                 <div class="form-group col-md-2">
                                <label>Number</label>
                                <input type="text" name="occupant_number[]" placeholder="Number" class="form-control " value="<?=$occupant->number?>">
                                    
                                </div>


                                <div class="form-group col-md-2">
                                <label>Age</label>
                                <input type="text" value="<?=$occupant->age?>" name="age[]" placeholder="Age" class="form-control ">
                                    
                                </div>

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-persons" style="margin-top:25%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                    

                                </div>
                                </div>
                            <?php endforeach; else:?>

                            <div id="persons-container">
                                <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="person_name[]" placeholder="Full Name" class="form-control " value="<?=@$occupant->name?>">
                                    
                                </div>
                                <div class="form-group col-md-2">
                                <label>Identification</label>
                                <select class="form-control" name="identification[]">
                                <option <?php if(@$occupant->identification=="National ID"): ?> selected<?php endif;?> value="National ID">National ID</option>
                                <option <?php if(@$occupant->identification=="Birth Certificate"): ?> selected<?php endif;?> value="Birth Certificate">Birth Certificate</option>
                                <option <?php if(@$occupant->identification=="Passport Number"): ?> selected<?php endif;?> value="Passport">Passport Number</option>
                                <option

                                <?php if(@$occupant->identification=="Allien Card"): ?> selected<?php endif;?> 

                                   value="Allien Card">Allien Card</option>
                                    

                                </select>
                                    
                                </div>
                                 <div class="form-group col-md-2">
                                <label>Number</label>
                                <input type="text" name="occupant_number[]" placeholder="Number" class="form-control " value="<?=@$occupant->number?>">
                                    
                                </div>


                                <div class="form-group col-md-2">
                                <label>Age</label>
                                <input type="text" value="<?=@$occupant->age?>" name="age[]" placeholder="Age" class="form-control ">
                                    
                                </div>

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-persons" style="margin-top:25%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                    

                                </div>
                                </div>
                              <?php endif;?>
                                    


                                </div>
                                <div style="margin-top:6%;"></div>
                            </fieldset>

                            <fieldset title="3">
                                <legend class="text-semibold">Possession Details</legend>

                                   
                                   <div class="col-md-12">
                                   <button class="btn btn-default" id="add-tenant-items"><span class="glyphicon glyphicon-plus"></span>Add Tenant Items</button>
                                       

                                   </div>
                                    <div id="item-container">
                                    <?php foreach($model->items as $item):?>
                                    
                                    <div class="col-md-12" style="margin-top:2%;">
                                    <div class="col-md-3">
                                    <label>Type</label>
                                    <select class="form-control" name="item_type[]">
                                    <Option <?php if($item->type=="Electronics"):?>selected <?php endif;?> >Electronic</Option>
                                     <Option <?php if($item->type=="Vehicle"):?>selected <?php endif;?>>Vehicle</Option>
                                      <Option <?php if($item->type=="Pet"):?>selected <?php endif;?>>Pet</Option>

                                        
                                    </select>
                                    </div>
                                    <div class="col-md-3">
                                    <label>Name/Make</label>
                                     <input type="text" name="item_name[]" class="form-control" value="<?=$item->name?>">
                                    </div>

                                    <div class="col-md-3">
                                    <label>Number</label>
                                     <input type="text" name="item_number[]" class="form-control"
                                     value="<?=$item->number?>">
                                    </div>

                                    <div class="col-md-3" style="margin-top: 3.45%;">

                                    
                                     <button class="btn btn-danger dremove-me">Remove Item</button>
                                    </div>
                                        

                                    </div>

                                        


                                   


                                    <?php endforeach;?>
                                     </div>
                                             <div class="clearfix"></div>
                                     <div style="margin-top:10%;"></div>





                                    
                                    
                                     
                                          
                                  


                            </fieldset>

                            <fieldset title="4">
                                <legend class="text-semibold">Additional info</legend>
                              
                               

                                <div class="row" style="margin-top: 5%;">
                                <legend><b>Employment Details:,</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation Details: <span class="text-danger">*</span></label>
                                             <select class="form-control " name="employement_type" id="employer" >
                                                <option value="" >--Select One--</option>
                                                <option <?php if($model->type=="Employed"):?> selected <?php endif;?> value="Employed">Employed</option>
                                                <option <?php if($model->type=="Self Employed"):?> selected <?php endif;?> value="Self Employed">Self Employed</option> 
                                                <option  <?php if($model->type=="Student"):?> selected <?php endif;?> 
                                                value="Student">Student</option>

                                                </select>
                                            
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                                 <?php if($model->employer):?>
                                <div class="row employer hidden">
                                <div class='form-group col-md-6'>
                                    <label>Current Employer: <span class="text-danger">*</span></label>
                                     <input type="text" name="employer" placeholder="Current Employer" class="form-control" value="<?=$model->employer->employer_name?>"  >
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Job Title: <span class="text-danger">*</span></label>
                                     <input type="text" name="job_title" placeholder="Job Title" class="form-control" value="<?=$model->employer->job_title?>">
                                </div>
                                </div>
                                 <div class="row employer hidden">
                                <div class='form-group col-md-6'>
                                    <label>Contact Name For Reference: <span class="text-danger">*</span></label>
                                     <input type="text" name="reference_name" placeholder="Full Name" class="form-control" value="<?=$model->employer->contact_name?>">
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Contact Telephone: <span class="text-danger">*</span></label>

                                     <input type="text" name="reference_phone" placeholder="Full Name" class="form-control" value="<?=$model->employer->contact_phone?>" data-mask="+99-99-9999-9999">


                                      
                                </div>
                                </div>

                            <?php endif;?>


                            <?php if($model->student):?>

                                <div class="row student hidden">
                                <legend><b>Student Details</b></legend>
                                <div class='form-group col-md-6'>
                                    <label>University/College: <span class="text-danger">*</span></label>
                                     <input type="text" name="university_name" placeholder="Current Employer" class="form-control" value="<?=$model->student->institution_name?>" >
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Year of study: <span class="text-danger">*</span></label>
                                     <input type="text" name="year_of_study" placeholder="Year Of Study" class="form-control" value="<?=$model->student->year_of_study?>">
                                </div>
                                </div>
                                 <div class="row student hidden">
                                <div class='form-group col-md-6'>
                                    <label>Course title: <span class="text-danger">*</span></label>
                                     <input type="text" name="course" placeholder="Course Title" class="form-control" value="<?=$model->student->course_title?>">
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Course length: <span class="text-danger">*</span></label>
                                      <select class="form-control" name="course_length">
                                      <option>6 Months</option>
                                      <option>1 Year</option>
                                      <option>2 Year</option>
                                      <option>3 Year</option>
                                      <option>4 Year</option>
                                      <option>5 Year</option>
                                      <option>6 Year</option>
                                          
                                      </select>
                                </div>
                                </div>
                                <div class="row student hidden">
                                <div class='form-group col-md-6'>
                                    <label>Admission Number: <span class="text-danger">*</span></label>
                                     <input type="text" name="reg_number" placeholder="Admission Number" class="form-control" value="<?=$model->student->reg_number?>">
                                </div>
                                
                                </div>

                                    <?php endif;?>



                                <div class="row" style="margin-top: 5%;">
                                <legend><b>Tenant's Requirements</b></legend>
                                <div class="col-md-12 form-group">
                                <label>DO YOU HAVE ANY REQUIREMENTS TO TAKE THIS PROPERTY? (e.g. pets/unfurnished/request an item of furniture)</label><br>

                                <input class="radio-inline privous-license" required type="radio" name="has_requirement" value="No">NO
                                <input class="radio-inline" required type="radio" name="has_requirement" value="Yes"  style='margin-left:30%;'>Yes
                                </div>
                                <div class="col-md-12 form-group hidden requirement">
                                <label>Description</label>
                                 <textarea rows="4" class="form-control"  value="<?=$model->requirement?>" name="requirement" >{!!$model->requirement !!}</textarea>
                                </div>



                                <div class="col-md-12 form-group">
                                <label>How long do you see yourself living at the property</label><p>

                                <input class="radio-inline privous-license" required type="radio" name="stay_duration" value="6-12 MONTHS">6-12 MONTHS
                                <input class="radio-inline" required type="radio" name="stay_duration" value="1-2 YEARS"  style='margin-left:10%;'>1-2 YEARS

                                 <input class="radio-inline" required type="radio" name="stay_duration" value="2 YEARS+"  style='margin-left:10%;'>2 YEARS+
                                </div>
                                
                                    

                                </div>


                            </fieldset>

                             <fieldset title="5">
                                <legend class="text-semibold">Payment Details</legend>

                                   <div class="row">
                                   <div id="button-holder " class="col-md-12">

                                <button class="btn btn-info pull-right" style="margin-bottom:1%" id="add-charge">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add Charge
                                </button>
                                 <div class="clearfix"></div>
                                <hr style="width:100%;background: green">
                                    
                                </div>

                                 <div id="charges-container">
                                 <?php if(sizeof($model->charges)>0):?>
                                    <?php foreach($model->charges as $mod):?>

                                    <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="charge[]" placeholder="Charge Name" class="form-control " value="<?=$mod->charge_name?>" readonly>
                                    
                                </div>
                                
                                 <div class="form-group col-md-3">
                                <label>Amount</label>
                                <input type="text" name="amount[]" placeholder="Amount" class="form-control " value="<?=$mod->amount;?>">
                                    
                                </div>
                                 <div class="form-group col-md-3">
                                <label>Effective Date</label>
                                <input type="text" name="effective_from[]" placeholder="Effecive Date" class="form-control datepicker" readonly value="<?=$mod->effective_from?>">
                                    
                                </div>


                                

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-charge" style="margin-top:25%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                </div>

                                <?php endforeach;?>

                                <?php else:?>
                                  <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="charge[]" placeholder="Charge Name" class="form-control " value="Deposit" readonly>
                                    
                                </div>
                                
                                 <div class="form-group col-md-3">
                                <label>Amount</label>
                                <input type="text" name="amount[]" placeholder="Amount" class="form-control ">
                                    
                                </div>
                                 <div class="form-group col-md-3">
                                <label>Effective Date</label>
                                <input type="text" name="effective_from[]" placeholder="Effecive Date" class="form-control datepicker" readonly>
                                    
                                </div>


                                

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-charge" style="margin-top:25%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                </div>
                            <?php endif;?>
                                



                                </div>


                                    
                                    </div>
                                    </fieldset>

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}">
</script>
<script type="text/javascript">
   
    $("#property").on("change",function(){
      var id=$("#property").val();

      var length=id.length;
       var token="<?=csrf_token();?>";
        if(length>=1){
        var url="<?=url('/backend/fetch/property_spaces')?>/"+id;
         $.post(url,{'_token':token},function(data){
            $("#spaces").html(data);

         });
       
      }

      
    });


    $("#pet").on("change",function(){
       var value=$(this).val();
         if(value=="Yes"){
            $("#pet-container").removeClass("hidden");
         }else{
            $("#pet-container").addClass("hidden");
         }

    });


    $("#add-pet").on('click',function(e){
        e.preventDefault();
        var html='<div id="inner-container">'
                 +'<div class="col-md-6">'
                 +'<label class="display-block">Pet Name:</label>'
                 +'<input type="text" name="pet_name[]" placeholder="Pet Name" class="form-control">'
                 +'</div>'
                 +'<div class="col-md-3">'
                 +'<label class="display-block">Number:</label>'
                 +'<input type="text" name="pet_number[]" placeholder="Number" class="form-control">'
                 +'</div>'
                 +'<div class="col-md-3">'
                 +'<button style="margin-top:18%;" class="btn btn-danger remove-pet"><span class="glyphicon glyphicon-remove"></span>Delete</button>'
                 +'</div>'
                 +'</div>';
                 $("#pet-container").append(html);

    });

    


     $("body").on('click','.dremove-me,.remove-vehicle',function(e){
             var item=$(this).parent().parent();
             $(item).remove();
             });


         $("body").on('click','.remove-persons',function(e){
             var item=$(this).parent().parent();
             $(item).remove();
             });


     $("#vehicle").on("change",function(){
        var value=$(this).val();
         if(value=="Yes"){
            $("#vehicle-container").removeClass("hidden");
         }else{
            $("#vehicle-container").addClass("hidden");
         }

     });


     $("#add-vehicle").on('click',function(e){
         e.preventDefault();
        var html='<div id="inner-vehicle-container">'
                 +'<div class="col-md-6">'
                 +'<label class="display-block">Body Type:</label>'
                 +'<select name="body_type[]" data-placeholder="Choose an option..." class="form-control r">'
                 +'<option value="" selected>--Select One--</option>'
                 +'<option value="Bus">Bus</option> '
                 +'<option value="Matatu">Matatu</option>' 
                 +'<option value="Lorry">Lorry</option>'
                +'<option value="Car">Car</option>' 
                 +'<option value="Motocycle">Motocycle</option>'
                 +'</select>'
                 +'</div>'
                 +'<div class="col-md-3">'
                 +'<label class="display-block">Number:</label>'
                 +'<input type="text" name="vehicle_number[]" placeholder="Number" class="form-control">'
                 +'</div>'
                 +'<div class="col-md-3">'
                 +'<button style="margin-top:18%;" class="btn btn-danger remove-vehicle"><span class="glyphicon glyphicon-remove"></span>Delete</button>'
                 +'</div>'
                 +'</div>';
                 $("#vehicle-container").append(html);

    });

     $("#add-tenant-items").on("click",function(e){
         e.preventDefault();
         var html='<div class="col-md-12" style="margin-top:2%;">'
                  +'<div class="col-md-3">'
                  +'<label>Type</label>'
                  +'<select class="form-control" name="item_type[]">'
                  +'<Option>Electronic</Option>'
                  +'<Option>Vehicle</Option>'
                  +'<Option>Pet</Option>'
                  +'</select>'
                  +'</div>'
                  +'<div class="col-md-3">'
                  +'<label>Name/Make</label>'
                  +'<input type="text" name="item_name[]" class="form-control" >'
                  +'</div>'
                  +'<div class="col-md-3">'
                  +'<label>Number</label>'

                  +'<input  type="text" name="item_number[]"  class="form-control" >'
                   
                  +'</div>'
                  +'<div class="col-md-3" style="margin-top: 3.45%;">'
                +'<button class="btn btn-danger">Remove Item</button>'
                +'</div>'
                +'</div>';
              $("#item-container").append(html);


     })



      function showMyID(fileInput) {
            $("#passport").css({'color': 'Black',
                         'height':'205px',
                         'width':'330px',
                         'font-size':'24px',

                       });

        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("passport");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }



    var mytype="<?=$model->type?>";
       if(mytype=="Employed"){

       $(".employer").removeClass("hidden");
        $(".student").addClass("hidden");
       }else if(mytype=="Student"){
         $(".student").removeClass("hidden");
        $(".employer").addClass("hidden");
       }

    $("#employer").on("change",function(){
        var value=$(this).val();
        alert(value);
    if(value=="Employed"){
        $(".employer").removeClass("hidden");
        $(".student").addClass("hidden");
    }else if(value=="Student"){
         $(".student").removeClass("hidden");
        $(".employer").addClass("hidden");

    }
     

    });


    $(".radio-inline ").on('click',function(){
      var them=($("input[name=has_requirement]:checked").val());

       if(them=="Yes"){
        $(".requirement").removeClass("hidden");
          $(".checking").addAttr("readonly",true);
          
         
       }else{

         $(".requirement").addClass("hidden");
         $(".checking").prop("readonly", true);
       }
     

    });

     var themt="<?=$model->has_requirement?>";
       if(themt=="Yes"){
        $(".requirement").removeClass("hidden");
          $(".checking").addAttr("readonly",true);
          
         
       }else{

         $(".requirement").addClass("hidden");
         $(".checking").prop("readonly", true);
       }



    $("#add-person").on("click",function(e){
        e.preventDefault();
        var html='<div class="row">'
                 +'<div class="form-group col-md-4">'
                 +'<label>Name</label>'
                 +'<input type="text" name="person_name[]" placeholder="Full Name" class="form-control ">'
                 +'</div>'
                 +'<div class="form-group col-md-2">'
                 +'<label>Identification</label>'
                 +'<select class="form-control" name="identification[]">'
                 +'<option value="National ID">National ID</option>'
                 +'<option value="Birth Certificate">Birth Certificate</option>'
                 +'<option value="Passport">Passport Number</option>'
                 +'<option value="Allien Card">Allien Card</option>'
                 +'</select>'
                 +'</div>'
                 +'<div class="form-group col-md-2">'
                 +'<label>Number</label>'
                 +'<input type="text" name="occupant_number[]" placeholder="Number" class="form-control ">'
                 +'</div>'
                 +'<div class="form-group col-md-2">'
                 +'<label>Age</label>'
                 +'<input type="text" name="age[]" placeholder="Age" class="form-control ">'
                 +'</div>'
                 +'<div class="form-group col-md-2">'
                 +'<button class="btn btn-danger remove-persons" style="margin-top:25%;" >'
                 +'<span class="glyphicon glyphicon-remove"></span>Remove</button>'
                 +'</div>'
                 +'</div>'
                 +'</div>';

            $("#persons-container").append(html);


    });


    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });

    $( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true,
    dateFormat: 'yy-mm-dd',
    });

     


      $("#add-charge").on('click',function(e){
        e.preventDefault();
         var html='<div class="row">'
                   +'<div class="form-group col-md-4">'
                    +'<label>Name</label>'
                    +'<input type="text" name="charge[]" placeholder="Charge Name" class="form-control " >'
                    +'</div>'
                    +'<div class="form-group col-md-3">'
                    +'<label>Amount</label>'
                    +'<input type="text" name="amount[]" placeholder="Amount" class="form-control ">'
                    +'</div>'
                    +'<div class="form-group col-md-3">'
                    +'<label>Effective Date</label>'
                    +'<input type="text" name="effective_from[]" placeholder="Effecive Date" class="form-control datepicker">'
                    +'</div>'
                    +'<div class="form-group col-md-2">'
                    +'<button class="btn btn-danger remove-charge" style="margin-top:25%;">'
                    +'<span class="glyphicon glyphicon-remove"></span>Remove</button>'
                    +'</div>'
                    +'</div>';

    $("#charges-container").append(html);            

     });

       $("body").on('click','.remove-charge',function(e){
             var item=$(this).parent().parent();
             $(item).remove();
             });


      $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
    dateFormat: 'yy-mm-dd',
    });




</script>
@endpush
