  
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

               <div class="table-responsive">
                     <div class="col-md-2 pull-left" style="margin-bottom:5%;">

                      <select class="form-control search" data-url="<?=url('/backend/property/get/repair_statistics')?>">
                      <option>----Select Property------</option>
                     <?php foreach($properties as $property):?>
                     <option value="<?=$property->id?>"><?=$property->title;?></option>
                     <?php endforeach;?>
                       
                     </select>

                     </div>
                      <div class="col-md-7" >
                      <a style="margin-left:45%;" href="<?=url('/backend/property/repairs/statistics/'.date('Y'));?>">All Properties</a>

                      </div>

                     <div class="col-md-2 pull-right" style="margin-bottom:5%;">
                     <select class="form-control">
                      <option>Export</option>
                       
                     </select>
                       
                     </div>

                    <table id="repair-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info"><th colspan="15" class="text-center"><?=$detail->title?> Repair Statsics</th></tr>
                            <tr class="info">
                            <th>Year</th>
                            <th>Object</th>
                            <?php foreach($months as $key=>$value):?>
                              <th><?=$key;?></th>
                            <?php endforeach;?>
                            <th>Total</th>
                            
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                   
                   foreach($years as $myyear):
                    ?>

                  <tr>
                    <td rowspan="2"><?=$myyear;?></td>
                    <td>Number</td>
                    <?php foreach($months as $key=>$value):?>
                    <td><?=$model->statisticscount($detail,$myyear,$value)?></td>
                    <?php endforeach;?>
                    <td><?=$model->statisticscount($detail,$myyear,false)?></td>
                  </tr>

                   <tr class="warning">
                    <td>T. Cost</td>
                     <?php foreach($months as $key=>$value):?>
                    <td><i><?=number_format($model->statistics($detail,$myyear,$value),2)?></i></td>
                     <?php endforeach;?>
                     <td><i><?=number_format($model->statistics($detail,$myyear,false),2)?></i></td>
                  </tr>
                

                   
                   
                   </tr>

                  <?php endforeach;?>
                     </tbody>
                     <tfoot>
                     
                     <tr>
                    <td rowspan="2">Total</td>
                    <td>T.Number</td>
                    <?php foreach($months as $key=>$value):?>
                    <td><?=$model->statisticscount($detail,false,$value)?></td>
                    <?php endforeach;?>
                    <td><?=$model->statisticscount($detail,false,false)?></td>
                  </tr>

                   <tr class="warning">
                    <td>T. Cost</td>
                     <?php foreach($months as $key=>$value):?>
                    <td><i><?=number_format($model->statistics($detail,false,$value),2)?></i></td>
                     <?php endforeach;?>
                     <td><i><?=number_format($model->statistics($detail,false,false),2)?></i></td>
                  </tr>
                

                   
                   
                   </tr>
                       
                     </tfoot>

                  </table>



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
        var year=$("#year").val();
        var property=$("#property-id").val();

         drawGraph(graphtype,year,property,kala);

    });


     function drawGraph(type,year,property,kolo){
       
          
       
       if(type=="Line"){
        drawLineGraph(year,property,kolo);

       }else if(type=="Bar"){
        drawBarGraph(year,property,kolo);
       }else{
        drawAreaGraph(year,property,kolo);
       }


     }




   function drawLineGraph(year,property,colo){
    

     $.get('<?=url("/backend/statistics_graph/")?>/'+year+'/'+property,function(data2){
      if(data2=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{
       

        $("#graph").html("");

      

             data2=JSON.parse(data2);
    Morris.Line({
 element: 'graph',
data: data2,
xkey: "y",
ykeys: ["a"],
labels: ['No of Visitors'],
lineColors:[colo],
hideHover:false,
fillOpacity : 0.5,
parseTime : false,
 hideHover:"auto",
 resize:true,

});

      }

});
   }


    function drawBarGraph(year,property,colo){


      $.get('<?=url("/backend/statistics_graph/")?>/'+year+'/'+property,function(data2){
      if(data2=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{
        
        
        $("#graph").html("");

             data2=JSON.parse(data2);
    Morris.Bar({
 element: 'graph',
data: data2,
xkey: "y",
ykeys: ["a"],
labels: ['No of Visitors'],
lineColors:[colo],
barColors:[colo],
hideHover:false,
fillOpacity : 0.5,
parseTime : false,
 hideHover:"auto",
 resize:true,

});

      }

});



    }


     function drawAreaGraph(year,property,colo){

       $.get('<?=url("/backend/statistics_graph/")?>/'+year+'/'+property,function(data2){
      if(data2=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{
        var type="Area";
        $("#graph").html("");
        var color=$("#graphical-color").val();

             data2=JSON.parse(data2);
    Morris.Area({
 element: 'graph',
data: data2,
xkey: "y",
ykeys: ["a"],
labels: ['No of Visitors'],
lineColors:[colo],
hideHover:false,
fillOpacity : 0.5,
parseTime : false,
 hideHover:"auto",
 resize:true,

});

      }

});

     }


var year='<?=date('Y');?>';
drawAreaGraph(year,'All',"Teal");



$('#test').on('shown.bs.tab', function (e) {

       drawAreaGraph(year,'All',"Teal");
         
      });

</script>

 


@endpush

