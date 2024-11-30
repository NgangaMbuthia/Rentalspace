@extends('layout.main')

@section('content')

    <div class="row">
                                <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400">
                                    
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <span class="heading-text badge bg-teal-800">
                                                    <span class="glyphicon glyphicon-home ">
                                                        
                                                    </span>
                                                </span>
                                            </div>
                                             <a style="color:white" href="<?=url('/hotels/hotel/index')?>">
                                            <h3 class="no-margin">
                                            <?=$hotel_count;?></h3>
                                             </a>
                                           Hotels
                                            
                                        </div>
                                       

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->

                                </div>

                                <div class="col-lg-2">

                                    <!-- Current server load -->
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><?=$empty_rooms_count;?>&nbsp;&nbsp;Empty</a></li>

                                                             <li><a href="#"><?=$booked_rooms_count;?>&nbsp;&nbsp;Booked</a></li>

                                                            <li><a href="#"><?=$occupied_rooms_count;?> &nbsp;&nbsp;Occupied</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                             <a href="<?=url('/hotels/rooms/index')?>" style="color:white">

                                          <h3 class="no-margin"><?=$rooms_count;?></h3>
                                            Rooms

                                            </a>

                                            
                                            
                                        </div>

                                        <div id="server-load"></div>
                                    </div>
                                    <!-- /current server load -->

                                </div>

                                <div class="col-lg-2">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-blue-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin">0</h3>
                                            Bookings
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>

                                <div class="col-lg-2">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-purple-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>
                                            <a href="<?=url('/hotels/amentities/index')?>" style="color:white">

                                           <h3 class="no-margin"><?=$amentities_count?></h3>
                                            Amentities

                                            </a>

                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>

                                 <div class="col-lg-2">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-orange-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>
                                             <a href="<?=url('/hotels/rooms/room-types')?>" style="color:white">

                                            <h3 class="no-margin"><?=$room_name_count;?></h3>
                                            Room Names

                                            </a>
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>



                                    <!-- /today's revenue -->

                                </div>

                                <div class="col-lg-2">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-green-400">
                                    
                                        <div class="panel-body">
                                        
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>
                                            <a href="<?=url('/hotels/room/bed-types')?>" style="color:white">

                                            <h3 class="no-margin"><?=$bed_type_count;?></h3>
                                            Bed Types
                                             </a>
                                           
                                        </div>
                                       

                                        <div id="today-revenue"></div>
                                    </div>


                                    
                                    <!-- /today's revenue -->

                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-8">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-graph position-left"></i>Income By Hotels In KES</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="com-md-12">
                            <div class="row">
                            <div class="col-md-2 form-group">
                            <label>Graph Type</label>
                            <select class="form-control my-graph" id="type">
                            <option value="Area"></option>
                            <option>Bar</option>
                            <option>Line</option>
                            <option>Area</option>
                                
                            </select>
                                
                            </div>
                             <div class="col-md-4 form-group">
                            <label>Hotel</label>
                            <select class="form-control my-graph" id="hotel">
                            <option value="All"></option>
                            <?php foreach($hotels as $hotel):?>
                            <option value="<?=$hotel->id?>"><?=$hotel->hotel_name?></option>
                            <?php endforeach;?>
                           
                                
                            </select>
                                
                            </div>

                             <div class="col-md-2 form-group">
                            <label>Year</label>
                            <select class="form-control my-graph" id="mwaka">
                            <option value="All"></option>

                            <?php foreach($years as $maka):?>
                            <option><?=$maka?></option>
                            <?php endforeach;?>
                            
                                
                            </select>
                                
                            </div>

                            <div class="col-md-2 form-group pull-right">
                            <label>Graph Color</label>
                            <select class="form-control my-graph" id="my-color">
                            <option value="#29B6F6"></option>
                            <option>Blue</option>
                            <option>Red</option>
                            <option>Green</option>
                            <option>Orange</option>
                            <option>Indigo</option>
                            <option>Aqua</option>
                            <option>Purple</option>
                            <option value="#EC407A">Pink</option>
                            <option>Teal</option>
                                
                            </select>
                                
                            </div>
                                
                            </div>
                            <div id="graph" ></div>
                                
                            </div>

                            
                            </div>
                            </div>
                            </div>


                            <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="fa fa-pie-chart"></i>Last 6 Months Bookings</h6>
                                </div>
                                
                            <div class="panel-body">

                            
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                            <thead>
                            <tr class="info">
                            <th>#</th>
                            <th>Month</th>
                            <th>Number</th>
                              
                            </tr>
                              
                            </thead>
                            <tbody>
                            <?php $i=1;foreach($months as $key):?>
                            <tr>
                            <td><?=$i;?></td>
                            <td><?=$key;?></td>
                            <td>0</td>
                            </tr>
                            <?php $i++; endforeach;?>
                              


                            </tbody>
                              
                            </table>
                              

                           
                              



                            </div>


                            </div>
                            </div>




                            </div>
                            
                            <div class="row">
                            <div class="col-md-12">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-file-spreadsheet position-left"></i>Hotel Year Performance Analysis </h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered  table-hover">
                            <thead>
                            <tr class="info">
                            <th>Hotel</th>
                            <th>Type</th>
                            <?php foreach($years as $year):?>
                              <th><?=$year;?></th>
                            <?php endforeach;?>
                            
                              
                            </tr>
                              
                            </thead>
                            <tbody>
                            <?php foreach($hotels as $hotel):?>
                              <tr>
                              <td rowspan="2"><?=$hotel->hotel_name?></td>
                              <td>Bookings</td>
                               <?php foreach($years as $key):?>
                                  <td>0</td>
                                 <?php endforeach;?>
                                 </tr>

                                 <tr>
                     <td>Total Amount</td>
                     <?php foreach($years as $key):?>
                      
                      <td><?=number_format(0,2)?></td>
                       
                      <?php endforeach;?>
                      
                
                  </tr>

                                
                              
                                
                              </tr>


                              <?php endforeach;?>
                              
                            </tbody>
                              

                            </table>
                              
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>

                              <div class="row hidden">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-file-spreadsheet position-left"></i>Rent Payment Statistics By Property</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="info">
                                <th>Property</th>
                                <?php foreach($years as $year):?>
                                <th><?=$year;?></th>
                               <?php endforeach;?>
                                <th>Total</th>
                                </tr>
                                    
                                </thead>
                                <tbody>
                                
                                    


                                </tbody>
                                
                                    
                                </table>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>

