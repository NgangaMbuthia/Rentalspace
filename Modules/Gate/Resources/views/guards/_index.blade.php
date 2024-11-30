  
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
       <li><a href="<?=url('/security/guards/assignments')?>">Security</a></li>
         <li><a href="<?=url('/security/guards/assignments')?>">Assignments</a></li>
        
        <li class="active">index</li>
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
                  <h6 class="panel-title">Guard Assignments </h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                 

                    <table id="guard-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Property</th>
                            <th>Gate</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            
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
             $("#guard-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("security/assignments/fetch_assignments")?>',
                        columns: [
                    {data: 'id', name: 'gate_guards.id'},
                    {data: 'name', name: 'users.name'},
                     {data: 'id_number', name: 'profiles.id_number'},
                    {data:'title',name:'properties.title'},
                    {data:'gate_name',name:'gate_gates.name'},
                    {data:'start_date',name:'gate_gateassignments.start_date'},
                    {data: 'end_date', name: 'gate_gateassignments.end_date'},
                    {data: 'assign_status', name: 'gate_gateassignments.status'},

                    
                    
                ],
            });
           </script>
           @endpush

