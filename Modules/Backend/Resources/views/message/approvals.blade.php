  
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
        
       <li class="active">Service Providers</li>
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

<div class="row">
             <div class="col-md-12">

            <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title">Bulk SMS and Emails Recharges</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
            <div class="table-responsive">
            <table id="job-table" class="table table-hover table-bordered" style="width:100%;">
              <thead>
                <tr class="info">
                  <th>Name</th>
                   <th>Mobile</th>
                  <th>Gateway</th>
                 
                  <th>Amount</th>
                  <th>Ref No</th>
                  <th>Date</th>
                  <th>Status</th>
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
             $("#job-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/providers/fetch_recharge/index")?>',
                      columns: [
                  {data: 'name', name: 'users.name'},
                  {data: 'telephone', name: 'profiles.telephone'},
                  {data:'gateway',name:'topup_histories.gateway'},
                  
                  {data:'amount',name:'topup_histories.amount'},
                  {data:'transaction_code',name:'topup_histories.transaction_code'},
                  {data:'created_at',name:'topup_histories.created_at'},
                  {data: 'status', name: 'topup_histories.status'},
                  
                  {data: 'action', name: 'topup_histories.id',searchable:false},
              ],
             });
           </script>
           @endpush

