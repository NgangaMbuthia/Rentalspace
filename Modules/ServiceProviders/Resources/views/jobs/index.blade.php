  
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
        
       <li class="active">Job Requests</li>
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
              <h6 class="panel-title">Job Requests</h6>
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
                  <th>ID</th>
                  <th>Client</th>
                  <th>Property</th>
                          <th>Location</th>
                          <th>Mobile</th>
                          <th>Status</th>
                          <th>Closing Date</th>
                          
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
              ajax: '<?=url("serviceproviders/jobs/fetch_job_requests/".$status)?>',
                      columns: [
                  {data: 'id', name: 'job_requests.id'},
                  {data:'name',name:'users.name'},
                  {data: 'title', name: 'properties.title'},
                  {data:'location',name:'properties.location'},
                  {data:'telephone',name:'profiles.telephone'},
                  {data:'status',name:'job_requests.status'},
                  {data: 'request_close_date', name: 'job_requests.request_close_date'},
                  
                  {data: 'action', name: 'job_requests.created_at',searchable:false},
              ],
             });
           </script>
           @endpush

