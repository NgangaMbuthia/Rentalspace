  
  <?php
 
  use App\Helpers\Helper;


  ?>

  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/hotels/hotel/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Hotels</span></a>
                <a href="<?=url('/hotels/rooms/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Rooms</span></a>
                                <a href="<?=url('hotel/bookings/index');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Bookings</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/hotels/supplier/gallery')?>"></span>My Gallery</a></li>
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

<div class="row">

<div class="col-md-12">

<?php foreach($images as $image):


  ?>

  <div class="col-lg-3 col-sm-6">
              <div class="thumbnail">
                <div class="thumb">
                  <img src="{{Helper::getFilePath($image->id)}}" alt="Image Not Found" style="height:180px;">
                  <div class="caption-overflow">
                    <span>
                      <a href="{{Helper::getFilePath($image->id)}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                      <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                    </span>
                      <?=($image->hotel)?$image->hotel->hotel_name:''?>
                  </div>
                </div>
               <?=($image->hotel)?$image->hotel->hotel_name:''?>
              </div>
            </div>

      <?php endforeach;?>



  


</div>



        
</div>

              @stop
              

