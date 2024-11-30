	
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
<div class="row" style="margin-top:2%;">
              
                
              </div>

             <div class="panel panel-white">

             <div class="panel-heading">
              <h6 class="panel-title">List Of Tenants</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
               
                
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12">
               <div class="btn-group">
              <a type="button" class="btn btn-info" target="_blank" href="<?=url('/backend/reports/tenants')?>">Export To PDF</a>
              <a type="button" class="btn btn-success"  href="<?=url('/backend/reports/tenants/xls')?>"  >Export To Excel</a>
              <a href="<?=url('/backend/reports/tenants/csv')?>" type="button" class="btn btn-danger">Export To CSV</a>
              </div>
                
              </div>
              
                
              </div>
              <div class="table-responsive">

              <table id="tenants-table" class="table table-hover table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
            
               <th>Property Name</th>
              <th>Unit </th>
              <th>Tenant Name</th>
              <th>Telephone</th>

              <th title="Monthly Charges">Charges</th>
              <th>Balance</th>
               
              </tr>
            </thead>
            <tbody>
            

            </tbody>

            </table>



              </div>

              </div>

              </div>

              @stop
                  @push('scripts')
           <script>
             $("#tenants-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/tenants/fetch_tenants")?>',
                      columns: [
                  
                  {data: 'title', name: 'properties.title'},
                  {data: 'number', name: 'spaces.number'},
                  {data:'name',name:'users.name'},
                  {data:'telephone',name:'profiles.telephone'},
                  
                  {data:'created_at',name: 'created_at',searchable:false},
                  {data:'updated_at',name: 'updated_at',searchable:false},
                 
              ],
             });
           </script>
           @endpush

