<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Name</label>
		 	<input type="text" class="form-control" value="<?=$user->name?>" name="name">
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Username</label>
		 	<input type="text"  class="form-control" value="<?=(isset($user->username)?$user->username:$user->profile->telephone)?>" name="username" required>
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Email Address</label>
		 	<input type="text" class="form-control" value="<?=$user->email?>" name="email">
		 	
		 </div>
		  <div class="col-md-12 form-group">
		 	<label>Passowrd</label>
		 	<input type="password" class="form-control"  name="password">
		 	
		 </div>

		  <div class="col-md-12 form-group">
		 	<label>Confirm Passowrd</label>
		 	<input type="password" class="form-control"  name="password_confirmation">
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<button class="btn btn-primary">Update Details</button>
		 	
		 </div>

		
	</form>
	

</div>