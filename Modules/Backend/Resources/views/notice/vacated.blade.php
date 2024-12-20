	
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
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
        <li><a href="<?=url('/backend/v-notice/index')?>"></span>V-Notices</a></li>
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
@include('backend::tenants.t_head')
            <div class="row">
              
                
              </div><p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Tenant Vaccation Notice Management</h6>
                </div>
                
              <div class="panel-body">
               
              
              <div class="table-responsive">

              <table id="notice-table" class="table  table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>Action</th>
              <th>Property</th>
              <th>Unit</th>
              <th>Tenant</th>
              <th>Vaccation Date</th>
              <th>Balance</th>
              
            </tr>
            </thead>
            </table>
              </div>

              </div>

              </div>

              @stop
              @push('scripts')
           <script>
             $("#notice-table").dataTable({
        processing: true,
        serverSide: true,
        ajax: '<?=url("backend/notices/FetchList")?>',
                columns: [
            {data: 'action', name: 'action',searchable:false,orderable:false},
            {data:'title',name:'properties.title'},
            {data:'number',name:'spaces.number'},
            {data: 'name', name: 'users.name'},
            {data: 'vacation_date', name: 'tenants.vacation_date'},
            {data:'vacation_balance',name:'tenants.vacation_balance'},
            
         
            
            
        ],
    });
           </script>
           @endpush

