	
	@extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('backend/invoice/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoice</span></a>
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="<?=url('/backend/invoices/index')?>">Invoice Management</a></li>
				<li class="active"><?=$status?></li>
</ol>
@stop

@section('content')
@include('backend::tenants.t_head')
              <!-- Invoice grid -->

<style type="text/css">
  
  th, td { white-space: nowrap; }

  .dataTables_scrollBody thead tr[role="row"]{
    visibility: collapse !important;
}
</style>
  

  <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title"><?=$status;?>  Invoices </h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
            <div class="table-responsive">
            <table id="invoice-table" class="table table-hover table-bordered" style="width:100%;">
              <thead>
                <tr class="info">
                  <th>Invoice Number</th>
                  <th>Period</th>
                  <th>Property Name</th>
                  <th>Unit Name</th>
                  <th>Issued To</th>
                  <th>Status</th>
                  <th>Issue Date</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                  <th class="text-center">Actions</th>
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
             $("#invoice-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/tenants/fetch_invoices")?>/'+'<?=$status?>',
                      columns: [
                  
                  {data: 'invoice_number', name: 'invoices.invoice_number'},
                  {data:'created_at',name:'invoices.created_at'},
                  {data:'title',name:'properties.title'},
                  {data:'number',name:'spaces.number'},
                  {data:'name',name:'users.name'},
                  {data:'status',name:'invoices.status'},
                  {data:'issue_date',name:'invoices.issue_date'},
                  {data: 'due_date', name: 'invoices.due_date'},
                  {data: 'amount', name: 'invoices.amount'},
                  {data: 'action', name: 'invoices.created_at',searchable:false,orderable:false},
                  
              ],
             });
           </script>
           @endpush
