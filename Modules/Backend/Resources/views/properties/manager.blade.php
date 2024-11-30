<div class="row">
<div class="col-md-12">
<form action="<?=$url;?>" method="post" id="manager-form">

<div class="col-md-6 form-group">
<label>Name</label>
<input type="text" value="<?=$model->managed_by?>" name="managed_by"  required class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>Telphone</label>
<input type="text" value="<?=$model->manager_phone?>" name="manager_phone" required class="form-control" />
</div>

<div class="col-md-6 form-group">
<label>Email</label>
<input type="text" value="<?=$model->Manager_email?>" name="Manager_email" required class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>ID Number</label>
<input type="text" value="<?=$model->id_number?>" name="id_number" required class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>Password</label>
<input type="password"  name="password" required class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>Confirm Password</label>
<input type="password"  name="password_confirmation" required class="form-control" />
</div>
<div class="col-md-12">
<?=csrf_field();?>
<button class="btn btn-primary submit-my-phone" data-form="manager-form" data-title="update this record">Update</button>
	

</div>
	

</form>

	

</div>
	

</div>