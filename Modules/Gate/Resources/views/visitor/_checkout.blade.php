<div class="row">
<form action="<?=$url;?>" method="post">
<?=csrf_field();?>
<div class="form-group col-md-12">

<div class="table-responsive">
<table class="table table-bordered table-striped">
<tr class="success">
<th colspan="4" class="text-center">Visitor Details</th>
	
</tr>
<tr>
<td><b>Visitor </b></td><td><?=$model->name?></td>
<td><b>ID Number </b></td><td><?=$model->id_number?></td>
</tr>
<tr>
<td><b>Mobile </b></td><td><?=$model->mobile?></td>
<td><b>Email </b></td><td><?=$model->email_address?></td>

</tr>
<tr>
<td><b>CheckIn  </b></td><td><?=$model->created_at?></td>
<td><b>Duration </b></td><td><?=$model->created_at->diffForHumans()?></td>

</tr>
<tr>
<td><b>Host </b></td><td><?=$model->vhost->name;?></td>
<td><b>Telephone </b></td><td><?=$model->vhost->profile->telephone;?></td>

</tr>

</table>
</div>

	




</div>

<div class="form-group col-md-12">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr class="success">
<th colspan="6" class="text-center">Visitor Items</th>
	
</tr>
<tr class="info">
<th>#</th>
<th>Type</th>
<th>Make</th>
<th>Model</th>
<th>Number</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($models as $mod):?>
<tr>
<td><?=$i;?></td>
<td><?=$mod['item_name'];?></td>
<td><?=$mod['make']?></td>
<td><?=$mod['model']?></td>
<td><?=$mod['number']?></td>
<td><input type="checkbox" name="items[]"  value="<?=$mod['item_name'].'_'.$mod['item_id']?>"></td>
	




</tr>



<?php $i++; endforeach; ?>
	
</tbody>
	

</table>
	

</div>
	

</div>
<div class="form-group col-md-12">
<button class="btn btn-info">Complete</button>

</div>
	


</form>
	



</div>