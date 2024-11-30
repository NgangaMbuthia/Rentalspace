  
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
       <li><a href="<?=url('/tenants/repair/request/index')?>">My Repair Requests</a></li>
        
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

<div class="row">
   <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Repairs Piad By Tenants  </h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="repair-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                           <th>Ticket#</th>
                            <th>Unit</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Category</th>
                            <th>Expected Investigation Date</th>
                            <th>Expected Repair Date</th>
                            <th>Request Status</th>
                            </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>
              </div>

              </div>

              @stop
               @push('scripts')
           <script>
             $("#repair-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("tenants/repairs/my_repairs")?>',
                        columns: [
                    {data:'repair_ticket',name:'repair_requests.repair_ticket'},
                    {data: 'number', name: 'spaces.number'},
                    {data: 'type', name: 'repair_requests.type'},
                    {data:'priorty',name:'repair_requests.priorty'},
                    {data:'level',name:'repair_requests.level'},
                    {data:'expected_investination_date',name:'repair_requests.expected_investination_date'},
                   
                    {data:'expected_repair_date',name:'repair_requests.expected_repair_date'},
                    {data:'status',name:'repair_requests.status'}
                    
                    
                ],
            });
           </script>
           @endpush

