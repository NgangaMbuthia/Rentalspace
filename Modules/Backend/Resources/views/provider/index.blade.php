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
       <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/provider/list')?>">Properties</a></li>
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
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  
                  <li><a href="#"><i class="icon-accessibility"></i>Change Password</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

              <div class="row">
              <div class="col-md-12">
                
              
              

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"></i>Providers List</h6>
                </div>
                
              <div class="panel-body">

               

   <div class="row">
            
            <div class="table-responsive">
            <table id="agent-table" class="table table-hover table-bordered"  style="width:100%;">
                                <thead>
                                    <tr class="info" >
                                   
                                       <th>Name</th>
                                        <th>Telephone</th>
                                        <th>Mobile</th>
                                        <th>PostalAddress</th>
                                        <th>City</th>
                                        
                                        <th>Status</th>
                                        <th>Action</th>
                                        
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

        $("#agent-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/admin/fetch_agents")?>',
                      columns: [
                 
                  {data: 'name', name: 'name'},
                  {data: 'telephone', name: 'telephone'},
                  {data: 'email', name: 'email'},
                  {data: 'postal_address', name: 'postal_address'},
                  {data: 'town', name: 'town'},
                  {data: 'status', name: 'status'},
                   {data: 'action', name: 'created_at'},
                  
                 
              ],
             });
  
  </script>
@endpush