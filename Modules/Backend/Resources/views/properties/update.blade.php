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


<style type="text/css">
          #submit-map {
            margin-bottom: 20px;
          }
          #submit-map {
            height: 320px;
            width: 100%;
         }
</style>

@stop
@section('breadcrumb')


<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li class="active">Index</li>
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
@include('backend::properties.t_head')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Edit Property Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=url('/backend/property/update_details/'.$model->id)?>"  method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">General Details</legend>
                                {{csrf_field()}}

                                <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property Title</label>
                                    <input type="text" class="form-control" name="title" value="<?=$model->title?>">
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Purpose</label>
                                   <select name="type" id="purpose" class="form-control" required>
                                   <option value="">--Select Purpose--</option>
                                   <option  <?php if($model->type=="For Rent"): ?> selected <?php endif;?>>For Rent</option>
                                   <option <?php if($model->type=="For Sale"): ?> selected <?php endif;?>>For Sale</option>
                                       

                                   </select>
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                        <div class="row hidden" id="for-sale">
                         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('currency') ? ' has-error' : '' }}">
                                    <label>Currency</label>
                                   <select name="currency" class="form-control" >
                                   <option value="">--Select Currency--</option>
                                   <option <?php if($model->currency=="KES"):?>selected <?php endif;?>>KES</option>
                                   <option <?php if($model->currency=="USD"):?>selected  <?php endif;?> 
                                   value="USD">USD</option>
                                   <option <?php if($model->currency=="EURO"):?>selected   <?php endif;?> value="EURO"> Euros</option>
                                   <option <?php if($model->currency=="POUND"):?>selected   <?php endif;?>  value="POUND">Sterling Pounds</option>


                                       

                                   </select>
                                     @if ($errors->has('currency'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('unit_price') ? ' has-error' : '' }}">
                                    <label>Selling Price</label>
                                    <input type="text" value="<?=$model->unit_price;?>" name="unit_price" class="form-control">
                                     @if ($errors->has('unit_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit_price') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            

                        </div>
                        <div class="row">

                           <div class="form-group col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label>Category</label>
                             <select class="form-control" name="category_id" id="category">
                                
                             <option value="">---Select Category----</option>

                             <?php foreach($categories as $category):?>
                                <option  <?php if($model->category_id==$category->id):?> selected    <?php endif;?>value="<?=$category->id?>"><?=$category->name;?></option>


                            <?php endforeach;?>
                             <option value="add">--Add New Category--</option>
                            </select>
                             @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>

                         <div class="form-group col-md-6 {{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label>Type</label>
                             <select class="form-control" name="subcategory_id" id="subcategory" required>

                            <option value="<?=$model->subcategory_id?>"><?=$model->subcategory->name?></option>
                            
                                
                            </select>
                             @if ($errors->has('subcategory_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">

                            <label>Town <span  class="label label-default"></span> <span id="longitudess" class="label label-default"></span></label>

                             <input class="form-control" name="town" type="text" id="town" placeholder="Enter a Town" autocomplete="off" value="{{$model->town}}">
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
         <label>Location <span  class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>

                            <input class="form-control" type="text" name="location"  placeholder="Enter a Location" value="{{$model->location}}" id="autocomplete1">
                             @if ($errors->has('location'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
 
                       </div>

                        <div class="row">

                        <div class="col-md-12">
                                                <section id="place-on-map">
                                                    <header class="section-title">
                                                        <h4>Place on Map</h4>
                                                       
                                                    </header>
                                                    <div class="form-group">
                                                        <label for="address-map">Address (Start Typing your address below!)</label>
                                                        <input type="text" class="form-control" id="address-map" name="address">
                                                    </div><!-- /.form-group -->
                                                    <label for="address-map">Or drag the marker to property position</label>
                                                    <div id="submit-map"></div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{$model->latitude}}" readonly required placeholder="Latitude">
                                                                @if ($errors->has('latitude'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('latitude') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="longitude" value="{{$model->longitude}}" name="longitude" readonly required placeholder="Longitude">
                                                                @if ($errors->has('longitude'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('longitude') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                    </div>
                                                </section><!-- /#place-on-map -->
                          </div>
                      </div>


   <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Longitude</label>
                            <input class="form-control" type="text" name="longitude"  placeholder="Enter a Longitude"   value="{{$model->longitude}}" id="autocomplete1">
                             @if ($errors->has('longitude'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('longitude') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Latitude</label>
                            <input class="form-control" type="text" name="latitude"  placeholder="Enter Latitude"   value="{{$model->latitude}}" id="autocomplete1">
                             @if ($errors->has('longitude'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('longitude') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                         <div class="row">

                       

                           



                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Postal Address</label>
                                     <input type="text" placeholder="Postal Address" class="form-control" name="postal_address" value="<?=$model->postal_address?>"> 
                                     @if ($errors->has('postal_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postal_address') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Country</label>
                                    <input type="text" placeholder="Country" class="form-control" name="country" value="<?=$model->country;?>"> 
                                     @if ($errors->has('country'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                             <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Street</label>
                                    <input type="text" placeholder="Street" class="form-control" name="street_road" value="<?=$model->street_road;?>"> 
                                     @if ($errors->has('street_road'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('street_road') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>





                           
                          

                           
                            
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  commercial hidden">
                                <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
                                    <label>Area</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="area" placeholder="2 ft By 12 ft">
                                         @if ($errors->has('area'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('area') }}</strong>
                                                </span>
                                            @endif
                                        <div class="input-group-addon">Sq Ft</div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                       

                   <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Amentities</legend>

                                   <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group {{ $errors->has('amentities') ? ' has-error' : '' }}">
                                    <label>Amenities</label>
                                    <div class="checkbox custom-checkbox"><label>
                                    <input type="checkbox" <?php if(in_array("In-unit laundry", $amentities)):?>checked="checked" <?php endif;?> name="amenities[]" value="In-unit laundry"><span class="fa fa-check"></span> In-unit laundry</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="On-site laundry"
                                     <?php if(in_array("On-site laundry", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> On-site laundry</label></div>

                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Security"
                                     <?php if(in_array("Security", $amentities)):?>checked="checked" <?php endif;?>
                                     ><span class="fa fa-check"></span> Security</label></div>
                                   <div class="checkbox custom-checkbox"><label>
                                   <input type="checkbox" name="amenities[]" value="Air Conditioning"
                                     <?php if(in_array("Air Conditioning", $amentities)):?>checked="checked" <?php endif;?>
                                     ><span class="fa fa-check"></span> Air Conditioning</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Balcony"
                                       <?php if(in_array("Balcony", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Balcony</label></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Dishwasher"
                                    <?php if(in_array("Dishwasher", $amentities)):?>checked="checked" <?php endif;?>
                                     ><span class="fa fa-check"></span> Dishwasher</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Natural lighting" 
                                      <?php if(in_array("Natural lighting", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Natural lighting</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Outdoor space"
                                     <?php if(in_array("Outdoor space", $amentities)):?>checked="checked" <?php endif;?>
                                     ><span class="fa fa-check"></span> Outdoor space</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="TV Cable"
                                       <?php if(in_array("TV Cable", $amentities)):?>checked="checked" <?php endif;?>
                                     ><span class="fa fa-check"></span> TV Cable</label></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Garden"
                                     <?php if(in_array("Garden", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Garden</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Storage"
                                      <?php if(in_array("Storage", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Storage</label></div>

                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Assigned parking Lots"
                                     <?php if(in_array("Assigned parking Lots", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Assigned parking Lots</label></div>

                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Shared amenities (pool, fitness center)"
                                     <?php if(in_array("Shared amenities (pool, fitness center)", $amentities)):?>checked="checked" <?php endif;?>
                                    ><span class="fa fa-check"></span> Shared amenities (pool, fitness center)</label></div>
                                </div>
                            </div>
                        </div>    
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>

                            <fieldset title="3">
                             
                             <legend class="text-semibold">Property Management</legend>


                             <div class="row">

                             <div class="form-group col-md-3 {{ $errors->has('agency') ? ' has-error' : '' }}">
                            <label>Managed BY</label>
                             <select class="form-control" name="agency" required>
                             <option value="">--Select One--</option>
                             <option <?php if($model->agency=="Personal Assistant"): ?> selected <?php endif;?>>Personal Assistant</option>
                             <option  <?php if($model->agency=="Agent"): ?> selected <?php endif;?>>Agent</option>
                             </select>
                             @if ($errors->has('agency'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('agency') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('managed_by') ? ' has-error' : '' }}">
                            <label>Manager Name </label>
                             <input class="form-control" name="managed_by" type="text" id="town" placeholder="Full Name" autocomplete="off" value="<?=$model->managed_by?>">
                             @if ($errors->has('managed_by'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('managed_by') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('manager_phone') ? ' has-error' : '' }}">
                            <label>Manager Phone </label>
                            <input class="form-control" type="text" name="manager_phone"  placeholder="Telephone" autocomplete="off" value="<?=$model->manager_phone?>">
                             @if ($errors->has('manager_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('manager_phone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('Manager_email') ? ' has-error' : '' }}">
                            <label>Manager Email </label>
                            <input class="form-control" name="Manager_email" type="text" id="town" placeholder="Email Address" autocomplete="off" value="<?=$model->Manager_email;?>">
                             @if ($errors->has('Manager_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('Manager_email') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('manager_postal') ? ' has-error' : '' }}">
                            <label>Manager Postal Address </label>
                            <input class="form-control" type="text" name="manager_postal"  placeholder="Postal Address" autocomplete="off" value="<?=$model->manager_postal?>" >
                             @if ($errors->has('manager_postal'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('manager_postal') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>



                            </fieldset>

                            <fieldset title="4">
                                <legend class="text-semibold">Payments Details</legend>

                                 <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <label>Bank Name</label>
                            <input class="form-control" name="bank_name" type="text"placeholder="Bank Name" autocomplete="off" value="<?=$model->bank_name;?>">
                             @if ($errors->has('bank_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label>Branch </label>
                            <input class="form-control" type="text" name="branch"  placeholder="Branch" autocomplete="off" value="<?=$model->branch?>" >
                             @if ($errors->has('branch'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('branch') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('account_number') ? ' has-error' : '' }}">
                            <label>Account Number</label>
                            <input class="form-control" name="account_number" type="text"  placeholder="Account Number" autocomplete="off" value="<?=$model->account_number;?>">
                             @if ($errors->has('account_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('account_number') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('account_name') ? ' has-error' : '' }}">
                            <label>Account Name </label>
                            <input class="form-control" type="text" name="account_name"  placeholder="Account Name" autocomplete="off" value="<?=$model->account_name;?>" >
                             @if ($errors->has('account_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('account_name') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('account_number') ? ' has-error' : '' }}">
                            <label>PayBill Number</label>
                            <input class="form-control" name="paybill" type="text"  placeholder="PayBill Number"  value="<?=$model->paybill;?>">
                             @if ($errors->has('paybill'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('paybill') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-3 {{ $errors->has('account_name') ? ' has-error' : '' }}">
                            <label>MPesa Mobile Number </label>
                            <input class="form-control" type="text" name="mpesa_phone"  placeholder="Account Name" autocomplete="off" value="<?=$model->mpesa_phone?>" >
                             @if ($errors->has('mpesa_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('mpesa_phone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>


                        <div class="form-group col-md-3 {{ $errors->has('tax_charged') ? ' has-error' : '' }}">
                            <label>Percentage Tax (If Applicable) </label>
                            <input class="form-control" type="text" name="tax_charged"  placeholder="Account Name" autocomplete="off" value="<?=$model->tax_charged?>" >
                             @if ($errors->has('tax_charged'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tax_charged') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                                


                            </fieldset>
                            <fieldset title="5">
                                <legend class="text-semibold">Gellary</legend>
                                

                             <div class="row">
                            <h3>Property Images</h3>

                            <div id="property_images">
                             
                                
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a href="#modal-message" class="uploadmodalwidget btn btn-default btn-sm" data-toggle="modal" id="uploadmodal" data-inputid="img_ids" data-mode="multiple" data-divid="image_array">Upload Images <i class="icon-play3 position-right"></i></a>
                                    
                                    <p class="help-block">You can select multiple images at once</p>
                                </div>


                                <div class="superbox" id="image_array">
                                <?php foreach($model->images as $image):?>

                                <div class="superbox-list" style="width:14.2%;height: 100px;margin-bottom: 2.7%;"><span title="Delete Image" class="close delete_image" data-id="<?=$image->image_id;?>" style="opacity:.9;float: left;width:100%;color: red">x</span>
                                <img src='{{Helper::getFilePath($image->image_id)}}' style='width:200px;height: 100px;' class='superbox-img' />
                                </div>


                             <?php endforeach;?>

                                </div>
                                 <div class="m-b-10">
                                  
                                            <div class="hidden change-picture">
                                                <input type="hidden" name="images" id="img_ids" value='<?php 

                                                foreach ($model->images as $image) {
                                                  echo $image->image_id.",";
                                                }
                                                ?>' />
                                            </div>
                                        </div>
                            </div>

                           

                            

                            
                        </div>

                             



                             <div class="row" style="margin-top:3%;">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">

                            <label>Other Descriptions</label>
                            <textarea class="form-control" name="description"   rows="4"><?=$model->description?></textarea>
                             @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                             </div>


                             </div>

                                   

                                    </fieldset>

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    
                </div>
            </div>

            <div class="modal fade" id="county-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="my-header">Give Reason(s)</h4>
                    </div>
                    
                    <div class="modal-body" id="load-county-details">
                    ghhghghghhghghg
                        
                    </div>               
                   
                     
                  </div>
                </div>
              </div>
            




{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="<?=url('/front/assets/js/markerwithlabel_packed.js');?>"></script>
<script type="text/javascript" src="<?=url('/front/assets/js/custom-map.js');?>"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>

<script type="text/javascript">
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript">


$(document).on("click",".delete_image",function(){
        var test=confirm("Confirm You want to delete this Image");
          if(test==true){

             $(this).parent().remove();
          var id=$(this).attr("data-id");
          var images = $("#filename4").val();
          var temp = new Array();
          var temp = images.split(',');
          $.each(temp, function( index, value ) {
            if(value != "")
            {
              if(id==value)
              {
                temp.splice( index, 1 );  
              }
              
            }
            //alert( index + ": " + value );
          });  
          var new_array="";

          $.each(temp, function( index, value ) {
            if(value !="")
            {
              new_array=new_array+value+",";
            }
            
          });  

          $("#filename4").val(new_array);

          }
            
         
        });


        $("#purpose").on('change',function(){
             var value=$(this).val();
              if(value=="For Sale"){
                 $("#for-sale").removeClass("hidden");
              }else{
                $("#for-sale").addClass("hidden");
              }

        });



        var type_test="<?=$model->type;?>";
           if(type_test=="For Sale"){
                 $("#for-sale").removeClass("hidden");
              }else{
                $("#for-sale").addClass("hidden");
              }
    $("#category").on("change",function(){

      var id=$(this).val();
      var lengths=id.length;
       var token="<?=csrf_token();?>";


       

       if(lengths >=1){
          if(id=="add"){
        var title="Add New Category";
        var url='<?=url("backend/category/add")?>';
         
            addNewCategory(title,url);
          }else{
             var url="<?=url('/backend/property/getsubcategories')?>/"+id;
           $.post(url,{'_token':token},function(data){
            $("#subcategory").html(data);
           });

          }
         
       }
    });
     var value="<?=$model->subcategory->name?>";

            if(value=="Apartments" || value=="Bungalow" ||  value=="massionate"|| value=="Apartment" ){
             $(".apartments").removeClass("hidden");
             $(".commercial").addClass("hidden");
           }else if(value=="---Select Option--"){
            $(".commercial").addClass("hidden");
            $(".apartments").addClass("hidden");

           }


      $("#subcategory").on("change",function (e){
        

        var value=$(this).val();

           if(value=="Add"){
            var cat_id= $("#category").val();
             if(cat_id==""){
             bootbox.alert("Please Select Category to create Subcategory"); 
             }else{
                addSubCategory(cat_id);
             }

           }else{

             if(value=="Apartments" || value=="Bungalow" ||  value=="massionate"){
             $(".apartments").removeClass("hidden");
             $(".commercial").addClass("hidden");
           }else if(value=="---Select Option--"){
            $(".commercial").addClass("hidden");
            $(".apartments").addClass("hidden");

           }

           else{
             $(".commercial").removeClass("hidden");
            $(".apartments").addClass("hidden");
           }

           }
        
          





      });


       
</script>
<script type="text/javascript">

  $("#purpose").on("change",function(e){
    e.preventDefault();
    var value=$(this).val();
     if(value=="For Sale"){
        $( "#price" ).attr( "required", true );
        $(".sales").removeClass("hidden");
     }else{
        $( "#price" ).attr( "required", false);
         $(".sales").addClass("hidden");
     }

  });

    
    function addNewCategory(id,url){
        
        $("#load-county-details").html("");
        $("#my-header").html(" ");
        $("#my-header").html(id);
               $("#load-county-details").load(url,function(data){
            $("#county-modal").modal("show");
             
          });
       }

       function addSubCategory(id){
        $("#load-county-details").html("");
        $("#my-header").html(" ");
        $("#my-header").html("Add New SubCategory");
        var url='<?=url("/backend/category/addsub")?>/'+id;
               $("#load-county-details").load(url,function(data){
            $("#county-modal").modal("show");
             
          });
       }


</script>


<script>
    var _latitude = <?=$model->latitude;?>;
    var _longitude = <?=$model->longitude;?>;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 15,
            center: mapCenter,
            disableDefaultUI: false,
            //scrollwheel: false,
            styles: mapStyles
        };
        var mapElement = document.getElementById('submit-map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new MarkerWithLabel({
            position: mapCenter,
            map: map,
            icon: '<?=url('front/assets/img/marker.png');?>',
            labelAnchor: new google.maps.Point(50, 0),
            draggable: true
        });
        $('#submit-map').removeClass('fade-map');
        google.maps.event.addListener(marker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').val( this.position.lat() );
            $('#longitude').val( this.position.lng() );
        });

//      Autocomplete
        var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            $('#latitude').val( marker.getPosition().lat() );
            $('#longitude').val( marker.getPosition().lng() );
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        });

    }

    function success(position) {
        initSubmitMap(position.coords.latitude, position.coords.longitude);
        $('#latitude').val( position.coords.latitude );
        $('#longitude').val( position.coords.longitude );
    }

    $('.geo-location').on("click", function() {
        if (navigator.geolocation) {
            $('#submit-map').addClass('fade-map');
            navigator.geolocation.getCurrentPosition(success);
        } else {
            error('Geo Location is not supported');
        }
    });











</script>


@endpush