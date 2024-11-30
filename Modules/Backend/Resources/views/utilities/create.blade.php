	
	@extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/utility-bills/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Utility Bills</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url()->current();?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url()->current();?>"></span>Utilities</a></li>
       
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
@include('backend::utilities.p_head')
            <div class="row">
              
                
              </div><p>
                
                
                  
              </p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Record Utility Bills By Properties</h6>
                </div>
                
              <div class="panel-body">
                <form action="<?=$url?>" method="post">
                   <?=csrf_field();?>
             
                <div class="col-md-8">
                  <div class="col-md-12">
                    <select  id="property" style="width:30% !important;">
                    <option value="">---Select Property----</option>
                     <?php foreach($properties as $property):?>
                     <option value="<?=$property->id;?>"><?=$property->title;?></option>
                     <?php endforeach;?>
                    </select>
                    <button class="btn btn-xs btn-primary" id="load">Load</button>
                    
                  </div>
                  </div>
                    <div class="col-md-3 pull-right">
                       <input type="text" name="reading-date"  id="datepicker" class="datepicker form-control col-md-6" placeholder="Reading Date" required value="<?=date('Y-m-d')?>">
                    </div>
                <div class="col-md-12" style="margin-top: 2%;">
                  <div class="row">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="info">
                          <th>Unit</th>
                          <th>WaterMeter#</th>
                          <th>ElectrictMeter#</th>
                          <th>OldMeter(Water)</th>
                          <th>WaterMeter Reading</th>
                          <th>OldMeter(Electricity) </th>
                          <th>Electricity Reading</th>
                          
                        </tr>
                      </thead>
                      <tbody id="unit-body">
                        
                      </tbody>
                      
                    </table>
                    



                  </div>
                    
                  </div>
                   
                 
                  
                </div>
                  <div class="col-md-12 hidden submit-me" style="margin-top: 2%;">
                  <div class="row">
                   <button class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
                 

           

              </div>

              @stop
              @push('scripts')
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}">
</script>
           <script>


                $("#load").on("click",function(e){

                e.preventDefault();
                 var value=$("#property").val();
                 if(value.length>0)
                { 

                  loadSpaces(value);
                  $(".submit-me").removeClass("hidden");
                }else{
                  $(".submit-me").addClass("hidden");
                }

                });


                function  loadSpaces(value)
                {
                   var url="<?=url('/backend/utility-bills/fetch_units')?>/"+value;
                  $.get(url,function(data){
                    $("#unit-body").html("");
                       $("#unit-body").html(data);


                  });
                }





              $("#property").on("change",function(e){
                e.preventDefault();

                var value=$(this).val();
                if(value.length>0)
                {
                   loadSpaces(value);
                   $(".submit-me").removeClass("hidden");
                  
                }else{
                  $(".submit-me").addClass("hidden");
                }
               

              });


               $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
      maxDate:0,
    });
           </script>
           @endpush

