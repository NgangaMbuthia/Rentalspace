  
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
        <li><a href="<?=url('/backend/repair/requests/index')?>">Repair Requests</a></li>
        
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
@include('backend::repairs.r_header')

<div class="row">
   <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Repairs Requests From Renter/Tenants</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="repair-request-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                           <th>#</th>
                            <th>Ticket</th>
                            <th>Tenant</th>
                           
                            <th>Unit</th>
                             <th>Priority</th>
                            <th>Type</th>
                         
                            <th>R.I.Date</th>
                            <th>R.S.Date</th>
                            <th>Status</th>
                            
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
             


             $("#repair-request-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("/backend/repairs_index/fetch_repair_requests/".$status)?>',
                        columns: [
                    {data: 'id', name: 'repair_requests.id'},
                    {data: 'repair_ticket', name: 'repair_requests.repair_ticket'},
                    {data: 'name', name: 'users.name'},
                    {data: 'number', name: 'spaces.number'},  //
                    {data: 'priorty', name: 'repair_requests.priorty'},
                    {data: 'repair_type', name: 'repair_requests.type'},
                    {data: 'expected_investination_date', name: 'repair_requests.expected_investination_date'},
                    {data: 'expected_repair_date', name: 'repair_requests.expected_repair_date'},
                     {data: 'repaiR-status', name: 'repair_requests.status'},
                   
                    
                  
                    
                ],
            });
           </script>
           @endpush

