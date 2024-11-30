<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Kindly Reason For Rejecting This Payment</label>
		 	<textarea class="form-control" rows="4" required name="reason"><?=$model->reason?></textarea>
		 </div>
		  <div class="col-md-12 form-group">
            <button class="btn btn-primary">Complete</button>
		  </div>

		

	</form>
	

</div>