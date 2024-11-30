	
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
<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Tenants Transaction List </h6>

                  <div class="dropdown pull-right" >
                                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  --Export--
                                   <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                   <li><a target="_blank" href="{{url("/user/analysis/year/category/print/")}}">Export to PDF</a></li>

                                   <li><a target="_blank" href="{{url("/user/analysis/year/category/print/")}}">Export to Excel</a></li>

                                   
                                   </ul>
            </div>


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="charge-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>#</th>
              <th>Full Name</th>
              <th>Property </th>
              <th>Unit</th>

              <th>Charge</th>
              <th>Amount</th>
              <th>Effective Date</th>
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
             $("#charge-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/tenants/fetch_charges")?>/'+'<?=$tenant_id;?>',
                      columns: [
                  {data: 'id', name: 'tenant_charges.id'},
                  {data: 'name', name: 'name'},
                 {data:'title',name:'properties.title'},
                 {data:'number',name:'spaces.number'},
                  
                  {data:'charge_name',name:'charge_name'},
                  {data:'amount',name:'amount'},
                  {data:'effective_from',name:'effective_from'},
                 {data:'t_status',name:'tenant_charges.status'},
              ],
             });
           </script>
           @endpush

