  
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
       <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>"></span>Properties</a></li>
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
                  <h6 class="panel-title">Properties Space/Unit Analysis</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                   <div class="col-md-2">
                   <div class="form-group">
                   <label>Graph Type</label>
                   <select class="form-control my-graph" id="type">
                    <option>Bar</option>
                    <option>Line</option>
                   
                   </select>
                     
                   </div>
                   </div>
                   <div class="col-md-10">
                   <div id="graph">
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

 $(".my-graph").on("change",function(e){
   var type=$("#type").val();

   var url="<?=url('/backend/property/spaces_statistics')?>";
   
   
    if(type=="Bar"){
      DrawBarGraph(url);
    } else if(type=="Line"){
     DrawLineGraph(url);
    }else{
      DrawAreaGraph();
    }

 });



  function DrawBarGraph(url){
     
     $.get(url,function(data){

      $("#graph").html("");
       data=JSON.parse(data);
       Morris.Bar({
  element: 'graph',
  data: data,
  xkey: 'x',
  ykeys: ['y', 'z', 'a',],
  labels: ['Empty Spaces', 'Occupied Spaces', 'OnNotice Spaces'],
  lineColors:['red','purple','green'],
  barColors:['blue','Teal','Orange'],
  fillOpacity : 0.6,
  parseTime : false,
  resize:true,
xLabelAngle:7,
});

     });

     
    

  }

  function DrawLineGraph(){
      $.get(url,function(data){

      $("#graph").html("");
       data=JSON.parse(data);
       Morris.Line({
  element: 'graph',
  data: data,
  xkey: 'x',
  ykeys: ['y', 'z', 'a',],
  labels: ['Empty Spaces', 'Occupied Spaces', 'OnNotice Spaces'],
  lineColors:['red','purple','green'],
  barColors:['blue','Teal','Orange'],
  fillOpacity : 0.6,
  parseTime : false,
  resize:true,
xLabelAngle:7,
});

     });

  }

  function DrawAreaGraph(property_id){
     $("#graph").html("");
    Morris.Area({
  element: 'graph',
  data: [
    {x: '2011 Q1', y: 3, z: 5, a: 7,p:9},
    {x: '2011 Q2', y: 6, z: 7, a: 1,p:10},
    {x: '2011 Q3', y: 4, z: 2, a: 5,p:2},
    {x: '2011 Q4', y: 2, z: 1, a: 3,p:10}
  ],
  xkey: 'x',
  ykeys: ['y', 'z', 'a',],
  labels: ['Y', 'Z', 'A'],
  lineColors:['red','purple','green'],
  barColors:['blue','Teal','Orange'],
  fillOpacity : 0.6,
  parseTime : false,
});

  }

  var url="<?=url('/backend/property/spaces_statistics')?>";

  DrawBarGraph(url);




</script>
           <script>
             $("#property-table").dataTable();
           </script>
           @endpush

