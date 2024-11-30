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

                                            <h3 class="no-margin"><?=$properties_count;?></h3>
                                            Properties
                                            
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->

                                </div>

                                <div class="col-lg-3">

                                    <!-- Current server load -->
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-sync"></i>Approved</a></li>
                                                            <li><a href="#"><i class="icon-list-unordered"></i> Pending</a></li>
                                                            <li><a href="#"><i class="icon-pie5"></i> Suspended</a></li>
                                                            <li><a href="#"><i class="icon-cross3"></i> Full List</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=$agents_count;?></h3>
                                             Providers/Agents
                                            
                                        </div>

                                        <div id="server-load"></div>
                                    </div>
                                    <!-- /current server load -->

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

                                            <h3 class="no-margin">0</h3>
                                            Tenants
                                           
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
                                            Service Providers
                                           
                                        </div>

                                        <div id="today-revenue"></div>
                                    </div>
                                    <!-- /today's revenue -->

                                </div>
                            </div>


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

                                            <h3 class="no-margin"><?=$properties_count;?></h3>
                                            Hotels
                                            
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->

                                </div>

                                <div class="col-lg-3">

                                    <!-- Current server load -->
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-sync"></i>Approved</a></li>
                                                            <li><a href="#"><i class="icon-list-unordered"></i> Pending</a></li>
                                                            <li><a href="#"><i class="icon-pie5"></i> Suspended</a></li>
                                                            <li><a href="#"><i class="icon-cross3"></i> Full List</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin"><?=$agents_count;?></h3>
                                             Suppliers
                                            
                                        </div>

                                        <div id="server-load"></div>
                                    </div>
                                    <!-- /current server load -->

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

                                            <h3 class="no-margin">0</h3>
                                            Tour Operators
                                           
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
                                            Hotel Rooms
                                           
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
                                    <h6 class="panel-title"><i class="icon-bucket position-left"></i>Provider Registration statistics</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div id="graph" ></div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                        <div class=
                            "col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Latest Properties To Be Added</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                  
                                        
                                      <?php foreach($properties as $model):?>
                                        <div class="col-lg-6">
                                            <ul class="media-list content-group">
                                              
                                                <li class="media stack-media-on-mobile">
                                                    <div class="media-left">
                                                        <div class="thumb">
                                                            <a href="#">
                                                                <img src="{{asset('/frontend/assets/img/tmp/tmp-10.jpg')}}" class="img-responsive img-rounded media-preview" alt="">
                                                                <span class="zoom-image"><i class="icon-play3"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="media-body">
                                                        <h6 class="media-heading"><a href="#"><?=@$model->title;?></a></h6>
                                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                                            <li><i class="icon-user position-left"></i> <?=@$model->getProvider->user->name;?></li>
                                                            <li><?=$model->created_at->diffForHumans();?></li>
                                                        </ul>
                                                        On it differed repeated wandered required in. Then girl neat why yet knew rose spot...
                                                    </div>
                                                </li>
                                          

                                              
                                            </ul>
                                        </div>
                                          <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <!-- /latest posts -->
                                

                            </div>
                                

                            </div>
                            <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-file-spreadsheet position-left"></i>Revenue Generation Statistics</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div id="graph2" ></div>
                            </div>
                            </div>
                            </div>
                            </div>

                              <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-file-spreadsheet position-left"></i>Providers and Agents Statistics By Status</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="info">
                                <th>Category</th>
                                <th>Pending</th>
                                <th>Approved</th>
                                <th>Suspended</th>
                                <th>Rejected</th>
                                <th>Total</th>
                                </tr>
                                    
                                </thead>
                                <tbody>
                                <tr>
                                <td>Providers</td>
                                <td><?=$agent->getStats("Pending");?></td>
                                <td><?=$agent->getStats("Approved");?></td>
                                <td><?=$agent->getStats("Suspended");?></td>
                                <td><?=$agent->getStats("Rejected");?></td>
                                <td><?=$agent->getStats();?></td>
                                </tr>
                                <tr>
                                <td>Properties</td>
                                <td><?=$property->getStats("Pending");?></td>
                                <td><?=$property->getStats("Approved");?></td>
                                <td><?=$property->getStats("Suspended");?></td>
                                <td><?=$property->getStats("Rejected");?></td>
                                <td><?=$property->getStats();?></td>
                                </tr>
                                    
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
<script type="text/javascript">

Morris.Area({
  element: 'graph',
  data: [
    {x: '2010 Q4', y: 3},
    {x: '2011 Q1', y: 3},
    {x: '2011 Q2', y: 9},
    {x: '2011 Q3', y: 2},
    {x: '2011 Q4', y: 8},
    {x: '2012 Q1', y: 4}
  ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Y'],
  pointSize:2,
  hideHover:'auto',
  resize:true,

});

Morris.Bar({
  element: 'graph2',
  data: [
    {x: '2011', y: 3, z: 12, a: 3},
    {x: '2012', y: 2, z: null, a: 1},
    {x: '2013', y: 0, z: 2, a: 4},
    {x: '2014', y: 2, z: 9, a: 3},
    {x: '2015', y: 2, z: 8, a: 3},
    {x: '2016', y: 2, z: 5, a: 3}
  ],
  xkey: 'x',
  ykeys: ['y', 'z', 'a'],
  labels: ['Bulk SMS', 'Provider Subscriptions', 'Advertisements'],
  stacked: true
});



    

    

</script>


@endpush
