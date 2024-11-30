
<div class="row">
<div class="col-md-12">
<form action="<?=$url?>" method="post">
<div class="form-group">
<label>Category Name</label>
<input type="text" name="name" value="<?=$model->name?>" class="form-control">
	
</div>
<div class="form-group">
<?=csrf_field();?>
<button class="btn btn-primary">Create Category</button>
	

</div>
	


</form>
	

</div>
</div>