<div class="row">
<form action="<?=$url?>" method="post">
<div class="form-group col-md-12">
<label>Group Name</label>
<input  required type="text" name="name" value="<?=$model->group_name;?>" class="form-control">
	

</div>
<div class="form-group col-md-12">
<?=csrf_field();?>
<button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;<?=($model->exists)? "Update" :"Create"?></button>
	

</div>
	

</form>
	
</div>