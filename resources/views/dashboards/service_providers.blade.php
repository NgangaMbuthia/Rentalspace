@extends('layout.main_sidebar')

@section('content')

    <div class="row">
                                <div class="col-lg-3">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <span class="heading-text badge bg-teal-800">
                                                    <span class="icon-coins">
                                                        
                                                    </span>
                                                </span>
                                            </div>

                                            <h3 class="no-margin"><?=@$total_works;?></h3>
                                            Total Earnings
                                            
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
                                                <ul class="icon-cash3">
                                                    
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=@$active_balance;?></h3>
                                            Current Balance
                                           
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
                                                <ul class="icon-piggy-bank">
                                                    
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=@$total_earnings;?></h3>
                                            Completed Works
                                           
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
                                                <ul class="icon-upload">
                                                    
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=$job_requests;?></h3>
                                            Job Requests
                                           
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
                                    <h6 class="panel-title"><i class="icon-graph position-left"></i>Monthly Spending In KES For Last 6 Months</h6>
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
$.get('<?=url("/tenants/statistics/".date("Y"))?>',function(data2){
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
lineColors:["red"],
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
