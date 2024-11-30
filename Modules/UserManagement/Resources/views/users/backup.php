@extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
        <li><a href="javascript:;">User Module</a></li>
        <li class="active">User List</li>
</ol>
@stop

@section('content')


	
	<div class="row"> 
		<div class="col-lg-12">
		<a href="<?=url('admin/user/adduser')?>"  title="Add New User" class="btn btn-info">Add New Account</a>
		<p></p>
		<div class="panel panel-info" data-sortable-id="index-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
               
            </div>
            <h4 class="panel-title">User Account List</h4>
        </div>
       <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
            	<form method="POST" id="search-form" role="form">
      <div class="form-group col-md-2">
        <label>Name</label>
        <input type="text" class="form-control" name="file_number" id="name" placeholder="Name">

      </div>
      <div class="form-group col-md-2">
        <label>Email</label>
         <input type="text" class="form-control" name="email" id="email" placeholder="email">

      </div>

      <div class="form-group col-md-2">
        <label>Telephone</label>
         <input type="text" class="form-control" name="mobile" id="name" placeholder="Mobile Number">

      </div>


      <div class="form-group col-md-2">
        <label>ROLE</label>
        <select class="form-control" id="role" name="branch_id">
           <option> </option>
           <?php foreach($roles as $role):?>
           	<option value="<?=$role->name?>"><?=$role->display_name?></option>

           <?php endforeach;?>
          
        </select>

      </div>
       <div class="form-group col-md-2">
        <label>STATUS</label>
        <select class="form-control" id="status" name="status">
          <option>  </option>
         <option>Active</option>
         <option>Blocked</option>
        </select>
        </div>
   <div class="form-group col-md-2">
        <label>Date</label>
         <input type="datepicker" id="datepicker" name="created_at" class="form-control" />

      </div>
     

     
    </form>
      </div>
            </div>
           
            	
            
            <div class="table-responsive">
			  <table id="data-table" class="table table-hover table-bordered" >
                                <thead>
                                    <tr class="info">
                                       <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Role</th>
                                          <th>Date</th>
                                        <th>Status</th>
                                        <th>Block</th>
                                      
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
 
  
   

	
	</script>
@endpush