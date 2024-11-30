<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12">
		 	<div class="col-md-12 form-group">
		 		<label>Property</label>
		 		<input type="text" required  class="form-control" value="<?=$model->space->property->title?>" readonly>
		 		
		 	</div>
		 		<div class="col-md-6 form-group">
		 		<label>Unit Number</label>
		 		<input type="text" required  class="form-control" value="<?=$model->space->number?>" readonly>
		 		
		 	</div>
		 	<div class="col-md-6 form-group">
		 		<label>Current Water Reading</label>
		 		<input type="text" name="water_reading" required  class="form-control" value="<?=$model->current_w_reading;?>">
		 		
		 	</div>
		 	<div class="col-md-6 form-group">
		 		<label>Current Power Reading</label>
		 		<input type="text" name="power_reading" required  class="form-control" value="<?=$model->current_e_reading;?>">
		 		
		 	</div>

		 	<div class="col-md-6 form-group">
		 		<label>Reading Date</label>
		 		<input type="text" name="reading_date" required  class="form-control datepicker" value="<?=$model->reading_date?>" id="datepicker">
		 		
		 	</div>

		 		<div class="col-md-12 form-group">
		 		<button class="btn btn-primary">Submit</button>
		 		
		 	</div>


		 	
		 </div>
		
	</form>
	
</div>
  <script type="text/javascript">
  	$("#datepicker").datepicker();
  </script>