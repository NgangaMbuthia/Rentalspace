  
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
@include('backend::properties.t_head')
<div class="row">

             
              
              
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Properties Rent Payment Statistics</h6>
                </div>
                
              <div class="panel-body">
              <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">Graphical View</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Tabulated Format</a></li>
                      
                        </ul>
                      </li>
                    </ul>

                    <div class="tab-content">
                     <div class="tab-pane " id="highlighted-justified-tab2">

                     <div class="table-responsive">
                     <div class="col-md-2 pull-left" style="margin-bottom:5%;">

                      <select class="form-control search" data-url="<?=url('/backend/property/get/statistics')?>">
                      <option>----Select Property------</option>
                     <?php foreach($properties as $property):?>
                     <option value="<?=$property->id?>"><?=$property->title;?></option>
                     <?php endforeach;?>
                       
                     </select>

                     </div>
                     <div class="col-md-2 pull-right" style="margin-bottom:5%;">
                     <select class="form-control">
                     <?php foreach($years as $year):?>
                     <option><?=$year;?></option>
                   <?php endforeach;?>
                       
                     </select>
                       
                     </div>

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th class="text-center" colspan="14"><?=$detail->title?> Performance Over Time</th>
                            </tr>
                            <tr class="info">
                            <th>Year</th>
                            <?php foreach($months as $key=>$value):?>
                              <th><?=$key;?></th>
                            <?php endforeach;?>
                            <th>Total</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($years as $year):?>
                       <tr>
                       <td><?=$year;?></td>
                      <?php foreach($months as $key=>$value):  ?>

                              <td><?=$model->propertystatistics($detail,$year,$value);?></td>
                            <?php endforeach;?>
                            <td><?=$model->propertystatistics($detail,$year,false);?></td>
                          </tr>
                        <?php endforeach;?>
                     </tbody>
                     <tfoot>
                     <tr>
                     <th>Total</th>
                      <?php foreach($months as $key=>$value):?>
                              <th><?=$model->propertystatistics($detail,false,$value)?></th>
                            <?php endforeach;?>

                             <th><?=$model->propertystatistics($detail,false,false)?></th>
                       
                     </tr>
                       
                     </tfoot>

                  </table>



                  </div>


                     </div>



                      <div class="tab-pane active" id="highlighted-justified-tab1">

                         <div class="col-md-2 form-group pull-right">
                         
                  

                  <label>Property</label>
                  <select class="form-control rose-njeri" id="property-id">
                  
                   <?php foreach($properties as $property):?>
                    <option value="<?=$property->id;?>"><?=$property->title;?></option>
                  <?php endforeach;?>
                  </select>
                   <p><br>



                  <label>Graph Type</label>
                  <select class="form-control rose-njeri" id="graphical-id">
                   <option>Area</option>
                   <option>Line</option>
                   <option>Bar</option>
                  
                  </select>
                 



                  

                   
              


                  
                    

                  </div>
                  <div class="col-md-9 form-group">
                  <div id="graph" style="width:100%;" ></div>
                  
                  

                    





                      </div>


                  </div>


            </div>




















                  

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
          
           
<link href="{{ asset('/assets/js/plugins/morris/morris.css') }}" rel="stylesheet" />
<script src="{{ asset('/assets/js/plugins/morris/raphael.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/morris/morris.js')}}"></script>
<script type="text/javascript">
var year="";

 
    $(".rose-njeri").on("change",function(){
        var graphtype=$("#graphical-id").val();
        var kala=$("#graphical-color").val();
        var property=$("#property-id").val();
      drawGraph(graphtype,property,kala);

    });


     function drawGraph(type,property,kolo){
       
          
       
       if(type=="Line"){
        drawLineGraph(property,kolo);

       }else if(type=="Bar"){
        drawBarGraph(property,kolo);
       }else{
        drawAreaGraph(property,kolo);
       }


     }




   function drawLineGraph(property,colo){


      $.get('<?=url("/backend/payment_statistics/graph/")?>/'+property,function(data){
      if(data=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{

        var type="Area";
        $("#graph").html("");
        
       data=JSON.parse(data);
       data2= data.mydata;
       var label=data.label;
       //alert(JSON.stringify(label));
       $("#graph").html("");
      Morris.Line({
      element: 'graph',
      behaveLikeLine: true,
      data: data2,
      xkey: 'x',
      ykeys: label,
      labels: label,
      parseTime : false,
      xLabelAngle:60,
    }); 

      }

});
    

     
   }


    function drawBarGraph(property,colo){


         $.get('<?=url("/backend/payment_statistics/graph/")?>/'+property,function(data){
      if(data=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data);

      }else{
        
        
        

         $("#graph").html("");
        
       data=JSON.parse(data);
       data2= data.mydata;
       var label=data.label;
       //alert(JSON.stringify(label));
       $("#graph").html("");
     $.get('<?=url("/backend/payment_statistics/graph/")?>/'+property,function(data){
      if(data=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{

        var type="Area";
        $("#graph").html("");
        
       data=JSON.parse(data);
       data2= data.mydata;
       var label=data.label;
       //alert(JSON.stringify(label));
       $("#graph").html("");
      Morris.Bar({
      element: 'graph',
      behaveLikeLine: true,
      data: data2,
      xkey: 'x',
      ykeys: label,
      labels: label,
      parseTime : false,
      xLabelAngle:60,
    }); 

      }

});   Morris.Bar({
      element: 'graph',
      behaveLikeLine: true,
      data: data2,
      xkey: 'x',
      ykeys: label,
      labels: label,
      parseTime : false,
      xLabelAngle:60,
   colors: [
    'orange',
    '#1e9090',
    '#fbea19',
    '#95D7BB',
    '#b5a1e7',
    '#f4f6f7',
    '#e6b0aa'
  ],
    }); 

      }

});



    }


     function drawAreaGraph(property,colo){

         $.get('<?=url("/backend/payment_statistics/graph/")?>/'+property,function(data){
      if(data=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{

        var type="Area";
        $("#graph").html("");
        
       data=JSON.parse(data);
       data2= data.mydata;
       var label=data.label;
       //alert(JSON.stringify(label));
       $("#graph").html("");
      Morris.Area({
      element: 'graph',
      behaveLikeLine: true,
      data: data2,
      xkey: 'x',
      ykeys: label,
      labels: label,
      parseTime : false,
      xLabelAngle:60,
    }); 

      }

});

     }


var year='<?=date('Y');?>';
drawAreaGraph('<?=$detail->id?>',"Teal");

</script>


@endpush

