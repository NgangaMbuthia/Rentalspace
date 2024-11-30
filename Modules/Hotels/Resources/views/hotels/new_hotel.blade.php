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
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Hotels</a></li>
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



<div class="row">


  <div class="col-md-12">
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i> <?=(isset($action))?$action:'Create Hotel'?></h6>
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
                                    <input type="text" class="form-control" name="hotel_name" value="<?=(isset($model->hotel_name))? $model->hotel_name :old('hotel_name');?>" required>
                                     @if ($errors->has('hotel_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Type</label>
                                     <select name="hotel_type" class="form-control" required>
                                     <option value="">---Select Type---</option>
                                     <?php foreach($hotel_types as $type):?>
                                       <option <?php if($model->hotel_type==$type->name):?>selected <?php endif;?>><?=$type->name;?></option>


                                     <?php endforeach;?>
                                       
                                     </select>
                                   
                                     @if ($errors->has('city'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('hotel_email') ? ' has-error' : '' }}">
                            <label>Email Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="hotel_email" type="email" id="email" placeholder="Hotel Email" autocomplete="off" value="<?=(isset($model->hotel_email))?$model->hotel_email:old('hotel_email')?>">
                             @if ($errors->has('hotel_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_email') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('hotel_telephone') ? ' has-error' : '' }}">
                            <label>Telephone<span class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                            <input class="form-control" type="text" name="hotel_telephone"  placeholder="Hotel Telephone" autocomplete="off" value="<?=(isset($model->hotel_telephone))? $model->hotel_telephone:old('hotel_telephone')?>" required>
                             @if ($errors->has('hotel_telephone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_telephone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                        <div class="row">

                           <div class="form-group col-md-6 {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                            <label>Postal Address</label>
                            <input class="form-control" type="text" name="postal_address"  placeholder="Hotel Postal Address" autocomplete="off" value="<?=(isset($model->postal_address))? $model->postal_address:old('postal_address')?>" required>
                             @if ($errors->has('postal_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postal_address') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>

                         <div class="form-group col-md-6 {{ $errors->has('hotel_start') ? ' has-error' : '' }}">
                            <label>Hotel Rating</label>
                            <select name="hotel_start" required class="form-control">
                              <option>---Select Rating --</option>
                              <option <?php if($model->hotel_start=="One Star"):?>selected <?php endif;?> >One Star</option>
                              <option <?php if($model->hotel_start=="Two Star"):?>selected <?php endif;?> >Two Star</option>
                              <option <?php if($model->hotel_start=="Three Star"):?>selected <?php endif;?> >Three Star</option>
                              <option <?php if($model->hotel_start=="Four Star"):?>selected <?php endif;?> >Four Star</option>
                              <option <?php if($model->hotel_start=="Five Star"):?>selected <?php endif;?> >Five Star</option>
                            </select>
                             @if ($errors->has('hotel_start'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_start') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                        
                        

                       

                   <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Location  Details</legend>
                                <div class="clearfix"></div>

                                 <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('hotel_country') ? ' has-error' : '' }}">
                            <label>Country<span  class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="hotel_country" type="text" id="town" placeholder="Country" autocomplete="off" value="<?=(isset($model->hotel_country))?$model->hotel_country:old('hotel_country')?>">
                             @if ($errors->has('hotel_country'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_country') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>State/County<span  class="label label-default"></span> <span class="label label-default"></span></label>
                            <input class="form-control" type="text" name="hotel_state"  placeholder="State/County" autocomplete="off" value="<?=(isset($model->hotel_state))?$model->hotel_state:old('hotel_state')?>" id="autocomplete1">
                             @if ($errors->has('hotel_state'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_state') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                                  <div class="row">
                                   
                        <div class="form-group col-md-6 {{ $errors->has('hotel_city') ? ' has-error' : '' }}">
                            <label>City/Town</label>
                            <input class="form-control" name="hotel_city" type="text" placeholder="City/Town" autocomplete="off" value="<?=(isset($model->hotel_city))?$model->hotel_city:old('hotel_city')?>">
                             @if ($errors->has('hotel_city'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_city') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-3 {{ $errors->has('hotel_logitude') ? ' has-error' : '' }}">
                            <label>Longitude</label>
                            <input class="form-control" type="text" name="hotel_logitude"  placeholder="Longitude" autocomplete="off" value="<?=(isset($model->hotel_logitude))?$model->hotel_logitude:old('hotel_logitude')?>" >
                             @if ($errors->has('hotel_logitude'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_logitude') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('hotel_latitude') ? ' has-error' : '' }}">
                            <label>Latitude</label>
                            <input class="form-control" type="text" name="hotel_latitude"  placeholder="Latitude" autocomplete="off" value="<?=(isset($model->hotel_latitude))?$model->hotel_latitude:old('hotel_latitude')?>" id="autocomplete1">
                             @if ($errors->has('hotel_latitude'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_latitude') }}</strong>
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
                        <legend>Hotel Amentities </legend>

                       
                       <?php foreach($amentities as $amentity):?>
                         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                   
                                <div class="checkbox custom-checkbox"><label>
                                   <?php if(in_array($amentity, $available_amentities)):?>
                                     <input type="checkbox" name="amenities[]" value="<?=$amentity?>" checked ><span class="fa fa-check" ></span> <?=$amentity?></label>
                                   <?php else:?>
                                     <input type="checkbox" name="amenities[]" value="<?=$amentity?>" ><span class="fa fa-check" ></span> <?=$amentity?></label>
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
                        <div class="form-group col-md-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>CheckIn Time</label>
                            <input type="text" name="hotel_check_in_time" class="form-control setTimeExample" value="<?=(isset($model->hotel_check_in_time))?$model->hotel_check_in_time:old('hotel_check_in_time')?>">
                           
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label> CheckOut Time</label>
                            <input type="text" name="hotel_check_out_time" class="form-control setTimeExample" value="<?=(isset($model->hotel_check_out_time))?$model->hotel_check_out_time:old('hotel_check_out_time')?>">

                             @if ($errors->has('hotel_check_out_time'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('hotel_check_out_time') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>
                         <div class="row">
                        <div class="form-group col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Hotel Description(Overview)</label>
                            <textarea name="description" class="form-control" rows="6"><?=(isset($model->description))? $model->description:old('description')?></textarea>
                             @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>

                       
                                


                            </fieldset>
                            <fieldset title="5">
                                <legend class="text-semibold">Gellary</legend>
                                

                             <div class="row">
                            <h3>Hotel Images</h3>

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
                      <h4 class="modal-title" id="my-header">Give Reason(s)</h4>
                    </div>
                    
                    <div class="modal-body" id="load-county-details">
                    ghhghghghhghghg
                        
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


</script>
@endpush