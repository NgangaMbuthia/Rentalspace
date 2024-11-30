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
@include('backend::properties.s_head')
<div class="panel panel-white">
  <div class="panel-heading">
    <h6 class="panel-title"><i class="icon-users position-left"></i>Add New Space</h6>
  </div>

  <div class="panel-body">




    <form   class="stepy-validation" role="form" action="<?=$url?>"  method="post">
     <?=csrf_field();?>
     <div class="col-md-12">
      <div class="col-md-4 form-group">
        <label>Property Name</label>
        <select class="form-control" name="property_id" id="property_id"  required>
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
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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

      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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

    </div>
     <div class="col-md-12">
      <div class="col-md-4 form-group">
        <label>Template Name</label>
        <select class="form-control" name="template_id" id="property_id"  required>
          <option value="">-----Select Template-----</option>
          <?php foreach($templates as $property):?>
           <option value="<?=$property->id?>">
             {{$property->name}}</option>

           <?php endforeach;?>
           

         </select>
         
         @if($errors->has('title'))
         <span class="help-block">
          <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
        
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
          <label>Unit Monthly Price</label>
          <input type="text"  name="unit_rate" class="form-control number" required   value="<?=old('category')?>" />
          
          @if ($errors->has('unit_price'))
          <span class="help-block">
            <strong>{{ $errors->first('unit_price') }}</strong>
          </span>
          @endif

        </div>
      </div>

      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
          <label>Number of Units/Space</label>
          <input type="text"  class="form-control number"  id="number-of-units" name="number_of_units" value="<?=old('type')
          ?>" required />
          
          @if ($errors->has('number_of_units'))
          <span class="help-block">
            <strong>{{ $errors->first('number_of_units') }}</strong>
          </span>
          @endif

        </div>
      </div>
      
    </div>

     <div class="col-md-12 hidden table-creator" style="margin-bottom: 1%;">
       <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered ">
            <thead>
              <tr class="info">
                <th>#</th>
                <th>UnitName</th>
                <th>Floor</th>
                <th>WaterMeter#</th>
                <th>PowerMeter#</th>
              </tr>
            </thead>
            <tbody id="table-body">
              
            </tbody>
            
          </table>
          
        </div>


       </div>




     </div>
    <div class="col-md-12">
         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
         <button type="submit" class="btn btn-primary stepy-finish">Create Spaces <i class="icon-check position-right"></i></button>
         </div>
      
    </div>

    
  </form>

</div>
</div>







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



    $(".number,.allowed-length").on("keydown",function(e){
      var key = e.keyCode ? e.keyCode : e.which;
    if ( isNaN( String.fromCharCode(key) ) && key != 8 && key != 46  &&key != 190 &&key !=110 &&key !=37 &&key !=39) return false;


      });


    $("body").on("input","#number-of-units",function(e){
      e.preventDefault();
        $("#table-body").html("");
       var value=$(this).val();

         if(value.length>0)
         {
          $(".table-creator").removeClass("hidden");
         }else{
          $(".table-creator").addClass("hidden");
         }
       for (i = 0; i < value; i++) {
        var j=i+1;
       var html='<tr>'
                 +'<td>'+j+'</td>'
                 +'<td><input type="text" required=true name="unitname[]">'
                 +'<td><select name="floor[]" required>'
                  +'<option value="">--Select Floor---</option>'
                  +'<option>Basement 2</option>'
                  +'<option>Basement 1</option>'
                  +'<option>Ground Floor</option>'
                    +'<option>Mezzanine</option>'
                   +'<option>1st Floor</option>'
                    +'<option>2nd  Floor</option>'
                    +'<option>3rd Floor</option>'
                    +'<option>4th  Floor</option>'
                    +'<option>5st Floor</option>'
                    +'<option>6th  Floor</option>'
                    +'<option>7th Floor</option>'
                    +'<option>8th  Floor</option>'
                    +'<option>9th  Floor</option>'
                    +'<option>10st Floor</option>'
                    +'<option>11th  Floor</option>'
                    +'<option>12th Floor</option>'
                    +'<option>13th  Floor</option>'
                    +'<option>12th Floor</option>'
                    +'<option>13th  Floor</option>'
                    +'<option>14th  Floor</option>'
                    +'<option>15st Floor</option>'
                    +'<option>16th  Floor</option>'
                    +'<option>17th Floor</option>'
                    +'<option>18th  Floor</option>'
                     +'<option>19th Floor</option>'
                    +'<option>20th  Floor</option>'
                    +'<option>21st Floor</option>'
                    +'<option>22nd  Floor</option>'
                    +'<option>23rd  Floor</option>'
                    +'<option>24th Floor</option>'
                    +'<option>25th  Floor</option>'
                    +'<option>26th Floor</option>'
                    +'<option>27th  Floor</option>'
                    +'<option>28th  Floor</option>'
                    +'<option>29th Floor</option>'
                    +'<option>30th  Floor</option>'
                    +'<option>31st Floor</option>'
                    +'<option>32nd  Floor</option>'





                 +'</select>'
                 +'<td><input type="text" name="watermeter[]" >'
                  +'<td><input type="text"  name="powermeter[]">'
                 +'</tr>';

        $("#table-body").append(html);
      } 

    })
</script>
@endpush
