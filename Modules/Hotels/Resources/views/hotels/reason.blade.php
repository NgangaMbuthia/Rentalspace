<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field();?>
<div class="col-md-12 form-group">
<label>Supplier Name</label>
<input readonly type="text" name="name" class="form-control" value="<?=$model->name?>">
</div>
<div class="col-md-12 form-group">
<label>Reason</label>
<textarea class="form-control" name="reason" rows="4"><?=$model->reason?></textarea>


</div>
<div class="col-md-12 form-group">
<button class="btn btn-primary">Complete</button>

</div>
	


</form>
	

</div>