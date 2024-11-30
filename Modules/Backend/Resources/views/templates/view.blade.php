<?php 
use App\Helpers\Helper;
?>

@extends('layout.wizard')



@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/templates/index')?>"></span>Templates</a></li>
        <li><a href="<?=url()->current();?>"></span>Space Template</a></li>
        <li class="active"><?=$model->id?></li>
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
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Template Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                      <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">General Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Template Gallery</a></li>
                      
                     
                         
                       

                          
                        </ul>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td  colspan="2">Template Name</td>
                          <td><?=$model->name?></td>
                        </tr>
                         <?php foreach($model->attributes as $attr):?>
                           <tr>
                          <td colspan="2"><?=$attr->key?></td>
                          <td><?=$attr->value?></td>
                          <td>
                            <span data-url="<?=url('/backend/template/edit-attribute/'.$attr->id)?>" class="icon-pencil reject-modal" data-title="Edit Details" style="cursor: pointer;" title="Edit Details"></span>

                            </td>
                        </tr>


                         <?php endforeach;?>



                         <tr>
                          <td>Description</td>
                          <td><?=$model->description?></td>
                        </tr>
                         
                    
                          
                          

                        </table>
                          
                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab2">
                           
                          <?php if(sizeof($model->images)>0):?>
                            <div class="clearfix"></div>
                       <div class="table-responsive" style="margin-top: 3%;"> 
                        <?php foreach($model->images as $image):?>

  <div class="col-lg-4 col-sm-6">
              <div class="thumbnail">
                <div class="thumb">
                  <img src="{{Helper::getFilePath($image->image_id)}}" alt="dhjdj" style="height:180px;">
                  <div class="caption-overflow">
                    <span>
                      <a href="{{Helper::getFilePath($image->image_id)}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                      <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                    </span>
                  </div>
                </div>
              </div>
            </div>

      <?php endforeach;?>
                      </div>



                       <?php else:?>

                        <h4>No Images To Display</h4>

                       <?php endif;?>
                      </div>

                       
                      
                      



                    </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')

<script type="text/javascript">
    $('#reapir').DataTable();
</script>
@endpush
