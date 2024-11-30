<div class="row">
<form action="<?=$url?>" method="post">
<div class="form-group col-md-12">
<label>Group </label>
<select name="group_id" class="form-control">
<?php foreach($groups as $group):?>
	<option value="<?=$group->id?>"
      <?php if($model->group_id==$group->id):?>selected <?php endif;?>
	><?=$group->group_name;?></option>
 
 <?php endforeach;?>
</select>
</div>
<div class="form-group col-md-6">
<label>Full Name</label>
<input type="text" class="form-control" required name="name" value="<?=$model->name?>">


</div>
<div class="form-group col-md-6">
<label>Email Address</label>
<input type="text" class="form-control" required name="email" value="<?=$model->email?>">
</div>

<div class="form-group col-md-6">
<label>Mobile Number</label>
<input type="text" class="form-control" required name="mobile" value="<?=$model->mobile?>">
</div>

<div class="form-group col-md-6">
<label>Altenate Mobile Number&nbsp;(Optional)</label>
<input type="text" class="form-control" required name="alt_phone" value="<?=$model->alt_phone?>">
</div>


<div class="form-group col-md-12">
<?=csrf_field();?>
<button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;<?=($model->exists)? "Update" :"Create"?></button>
	

</div>
	

</form>
	
</div>