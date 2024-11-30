<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Amentity Name</label>
		 	<input type="text" name="name" class="form-control" required value="<?=$model->name?>">
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Amentity Description</label>
		 	<textarea name="description" class="form-control" rows="2"><?=$model->description;?></textarea>
		 </div>
		 <div class="col-md-12 form-group">
          <button class="btn btn-primary"><?=($model->exists)?"Update":"Create";?></button>
		 </div>
		
	</form>
	

</div>