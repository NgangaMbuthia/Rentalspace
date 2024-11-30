<div class="row">

	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>

	<div class="col-md-12">
		<div class="col-md-6 form-group">
			<label>Transaction Name</label>
			<input type="text" name="Description" class="form-control" value="{{$model->Description}}">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Transaction Description</label>
			<input type="text" name="transaction_name" value="{{$model->other_details}}" class="form-control">
			
		</div>
		
	</div>
	<div class="col-md-12">
		<div class="col-md-6 form-group">
			<label>Ref Number</label>
			<input type="text" name="Description" class="form-control" value="{{$model->ref_no}}">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Transaction Amount</label>
			<input type="text" name="transaction_name" value="{{$model->credit}}" class="form-control">
			
		</div>
		
	</div>
	<div class="col-md-12">
		<div class="col-md-12 form-group">
         <button class="btn btn-primary">Complete</button>
		</div>
	</div>
		


	</form>
	

</div>