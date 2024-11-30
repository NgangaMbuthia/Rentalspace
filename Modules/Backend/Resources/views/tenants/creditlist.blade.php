	
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

                                   <li><a  href="{{url('/backend/tenant_reports/credits/excel/credit/'.$tenant_id)}}">Export to Excel</a></li>

                                   
                                   </ul>
            </div>


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="lease-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>Invoice #</th>
              <th>Full Name</th>
              <th>Date Charged</th>
              <th>Unit</th>
              <th>Unit Type</th>

              <th>Ref No</th>
              <th>Amount</th>
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
             $("#lease-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/tenants/fetch_credit_payments")?>/'+'<?=$tenant_id;?>',
                      columns: [
                  {data: 'invoice_id', name: 'tenant_payments.invoice_id'},
                  {data: 'name', name: 'users.name'},
                 
                  {data:'created_at',name:'tenant_payments.created_at'},
                   {data: 'number', name: 'spaces.number'},
                   {data: 'sub_cat', name: 'sub_categories.name'},
                   {data:'reference_number',name:'tenant_payments.reference_number'},
                  {data:'credit',name:'tenant_payments.credit'},
                 
                  ],
             });
           </script>
           @endpush