@endsection

@push('scripts')
<link href="{{ asset('/assets/js/plugins/morris/morris.css') }}" rel="stylesheet" />
<script src="{{ asset('/assets/js/plugins/morris/raphael.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/morris/morris.js')}}"></script>
<script src="{{ asset ('/assets/js/plugins/morris/highcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/assets/js/plugins/morris/highcharts-3d.js') }}" type="text/javascript"></script>

<script type="text/javascript">

 $(".my-graph").on("change",function(){
     var type=$("#type").val();
      var color=$("#my-color").val();
      var mwaka=$("#mwaka").val();
      var hotel=$("#hotel").val();
      
      DrawGraph(type,color,mwaka,hotel);

 });

  function DrawGraph(type,color,year,hotel){
     if(type=="Bar"){
      var url="<?=url('/hotels/payment')?>/"+hotel+"/"+year;
       
        $.get(url,function(data){
            $("#graph").html("");
    data=JSON.parse(data);
Morris.Bar({
  element: 'graph',
  data: data,
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Y'],
  pointSize:2,
  hideHover:'auto',
  resize:true,
  parseTime : false,
  fillOpacity : 0.6,
  lineColors:[color],
barColors:[color],

});

});

     }else if(type=="Area"){
      var url="<?=url('/hotels/payment')?>/"+hotel+"/"+year;

        $.get(url,function(data){
            $("#graph").html("");
    data=JSON.parse(data);
Morris.Area({
  element: 'graph',
  data: data,
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Y'],
  pointSize:2,
  hideHover:'auto',
  resize:true,
  parseTime : false,
  fillOpacity : 0.6,
  lineColors:[color],
barColors:[color],

});

});

     }else{
      var url="<?=url('/hotels/payment')?>/"+hotel+"/"+year;
        $.get(url,function(data){
            $("#graph").html("");
    data=JSON.parse(data);
Morris.Line({
  element: 'graph',
  data: data,
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Y'],
  pointSize:2,
  hideHover:'auto',
  resize:true,
  parseTime : false,
  fillOpacity : 0.6,
  lineColors:[color],
barColors:[color],

});

});
     }






  }



DrawGraph("Area","#29B6F6","All","All");

















    

    

</script>


@endpush
