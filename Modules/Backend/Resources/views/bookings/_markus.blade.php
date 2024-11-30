<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12">
		 	<div  class="table-responsive">
		 	<table class="table table-bordered table-striped">
		 		<tr>
		 			<th>Name</th>
		 			<td><?=$model->name?></td>
		 			<th>Email Address</th>
		 			<td><?=$model->email?></td>
		 			
		 		</tr>
		 		
		 		<tr>
		 			<th>Telephone</th>
		 			<td><?=$model->phone?></td>

		 			<th>Telephone</th>
		 			<td><?=$model->expected_entry?></td>
		 		</tr>
		 		<tr>
		 			<th>Details</th>
		 			<td colspan="3"><?=$model->details?></td>

		 			
		 		</tr>
		 		

		 		
		 	</table>
		 		
		 	</div>
		 	
		 	
		 </div>
		 
		 <div class="form-group col-md-12">
		 	<label>Reply To Email</label>
		 	<input type="text" name="reply_to_email" class="form-control" required value="<?=$model->space->property->getProvider->email;?>">
		 	
		 </div>
		 <div class="form-group col-md-6">
		 	<label>Contact Telephone</label>
		 	<input type="text" name="reply_to_phone" class="form-control" required  value="<?=$model->space->property->getProvider->telephone;?>">
		 	
		 </div>
		 <div class="form-group col-md-6">
		 	<label>Mark As</label>
		 	<select name="mark_as" class="form-control" required>
		 		<option>Opened</option>
		 		<option>Called</option>
		 		<option>Closed</option>
		 		
		 	</select>
		 	
		 </div>


		  <div class="form-group col-md-12">
		 	<label>Response Details</label>
		 	<textarea class="form-control" name="response" rows="3" required></textarea>
		 	
		 </div>
		 <div class="form-group col-md-12">
        <button class="btn btn-primary" style="width:100%;" >Respond</button>
		 </div>

		 
		 
		


	</form>
	

</div>