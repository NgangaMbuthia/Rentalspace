@extends('layout.wizard')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        
        <li><a href="<?=url('/backend/tenants/listView')?>">Tenants List</a></li>
        <li class="active">Create Account</li>
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
@include('backend::tenants.t_head')

<div>
    <p>
          <a href="<?=url('backend/tenants/import')?>" class="btn btn-primary "><span class="glyphicon glyphicon-upload"></span>Import Tenants</a>
    </p>
  
    

</div>
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Add New Tenants</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation"   enctype="multipart/form-data" role="form" action="<?=url('/backend/tenants/store')?>" method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">Personal Details</legend>
                                {{csrf_field()}}

                                <div class="row" style="margin-top: 5%;">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <select class="form-control" name="property_id" id="property">
                                    <option value="">--Select Property--</option>
                                    <?php foreach($properties as $property):?>
                                     <option value="<?=$property->id?>">{{$property->title}}-- {{$property->location}}</option>

                                    <?php endforeach;?>
                                        

                                    </select>
                                  
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
                                    <select class="form-control" name="space_id"  id="spaces">
                                     <option value="">----Select Space Number/Name ----</option>
                                        

                                    </select>
                                  
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
                                     <input type="text" class="form-control" name="name" placeholder="Full Names"  value="{{old('name')}}"/>
                                  
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
                                     <input type="text" class="form-control" name="id_number" placeholder="ID Number"  value="{{old('id_number')}}" />
                                  
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
                                     <input type="text" class="form-control" name="email" placeholder="Email Address"  value="{{old('email')}}" />
                                  
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
                                            <input type="text" name="phone" class="form-control" placeholder="Mobile Number">

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
                                     <input type="text" class="form-control" name="postal_address" placeholder="Postal Address" value="{{old('postal_address')}}" />
                                  
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
                                     <select class="form-control" name="gender" >
                                         <option value=" ">--Select Gender---</option>
                                         <option>Male</option>
                                         <option>Female</option>

                                     </select>
                                  
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
                                     <input type="text" class="form-control" name="entry_date" placeholder="Lease Start Date" value="{{old('entry_date')}}"  id="datepicker2" />
                                  
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

                                    <input type="text" class="form-control" name="expected_end_date" placeholder="Lease End Date" value="{{old('deposit')}}" id="datepicker"  />
                                     
                                  
                                     @if ($errors->has('expected_end_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expected_end_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>





                                </div>
                                <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Occupants Detail</legend>
                                     
                                <div class="row">
                                <legend><b>EMERGENCY CONTACT:</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name: <span class="text-danger">*</span></label>
                                            <input type="text" name="kin_name" placeholder="Next of Kin" class="form-control required" value="<?=old('kin_name')?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship:</label>
                                            <select name="relationship" data-placeholder="Choose a Relationship..." class="form-control" required>
                                                <option value=""></option> 
                                                <option value="Spouse">Spouse</option> 
                                                <option value="Child">Child</option> 
                                                <option value="Brother">Brother</option> 
                                                <option value="Sister">Sister</option> 
                                                <option value="Parent">Parent</option>
                                                <option>WorkMate</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Address: <span class="text-danger">*</span></label>
                                            <input type="text" name="conatct_postal_address" placeholder="Postal Address" class="form-control required" value="{{old('conatct_postal_address')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Postal Code:</label>
                                            <input type="text" name="conatct_postal_address" placeholder="Postal Code." class="form-control"
                                             value="<?=old('conatct_postal_address')?>"
                                            >
                                        </div>
                                    </div>

                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email  Address: <span class="text-danger">*</span></label>
                                            <input type="text" name="kin_email" placeholder="Email Address" class="form-control" value="<?=old('kin_email')?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Telephone:</label>
                                            <input type="text" name="tel" class="form-control" placeholder="Mobile Number"  required value="<?=old('tel')?>">
                                        </div>
                                    </div>

                                   
                                </div>


                                <div class="row">
                                <legend><b>Other Space Occupants :</b></legend>
                                <strong>Hint:Those who will also be using the premises with you</strong>
                                <div id="button-holder " class="col-md-12">

                                <button class="btn btn-info pull-right" style="margin-bottom:1%" id="add-person">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add Person
                                </button>
                                    
                                </div>
                                <div id="persons-container">
                                <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" name="person_name[]" placeholder="Full Name" class="form-control ">
                                    
                                </div>
                                <div class="form-group col-md-2">
                                <label>Identification</label>
                                <select class="form-control" name="identification[]">
                                <option value="National ID">National ID</option>
                                <option value="Birth Certificate">Birth Certificate</option>
                                <option value="Passport">Passport Number</option>
                                <option value="Allien Card">Allien Card</option>
                                    

                                </select>
                                    
                                </div>
                                 <div class="form-group col-md-2">
                                <label>Number</label>
                                <input type="text" name="occupant_number[]" placeholder="Number" class="form-control ">
                                    
                                </div>


                                <div class="form-group col-md-2">
                                <label>Age</label>
                                <input type="text" name="age[]" placeholder="Age" class="form-control ">
                                    
                                </div>

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-persons" style="margin-top:18%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                    

                                </div>
                                </div>
                                    


                                </div>
                            </fieldset>

                            <fieldset title="3">
                                <legend class="text-semibold">Possession Details</legend>

                                   <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Do You Have Pets: <span class="text-danger">*</span></label>
                                            <select class="form-control" name="do_you_have_pet" id="pet">
                                            <option value="">--Select Pet Type--</option>
                                            <option>Yes</option>
                                            <option>No</option> 

                                            </select>
                                           
                                        </div>

                                    </div>
                                    </div>
                                    <div class="row hidden" id="pet-container">
                                    <div id="inner-container">
                                    <div class="col-md-6">
                                    <label class="display-block">Pet Name:</label>
                                       <input type="text" name="pet_name[]" placeholder="Pet Name" class="form-control">
                                    </div>


                                    <div class="col-md-3">
                                    <label class="display-block">Number:</label>
                                       <input type="text" name="pet_number[]" placeholder="Number" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                    
                                       <button class="btn btn-info" style="margin-top:12%;" id="add-pet"><span class="glyphicon glyphicon-plus"></span>Add Pet</button>
                                    </div>
                                    </div>
                                    </div>

                                    <div >
                                     <legend>Vehicle Details</legend>

                                      <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Do You Have Vehicles: <span class="text-danger">*</span></label>
                                                <select class="form-control" name="do_you_have_vehicle" id="vehicle">
                                                <option value="" selected>--Select One--</option>
                                                <option>Yes</option>
                                                <option>No</option> 

                                                </select>
                                               
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row hidden" id="vehicle-container">
                                    <div id="inner-vehicle-container">

                                    <div class="col-md-6">
                                    <label class="display-block">Body Type:</label>
                                      <select name="body_type[]" data-placeholder="Choose an option..." class="form-control ">
                                                <option value="" selected>--Select One--</option>
                                                <option value="Bus">Bus</option> 
                                                <option value="Matatu">Matatu</option> 
                                                <option value="Lorry">Lorry</option> 
                                                <option value="Car">Car</option> 
                                                <option value="Motocycle">Motocycle</option>
                                            </select>
                                    </div>


                                    <div class="col-md-3">
                                    <label class="display-block">Number:</label>
                                       <input type="text" name="vehicle_number[]" placeholder="Number" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                    
                                       <button class="btn btn-info" style="margin-top:12%;" id="add-vehicle"><span class="glyphicon glyphicon-plus"></span>Add Vehicle</button>
                                    </div>
                                    </div>
                                    </div>
                                        



                                    </div>
                                    
                                     
                                          
                                      <div class="row" style="margin-top: 5%;margin-bottom: 6%;">
                                      <legend>Smoking Habits</legend>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Do You Have Smoker(s): <span class="text-danger">*</span></label>
                                                <select class="form-control" name="do_you_have_smokers" id="vehicle">
                                                <option value="" selected>--Select One--</option>
                                                <option>Yes</option>
                                                <option>No</option> 

                                                </select>
                                               
                                            </div>

                                        </div>
                                        <div class="col-md-7 hidden">
                                            <div class="form-group">
                                                <label>Number: <span class="text-danger">*</span></label>
                                                <input type="text" value="0" name="smoker_number" placeholder="Number" class="form-control">
                                               
                                            </div>

                                        </div>
                                    </div>
                                    <p>
                                    </p>


                            </fieldset>

                            <fieldset title="4">
                                <legend class="text-semibold">Additional info</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="display-block">Applicant Scanned ID Number:</label>
                                            <input style="margin-top:2%;" type="file" name="bio_data_page" class="" id="gallery-photo-add" placeholder="Passport Size Photo
                                                            2x2 inches
                                                            200kb" data-parsley-group="experience"   accept="image/*"  onchange="showMyID(this)" />
                                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="display-block">Preview:</label>
                                            <img class="img-responsive gallery" src="{{asset('/assets/images/dd.jpg')}}" alt="" style="border-radius:5%;" id="passport" style="height:170px;width:300px;">
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row" style="margin-top: 5%;">
                                <legend><b>Employment Details:,</b></legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation Details: <span class="text-danger">*</span></label>
                                             <select class="form-control " name="employement_type" id="employer" >
                                                <option value="" >--Select One--</option>
                                                <option value="Employed">Employed</option>
                                                <option value="Self Employed">Self Employment</option> 
                                                <option value="Student">Student</option>

                                                </select>
                                            
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                                <div class="row employer hidden">
                                <div class='form-group col-md-6'>
                                    <label>Current Employer: <span class="text-danger">*</span></label>
                                     <input type="text" name="employer" placeholder="Current Employer" class="form-control" >
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Job Title: <span class="text-danger">*</span></label>
                                     <input type="text" name="job_title" placeholder="Job Title" class="form-control">
                                </div>
                                </div>
                                 <div class="row employer hidden">
                                <div class='form-group col-md-6'>
                                    <label>Contact Name For Reference: <span class="text-danger">*</span></label>
                                     <input type="text" name="reference_name" placeholder="Full Name" class="form-control">
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Contact Telephone: <span class="text-danger">*</span></label>
                                      <input type="text" name="reference_phone" class="form-control" placeholder="Mobile Number" data-mask="+99-99-9999-9999" >
                                </div>
                                </div>


                                <div class="row student hidden">
                                <legend><b>Student Details</b></legend>
                                <div class='form-group col-md-6'>
                                    <label>University/College: <span class="text-danger">*</span></label>
                                     <input type="text" name="university_name" placeholder="School Name" class="form-control" >
                                </div>
                                <div class='form-group col-md-6'>
                                    <label>Year of study: <span class="text-danger">*</span></label>
                                     <input type="text" name="year_of_study" placeholder="Year Of Study" class="form-control">
                                </div>
                                </div>
                                 <div class="row student hidden">
                                <div class='form-group col-md-6'>
                                    <label>Course title: <span class="text-danger">*</span></label>
                                     <input type="text" name="course" placeholder="Course Title" class="form-control">
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
                                     <input type="text" name="reg_number" placeholder="Admission Number" class="form-control">
                                </div>
                                
                                </div>



                                <div class="row" style="margin-top: 5%;">
                                <legend><b>Tenant's Requirements</b></legend>
                                <div class="col-md-12 form-group">
                                <label>DO YOU HAVE ANY REQUIREMENTS TO TAKE THIS PROPERTY? (e.g. pets/unfurnished/request an item of furniture)</label><br>

                                <input class="radio-inline privous-license" required type="radio" name="has_requirement" value="No">NO
                                <input class="radio-inline" required type="radio" name="has_requirement" value="Yes"  style='margin-left:30%;'>Yes
                                </div>
                                <div class="col-md-12 form-group hidden requirement">
                                <label>Description</label>
                                 <textarea rows="4" class="form-control"  value="<?=old('requirement')?>" name="requirement"></textarea>
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
                                   <div id="button-holder " class="col-md-10">

                                <button class="btn btn-info pull-right" style="margin-bottom:1%" id="add-charge">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add Charge
                                </button>
                                    
                                </div>

                                 <div id="charges-container">
                                  <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                <select name="charge[]"  class="form-control" required>
                                    <?php foreach($charges as $charge):?>
                                         <option  <?php if($charge->name=="Deposit"):?>selected <?php endif;?>><?=$charge->name;?></option>
                                     <?php endforeach;?>
                                    
                                </select>
                               
                                    
                                </div>
                                
                                 <div class="form-group col-md-4">
                                <label>Amount</label>
                                <input type="text" name="amount[]" placeholder="Amount" class="form-control number" id="my-deposit">
                                    
                                </div>


                                

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-charged" style="margin-top:18%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                    

                                </div>
                                <div class="row">

                                <div class="form-group col-md-4">
                                <label>Name</label>
                                    <select name="charge[]"  class="form-control" required>
                                    <?php foreach($charges as $charge):?>
                                         <option  <?php if($charge->name=="Rent"):?>selected <?php endif;?>><?=$charge->name;?></option>
                                     <?php endforeach;?>
                                    </select>
                                    
                                </div>
                                
                                 <div class="form-group col-md-4">
                                <label>Amount</label>
                                <input type="text" name="amount[]" placeholder="Amount" class="form-control number" id="rent">
                                    
                                </div>


                                

                                <div class="form-group col-md-2">
                                
                                <button class="btn btn-danger remove-charged" style="margin-top:18%;">
                                <span class="glyphicon glyphicon-remove"></span>Remove</button>
                                    
                                </div>
                                </div>



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
      $("body").on('click','.remove-charged',function(e){
       e.preventDefault();
          var item=$(this).parent().parent();
             $(item).remove();
         
             
             });



         $("body").on('click','.remove-charge',function(e){
             var item=$(this).parent().parent();
             $(item).remove();
             });

     


            $("body").on("keydown",".number",function(e){
                
      var key = e.keyCode ? e.keyCode : e.which;
    if ( isNaN( String.fromCharCode(key) ) && key != 8 && key != 46  &&key != 190 &&key !=110 &&key !=37 &&key !=39) return false;


      });



   
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

     $("#spaces").on("change",function(e){
        e.preventDefault();
         var id=$(this).val();
       
       var length=id.length;
       var token="<?=csrf_token();?>";
        if(length>=1){
        var url="<?=url('/backend/fetch/space_price')?>/"+id;
         $.post(url,{'_token':token},function(data){
           
            $("#my-deposit").val(data);
            $("#rent").val(data);

         });
       
      }

     });


    $("#pet").on("change",function(){
       var value=$(this).val();
         if(value=="Yes"){
            var html='<div class="row" id="pet-fee">'
                   +'<div class="form-group col-md-4">'
                    +'<label>Charge Name</label>'
                  +'<select name="charge[]"  class="form-control" required>'
                    +'<?php foreach($charges as $charge):?>'
                    +'<option  <?php if(preg_match('/Pet Fee/i',$charge->name )):?>selected <?php endif;?>><?=$charge->name;?></option>'
                    +'<?php endforeach;?>'
                    +'</select>'
                    +'</div>'
                    +'<div class="form-group col-md-4">'
                    +'<label>Amount</label>'
                     +'<input type="text" name="amount[]" placeholder="Amount" class="form-control number">'
                    +'</div>'
                     +'<div class="form-group col-md-2">'
                                
                       +'<button class="btn btn-danger remove-charge" style="margin-top:18%;">'
                        +'<span class="glyphicon glyphicon-remove"></span>Remove</button>'
                                    
                        +'</div>'
                        +'</div>';

    $("#charges-container").append(html);  




            $("#pet-container").removeClass("hidden");
         }else{
            $("#pet-container").addClass("hidden");
            $("#pet-fee").addClass("hidden");
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
                 +'<button style="margin-top:12%;" class="btn btn-danger remove-pet"><span class="glyphicon glyphicon-remove"></span>Delete</button>'
                 +'</div>'
                 +'</div>';
                 $("#pet-container").append(html);

    });

     $("#add-charge").on('click',function(e){
        e.preventDefault();
         var html='<div class="row">'
                   +'<div class="form-group col-md-4">'
                    +'<label>Name</label>'
                     +'<select name="charge[]"  class="form-control" required>'
                    +'<?php foreach($charges as $charge):?>'
                    +'<option><?=$charge->name;?></option>'
                    +'<?php endforeach;?>'
                    +'</select>'
                    +'</div>'
                    +'<div class="form-group col-md-4">'
                    +'<label>Amount</label>'
                     +'<input type="text" name="amount[]" placeholder="Amount" class="form-control number">'
                     +'</div>'
                     +'<div class="form-group col-md-2">'
                                
                       +'<button class="btn btn-danger remove-charged" style="margin-top:18%;">'
                        +'<span class="glyphicon glyphicon-remove"></span>Remove</button>'
                                    
                        +'</div>'
                        +'</div>';

    $("#charges-container").append(html);            

     });

    


     $("body").on('click','.remove-pet,.remove-vehicle',function(e){
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
            var html='<div class="row" id="parking-fees">'
                    +'<div class="form-group col-md-4">'
                    +'<label>Charge Name</label>'
                    +'<select name="charge[]"  class="form-control" required>'
                    +'<?php foreach($charges as $charge):?>'
                    +'<option  <?php if(preg_match('/Parking Fee/i',$charge->name )):?>selected <?php endif;?>><?=$charge->name;?></option>'
                    +'<?php endforeach;?>'
                    +'</select>'
                    +'</div>'
                    +'<div class="form-group col-md-4">'
                    +'<label>Amount</label>'
                    +'<input type="text" name="amount[]" placeholder="Amount" class="form-control number ">'
                    +'</div>'
                    +'<div class="form-group col-md-2">'
                    +'<button class="btn btn-danger remove-charged" style="margin-top:18%;">'
                    +'<span class="glyphicon glyphicon-remove"></span>Remove</button>'
                    +'</div>'
                +'</div>';

    $("#charges-container").append(html); 
         }else{
            $("#vehicle-container").addClass("hidden");
            $("#parking-fees").addClass("hidden");
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
                 +'<button style="margin-top:12%;" class="btn btn-danger remove-vehicle"><span class="glyphicon glyphicon-remove"></span>Delete</button>'
                 +'</div>'
                 +'</div>';
                 $("#vehicle-container").append(html);


    });



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

    $("#employer").on("change",function(){
        var value=$(this).val();
    if(value=="Employed"){
        $(".employer").removeClass("hidden");
        $(".student").addClass("hidden");
    }
    else if(value=="Self Employed"){
          $(".student").addClass("hidden");
        $(".employer").addClass("hidden");
    }

    else if(value=="Student"){
       
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
                 +'<button class="btn btn-danger remove-persons" style="margin-top:18%;" >'
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
    maxDate:0,
    });


     

   



</script>
@endpush
