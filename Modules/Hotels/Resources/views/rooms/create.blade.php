@extends('layout.wizard')
<?php
use App\Helpers\Helper;

?>
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
       <li><a href="#">Home</a></li>
       <?php if(Entrust::can("manage-hotels")):?>
        <li><a href="<?=url('/hotels/hotel/index')?>"></span>Hotels</a></li>
       <?php endif;?>
        <li><a href="<?=url('/hotels/room/index')?>"></span>Rooms</a></li>
        <li class="active">Create</li>
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

@include('hotels::hotels.s_header')

<div class="row">


  <div class="col-md-12">
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i> <?=(isset($action))?$action:'Create Hotel Room'?></h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=$url;?>"  method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">General Details</legend>
                                {{csrf_field()}}

                                <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('hotel_name') ? ' has-error' : '' }}">
                                    <label>Hotel Name</label>
                                    <select name="hotel_id" required class="form-control">
                                    <option value="">---Select Hotels---</option>
                                    <?php foreach($hotels as $hotel):?>
                                      <option value="<?=$hotel->id?>"><?=$hotel->hotel_name;?></option>

                                    <?php endforeach;?>

                                      
                                    </select>
                                     @if ($errors->has('hotel_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_id') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('room_name') ? ' has-error' : '' }}">
                                    <label>Room Name</label>
                                     <select name="room_name" class="form-control" required>
                                     <option value="">---Select Room Name---</option>
                                     <?php foreach($room_name as $roomname):?>
                                      <option><?=$roomname->name;?></option>
                                     <?php endforeach;?>
                                     
                                       
                                     </select>
                                   
                                     @if ($errors->has('room_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('bed_type') ? ' has-error' : '' }}">
                            <label>Bed Type</label>
                             <select name="bed_type" class="form-control" required>
                                     <option value="">---Select Bed Type---</option>
                                     <?php foreach($bed_types as $roomname):?>
                                      <option><?=$roomname->name;?></option>
                                     <?php endforeach;?>
                                     
                                       
                                     </select>
                            
                             @if ($errors->has('bed_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bed_type') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('hotel_telephone') ? ' has-error' : '' }}">
                            <label>Occupants</label>
                            <select name="occupants" class="form-control" required>
                              <option value="">--Select Room Occupants--</option>
                              <option>Adults</option>
                              <option>Children</option>
                              <option>Both</option>
                            </select>
                             @if ($errors->has('hotel_telephone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_telephone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                        <div class="row">

                           <div class="form-group col-md-3 {{ $errors->has('room_size') ? ' has-error' : '' }}">
                            <label>Room Size (In Metres)</label>
                            <input class="form-control" type="text" name="room_size"  placeholder="Room Size" autocomplete="off" value="<?=(isset($model->room_size))? $model->room_size:old('room_size')?>" required>
                             @if ($errors->has('room_size'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_size') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('room_size') ? ' has-error' : '' }}">
                            <label>No of Bathrooms</label>
                            <input class="form-control" type="number" name="no_of_bathrooms"  placeholder="Bathrooms" autocomplete="off" value="<?=(isset($model->no_of_bathrooms))? $model->room_size:old('no_of_bathrooms')?>" required>
                             @if ($errors->has('no_of_bathrooms'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_bathrooms') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>

                         <div class="form-group col-md-6 {{ $errors->has('room_capacity') ? ' has-error' : '' }}">
                            <label>Capacity</label>
                            <input class="form-control" type="number" name="room_capacity"  placeholder="Capacity" autocomplete="off" value="<?=(isset($model->room_capacity))? $model->room_capacity:old('room_capacity')?>" required >
                             @if ($errors->has('room_capacity'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_capacity') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                        
                        

                       

                   <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Pricing</legend>
                                <div class="clearfix"></div>


                                 <div class="row">
                                 <legend>Room Price</legend>
                        <div class="form-group col-md-6 {{ $errors->has('hotel_country') ? ' has-error' : '' }}">
                            <label>Currency</label>
                            <select name="currency" class="form-control" required>
                            <option value="">--Select Currency--</option>
                              <?php foreach($currencies as $currency):?>
                              <option><?=$currency;?></option>
                              <?php endforeach;?>
                              
                            </select>
                            
                             @if ($errors->has('currency'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('local_price_off_peak_night') ? ' has-error' : '' }}">
                            <label>Price Per Night</label>
                            <input class="form-control" type="number" name="local_price_off_peak_night"  placeholder="Price" autocomplete="off" value="<?=(isset($model->hotel_state))?$model->hotel_state:old('local_price_off_peak_night')?>"  required>
                             @if ($errors->has('local_price_off_peak_night'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('local_price_off_peak_night') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                         
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>

                            <fieldset title="3">
                             
                             <legend class="text-semibold">Amentities</legend>


                              <div class="row">
                        <div class="form-group col-md-12 {{ $errors->has('plot_size') ? ' has-error' : '' }}">
                        <legend>Room Amentities</legend>
                       
                       <?php foreach($amentities as $amentity):?>
                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                   
                                <div class="checkbox custom-checkbox"><label>
                                  <?php if(in_array($amentity->id, $available_amentities)): ?>


                                    <input type="checkbox" name="amenities[]" value="<?=$amentity->id?>"  checked><span class="fa fa-check" ></span> <?=$amentity->name?></label>
                                  <?php else:?>


                                  <input type="checkbox" name="amenities[]" value="<?=$amentity->id?>" ><span class="fa fa-check" ></span> <?=$amentity->name?></label>


                                  <?php endif;?>
                                    </div>
                                    

                                   
                                    
                                </div>
                            </div>
                          <?php endforeach;?>


                             




                        </div>



                        </div> 










                            </fieldset>

                            <fieldset title="4">
                                <legend class="text-semibold">Other Details</legend>

                               
                        <div class="row">
                        <legend>Other Details</legend>
                        <div class="form-group col-md-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Number of Rooms</label>
                            <input type="number" name="no_of_similar_rooms" class="form-control " value="<?=(isset($model->no_of_similar_rooms))?$model->no_of_similar_rooms:old('no_of_similar_rooms')?>" required>
                           
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="need-help" style="cursor: pointer;" >Room Number Pattern e.g A00 <span id="need-help"  data-title="Example Demo" style="color:blue;font-weight: bold;">(Need Help ?)</span> </label>
                            <input type="text" name="room_start_key" class="form-control " value="<?=(isset($model->room_start_key))?$model->room_start_key:old('room_start_key')?>" placeholder="A001 or B00 or C00 or Delux00">

                             @if ($errors->has('room_start_key'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_start_key') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>
                         <div class="row">
                        <div class="form-group col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Room  Description</label>
                            <textarea name="room_description" class="form-control" rows="6"><?=(isset($model->room_description))? $model->room_description:old('room_description')?></textarea>
                             @if ($errors->has('room_description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('room_description') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>

                       
                                


                            </fieldset>
                            <fieldset title="5">
                                <legend class="text-semibold">Gellary</legend>
                                

                             <div class="row">
                             <legend class="text-semibold">Room Gellary</legend>
                            <h3>Room Images</h3>

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
                      <h4 class="modal-title" id="my-header">Room Number Genarator</h4>
                    </div>
                    
                    <div class="modal-body" id="load-county-details">
                      <strong>Example 1 :</strong>
                       if you input Number of Rooms as 3,and A00 as Pattern,3 rooms will be added to your account with the following room numbers A001,A002 and A003
                       <br>

                        <strong>Example 2 :</strong>
                       if you input Number of Rooms as 5,and Delux as Pattern,5 rooms will be added to your account with the following room numbers Delux1,Delux2 , Delux4,Delux3 and Delux5
                        
                    </div>               
                   
                     
                  </div>
                </div>
              </div>
              </div>
            




{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>


               <script type="text/javascript" src="{{asset('/js/jquery.timepicker.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('/js/jquery.timepicker.css')}}" />
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





      
  $('.setTimeExample').timepicker({ 'timeFormat': 'H:i:s' });

       
</script>
<script type="text/javascript">
    
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

       $(document).on("click","#need-help",function(e){
         $("#county-modal").modal("show");

       });


       


</script>
@endpush