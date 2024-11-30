  
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
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li><a href="<?=url('/backend/property/view/'.$model->id)?>"></span><?=$model->title;?></a></li>
        <li><a href="<?=url('/backend/property/view/'.$model->id)?>"></span><?=$model->number;?></a></li>
        <li class="active">Invoice</li>
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
@include('backend::properties.t_head')
<div class="row">
             <div class="col-md-12">

            <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title"><?=$model->number;?>  Invoices </h6>
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
                  <th>Invoice #</th>
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
  </div>
  </div>

              @stop
 @push('scripts')
           <script>
             $("#invoice-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/space/fetch_invoices")?>/'+'<?=$id?>',
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

