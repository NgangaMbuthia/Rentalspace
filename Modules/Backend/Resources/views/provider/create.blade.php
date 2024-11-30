@extends('layout.main_sidebar')

@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">Agent Management</a></li>
        <li class="active">Add New</li>
  </ul>

@stop
@section('content')

	 <div class="panel panel-white">
			<div class="panel-heading">
				<h6 class="panel-title"><i class="icon-home position-left"></i>Add New Provder/Agent</h6>
			</div>
			
		<div class="panel-body">
		<form action="<?=url('backend/provider/store')?>" method="post">
		   <div class="text-center">
			<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
			<h5 class="content-group-lg">Create New Agent account <small class="display-block">All fields are required</small></h5>
		   </div>

										<div class="form-group has-feedback {{ $errors->has('auth_key') ? ' has-error' : '' }}">
											<label>Authorization Key</label>

											<input type="text" name="auth_key" class="form-control" placeholder="Auth Key" readonly="true" value="<?=$auth_key?>">

			                                @if ($errors->has('auth_key'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('auth_key') }}</strong>
			                                    </span>
			                                @endif
											<div class="form-control-feedback">

												<i class="icon-key text-muted"></i>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
												<label>First Name</label>
													<input type="text" class="form-control"  name="first_name" placeholder="First name" value="{{old('first_name')}}">
													 @if ($errors->has('first_name'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('first_name') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">

												<div class="form-group has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
												<label>Last Name</label>
													<input type="text" class="form-control" placeholder="Last name" name="last_name"  value="{{old('last_name')}}">
													 @if ($errors->has('last_name'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('last_name') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
											
												<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
												<label>Password</label>
													<input type="password" class="form-control" placeholder="Create password" name="password">
												@if ($errors->has('password'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('password') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
												<label>Confirm Password</label>
													<input type="password" class="form-control" placeholder="Repeat password" name="password_confirmation">
													@if ($errors->has('password_confirmation'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-user-lock text-muted"></i>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
											  <label>Email Address</label>
												<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
													<input type="email" class="form-control" placeholder="Your email" name="email" value="{{old('email')}}">
														@if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-envelop text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
												<label>Telephone</label>
													<input type="text" class="form-control" placeholder="Telephone/Mobile Number" name="phone" value="{{old('phone')}}">
														@if ($errors->has('phone'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('phone') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-phone text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
											  <label>Postal Address</label>
												<div class="form-group has-feedback {{ $errors->has('postal_address') ? ' has-error' : '' }}">
													<input type="text" class="form-control" placeholder="Postal Address" name="postal_address"  value="{{old('postal_address')}}" >
														@if ($errors->has('postal_address'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('postal_address') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-map text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('town') ? ' has-error' : '' }}">
												<label>Residentail Address/Town</label>
													<input type="text" class="form-control" placeholder="Residentail Address/Town" name="town" value="{{old('town')}}">
														@if ($errors->has('town'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('town') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-city text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
										<div class="table-responsive">
										<table class="table table-bordered">
										<thead>
										<tr class="success">
										<th>#</th>
										<td>Name</td>
										<td>Amount Charged</td>
										<td>Select/Unselect</td>
										 </tr>
											
										</thead>
										<tbody>
										<?php $i=1;foreach($modules as $module):?>
										<tr>
										<td><?=$i;?></td>
										<td><?=$module->name;?></td>
										<td><input type="text" name="amount[<?=$module->id?>]" value="<?=$module->standard_charges;?>">  </td>
										<td>
											<input type="checkbox" name="module_id[]" value="<?=$module->id;?>">
										</td>
											

										</tr>



										<?php $i++; endforeach;?>
											

										</tbody>
										</table>
											

										</div>
											

										</div>



										<div class="text-right">
										 <p>
											{{csrf_field()}}
											<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create account</button>
										</div>
										</form>


		</div>
   </div>
    


 @stop