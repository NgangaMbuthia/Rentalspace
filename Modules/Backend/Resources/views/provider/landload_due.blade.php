	
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
				<li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
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
@include('backend::tenants.t_head')
<div class="row" style="margin-top:2%;">
              
                
              </div>

             <div class="panel panel-white">

             <div class="panel-heading">
              <h6 class="panel-title">Generate Landload Payment Statement</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
               
                
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12">

                <div class="col-md-3 form-group">
                  <label>Month </label>
                  <select name="property_id" id="Id" class="form-control">

                     <?php foreach($months as $key=>$value):?>
                       <option   <?php if(date('m')==$value):?>selected <?php endif;?>value="{{$value}}">{{$key}}</option>
                     <?php endforeach;?>
                 
                    
                  </select>
                  
                </div>
                <div class="col-md-2 form-group">
                  <label>Year</label>
                  <input type="text" id="from" class="form-control" value="{{date('Y')}}" >
                  
                </div>
               
                <div class="col-md-2">
                  
                <button id="Generate" style="margin-top:18%;" class="btn btn-primary btn-sm">Generate</button>
                
              </div>
                 
                
              </div>
                
              </div>
             
                

             
              <div class="table-responsive" id="tablecontent">

             



              </div>
              

               

              </div>

              @stop
                  @push('scripts')

             <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

              <script>
       
          $("#Id").select2();
  
   

    $("#Generate").on("click",function(e){
      e.preventDefault();
      var id=$("#Id").val();
      var start=$("#from").val();
        
      var url="<?=url('/backend/landload/GetLandloadPaymentStatement')?>";

      $.get(url,{'month':id,'year':start},function(data){
        $("#tablecontent").html("");
        $("#tablecontent").html(data);

      })

    })
  
  </script>
            

           
           @endpush

