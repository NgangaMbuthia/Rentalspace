<div>
	<form action="<?=$url?>" method="post">

	<?=csrf_field();?>
	<div class="form-group">
	<label>Reason For Cancelling this invoice <?=$model->invoice_number?></label>
	<textarea class="form-control" rows="4" name="reason"><?=$model->reason?></textarea>
		


	</div>
	<div>
		<button class="btn btn-primary">Complete</button>
	</div>
		

	</form>


</div>