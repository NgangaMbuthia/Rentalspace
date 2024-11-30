  
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
        
        <li class="active">Units</li>
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
                  <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

@include('gate::gates.g_head')

<div class="row">
          <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Guard Management </h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                  <button  data-url="<?=url('/security/guards/create')?>"    class="btn btn-info reject-modal" data-title="Add New Guard">Add New Guard</button>

                    <table id="guard-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Mobile</th>
                            <th>Employer</th>
                            <th>Assignment Status</th>
                            <th>Property</th>
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

              @stop
               @push('scripts')
           <script>
             $("#guard-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("security/guards/fetch_guards")?>',
                        columns: [
                    {data: 'id', name: 'gate_guards.id'},
                    {data: 'name', name: 'users.name'},
                     {data: 'id_number', name: 'id_number'},
                    {data:'telephone',name:'profiles.telephone'},
                    {data:'employer_name',name:'employer_name'},
                    {data:'assignment_status',name:'gate_guards.assignment_status'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'gate_gates.created_at',searchable:false},

                    
                    
                ],
            });
           </script>
           @endpush

