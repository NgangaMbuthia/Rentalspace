@extends('layout.main')

@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Management</a></li>
				<li class="active">update/user/<?=$model->id?></li>
</ol>
@stop

@section('content')
	
	<div class="row">
	<p>
	 <a href="<?=url('/admin/user/viewuser')?>" class="btn btn-success">Cancel</a>

	</p>
	<div class="panel panel-info" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                               
                            </div>
                            <h4 class="panel-title">Edit User Details</h4>
                        </div>
                        <div class="panel-body"> 
		<div class="col-md-12">
			<div class="ibox float-e-margins">
				
				<div class="ibox-content">
				<form method="post" class="form-horizontal" action="{{url('admin/user/edit/'.$model->id)}}">
				<div class="form-group">
					<label class="col-sm-3">Name:</label>
					<div class="col-sm-7"><input type="text" name="name" class="form-control" value="{{$model->name}}"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Email:</label>
					<div class="col-sm-7"><input type="text" name="email" class="form-control" value="{{$model->email}}"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Role: </label>
					<div class="col-sm-7">
						<select name="role" class="form-control">
						@foreach($roles as $role)
							<option <?php if($model->getRole($model->id)==".$role->display_name."):?> selected <?php endif;?>value="{{$role->id}}">{{$role->display_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Password:</label>
					<div class="col-sm-7"><input type="password" name="password" class="form-control"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Confirm Password:</label>
					<div class="col-sm-7"><input type="password" name="password_confirmation" class="form-control"></div>
				</div>
				<div class="form-group">
					<div class="col-sm-7 col-sm-offset-3">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<button class="btn btn-primary">Save</button>
					</div>
				</div>
				</form>
				</div>
				</div>
			</div>
		</div>
	</div>

@stop