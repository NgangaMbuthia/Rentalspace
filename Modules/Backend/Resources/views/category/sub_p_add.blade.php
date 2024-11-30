<div class="row">
<form action="<?=$url?>" method="post">
<div class="col-md-12">

<div class="form-group">
<label>Category</label>
<select class="form-control" name="category_id" required>
<option value="">--Select Category</option>

<?php foreach($categories as $category):?>

    <option <?php if($id==$category->id):?> selected<?php endif;?>             value="<?=$category->id?>"><?=$category->name;?></option>
<?php endforeach;?>
                                        
</select>
</div>
<div class="form-group">
<label>Category</label>
<input type="text" name="name" class="form-control" required>
 <?=csrf_field()?>

 

</div>
<div class="form-group">
<button class="btn btn-primary">Create Subcategory</button>

</div>
	

</div>
</form>
	


</div>