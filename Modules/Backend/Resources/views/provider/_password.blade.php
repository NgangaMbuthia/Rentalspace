<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		 <div class="col-md-12 form-group">
		 	<label>Email Address</label>
		 	<input type="text" name="email" class="form-control" required="required" value="{{$user->email}}">
		 	
		 </div>
		  <div class="col-md-12 form-group">
		 	<label>New Password</label>
		 	<input type="password" name="password" class="form-control" required="required">
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Confirm Password</label>
		 	<input type="password" name="password_confirmation" class="form-control" required="required">
		 	
		 </div>
		<div class="col-md-12">
		 	<button class="btn btn-primary form-control">Complete</button>
		 </div>
		

	</form>
	

</div>