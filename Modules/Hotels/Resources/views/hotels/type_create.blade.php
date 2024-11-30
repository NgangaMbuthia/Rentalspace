<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field()?>
<div class="col-md-12 form-group">
<label>Name</label>
<input type="text"  class="form-control" name="name" value="<?=(isset($model->name))?$model->name:old('name');?>" required>
	
</div>
<div class="col-md-12 form-group">
<label>Description</label>
<textarea name="description" class="form-control" required><?=(isset($model->description))? $model->description:old('description')?></textarea>
	
</div>
<div class="col-md-12">
              <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
         </div>
	


</form>
	

</div>