<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field()?>
<div class="col-md-12 form-group">
<label>Name</label>
<input type="text"  class="form-control" name="name" value="<?=(isset($model->name))?$model->name:old('name');?>" required>
	
</div>
<div class="col-md-12 form-group">
<label>Category</label>
<select name="category" required class="form-control">
	<option value="">---Select Category</option>
	<option <?php if($model->category=="Hotel Amentity"):?>selected  <?php endif;?>>Hotel Amentity</option>
	<option <?php if($model->category=="Room Amentity"):?>selected  <?php endif;?> >Room Amentity</option>
	<option <?php if($model->category=="Both"):?>selected  <?php endif;?>>Both</option>
</select>
	
</div>
<div class="col-md-12">
              <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
         </div>
	


</form>
	

</div>