@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>">Provider List</a></li>
        <li><a href="<?=url('/backend/space/listView')?>">Spaces List</a></li>
        <li class="active">Add Space</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Add New Space</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=url('/backend/spaces/store')?>" method="post">
                        <div class="row">



                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <select class="form-control" name="property_id" id="property_id" >
                                    <option value="">-----Select Property-----</option>
                                    <?php foreach($properties as $property):?>
                                     <option value="<?=$property->id?>">
                                     {{$property->title}}-- {{$property->location}}</option>

                                    <?php endforeach;?>
                                        

                                    </select>
                                  
                                     @if($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label>Category</label>
                                <input type="text"  class="form-control"  id="category" readonly name="category" value="<?=old('category')?>" />
                                  
                                     @if ($errors->has('category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                         </div>
                      
                       
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Type</label>
                                    <input type="text"  class="form-control"  id="subcategory" readonly name="type" value="<?=old('type')
                                    ?>"/>
                                  
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                        <div class="form-group col-md-6 {{ $errors->has('number') ? ' has-error' : '' }}">
                            <label>Space Number <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" name="number" type="text" id="town" placeholder="Enter Space Number" autocomplete="off" value="{{old('number')}}">
                             @if ($errors->has('number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>

                        <div class="row">
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Space Name <span id="latitude" class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                            <input class="form-control" type="text" name="title" id="location" placeholder="Enter a Name That can be used to locate this space" autocomplete="off" value="{{old('title')}}">
                             @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('number') ? ' has-error' : '' }}">
                            <label>Unit Price <span id="latitude" class="label label-default"></span> <span  class="label label-default"></span></label>
                            <input class="form-control" name="unit_price" type="text" id="town" placeholder="Unit Price" autocomplete="off" value="{{old('number')}}">
                             @if ($errors->has('unit_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit_price') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>
                        
                        </div>

                         <div class="row hidden bunga">
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Number of BathRooms<span id="latitude" class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                            <input class="form-control" type="text" name="number_of_bathrooms"  placeholder="Number of Bathrooms" value="{{old('number_of_bathrooms')}}">
                             @if ($errors->has('number_of_bathrooms'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number_of_bathrooms') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                        <div class="form-group col-md-6 {{ $errors->has('number') ? ' has-error' : '' }}">
                            <label>Number Of BedRooms <span id="latitude" class="label label-default"></span> <span  class="label label-default"></span></label>
                            <input class="form-control" name="number_of_bedrooms" type="text" id="town" placeholder="Number Of BedRooms"  value="{{old('number_of_bedrooms')}}">
                             @if ($errors->has('number_of_bedrooms'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number_of_bedrooms') }}</strong>
                                                </span>
                                            @endif
                           
                        </div>


                        
                        </div>

                          <div class="row">

                              <div class="form-group  col-md-12{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Other Space Description</label>
                            <textarea class="form-control" name="description"   rows="4">{{old('description')}}</textarea>
                             @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                             </div>


                             </div>


                        
                        <div class="row">

                        <div class="col-md-12">
                        <fieldset>
                        <legend>Utility Settings</legend>
                          <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Water Meter Number<span id="latitude" class="label label-default"></span> <span id="longitudes" class="label label-default"></span></label>
                            <input class="form-control" type="text" name="water_meter_number"  placeholder="Water Meter Number" value="{{old('water_meter_number')}}">
                             @if ($errors->has('water_meter_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('water_meter_number') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                         <div class="form-group col-md-6 {{ $errors->has('location') ? ' has-error' : '' }}">
                            <label>Electricity Meter Number</label>
                            <input class="form-control" type="text" name="electricity_meter_number"  placeholder="Electricity Meter Number" value="{{old('electricity_meter_number')}}">
                             @if ($errors->has('electricity_meter_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('electricity_meter_number') }}</strong>
                                                </span>
                                            @endif
                            
                        </div>
                          

                        </fieldset>
                          

                        </div>


                        <p></p><br>
                        <div class="com-md-12">
                        <h3>Property Images</h3>

                            <div id="property_images">
                                
                            </div>
                          
                        </div>
                            
                        </div>

                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <a href="#modal-message" class="uploadmodalwidget btn btn-default btn-sm" data-toggle="modal" id="uploadmodal" data-inputid="img_ids" data-mode="multiple" data-divid="property_images">Upload Images <i class="icon-play3 position-right"></i></a>
                                    
                                    <p class="help-block">You can select multiple images at once</p>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="images" id="img_ids" value="">
                        </div>

                        
                      
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-success" >
                    <span class="glyphicon glyphicon-check"> Add Space</span>
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
   $("#property_id").on('change',function(){
    var id=$(this).val();
      var length=id.length;
     if(length>0){
      var url="<?=url('/backend/get_Cat/category')?>/"+id;
      $.getJSON(url,function(data){
        $("#category").val(data.category);
        $("#subcategory").val(data.subcategory);

        var cat=data.category;
    if(cat=="Commercial residential property" || cat=="Commercial residential property"){
           $(".bunga").removeClass("hidden");
         }else{
           $(".bunga").addClass("hidden"); 
         }
        

      });




     }

   });
</script>
@endpush
