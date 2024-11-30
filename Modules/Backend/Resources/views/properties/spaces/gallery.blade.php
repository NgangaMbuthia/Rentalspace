  

  <?php
 
  use App\Helpers\Helper;


  ?>

  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li><a href="<?=url('/backend/space/listView')?>"></span>Space Management</a></li>
        <li class="active">Units</li>
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
<div class="row">
          <div class="col-md-12">
          <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Space Gallery </h6>
                </div>
                
              <div class="panel-body">

          <?php foreach($images as $image):


  ?>

  <div class="col-lg-3 col-sm-6">
              <div class="thumbnail">
                <div class="thumb">
                  <img src="{{Helper::getFilePath($image->image_id)}}" alt="dhjdj" style="height:180px;">
                  <div class="caption-overflow">
                    <span>
                      <a href="{{Helper::getFilePath($image->image_id)}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                      <a title="Delete This Image"   data-url="<?=url('/backend/space/image_delete/'.$image->id)?>"  class="delete-record btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i  class="icon-trash" data-name="Space Image"></i></a>
                    </span>
                  </div>
                </div>
              </div>
            </div>

      <?php endforeach;?>

             

             

              </div>
              </div>
              </div>
              </div>

              @stop
               
