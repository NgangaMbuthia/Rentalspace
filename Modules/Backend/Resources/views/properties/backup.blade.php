@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">Provider/Agent Module</a></li>
        <li class="active">Edit Property/<?=$model->id?></li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Edit  Property Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=url('/backend/property/update_details/'.$model->id)?>" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Title</label>
                                     <input type="text" class="form-control" name="title" value="<?=$model->title?>">
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
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
                                <option  <?php if($model->category_id==$category->id):?> selected    <?php endif;?>        value="<?=$category->id?>"><?=$category->name;?></option>


                            <?php endforeach;?>
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

                            <option value="<?=$model->subcategory_id?>"><?=$model->subcategory->name?></option>
                            <option>--Select Type---</option>
                                
                            </select>
                             @if ($errors->has('subcategory_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subcategory_id') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>



                          </div>

                             <div class="row">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                             <textarea class="form-control" name="description"   rows="4">{{$model->description}}</textarea>
                             @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                             </div>


                             </div>
                          <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
                            <label>Town <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="town" type="text" id="town" placeholder="Enter a Town" autocomplete="off" value="{{$model->town}}">
                             @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Location <span id="latitude" class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                               <input class="form-control" type="text" name="location" id="location" placeholder="Enter a Location" autocomplete="off" value="{{$model->location}}">
                             @if ($errors->has('location'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('location') }}</strong>
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

                              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  commercial hidden">
                                <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
                                    <label>Area</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="area" placeholder="2 ft By 12 ft" value="<?=$model->area?>">
                                         @if ($errors->has('area'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('area') }}</strong>
                                                </span>
                                            @endif
                                        <div class="input-group-addon">Sq Ft</div>
                                    </div>
                                </div>
                            </div>
                           
                              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3  commercial hidden">
                                <div class="btn-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Business Type</label>
                                    <div class="clearfix"></div>

                                    <input type="text" placeholder="Business Type" class="form-control" name="postal_address" value="<?=$model->type?>"> 
                                   
                                         @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden apartments">
                                <div class="form-group {{ $errors->has('postal_address') ? ' has-error' : '' }}">
                                    <label>Number of Bedrooms</label>
                                    <input type="text" placeholder="Number of Bed Rooms" class="form-control" name="no_of_bedrooms" value="{{$model->no_of_bedrooms}}"> 
                                     @if ($errors->has('no_of_bedrooms'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_bedrooms') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden apartments">
                                <div class="form-group {{ $errors->has('no_of_bathroom') ? ' has-error' : '' }}">
                                    <label> Number of bathrooms</label>
                                    <input type="text" placeholder="Number of Birth Room" class="form-control" name="no_of_bathroom" value="{{$model->no_of_bathroom}}"> 
                                     @if ($errors->has('no_of_bathroom'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_bathroom') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden apartments">
                                <div class="form-group {{ $errors->has('servant_quater') ? ' has-error' : '' }}">
                                    <label> Servant Quarter </label>
                                    <input type="text" placeholder="Sarvant Quater" class="form-control" name="servant_quater" value="{{$model->servant_quater}}"> 
                                     @if ($errors->has('servant_quater'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('servant_quater') }}</strong>
                                                </span>
                                            @endif
                                </div>
                            </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
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
                        <div class="form-group col-md-6 {{ $errors->has('town') ? ' has-error' : '' }}">
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

                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="images" id="img_ids" value="">

                            
                        </div>

                        
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
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-success" >
                    <span class="fa fa-check"> Update Details</span>
                    </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>


{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript">


    var category="<?=$model->subcategory->name?>";
        if(category=="Apartments" || category=="Bungalow" ||  category=="massionate"){
             $(".apartments").removeClass("hidden");
             $(".commercial").addClass("hidden");
           }else if(category=="---Select Option--"){
            $(".commercial").addClass("hidden");
            $(".apartments").addClass("hidden");

           }

           else{
             $(".commercial").removeClass("hidden");
            $(".apartments").addClass("hidden");
           }

    $("#category").on("change",function(){
      var id=$(this).val();
      var lengths=id.length;

       if(lengths >=1){
          var url="<?=url('/backend/property/getsubcategories')?>/"+id;
           $.post(url,function(data){
            $("#subcategory").html(data);
           })
       }
    });



     $("#subcategory").on("change",function (e){
        

        var value=$(this).val();
        
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





      });
</script>
@endpush
