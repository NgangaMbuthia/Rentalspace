  
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
@include('backend::properties.t_head')
<div class="row">
 <div class="col-md-12">
     <div class="col-md-12">
             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Tenant Payment Accounts</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                    <div class="form-group col-md12 pull-left">
                      <div class="col-md-12">
               <div class="btn-group">
              <a type="button" class="btn btn-sm btn-info" target="_blank" href="<?=url('/backend/properties/managers-reports')?>">Export To PDF</a>
              <a type="button" class="btn btn-sm btn-success"  href="<?=url('/backend/reports/properties/xls')?>"  >Export To Excel</a>
              <a href="<?=url('/backend/reports/properties/csv')?>" type="button" class="btn btn-sm btn-danger">Export To CSV</a>
              </div>
                
              </div>

                      
                    </div>

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            
                            <th>Property</th>
                            <th>Bank</th>
                            <th>Acc Name</th>
                            <th>Acc No</th>
                          
                            <th>Paybill No</th>
                            <th>M-pesa </th>
                            </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>

              </div>
            </div>
              </div>

              @stop
               @push('scripts')
           <script>
             $("#property-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("backend/propery/fetch_propreties_manager")?>',
                        columns: [
                   //{data: 'id', name: 'properties.id'},
                    {data: 'title', name: 'title'},
                    {data:'bank_name',name:'bank_name'},
                    {data:'account_name',name:'account_name'},
                    {data: 'account_number', name: 'account_number'},
                    
                   
                    {data:'paybill',name:'paybill'},
                    {data:'mpesa_phone',name:'mpesa_phone'},
                    
                ],
            });
           </script>
           @endpush

