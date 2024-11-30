  
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
        <li><a href="<?=url('/backend/repair/index')?>"></span>Repairs</a></li>
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
@include('backend::repairs.r_header')

<div class="row">

             
          <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Repair List</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="repair-table" class="table table-hover table-striped" style="width:100%;">
                    <thead>
                    <tr class="info">
                    <th>ID</th>
                    <th>Code</th>
                    <th>Space</th>
                    
                    <th>Type</th>
                    <th>Payer</th>
                    <th>Amount</th>
                    <th>Ticket #</th>
                    
                    <th>Date</th>
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
                ajax: '<?=url("backend/repair/fetch_repairs/".$type)?>',
                        columns: [
                    {data: 'id', name: 'repairs.id'},
                    {data: 'repair_code', name: 'repairs.repair_code'},
                    {data:'title',name:'properties.title'},
                    {data:'repair_type',name:'repairs.type'},
                    {data: 'person_responsible', name: 'repairs.person_responsible'},
                    {data:'total_cost',name:'repairs.total_cost'},
                    {data: 'repair_ticket', name: 'repairs.repair_date'},
                    {data: 'repair_date', name: 'repairs.repair_date'},
                    
                  
                    
                ],
            });
           </script>
           @endpush

