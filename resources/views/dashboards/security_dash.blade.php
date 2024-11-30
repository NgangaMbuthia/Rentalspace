@extends('layout.main_sidebar')

@section('content')

    <div class="row">
                                <div class="col-lg-3">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <span class="heading-text badge bg-teal-800">
                                                    <span class="glyphicon glyphicon-home ">
                                                        
                                                    </span>
                                                </span>
                                            </div>

                                            <h3 class="no-margin"><?=$visitor_count;?></h3>
                                            Visitors Inside
                                            
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->

                                </div>

                                

                                <div class="col-lg-3">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-blue-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=$current_stats;?></h3>
                                             <?=date('F')?> Visitors
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>

                                <div class="col-lg-3">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-purple-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="reload"></a></li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin">0</h3>
                                            Vehicles Currently Out
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>

                                  <div class="col-lg-3">

                                    <!-- Today's revenue -->
                                    <div class="panel bg-orange-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icon-lock">
                                                    
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=$reported_incidents;?></h3>
                                            Reported Incidences
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>


                            </div>

                             <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-graph position-left"></i>Naviagation Menus</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="btn-group">
                            <a class="btn btn-info" href="<?=url('/security/visitor/create')?>">Visitors Checkin</a>

                            <a  href="<?=url('/security/visitor/checkout')?>" class="btn btn-danger">Visitors Check Out</a>

                             <button class="btn btn-default">Tanants Checkout</button>

                             <a href="<?=url('/security/incident/report')?>" class="btn btn-primary">Report Incidents</a>

                             <a href="<?=url('/security/view/reports/visitors/index')?>" class="btn btn-primary">View Reports</a>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-graph position-left"></i>Vistors Statistics For Last 6 Months</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div id="graph" style="width:100%;" ></div>
                            </div>
                            </div>
                            </div>
                            </div>


                           
                            
                            
                            


@endsection

@push('scripts')
<link href="{{ asset('/assets/js/plugins/morris/morris.css') }}" rel="stylesheet" />
<script src="{{ asset('/assets/js/plugins/morris/raphael.min.js')}}"></script>
<script src="{{ asset('/assets/js/plugins/morris/morris.js')}}"></script>
<script type="text/javascript">






  $.get('<?=url("/security/visitor/statistics")?>',function(data2){
      if(data2=="No Data To Show"){

        $("#graph").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#class-graph").html(data2);

      }else{

             data2=JSON.parse(data2);
    Morris.Area({
element: 'graph',
data: data2,
xkey: "y",
ykeys: ["a"],
labels: ['Amount Spend'],
lineColors:["teal"],
hideHover:false,
fillOpacity : 0.5,
parseTime : false,
 hideHover:"auto",
 resize:true,

});

      }

});






    

    

</script>


@endpush
