<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field();?>
<div class="col-md-12">
<label>Reason</label>
<textarea name="reason" class="form-control" rows="5" required><?=$model->reason?></textarea>
</div>
<div class="col-md-12 form-group">
<br>

	<button class="btn btn-warning">Complete</button>
</div>
	

</form>
	

</div>