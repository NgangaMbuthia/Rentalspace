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
    <h6 class="panel-title"><i class="icon-users position-left"></i>Add New Template</h6>
  </div>

  <div class="panel-body">




    <form   class="stepy-validation" role="form" action="<?=$url;?>"  method="post">
      <fieldset title="1">
        <legend class="text-semibold">General Details</legend>
        {{csrf_field()}}

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Template Name</label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif

            </div>
          </div>





        </div>




        <div class="row">
          <div class="form-group col-md-12 {{ $errors->has('town') ? ' has-error' : '' }}">
            <label>Template Description </label>

            <textarea name="description" class="form-control" rows="4">{{old('description')}}</textarea>
            @if ($errors->has('town'))
            <span class="help-block">
              <strong>{{ $errors->first('town') }}</strong>
            </span>
            @endif

          </div>
   </div>

 <div class="clearfix"></div>
</fieldset>


 <fieldset title="2">
        <legend class="text-semibold">Template Attributes</legend>
      

        <div class="row">
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
              <button class="btn btn-primary" id="add-attribute"><span class="fa fa-plus"></span>Add New Attribute</button>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Key</th>
                      <th>Value</th>
                    </tr>
                  </thead>
                  <tbody id="attribute-body">
                    <tr>
                      <td>
                         <input type="text" name="key[]" required>
                       </td>
                      <td>
                         <input type="text" name="value[]" required>
                       </td>
                       <td><span class="icon-trash remove-me" title="Delete This Attribute" style="cursor:pointer;"></span></td>
                    </tr>
                  </tbody>
                  
                </table>
                

              </div>

            </div>
          </div>
           <div class="col-xs-3 pull-right">
            <h4>Commonly Used  Attributes</h4>
            <ol>
              <li>Bedrooms</li>
              <li>Bathrooms</li>
              <li>Balcony</li>
              <li>Garage</li>
              <li>Store</li>
              <li>Kitchens</li>
              <li>Dinning Rooms</li>
              <li>Fireplaces</li>
              <li>Closets</li>
              <li>Toilets</li>
             
            </ol>




           </div>
    </div>
 

 <div class="clearfix"></div>
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

                                </div>
                            </div>

                            <input type="hidden" class="form-control" name="images" id="img_ids" value="">

                            
                        </div>

                        </fieldset>

      <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
    </form>

  </div>
</div>







{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
<script type="text/javascript">
  $("body").on("click","#add-attribute",function(e){
    e.preventDefault();
  var html=' <tr>'
            +'<td>'
            +'<input type="text" name="key[]" required>'
            +'</td>'
            +'<td>'
            +'<input type="text" name="value[]" required>'
            +' </td>'
            +' <td><span class="icon-trash remove-me" title="Delete This Attribute" style="cursor:pointer;"></span></td>'
            +'</tr>';

          $("#attribute-body").append(html);

          $("body").on('click','.remove-me',function(e){
             var item=$(this).parent().parent();
             $(item).remove();

          });

  });
  

</script>



@endpush