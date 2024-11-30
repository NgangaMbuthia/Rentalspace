<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
	<div class="col-md-12 form-group">
		<label>Agent Commission Percentage</label>
		<input type="text" value="{{$model->agent_commission_percentage}}" name="agent_commission_percentage" class="form-control" required>
		
	</div>
	<div class="col-md-12">
		<button class="btn btn-primary">Complete</button>
		
	</div>
		

	</form>
	
</div>