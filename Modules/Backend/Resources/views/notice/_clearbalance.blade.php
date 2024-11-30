<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		<div class="col-md-12">
			<div class="col-md-6 form-group">
				<label>Name</label>
				<input type="text" name="name" value="{{$model->user->name}}" class="form-control">

			</div>

			<div class="col-md-6 form-group">
				<label>Unit</label>
				<input type="text" name="unit" value="{{$model->space->number}}" class="form-control">

			</div>

			<div class="col-md-6 form-group">
				<label>Total Balance</label>
				<input type="text" name="old_balance" value="{{$payment->balance}}" class="form-control">

			</div>

			<div class="col-md-6 form-group">
				<label>Amount Paid</label>
				<input type="text" name="amount"  class="form-control" required>

			</div>
			<div class="col-md-6 form-group">
             <button class="btn btn-primary">Complete</button>
			</div>


			
		</div>
		

	</form>
	

</div>