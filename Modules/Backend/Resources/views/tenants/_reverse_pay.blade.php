<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
	<div class="col-md-12">
		<div class="col-md-6 form-group">
			<label>Property Name</label>
			<input type="text" class="form-control" value="{{$model->space->property->title}}" readonly>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Unit Number</label>
			<input type="text" class="form-control" value="{{$model->space->number}}" readonly>
			
		</div>
		
	</div>
	<div class="col-md-12">
		<div class="col-md-6 form-group">
			<label>Amount</label>
			<input type="text" class="form-control" value="{{$model->debit}}" readonly>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Date</label>
			<input type="text" class="form-control" value="{{$model->transaction_date}}" readonly>
			
		</div>
		
	</div>
	<div class="col-md-12">
		<div class="col-md-12 form-group">
			<label>Reason  For Rerversing</label>
			<textarea name="reason"  class="form-control"
			required></textarea>

		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-12 form-group">
			<button class="btn btn-danger">Complete</button>

		</div>
	</div>
		

	</form>
	

</div>