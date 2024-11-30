@extends('layout.main_sidebar')

@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">User Module</a></li>
        <li class="active">Add Roles</li>
  </ul>

@stop
@section('content')

	<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title"><i class="icon-bucket position-left"></i>Add New System Roles</h6>
								</div>
								
							<div class="panel-body">
		
				<form method="post" class="form-horizontal" action="{{url('admin/role/store')}}">
				<div class="form-group">
					<label class="col-sm-3">Name:</label>
					<div class="col-sm-9"><input type="text" name="name" value="{{old('name')}}" class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Display Name:</label>
					<div class="col-sm-9"><input type="text" name="display_name" value="{{old('display_name')}}" class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Description:</label>
					<div class="col-sm-9"><textarea name="description" class="form-control">{{old('description')}}</textarea> 

					</div>
				</div>
				
				<div class="form-group">
									<label class=" col-md-3">Permissions</label>
									<div class="col-md-9">
									    <select  id="perm" data-placeholder="Choose permissions" name="permission[]" class="multiple-select2 form-control"  multiple style="width:100%;"  >
									    
							<?php foreach($permissions as $permission): ?>
							<option value="{{$permission->id}}" >{{$permission->display_name}}</option>
							<?php endforeach;?>
							
							</select>


							

							  
									</div>
								</div>
				<div class="form-group">
					<div class="col-md-9 pull-right">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<button class="btn btn-primary" style="width:100%;">Save</button>
					</div>
				</div>
				</form>
				
			</div>
		
	</div>

@stop


@push('scripts')
	
	
	<link href="{{asset ('/assets/select2/select2.css') }}" rel="stylesheet" type="text/css">

	
<script src="{{ asset ('/assets/select2/select2.full.min.js') }}" type="text/javascript"></script>
	
	 <script>

	 $(document).ready(function() {
	   $("#perm").select2();

	 });
	 
	
		
		
	</script>
@endpush