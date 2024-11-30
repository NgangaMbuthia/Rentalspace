<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field()?>
<div class="col-md-6 form-group">
<label>Name</label>
<input type="text"  class="form-control" name="name" value="<?=(isset($model->name))?$model->name:old('name');?>" required>
	
</div>
<div class="col-md-6 form-group">
<label>Email Address</label>
<input type="text"  class="form-control" name="email" value="<?=(isset($user->email))?$model->email:old('email');?>" required>
	
</div>
<div class="col-md-6 form-group">
<label>Telephone</label>
<input type="text"  class="form-control" name="telephone" value="<?=(isset($model->phone))?$model->phone:old('telephone');?>" required>
	
</div>
<div class="col-md-3 form-group">
<label>Box</label>
<input type="text"  class="form-control" name="box" value="<?=(isset($model->box))?$model->box:old('box');?>" required>
	
</div>
<div class="col-md-3 form-group">
<label>Postal Code</label>
<input type="text"  class="form-control" name="postal_address" value="<?=(isset($model->postal_address))?$model->postal_address:old('postal_address');?>" required>
	
</div>
<div class="col-md-6 form-group">
<label>Country</label>
<input type="text"  class="form-control" name="country" value="<?=(isset($model->country))?$model->country:old('country');?>" required>
	
</div>
<div class="col-md-6 form-group">
<label>City</label>
<input type="text"  class="form-control" name="city" value="<?=(isset($model->city))?$model->city:old('name');?>" required>
	
</div>
<div class="col-md-6 form-group">
<label>Category</label>
<select name="type" class="form-control" required>
<option value="">---Select Category---</option>
<option <?php if($model->type=="Hotel-Supplier"):?> selected <?php endif;?>  value="Hotel-Supplier">Supplier</option>
<option <?php if($model->type=="Hotel"):?> selected <?php endif;?>  value="Hotel">Hotel</option>
<option <?php if($model->type=="Tour Operators"):?> selected <?php endif;?>   value="Tour Operators">Tour Operator</option>
	
</select>
	
</div>
<div class="col-md-6 form-group">
<label>TRA Number</label>
<input type="text"  class="form-control" name="tra_reg_no" value="<?=(isset($model->tra_reg_no))?$model->tra_reg_no:old('tra_reg_no');?>" required>
	
</div>
<div class="col-md-12">
              <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
         </div>
	


</form>
	

</div>