@extends('layout.main_sidebar')

@section('content')
	
	<div class="row"> 
		<div class="col-lg-7">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h4>Add Role</h4>
				</div>
				<div class="ibox-content">
				<form method="post" class="form-horizontal" action="{{url('admin/role/update/'.$model->id)}}">
				<div class="form-group">
					<label class="col-sm-3">Name:</label>
					<div class="col-sm-7"><input type="text" name="name" class="form-control" value="{{$model->name}}"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Display Name:</label>
					<div class="col-sm-7"><input type="text" name="display_name" class="form-control" value="{{$model->display_name}}"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Description:</label>
					<div class="col-sm-7"><input type="text" name="description" class="form-control" value="{{$model->description}}"></div>
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

@stop