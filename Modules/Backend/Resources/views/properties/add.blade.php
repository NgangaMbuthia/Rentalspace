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

@section('content')
@include('backend::properties.t_head')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Add New Property Account</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                       
                        
                        
                        <form   class="stepy-validation" role="form" action="<?=url('/backend/property/store')?>"  method="post">
                            <fieldset title="1">
                                <legend class="text-semibold">General Details</legend>
                                {{csrf_field()}}

                                <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property Title</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
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
                                   <select name="type" class="form-control" required   id="purpose">
                                   <option value="">--Select Purpose--</option>
                                   <option>For Rent</option>
                                   <option>For Sale</option>
                                       

                                   </select>
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                           
                        </div>
                        <div class="row">

                           <div class="form-group col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label>Category</label>
                            <select class="form-control" name="category_id" id="category" required>
                                
                             <option value="">---Select Category----</option>

                             <?php foreach($categories as $category):?>

                                <option value="<?=$category['id']?>"><?=$category['name'];?></option>


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
                            <select class="form-control" name="subcategory_id" id="subcategory">
                            <option value="">--Select Type---</option>


                                
                            </select>
                             @if ($errors->has('subcategory_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                         <div class="row sales hidden">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Currency </label>
                           <select name="currency" class="form-control" required>
                           <option>KES</option>
                            <?php  foreach(config('app.system_currency') as $currency):?>
                                <option><?=$currency;?></option>


                            <?php endforeach;?>
                               
                           </select>
                             @if ($errors->has('currency'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('currency') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Selling Price</label>
                            <input class="form-control" type="text" name="unit_price"  placeholder="Selling Price"   value="{{old('unit_price')}}" id="price">
                             @if ($errors->has('unit_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit_price') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Town </label>
                            <input class="form-control" name="town" type="text" id="town" placeholder="Enter a Town" autocomplete="off" value="{{old('town')}}">
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Location</label>
                            <input class="form-control" type="text" name="location"  placeholder="Enter a Location"   value="{{old('location')}}" id="autocomplete1">
                             @if ($errors->has('location'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>


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
                                                                <input type="text" class="form-control" id="latitude" name="latitude" readonly required placeholder="Latitude">
                                                                @if ($errors->has('latitude'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('latitude') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="longitude" name="longitude" readonly required placeholder="Longitude">
                                                                @if ($errors->has('longitude'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('longitude') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                    </div>
                                                </section><!-- /#place-on-map -->
                          </div><!-- /.col-md-6 -->



                         

                         


                        
                         
                        </div>
                         <div class="row">

                           



                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Postal Address</label>
                                    <input type="text" placeholder="Postal Address" class="form-control" name="postal_address" value="{{old('postal_address')}}"> 
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
                                    <select name="country" class="form-control" required>
                                      <option>Kenya</option>
                                      <option>Tanzania</option>
                                      <option>Uganda</option>
                                      
                                    </select>
                                    
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
                                    <input type="text" placeholder="Street" class="form-control" name="street_road" value="{{old('street')}}"> 
                                     @if ($errors->has('street'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('street') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                           
                            

                           
                           
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  commercial hidden">
                                <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
                                    <label>Area in Square Metres</label>
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
                                  <LABEL><h3>Amentities Avaliable</h3></LABEL><br>

                                   <?php foreach($amentities as $amentity):?>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group {{ $errors->has('amentities') ? ' has-error' : '' }}">
                                    
                                    <div class="checkbox custom-checkbox"><label>
                                    <input type="checkbox" name="amenities[]" value="<?=$amentity->id?>" required><span class="fa fa-check"></span> <?=$amentity->name?></label></div>

                                 
                                </div>
                            </div>


                                   <?php endforeach;?>


                            
                           
                            
                        </div>    
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>


                              <fieldset title="3">

                                <legend class="text-semibold">Associated Utilities</legend>

                                <div class="row">
                                  <LABEL><h3>Associated Utilities</h3></LABEL><br>

                                   <?php foreach($utilities as $amentity):?>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group {{ $errors->has('utilities') ? ' has-error' : '' }}">
                                    
                                    <div class="checkbox custom-checkbox"><label>
                                    <input type="checkbox" name="utilities[]" value="<?=$amentity->id?>" required><span class="fa fa-check"></span> <?=$amentity->name?></label></div>

                                 
                                </div>
                            </div>


                                   <?php endforeach;?>


                            
                           
                            
                        </div>    
                                     
                        <div class="clearfix"></div>
                                
                            </fieldset>

                            <fieldset title="4">
                             
                             <legend class="text-semibold">Managed By</legend>
                             <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('managed_by') ? ' has-error' : '' }}">
                            <label>Manager Name </label>
                            <input class="form-control" name="managed_by" type="text" id="town" placeholder="Full Name" autocomplete="off" value="{{old('managed_by')}}">
                             @if ($errors->has('managed_by'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('managed_by') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('manager_phone') ? ' has-error' : '' }}">
                            <label>Manager Phone </label>
                            <input class="form-control" type="text" name="manager_phone"  placeholder="Telephone" autocomplete="off" value="{{old('manager_phone')}}">
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
                            <input class="form-control" name="Manager_email" type="text" id="town" placeholder="Email Address" autocomplete="off" value="{{old('Manager_email')}}">
                             @if ($errors->has('Manager_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('Manager_email') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('manager_postal') ? ' has-error' : '' }}">
                            <label>Manager Postal Address </label>
                            <input class="form-control" type="text" name="manager_postal"  placeholder="Postal Address" autocomplete="off" value="{{old('manager_postal')}}" >
                             @if ($errors->has('manager_postal'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('manager_postal') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('garbage_fee') ? ' has-error' : '' }}">
                            <label>Garbage Collection Fee </label>
                            <input class="form-control" name="garbage_fee" type="text" id="garbage_fee" placeholder="Garbage Collection" autocomplete="off" value="{{old('garbage_fee')}}" required=true>
                             @if ($errors->has('Manager_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('garbage_fee') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('water_unit_price') ? ' has-error' : '' }}">
                            <label>Water Unit Fee </label>
                            <input class="form-control" type="text" name="water_unit_price"  placeholder="Water Unit Free" autocomplete="off" value="{{old('water_unit_price')}}"  required=true>
                             @if ($errors->has('water_unit_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('water_unit_price') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>



                            </fieldset>

                            <fieldset title="5">
                                <legend class="text-semibold">Payments Details</legend>

                                 <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <label>Bank Name</label>
                            <input class="form-control" name="bank_name" type="text"placeholder="Bank Name" autocomplete="off" value="{{old('bank_name')}}">
                             @if ($errors->has('bank_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label>Branch </label>
                            <input class="form-control" type="text" name="branch"  placeholder="Branch" autocomplete="off" value="{{old('branch')}}" >
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
                            <input class="form-control" name="account_number" type="text"  placeholder="Account Number" autocomplete="off" value="{{old('Manager_email')}}">
                             @if ($errors->has('account_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('account_number') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('account_name') ? ' has-error' : '' }}">
                            <label>Account Name </label>
                            <input class="form-control" type="text" name="account_name"  placeholder="Account Name" autocomplete="off" value="{{old('account_name')}}">
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
                            <input class="form-control" name="paybill" type="text"  placeholder="PayBill Number"  value="{{old('paybill')}}">
                             @if ($errors->has('paybill'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('paybill') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('account_name') ? ' has-error' : '' }}">
                            <label>MPesa Mobile Number </label>
                            <input class="form-control" type="text" name="account_name"  placeholder="Account Name" autocomplete="off" value="{{old('account_name')}}" >
                             @if ($errors->has('mpesa_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('mpesa_phone') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        </div>

                                


                            </fieldset>
                            <fieldset title="6">
                                <legend class="text-semibold">Gellary</legend>
                                


                        <div class="row">
                          <div class="col-md-12">
                            <h3>Select Cover Image</h3>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a href="#modal-message" class="uploadmodalwidget btn btn-default btn-sm" data-toggle="modal"  data-inputid="cover_image" data-mode="single" data-divid="cover_image_show">Choose Image <i class="icon-play3 position-right"></i></a>
                                    
                                    
                                </div>


                                <img id="cover_image_show" src="" alt="Cover Image" style="width: 14%;" />
                            </div>

                            <input type="hidden" class="form-control" name="cover_image" id="cover_image" value="" required>

                          </div>
                        </div>       

                        <div class="row">
                          <div class="col-md-12">

                             <div class="row">

                            <h3>Property Images</h3>

                            <div id="property_images">
                                
                            </div>



                          </div>
                            

                        </div>

                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a href="#modal-message" class="uploadmodalwidget btn btn-default btn-sm" data-toggle="modal" id="uploadmodal" data-inputid="img_ids" data-mode="multiple" data-divid="image_array">Upload Images <i class="icon-play3 position-right"></i></a>
                                    
                                    <p class="help-block">You can select multiple images at once</p>
                                </div>


                                <div class="superbox" id="image_array">

                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="images" id="img_ids" value="" required>

                            
                        </div>


                             <input type="hidden" name="_token" value="{{csrf_token()}}" />




                             <div class="row">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Short  Descriptions About The Property(250 words)</label>
                            <textarea class="form-control" name="description"   rows="4" required>{{old('description')}}</textarea>
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


           }
          else{


             if(value=="Apartments" || value=="Bungalow" ||  value=="massionate"){
             $(".apartments").removeClass("hidden");
             $(".commercial").addClass("hidden");

           }
           else if(value=="---Select Option--")
           {
              $(".commercial").addClass("hidden");
              $(".apartments").addClass("hidden");

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
    var _latitude = -1.2920659;
    var _longitude = 36.821946;

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
