  
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
        
       <li class="active">Amount Added To Your Account</li>
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
                 <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a>
                </ul>
              </li>
            </ul>
@stop

@section('content')

<div class="row">
             <div class="col-md-12">

            <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title">Amount Added To Your Account</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
            <div class="table-responsive">
             <div class="table-responsive">

               <table id="deductions-table" class="table table-hover table-striped table-bordered" style="width:100%;">
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
             $("#deductions-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("tenants/payments/fetch_debit_payments")?>',
                      columns: [
                  {data: 'invoice_id', name: 'invoice_id'},
                  {data: 'name', name: 'users.name'},
                   {data:'created_at',name:'tenant_payments.created_at'},
                   {data: 'number', name: 'number'},
                   {data: 'sub_cat', name: 'sub_categories.name'},
                   {data:'reference_number',name:'reference_number'},
                  {data:'debit',name:'debit'},
                 
                  ],
             });
           </script>
           @endpush


