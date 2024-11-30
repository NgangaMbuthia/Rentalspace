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
        <li><a href="<?=url('/backend/module/index')?>">System Modules</a></li>
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
                  
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i>Change Password</a></li>
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
                  <h6 class="panel-title"></i>System Modules</h6>
                </div>
                
              <div class="panel-body">

               

   <div class="row">
            
            <div class="table-responsive">
            <table id="module-table" class="table table-hover table-bordered"  style="width:100%;">
                                <thead>
                                    <tr class="info" >
                                       <th>Name</th>
                                        <th>Standard Charge</th>
                                        <th>No of Users</th>
                                        <th>Date Created</th>
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

        $("#module-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("admin/system/fetch_modules")?>',
                      columns: [
                  {data: 'name', name: 'system_modules.name'},
                  {data: 'standard_charges', name: 'system_modules.standard_charges'},
                  {data: 'no_of_clients', name: 'system_modules.no_of_clients'},
                  {data:'created_at',name:'system_modules.created_at'},
                 
              ],
             });
  
  </script>
@endpush