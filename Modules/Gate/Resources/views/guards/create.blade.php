
<?php 
use App\Helpers\Helper;

?>
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
<label>Guard Name</label>
<input type="text" name="name" id="gate-name"  class="form-control" value="<?=$user->name?>" required>
{{csrf_field()}}
</div>



<div class="col-md-6 form-group">
<label>Guard Telephone</label>
<input type="text" name="telephone" class="form-control" value="<?=$profile->telephone?>" required>
</div>



<div class="col-md-6 form-group">
<label>Guard Email Address  <a id="generate-email">--Generate--</a>                    </label>
<input type="text" name="email"  id="email" class="form-control" value="<?=$user->email?>" required>
</div>


<div class="col-md-6 form-group">
<label>Guard Postal Address  (Optional)</label>
<input type="text" name="postal_address" class="form-control" value="<?=$profile->postal_address?>" required>
</div>


<div class="col-md-6 form-group">
<label>Guard ID Number</label>
<input type="text" name="id_number" class="form-control" value="<?=$profile->id_number?>" required>
</div>


<div class="col-md-6 form-group">
<label>Employer Name</label>
<input type="text" name="employer_name" class="form-control" required value="<?=$model->employer_name?>" >
</div>


<div class="col-md-6 form-group">
<label>Employer Phone</label>
<input type="text" name="employer_mobile" class="form-control" required value="<?=$model->employer_mobile?>">
</div>

<div class="col-md-6 form-group">
<button class="btn btn-primary"><span class="glyphicon glyphicon-check"></span><?=($model->exists)? "Update" :"Create"?></button>
</div>

<input type="hidden" id="rose" value="<?=Helper::RandomEmail();?>">
	


</form>
	


</div>
<script type="text/javascript">

	
	$("#generate-email").on("click",function(e){
		e.preventDefault();
		var email=$("#rose").val();
		 $("#email").val(email);
		
		 });
</script>
