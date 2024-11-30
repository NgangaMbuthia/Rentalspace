@extends('layout.main')

@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Management</a></li>
			    <li class="active">View User/<?=$user->id;?></li>
</ol>
@stop

@section('content')
	
	<div class="row"> 
	<a href="<?=url('/admin/user/adduser')?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>Add New User</a>
	<a href="<?=url('/admin/user/viewuser')?>" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;View List</a>
    <?php if($user->status=="Active"):?>
	<a href="<?=url('/admin/user/block/'.$user->id)?>" class="btn btn-danger">
	<span class="fa fa-ban"></span>&nbsp;
	Block</a>
		<?php else:?>
        <a href="<?=url('/admin/user/unblock/'.$user->id)?>" class="btn btn-danger">
	<span class="glyphicon glyphicon-check"></span>&nbsp;
	Activate Account</a>

		<?php endif;?>

	<a href="<?=url('/admin/user/update/'.$user->id);?>" class="btn btn-warning"> <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Update User</a>
	<a href="" class="btn btn-success"><span class="fa fa-line-chart"></span>&nbsp;&nbsp;Audit Trail</a>
	<p>
	</p>
	<div class="panel panel-info" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                               
                            </div>
                            <h4 class="panel-title">View User Details</h4>
                        </div>
                        <div class="panel-body">
		<div class="col-md-8 pull-right">
			
				<table class="table table-hover table-striped table-bordered" id="user-list">
				<tbody>
					<tr>
						<td>Name:</td>
						<td>{{$user->name}}</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>{{$user->email}}</td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td>{{$user->profile->telephone}}</td>
					</tr>
					<tr>
						<td>Role:</td>
						<td>{{$user->getRole($user->id)}}</td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td>{{$user->profile->gender}}</td>
					</tr>
					<tr>
						<td>Country:</td>
						<td>{{$user->profile->country}}</td>
					</tr>
					<tr>
						<td>City:</td>
						<td>{{$user->profile->city}}</td>
					</tr>

					<tr>
						<td>Status:</td>
						<td>{{$user->profile->status}}</td>
					</tr>
					<tr>
						<td>Date Created:</td>
						<td><?=date('dS-M-Y',strtotime($user->created_at));?></td>
					</tr>
				</tbody>
				</table>

			
			</div>
			<div class="col-md-2">
					       <div class="profile-image" id="thumbnil">

                            <img src="{{asset('/assets/img/k.png')}}"    />
                            <i class="fa fa-user hide"></i>
                        </div>
				

			</div>
		</div>
	</div>

@stop
@push('script')
	 <script>
	$('#user-list').DataTable();
	</script>
@endpush