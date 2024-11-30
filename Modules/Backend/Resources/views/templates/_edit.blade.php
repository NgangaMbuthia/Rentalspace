<div class="row">
	<form action="<?=$url?>" method="post">
     <?=csrf_field();?>	
     <div class="col-md-12 form-group">
     	<label>Key</label>
     	<input type="text" name="key" value="<?=$model->key?>" class="form-control">
     	
     </div>	
     <div class="col-md-12 form-group">
     	<label>Value</label>
     	<input type="text" name="value" value="<?=$model->value?>" class="form-control">
     	
     </div>	
      <div class="col-md-12 form-group">
     <button class="btn btn-primary">Submit</button>
      </div>

	</form>
	
</div>