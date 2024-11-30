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
                                    <input type="text" class="form-control" name="name" value="{{old('title')}}" required>
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
                                     <input type="text" class="form-control" name="city" value="{{old('city')}}" required>
                                   
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
                            <option>Kenya</option>
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
                            <input type="text" class="form-control" name="state" value="{{old('city')}}" required>
                             @if ($errors->has('state'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Town <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="town" type="text" id="town" placeholder="Enter a Town" autocomplete="off" value="{{old('town')}}">
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Location/Area<span id="latitude" class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                            <input class="form-control" type="text" name="location"  placeholder="Enter a Location" autocomplete="off" value="{{old('location')}}" id="autocomplete1">
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
                                   
                        <div class="form-group col-md-6 {{ $errors->has('plot_size') ? ' has-error' : '' }}">
                            <label>Plot/Land Size <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="plot_size" type="text" placeholder="Enter  Size" autocomplete="off" value="{{old('plot_size')}}">
                             @if ($errors->has('plot_size'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('plot_size') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('plot_price') ? ' has-error' : '' }}">
                            <label>Selling Price</label>
                            <input class="form-control" type="text" name="plot_price"  placeholder="Enter Amount in KES" autocomplete="off" value="{{old('plot_price')}}" id="autocomplete1">
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
                                   
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Is Fenced" ><span class="fa fa-check"></span> Is Fenced</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Power Readily Available" ><span class="fa fa-check"></span> Power Readily Available</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Tamack Road" ><span class="fa fa-check"></span> Tamack Road</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                     value="Connected Water" ><span class="fa fa-check"></span>Connected Water</label></div>

                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                     value="Next To Hospital" ><span class="fa fa-check"></span>Next To Hospital</label></div>
                                   
                                    
                                </div>
                            </div>


                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                   
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Title Deeds Available" ><span class="fa fa-check"></span> Title Deeds Available</label></div>
                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Perimeter wall" ><span class="fa fa-check"></span> Perimeter wall</label></div>


                                     <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" value="Internal Murram Roads" ><span class="fa fa-check"></span> Internal Murram Roads</label></div>

                                      <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      
                                     value="Police post" ><span class="fa fa-check"></span>Police post</label></div>


                                       <div class="checkbox custom-checkbox"><label><input type="checkbox" name="amenities[]" 
                                      
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
                            <input class="form-control" name="contact_phone" type="text" id="town" placeholder="Telephone" autocomplete="off" value="{{old('contact_phone')}}">
                             @if ($errors->has('contact_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_phone') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label>Contact Email </label>
                            <input class="form-control" type="text" name="contact_email"  placeholder="Email Address" autocomplete="off" value="{{old('contact_email')}}">
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
                            <input class="form-control" name="contact_phone_two" type="text"  placeholder="Altenative Telephone" autocomplete="off" value="{{old('contact_phone_two')}}">
                             @if ($errors->has('contact_phone_two'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_phone_two') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('contact_email_two') ? ' has-error' : '' }}">
                            <label>Altenative Email</label>
                            <input class="form-control" type="text" name="contact_email_two"  placeholder="Postal Address" autocomplete="off" value="{{old('manager_postal')}}">
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
                            <input class="form-control" type="text" name="account_name"  placeholder="Account Name" autocomplete="off" value="{{old('account_name')}}" id="autocomplete1">
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

                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="images" id="img_ids" value="">

                            
                        </div>

                             <input type="hidden" name="_token" value="{{csrf_token()}}">



                             <div class="row">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Other Descriptions</label>
                            <textarea class="form-control" name="description"   rows="4">{{old('description')}}</textarea>
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