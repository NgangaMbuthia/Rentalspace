@extends('layout.main_sidebar')

@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">User Module</a></li>
        <li class="active">Add User</li>
  </ul>

@stop
@section('content')
    
						 <div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title"><i class="icon-user-plus position-left"></i>Add New User Account</h6>
								</div>
								
							<div class="panel-body">
                       <form method="post" class="form-horizontal" role="form" action="{{url('admin/user/store')}}">
				<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Name:</label>
					<div class="col-sm-9">
					<input type="text" value="{{old('name')}}"  name="name" class="form-control" required="required" >
					 @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
					</div>
					</div>
				<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Email:</label>
					<div class="col-sm-9">
					<input type="text" value="{{old('email')}}" name="email" class="form-control" required="required">
					 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
					</div>
					
				</div>
				<div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Role:</label>
					<div class="col-sm-9">
						<select name="role" id="my-role" class="form-control"  required="required">

						@foreach($roles as $role)
							<option  @if (old('role') == '.$role->id.') selected="selected" @endif value="{{$role->id}}">{{$role->display_name}}</option>
							@endforeach
						</select>
						 @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                            @endif
					</div>
				</div>
				<div class="form-group hidden company-details {{ $errors->has('company_name') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Type:</label>
					<div class="col-sm-9">
					
					<select class="form-control" name="type" requred>
					<option>--Select Provider Type---</option>
					<option >Company</option>
					<option>Individual</option>
						
					</select>
					 @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                            @endif
						
					</div>
					
				</div>
				<div class="form-group hidden company-details {{ $errors->has('company_name') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Provider Name:</label>
					<div class="col-sm-9">
					<input  value="{{old('company_name')}}" type="text" name="company_name" class="form-control">
					 @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                            @endif
						
					</div>
					
				</div>
				<div class="form-group hidden company-details {{ $errors->has('company_taxno') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Provider  Tax Number:</label>
					<div class="col-sm-9">
					<input type="text" value="{{old('company_taxno')}}" name="company_taxno" class="form-control">

					 @if ($errors->has('company_taxno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_taxno') }}</strong>
                                    </span>
                            @endif
						
					</div>
					
				</div>
				<div class="form-group hidden company-details {{ $errors->has('company_phone') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label">Provider Telephone:</label>
					<div class="col-sm-9">
					<input type="text" name="company_phone" class="form-control">
					 @if ($errors->has('company_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                            @endif
						
					</div>
					
				</div>
				<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Password:</label>
					<div class="col-sm-9">
					<input type="password" name="password" class="form-control"  required="required" >
					 @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
					</div>
				</div>
				<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label class="col-sm-3 control-label">Confirm Password:</label>
					<div class="col-sm-9">
					<input type="password" name="password_confirmation" class="form-control"  required="required">
					 @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-7 col-sm-offset-3">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<button class="btn btn-success" style="width:100%;">
					<span class="glyphicon glyphicon-check"> Save</span>
					</button>
					</div>
				</div>

				</form>
				</div>
				</div>

@stop

@section('scripts')



<script type="text/javascript">
	$(document).ready(function(){
		$("#my-role").on('change',function(){
			var selected_id=$(this).val();
          var company_id=$("#my-company_id").val();
            if(company_id==selected_id){
            	$(".company-details").removeClass("hidden");

            }
		});

	})
</script>
@endsection
