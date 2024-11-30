<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field();?>
<div class="col-md-12 form-group">
<label>Name</label>
<input type="text" name="display_name" class="form-control" value="<?=$model->display_name;?>">
</div>
<div class="col-md-12 form-group">
<label>Description</label>
<textarea name="description"  rows="3" class="form-control"><?=$model->description;?></textarea>
</div>
<div class="col-md-12">
<label>Permissions</label><br>

<?php foreach($available_permissions as $perms):?>

                    <div class="form-group col-md-6">
                              <div class="checkbox">
                               
                                 <?php if(in_array($perms->id, $my_perms)):?>
                                 <input type="checkbox" name="permission[]"  value="<?=$perms->id?>" checked>
                             <?php else:?>

                             	 <input type="checkbox" name="permission[]"  value="<?=$perms->id?>">

                             <?php endif;?>
                                  <label>
                                   <?=$perms->display_name;?><br>
                                  
                                   

                                </label>
                              </div>
                              </div>
									 <?php endforeach;?>
	
</div>
<div class="col-md-12">
<button class="btn btn-primary">Update</button>
	
</div>

	


</form>
	

</div>