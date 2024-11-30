<?php 
use App\Helpers\Helper;
?>

@extends('layout.wizard')



@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
        
        <li><a href="<?=url()->current();?>"></span>Bulk Payment</a></li>
        <li class="active">Bulk </li>
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
      @include('backend::tenants.t_head')      

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Bulk Tenants Vaccation</h6>
                </div>
                
              <div class="panel-body">


                

                <div class="col-md-4 form-group">
                 
                  <select name="property" class="form-control" id="property">
                    <option value="">--Select Property---</option>
                       <?php foreach($models as $proporty):?>
                           <option value="<?=$proporty->id;?>"><?=$proporty->title;?></option>
                       <?php endforeach;?>
                  </select>
                  
                </div>
                <div class="col-md-4 form-group">
                 
                 <button class="btn btn-primary" id="loadUnits">Load Tenants</button>
                  
                </div>
                 <div class="clearfix"></div>
                <div class="row" id="tabledata">
                 
                  
                </div>

              

              </div>

              </div>

              @stop
              @push('scripts')
              <script type="text/javascript">
                 

                 $("#property").select2();

             $("#loadUnits").on("click",function(e){
              e.preventDefault();

               var property=$("#property").val();
                 if(property.length>0)
                 {
                  var url="<?=url('/backend/MassVacation/getTenants')?>/"+property;
                   
                   $.get(url,function(data){
                   $("#tabledata").html(data);
                   })
                 }
                
                 


             });


                 $("#property").on("change",function(e){
                   var property=$(this).val();
                    if(property.length>0)
                    {
                     var url="<?=url('/backend/make/bulkloadTenants')?>/"+property;
                      $.get(url,function(data){
                        $("#property-body").html(data);


                      })
                    }

                 })

                 

              </script>

             


              @endpush

