	
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
				<li class="active"></li>
</ol>
@stop

@section('content')

<div class="container-detached">
            <div class="content-detached">

              <!-- Invoice grid options -->
              <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                  <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-filter">
                  
                  <ul class="nav navbar-nav">

                      
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> By Date <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Show all</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Today</a></li>
                        <li><a href="#">Yesterday</a></li>
                        <li><a href="#">This week</a></li>
                        <li><a href="#">This month</a></li>
                        <li><a href="#">This year</a></li>
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> By Status <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Show all</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">On hold</a></li>
                        <li><a href="#">Paid</a></li>
                        <li><a href="#">Cancelled</a></li>
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> By Payment <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Show all</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Bank Transfer</a></li>
                        <li><a href="#">PayBill</a></li>
                        <li><a href="#">M-Pesa</a></li>
                        <li><a href="#">Cash</a></li>
                        <li><a href="#">Others</a></li>
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-numeric-asc position-left"></i> By priority <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Show all</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Highest</a></li>
                        <li><a href="#">High</a></li>
                        <li><a href="#">Normal</a></li>
                        <li><a href="#">Low</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">

                      <input type="text" class="form-control" id="date" style="margin-top:1%;">
                    </li>
                  </ul>

                  <div class="navbar-right">
                    <p class="navbar-text">Sorting:</p>
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#"><i class="icon-sort-alpha-asc position-left"></i> Asc</a></li>
                      <li><a href="#"><i class="icon-sort-alpha-desc position-left"></i> Desc</a></li>
                    </ul>
                  </div>

                </div>
                
              </div>
              <!-- /invoice grid options -->

  </div>
              <!-- Invoice grid -->

  

  <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title"><?=$user->name?> -Invoices  List </h6>
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
                  <th>#</th>
                  <th>Period</th>
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

              @stop
 @push('scripts')
           <script>
             $("#invoice-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/tenants/fetch_tanant_invoices")?>/'+'<?=$user_id?>',
                      columns: [
                  {data: 'invoice_number', name: 'invoice_number'},
                  {data:'created_at',name:'invoices.created_at'},
                  {data:'name',name:'users.name'},
                  {data:'status',name:'invoices.status'},
                  {data:'issue_date',name:'issue_date'},
                  {data: 'due_date', name: 'due_date'},
                  {data: 'amount', name: 'amount'},
                  {data: 'action', name: 'invoices.created_at',searchable:false},
              ],
             });
           </script>
           @endpush
