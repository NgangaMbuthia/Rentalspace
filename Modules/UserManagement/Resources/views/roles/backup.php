@extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Management</a></li>
				<li class="active">Role List</li>
</ol>
@stop

@section('content')
	
	<div class="row"> 
	<div class="col-lg-12">
		<a href="<?=url('/admin/role/addrole')?>"  title="Add New User" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>Add New Role  </a>
		<p></p>
		<div class="panel panel-info" data-sortable-id="index-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
               
            </div>
            <h4 class="panel-title">System Roles</h4>
        </div>
       <div class="panel-body">
		
				
				<table id="role-datatable" class="table table-hover table-bordered" >
                                <thead>
                                    <tr class="info">
                                       <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        
                                      
                                      
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
	  	$(document).ready(function() {
	  			$('#role-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?=url("admin/role/fetch_roles")?>',
               columns: [
            {data: 'id', name: 'id'},
            {data: 'display_name', name: 'display_name'},
            {data: 'description', name: 'description'},
         
            {data: 'action', name: 'action',searchable:false},
       


        ],

    });



	  			});
	</script>
@endpush