<?php
use App\Helpers\Helper;
?>

@extends('layout.wizard')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="<?=url('/backend/space/listView')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Spaces</span></a>
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')

<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
       
        <li class="active">Provider Account</li>
</ol>
<ul class="breadcrumb-elements">
              <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-gear position-left"></i>
                  Settings
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="<?=url('/backend/property/statistics')?>"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>

@stop

@section('content')

                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Complete Personal Profile</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=url('/serviceproviders/provider/store')?>"  method="post" enctype="multipart/form-data" >
                            <fieldset title="1">
                                <legend class="text-semibold">Basic Details</legend>
                                {{csrf_field()}}

                                <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?=@auth::user()->name;?>" required>
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Mobile</label>
                                   <input type="text" class="form-control" name="telephone" value="<?=@auth::user()->profile->telephone;?>" required>
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                        

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>ID Number<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input type="text" class="form-control" name="id_number" value="<?=@auth::user()->profile->id_number;?>" required>
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email Address<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                             <input type="text" class="form-control" name="email" value="<?=@auth::user()->email;?>" required>
                             @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                         <div class="row">

                           



                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Postal Address</label>
                                   <input type="text" class="form-control" name="postal_address" value="<?=@auth::user()->profile->postal_address;?>" required>
                                     @if ($errors->has('postal_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postal_address') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country" value="<?=@auth::user()->sprovider->current_nationality?>" required>
                                     @if ($errors->has('country'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                             <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Town</label>
                                    <input type="text" placeholder="Town" class="form-control" name="city" value="<?=@auth::user()->sprovider->town?>"> 
                                     @if ($errors->has('city'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                             <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Location</label>
                                    <input type="text" placeholder="Town" class="form-control" name="city" value="<?=@auth::user()->sprovider->location?>"> 
                                     @if ($errors->has('street'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('street') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                           

                           
                            
                           
                        </div>

                       

                   <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Education Details</legend>

                                <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Highiest Qualification<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <select class="form-control" name="qualification">
                            <option 
                             <?php if(auth::user()->sprovider->qualification=="Primary"):?>
                               selected
                             <?php endif;?>
                            >Primary</option>
                            <option
                            <?php if(auth::user()->sprovider->qualification=="Secondary"):?>
                               selected
                             <?php endif;?>


                            >Secondary</option>
                            <option

                            <?php if(auth::user()->sprovider->qualification=="Polytechnic"):?>
                               selected
                             <?php endif;?>

                            >Polytechnic</option>
                            <option
                            <?php if(auth::user()->sprovider->qualification=="College"):?>
                               selected
                             <?php endif;?>>College</option>
                            <option

                            <?php if(auth::user()->sprovider->qualification=="University"):?>
                               selected
                             <?php endif;?>

                            >University</option>
                           
                        </select>
                             @if ($errors->has('qualification'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('qualification') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('institution') ? ' has-error' : '' }}">
                            <label>Institution<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                             <input type="text" class="form-control" name="institution" value="<?=@auth::user()->sprovider->institution;?>" required>
                             @if ($errors->has('institution'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('institution') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>


                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Type<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                             <?php $type_array=array("Electrician","Carpenter","Mason","Plumber","Welder","Glazer","Plasterer","Painter","Roofing","Interior Designer");?>


                             <select class="form-control" name="type" required>
                              <option value="">---Select Type--</option>
                                <?php foreach($type_array as $key):?>
                                  <option
                                   <?php if(@auth::user()->sprovider->type==strtoupper($key)):?>
                                     selected
                                   <?php endif;?>

                                  ><?=$key;?></option>

                                <?php endforeach;?>


                            
                        </select>
                             @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('year') ? ' has-error' : '' }}">
                            <label>Years Of Experience<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                            <?php $years_of_array=array("Less Than 1 Year","2 Years","5 Years","10 Years","Above 10 Year");?>


                             <select class="form-control" name="years" required>
                             <option value="">----Select Years of Experience--</option>
                             <?php foreach($years_of_array as $year):?>
                              <option

                              <?php if(auth::user()->sprovider->years==$year):?>
                                selected
                              <?php endif;?>



                              ><?=$year;?></option>

                             <?php endforeach;?>
                            
                             </select>
                             @if ($errors->has('year'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>

                            
                           
                           
                        </div>    
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>

                           

                           
                            <fieldset title="3">
                                <legend class="text-semibold">Verification Documents</legend>
                                

                             

                        
                        <div class="row">

                         <div class="row">
                            <div class="col-md-5">
                            <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="display-block">Scanned National ID:</label>
                                            <input  style="margin-top:2%;" type="file" name="scanned_id" class="" id="gallery-photo-add"   onchange="showMyID(this)" />
                                            <span class="help-block">Accepted formats: pdf and Max file size 2Mb</span>
                                        </div>
                                    </div>
                                     <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="display-block">Preview:</label>
                                            <?php if(!empty(@auth::user()->sprovider->scanned_id)):
                                            $path=@auth::user()->sprovider->scanned_id;
                                             ?>
                                            <img class="img-responsive gallery" src="<?=url('/images/'.$path);?>" alt="nouu" style="border-radius:5%;" id="passport" style="height:120px;width:300px;">
                                          <?php else:?>
                                            <img class="img-responsive gallery" src="{{asset('/assets/images/dd.jpg')}}" alt="" style="border-radius:5%;" id="passport" style="height:120px;width:300px;">
                                        <?php endif;?>
                                        </div>
                                    </div>
                                
                            </div>

                             <div class="col-md-5 pull-right">
                            <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="display-block">Good Conduct:</label>
                                            <input style="margin-top:2%;" type="file" name="good_conduct" class="" id="gallery-photo-add2" placeholder="" data-parsley-group="experience"   accept="image/*"  onchange="showMyID2(this)" />
                                            
                                        </div>
                                    </div>
                                     <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="display-block">Preview:</label>
                                            <?php if(!empty(@auth::user()->sprovider->good_conduct)):
                                            $path=@auth::user()->sprovider->good_conduct;
                                             ?>

                                             <img class="img-responsive gallery" src="<?=url('/images/'.$path);?>" alt="" style="border-radius:5%;" id="passport2" style="height:120px;width:300px;">

                                             <?php else:?>
                                            <img class="img-responsive gallery" src="{{asset('/assets/images/cert.jpeg')}}" alt="" style="border-radius:5%;" id="passport2" style="height:120px;width:300px;">
                                            <?php endif;?>
                                        </div>
                                    </div>
                                
                            </div>

                        </div>











                           

                            
                        </div>
                        

                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                     </fieldset>
                        <fieldset title="2">

                                <legend class="text-semibold">Referees' Details</legend>

                                <div class="row">
                                <div class="alert alert-info">
                                Kindly provide us with two referees that you have worked for previously.
                                    
                                </div>
                        <div class="form-group col-md-6 {{ $errors->has('first_ref') ? ' has-error' : '' }}">
                            <label>First Referee Name<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input type="text" class="form-control" name="first_ref" value="<?=@auth::user()->sprovider->first_ref;?>" required>
                             @if ($errors->has('first_ref'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_ref') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('ref_one_phone') ? ' has-error' : '' }}">
                            <label>First Referee Mobile<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                             <input type="text" class="form-control" name="ref_one_phone" value="<?=@auth::user()->sprovider->ref_one_phone;?>" required>
                             @if ($errors->has('ref_one_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ref_one_phone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Second Referee Name<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                             <input type="text" class="form-control" name="second_ref" value="<?=@auth::user()->sprovider->second_ref;?>" required>
                             @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>


                         <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Second Referee Mobile<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input type="text" class="form-control" name="ref_two_phone" value="<?=@auth::user()->sprovider->ref_two_phone;?>" required>
                             @if ($errors->has('ref_two_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('ref_two_phone') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                           <legend>Payments</legend>

                         <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Daily Price<span  class="label label-default"></span> <span  class="label label-default"></span></label>
                             <input type="text" class="form-control" name="daily_price" value="<?=@auth::user()->sprovider->daily_price;?>" required>
                             @if ($errors->has('daily_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('daily_price') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>


                         <div class="form-group col-md-6 {{ $errors->has('payment_frequency') ? ' has-error' : '' }}">
                            <label>Payment Frequency<span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                             <select class="form-control" name="payment_frequency">
                            <option

                             <?php if(@auth::user()->sprovider->payment_frequency=="Immediately After Job"):?>selected<?php endif;?> >Immediately After Job</option>
                            <option
                            <?php if(@auth::user()->sprovider->payment_frequency=="Weekly"):?>selected<?php endif;?>

                            >Weekly</option>
                            <option
                            <?php if(@auth::user()->sprovider->payment_frequency=="Monthly"):?>selected<?php endif;?>

                            >Monthly</option>
                           
                        </select>
                             @if ($errors->has('payment_frequency'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('payment_frequency') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         
                   </div>    
                                     
                        <div class="clearfix"></div>
                        <div class="row">
                        <div class="col-md-12">
                        
                        By Submitting this form means you have read and agree to abid by our rules and regulations.<br>
                        <input type="checkbox" name="agreement" required>
                            
                        </div>
                            
                        </div>
                                
                            </fieldset>
                                     <div class="clearfix"></div>

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    
                </div>
            </div>

           
            




{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>

<script type="text/javascript">
    
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


</script>

<script type="text/javascript">
    
     function showMyID2(fileInput) {
            $("#passport2").css({'color': 'Black',
                         'height':'150px',
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
            var img=document.getElementById("passport2");            
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


</script>
@endpush