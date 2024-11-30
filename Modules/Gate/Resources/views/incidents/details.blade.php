<div class="row">
<form action="<?=$url;?>" method="post">
  <?=csrf_field();?>
<div class="col-md-6">
<label><b>Incident Name</b></label>
<input type="text" class="form-control" value="<?=$model->incident_name;?>" name="incident_name">
	
</div>
<div class="col-md-6">
<label><b>Incident Code</b></label>
<input type="text" class="form-control"  value="<?=$model->insident_code;?>" readonly>
	
</div>

<div class="col-md-6">
<label><b>Incident Date</b></label>
<input type="text" class="form-control datepicker" name="incident_date" id="datepicker" value="<?=$model->incident_date;?>">
	
</div>
<div class="col-md-6">
<label><b>Incident Time</b></label>
<input type="text" class="form-control" name="incident_time" id="setTimeExample" value="<?=$model->incident_time;?>">
	
</div>
<div class="col-md-12">
<label><b>Description</b></label>
<textarea class="form-control" name="incident_description" rows="5"><?=$model->incident_description;?></textarea>
	
</div>
<?php if($model->status=="Open"):?>
<div class="col-md-12">
<p><br></p>
<button class="btn btn-primary">Update</button>
	
</div>
<?php endif;?>
</form>
	
</div>




