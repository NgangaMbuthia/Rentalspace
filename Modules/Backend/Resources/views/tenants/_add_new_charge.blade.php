<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		<div class="col-md-6 form-group">
			<label>Charge Name</label>
			<input type="text" name="charge_name" class="form-control" required>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Charge Amount</label>
			<input type="text" name="charge_amount" class="form-control" required>
			
		</div>
		<div class="col-md-6 form-group">
           <button class="btn btn-primary">Add</button>
		</div>

		
	</form>
	
</div>