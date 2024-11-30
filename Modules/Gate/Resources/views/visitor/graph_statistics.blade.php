  
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
                  <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

@include('gate::gates.g_head')

<div class="row">
          <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Visitor Statistics For <?=date('Y');?> : Graphical Representation</h6>
                </div>
                
              <div class="panel-body">
                 
                  <div class="col-md-2 form-group pull-right">

                  <label>Graph Type</label>
                  <select class="form-control rose-njeri" id="graphical-id">
                   <option>Area</option>
                   <option>Line</option>
                   <option>Bar</option>
                  
                  </select>
                  <p><br>
                  <label>Year</label>
                  <select class="form-control rose-njeri" id="year">
                    <option>2017</option>
                  </select>
                  <p><br>

                  <label>Property</label>
                  <select class="form-control rose-njeri" id="property-id">
                  <option value="all">   </option>
                   <?php foreach($properties as $property):?>
                    <option value="<?=$property->id;?>"><?=$property->title;?></option>
                  <?php endforeach;?>
                  </select>



                  <label>Graph Color</label>
                  <select class="form-control rose-njeri" id="graphical-color">
                   <option>Teal</option>
                   <option>Red</option>
                   <option>Blue</option>
                   <option>Orange</option>
                   <option>Purple</option>
                   <option>Indigo</option>
                  
                  </select>
                  <p><br>


                   
              


                  
                    

                  </div>
                  <div class="col-md-9 form-group">
                  <div id="graph" style="width:100%;" ></div>
                  
                  

                    



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

  /*$("#graphical-id").on('change',function(){
      var value=$(this).val();
       if(value=="Line"){
        var property_id=$("#property-id").val();
         //alert(property_id);
        drawLineGraph();
       }else if(value=="Bar"){
        drawBarGraph();

       }else{
        drawAreaGraph();
       }
  });
*/

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
    

     $.get('<?=url("/security/statistics/graph/")?>/'+year+'/'+property,function(data2){
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


       $.get('<?=url("/security/statistics/graph/")?>/'+year+'/'+property,function(data2){
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

       $.get('<?=url("/security/statistics/graph/")?>/'+year+'/'+property,function(data2){
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

</script>


@endpush

