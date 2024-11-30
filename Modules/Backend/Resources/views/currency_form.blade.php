<div class="row">
<form action="<?=$url?>" method="post">
 <?=csrf_field();?>
 <div class="col-md-6 form-group">
 <label>Currency</label>
 <select class="form-control" name="currency" required>
 	<option value="">--Select Currency</option>
 	<?php foreach($currencies as $curency):?>
    <option <?php if($model->currency==$curency):?>selected <?php endif;?>><?=$curency?></option>
 	<?php endforeach;?>
 </select>
 	
 </div>
  <div class="col-md-6 form-group">
 <label> <?=config('app.default_currency')?> Equivalent</label>
 <input type="text" name="kes_equivalent" class="form-control" value="<?=$model->kes_equivalent;?>" required>
 	
 </div>
 <div class="col-md-12 form-group">
              <button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
         </div>

	

</form>
	

</div>