<div class="row">
<form action="<?=$url?>" method="post">
<div class="col-md-6 form-group">
<label>Property</label>
<select class="form-control" required name="property_id">
<option value="">----Select Property---</option>
  <?php foreach($properties  as $property):?>
  	 <option   <?php if($model->property_id==$property->id): ?> selected <?php endif;?>value="{{$property->id}}">{{$property->title}}</option>
<?php endforeach;?>
</select>
</div>


<div class="col-md-6 form-group">
<label>Gate Name</label>
<input type="text" name="name" id="gate-name"  class="form-control" value="<?=$model->name?>" required>
{{csrf_field()}}
</div>



<div class="col-md-6 form-group">
<label>Gate Telephone</label>
<input type="text" name="telephone" class="form-control" value="<?=$model->telephone?>" required>
</div>


<div class="col-md-6 form-group">
<label>Gate Alt Telephone</label>
<input type="text" name="alt_telephone" class="form-control" value="<?=$model->alt_telephone?>" required>
</div>


<div class="col-md-6 form-group">
<label>Minmun No of Guards</label>
<input type="text" name="min_guards" class="form-control" required value="<?=$model->min_guards?>" >
</div>


<div class="col-md-6 form-group">
<label>Maxmum No of Guards</label>
<input type="text" name="max_guards" class="form-control" required value="<?=$model->max_guards?>">
</div>

<div class="col-md-6 form-group">
<button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
</div>
	


</form>
	


</div>
<script type="text/javascript">
	$("#gate-name").val("Gate");
</script>