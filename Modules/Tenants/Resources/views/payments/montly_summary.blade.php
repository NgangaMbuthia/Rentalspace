	
	@extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/tenants/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="<?=url('/tenants/payment/monthly-summary')?>" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Payment</span></a>
                                <a href="<?=url('/tenants/utility-bills/index');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Utilities</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
        
        <li><a href="<?=url('/backend/v-notice/index')?>"></span>Payment</a></li>
        <li class="active">Summary</li>
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
                 
                </ul>
              </li>
            </ul>
@stop

@section('content')

<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"> Monthly Payment  Summary </h6>

               


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="lease-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>Property</th>
              <th>Unit</th>
             
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
                  {data: 'title', name: 'properties.title'},
                  {data: 'number', name: 'spaces.number'},
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

