
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
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Manage Plots</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=$url;?>"  method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">General Details</legend>
                                {{csrf_field()}}

                                <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Plot Name/Title</label>
                                    <input type="text" class="form-control" name="name" value="{{$model->name}}" required>
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>City</label>
                                     <input type="text" class="form-control" name="city" value="{{$model->city}}" required>
                                   
                                     @if ($errors->has('city'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                        <div class="row">

                           <div class="form-group col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label>Country</label>
                            <select class="form-control" name="country"  required>
                            <option>---Select One---</option>
                            <option selected>Kenya</option>
                            <option>Uganda</option>
                            <option>Tanzania</option>
                                
                             
                            </select>
                             @if ($errors->has('country'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>

                         <div class="form-group col-md-6 {{ $errors->has('state') ? ' has-error' : '' }}">
                            <label>State/County</label>
                            <input type="text" class="form-control" name="state" value="{{$model->state}}" required>
                             @if ($errors->has('state'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Town</label>
                            <input class="form-control" name="town" type="text" id="town" placeholder="Enter a Town" autocomplete="off" value="{{$model->city}}">
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Location/Area</label>
                            <input class="form-control" type="text" name="location"  placeholder="Enter a Location" autocomplete="off" value="{{$model->area}}" id="autocomplete1">
                             @if ($errors->has('location'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                        

                       

                   <div class="clearfix"></div>

                                
                            </fieldset>

                            <fieldset title="2">

                                <legend class="text-semibold">Pricing Details</legend>
                                <div class="clearfix"></div>

                                  <div class="row">
                                   
                        <div class="form-group col-md-4 {{ $errors->has('plot_size') ? ' has-error' : '' }}">
                            <label>Plot/Land Size</label>
                            <input class="form-control" name="plot_size" type="text" placeholder="Enter  Size" autocomplete="off" value="{{$model->plot_size}}">
                             @if ($errors->has('plot_size'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('plot_size') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-4 {{ $errors->has('plot_price') ? ' has-error' : '' }}">
                            <label>Selling Price</label>
                            <input class="form-control" type="text" name="plot_price"  placeholder="Enter Amount in KES" autocomplete="off" value="{{$model->plot_price}}" id="autocomplete1">
                             @if ($errors->has('plot_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('plot_price') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('plot_price') ? ' has-error' : '' }}">
                            <label>Status</label>
                            <select class="form-control" name="plot_status">
                            <option>---Select One---</option>
                            <option <?php if($model->plot_status=="On Sale"):?>selected<?php endif;?>>On Sale</option>
                            <option <?php if($model->plot_status=="Sold"):?>selected<?php endif;?> >Sold</option>
                              

                            </select>
                           
                             @if ($errors->has('plot_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('plot_price') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div> 
                        <div class="row">
                        <div class="form-group col-md-12 {{ $errors->has('plot_size') ? ' has-error' : '' }}">
                        <legend>Value Additions</legend>
                       

                         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                   
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Is Fenced" 


                                    <?php if(in_array('Is Fenced',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>


                                     ><span class="fa fa-check"></span> Is Fenced</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]"
                                     <?php if(in_array('Power Readily Available',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Power Readily Available" ><span class="fa fa-check"></span> Power Readily Available</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      <?php if(in_array('Tamack Road',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Tamack Road" ><span class="fa fa-check"></span> Tamack Road</label></div>

                                      <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      <?php if(in_array('Connected Water',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Connected Water" ><span class="fa fa-check"></span>Connected Water</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      <?php if(in_array('Next To Hospital',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Next To Hospital" ><span class="fa fa-check"></span>Next To Hospital</label></div>
                                   
                                    
                                </div>
                            </div>


                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                   
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                     <?php if(in_array('Title Deeds Available',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                    value="Title Deeds Available" ><span class="fa fa-check"></span> Title Deeds Available</label></div>
                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]"
                                      <?php if(in_array('Perimeter wall',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Perimeter wall" ><span class="fa fa-check"></span> Perimeter wall</label></div>


                                     <div class="checkbox custom-checkbox"><label><input type="checkbox"  <?php if(in_array('Internal Murram Road',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                    name="amenities[]" value="Internal Murram Roads" ><span class="fa fa-check"></span> Internal Murram Roads</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      <?php if(in_array('Police post',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Police post" ><span class="fa fa-check"></span>Police post</label></div>


                                       <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      <?php if(in_array('Next To Schools',$available_ammentities)):?>
                                      checked
                                    <?php endif;?>
                                     value="Next To Schools" ><span class="fa fa-check"></span>Next To Schools</label></div>
                                   
                                    
                                </div>
                            </div>




                        </div>



                        </div>   
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>

                            <fieldset title="3">
                             
                             <legend class="text-semibold">Contact Details</legend>
                             <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('managed_by') ? ' has-error' : '' }}">
                            <label>Contact Telephone  </label>
                            <input class="form-control" name="contact_phone" type="text" id="town" placeholder="Telephone" autocomplete="off" value="{{$model->contact_phone}}">
                             @if ($errors->has('contact_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_phone') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label>Contact Email </label>
                            <input class="form-control" type="text" name="contact_email"  placeholder="Email Address" autocomplete="off" value="{{$model->contact_email}}">
                             @if ($errors->has('contact_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('contact_phone_two') ? ' has-error' : '' }}">
                            <label>Altenative Telephone </label>
                            <input class="form-control" name="contact_phone_two" type="text"  placeholder="Altenative Telephone" autocomplete="off" value="{{$model->contact_phone_two}}">
                             @if ($errors->has('contact_phone_two'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_phone_two') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('contact_email_two') ? ' has-error' : '' }}">
                            <label>Altenative Email</label>
                            <input class="form-control" type="text" name="contact_email_two"  placeholder="Postal Address" autocomplete="off" value="{{$model->contact_email_two}}">
                             @if ($errors->has('contact_email_two'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email_two') }}</strong>
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
                            <input class="form-control" name="bank_name" type="text"placeholder="Bank Name" autocomplete="off" value="{{$model->bank_name}}">
                             @if ($errors->has('bank_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label>Branch </label>
                            <input class="form-control" type="text" name="branch"  placeholder="Branch" autocomplete="off" value="{{$model->branch}}" >
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
                            <input class="form-control" name="account_number" type="text"  placeholder="Account Number" autocomplete="off" value="{{$model->account_number}}">
                             @if ($errors->has('account_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('account_number') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('account_name') ? ' has-error' : '' }}">
                            <label>Account Name </label>
                            <input class="form-control" type="text" name="account_name"  placeholder="Account Name" autocomplete="off" value="{{$model->account_name}}" id="autocomplete1">
                             @if ($errors->has('account_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('account_name') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                       
                                


                            </fieldset>
                            <fieldset title="5">
                                <legend class="text-semibold">Gellary</legend>
                                

                             <div class="row">
                            <h3>Plot/land Images</h3>

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


                             <input type="hidden" name="_token" value="{{csrf_token()}}">



                             <div class="row">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Other Descriptions</label>
                            <textarea class="form-control" name="description"   rows="6">{{$model->description}}</textarea>
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