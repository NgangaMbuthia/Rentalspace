<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Email Address</label>
		 	<input type="text" name="email" value="<?=$model->user->email?>" class="form-control" required>
		 	

		 </div>
		 <div class="col-md-12">
		 	<button class="btn btn-primary">Send <span class="icon-envelope"></span></button>

		 </div>
		

	</form>
	


</div>