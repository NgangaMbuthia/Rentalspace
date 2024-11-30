@extends('layout.wizard')

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

                                            <h3 class="no-margin"><?=@$properties_count;?></h3>
                                            Properties
                                            
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
                                                            <li><a href="#"><?=$fee_spaces;?>&nbsp;&nbsp;Free</a></li>
                                                            <li><a href="#"><?=$occupied_spaces;?> &nbsp;&nbsp;Occupied</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=@$spaces;?></h3>
                                             Total Spaces
                                            
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
<a href="<?=url('/backend/spaces/bookings')?>" style="color:white;">
                                            <h3 class="no-margin"> <?=$bookings?></h3>
                                            Bookings</a>
                                           
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

                                            <h3 class="no-margin"><?=$tenants_count?></h3>
                                            Tenants
                                           
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
                                             <a href="<?=url('/backend/repair/requests/index')?>" style="color:white">

                                            <h3 class="no-margin"><?=$repair_request_count;?></h3>
                                            Repair Requests

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
                                            <a href="<?=url('/backend/v-notice/index')?>" style="color:white">

                                            <h3 class="no-margin"><?=$vacattion_requests_count?></h3>
                                            Vaccation Notices
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
                                    <h6 class="panel-title"><i class="icon-graph position-left"></i>Tenant Rent Payments statistics In KES :&nbsp;<label id="pyear"><?=date('Y');?></label></h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="com-md-12">
                          
                            <div id="graph" ></div>
                                
                            </div>

                            
                            </div>
                            </div>
                            </div>


                            <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="fa fa-pie-chart"></i>General Analysis</h6>
                                </div>
                                
                            <div class="panel-body">

                            <div id="container" class="text-center" ></div>


                            </div>
                            </div>




                            </div>

                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="fa fa-pie-chart"></i>Daily Payment  Analysis For <?=date('Y')?></h6>
                                </div>
                                
                            <div class="panel-body">

                            <div id="daily_Payment" class="text-center" ></div>


                            </div>
                            </div>




                            </div>
                            
                          

                              <div class="row">
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
                                <th>Empty</th>
                                <th>Occupied</th>
                                <th>Invoiced</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                
                                </tr>
                                    
                                </thead>
                                <tbody>
                                <?php foreach($properties as $property):?>
                                    <tr>
                                    <td style="border-right:1 solid black;"><?=$property->title;?></td>
                                    
                                    <td><?=$summary->getSpaceFree($property->id)?></td>
                                     <td><?=$summary->getOccipiedFree($property->id)?></td>
                                     <td><?=$summary->getInvoiced($property->id)?></td>
                                     <td><?=$summary->getPaid($property->id)?></td>
                                     <td><?=$summary->getBalance($property->id)?></td>
                                   

                                   </tr>


                                <?php endforeach;?>
                                    


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





var url="<?=url('/Property/paymentStatistics')?>";
$.get(url,function(data){
    Highcharts.chart('graph', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Provider Payment By Month '
    },
    subtitle: {
        text: 'Source: {{config('app.name')}}'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (KES)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: data
});


})













$.get('<?php echo url('/get_invoices/status/statistics')?>',{},function(data){

    if(data=="No Data To Show"){
        $("#container").css({'color': 'Black',
                         'font-weight':'bold',
                         'padding-top':'75px',
                         'font-size':'24px',

                       });
        $("#container").html(data);
}else{

   $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 55,
                beta: 0
            }
        },
        title: {
            text: 'Payment Statistic For <?=date("M,Y")?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}</b><br>{point.percentage:.1f}%</br>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.y}<br>{point.percentage:.1f}%</br>'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Number',
            data: data
        }]
    });

}

  
  

});





    

    

</script>
<script type="text/javascript">
    var url="<?=url('/payments/getDailyPayment')?>";

    $.get(url,function(data){
        Highcharts.chart('daily_Payment', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Payment Per Day In <?=date("M")?>'
    },
    subtitle: {
        text: 'Source:<?=config("app.name")?>'
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Amount (KES)'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Payment For <?=date("M")?>: <b>{point.y:.1f} Kes</b>'
    },
    series: [{
        name: 'Payment',
        data: data,
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

    });
   
    

</script>


@endpush
