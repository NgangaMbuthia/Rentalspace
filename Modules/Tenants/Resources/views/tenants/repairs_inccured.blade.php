  
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
        
        <li class="active">Repair Incurred</li>
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
                  <h6 class="panel-title">Repairs Piad By Tenants  </h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="repair-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                           
                            <th>Unit</th>
                            <th>Repair Code</th>
                            <th>Repair Date</th>
                            <th>Service Fee</th>
                            <th>Total Cost</th>
                            <th>Person Responsible</th>
                            <th>Invioce Number</th>
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
             $("#repair-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("tenants/repairs/fetch_repairs")?>',
                        columns: [
                    
                    {data: 'number', name: 'spaces.number'},
                    {data: 'repair_code', name: 'repair_code'},
                    {data:'repair_date',name:'repair_date'},
                    {data:'technician_fee',name:'technician_fee'},
                    {data:'total_cost',name:'total_cost'},
                   
                    {data:'person_responsible',name:'person_responsible'},
                    {data:'invoice_number',name:'invoice_number'}
                    
                    
                ],
            });
           </script>
           @endpush

