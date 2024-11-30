	
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
<p>

  <a href="{{url('/backend/make/bulkpayment')}}" class="btn btn-success">Bulk Payments</a>
  
  <button data-url="<?=url('/backend/reports/payment-report')?>" class="btn btn-primary reject-modal" data-title="Genarate Monthly Summary">Genarate Monthly Reports</button>

   <button data-url="<?=url('/backend/reports/monthlyBreakdown')?>" class="btn btn-danger reject-modal" data-title="Genarate Monthly Breakdown">Genarate Monthly Breakdown</button>
</p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Tenants Monthly Summaries </h6>

                  


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="lease-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>Property</th>
              <th>Unit</th>
              <th>Tenant</th>
              <th>Bal/BF</th>
              <th>InvoicedAmount</th>
              <th>ResultantBal</th>
              <th>AmountPiad</th>
              <th>Bal/CF</th>
              <th>Month</th>
               <th>Year</th>
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
              ajax: '<?=url("backend/tenants/fetch_monthly_summary")?>',
                      columns: [
                  {data: 'title', name: 'properties.title','visible':false},
                  {data: 'number', name: 'spaces.number'},
                  {data: 'name', name: 'users.name'},
                  {data: 'bal_brought_forward', name: 'tenant_summaries.bal_brought_forward'},
                  {data:'invoice_amount',name:'tenant_summaries.invoice_amount'},
                  {data:'outstanding_balance',name:'tenant_summaries.outstanding_balance'},
                  {data:'amount_paid',name:'tenant_summaries.amount_paid'},
                  {data:'bal_carried_foward',name:'tenant_summaries.bal_carried_foward'},
                  {data:'month',name:'tenant_summaries.month'},
                  {data:'year',name:'tenant_summaries.year'},
              ],
              dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
             });
           </script>
           @endpush

