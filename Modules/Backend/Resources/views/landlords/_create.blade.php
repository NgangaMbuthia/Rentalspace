<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		 <div class="col-md-6 form-group">
		 	<label>Name</label>
		 	<input type="text" name="name" class="form-control" required value="{{$model->name}}">
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Emaill Address</label>
		 	<input type="email" name="email" class="form-control" required value="{{$model->email}}">
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Telephone</label>
		 	<input type="text" name="telephone" class="form-control" value="{{$profile->telephone}}">
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Postal Address</label>
		 	<input type="text" name="postal_address" class="form-control" value="{{$profile->postal_address}}">
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Gender</label>
		 	<select name="gender" class="form-control">
		 		<option value="">--Select Gender---</option>
		 		<option>Male</option>
		 		<option>Female</option>
		 		
		 	</select>
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Town</label>
		 	<input type="text" name="city" class="form-control" value="{{$profile->city}}">
		 	
		 </div>

		 <div class="col-md-12 form-group">
         <button class="btn btn-primary">Complete</button>
		 </div>
		
	</form>
	
</div>