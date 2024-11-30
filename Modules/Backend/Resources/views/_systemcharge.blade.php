<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Code</label>
		 	<input type="text" name="code" class="form-control number" required value="<?=$model->code?>" maxlength="4">
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Name</label>
		 	<input type="text" name="name" class="form-control number" required value="<?=$model->name?>">
		 </div>
		 <div class="col-md-12 form-group">
          <button class="btn btn-primary"><?=($model->exists)?"Update":"Create";?></button>
		 </div>
		
	</form>
	

</div>