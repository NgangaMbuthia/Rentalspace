<div class="row">
<form action="<?=$url?>" method="post">
 <?=csrf_field();?>
 <div class="col-md-6 form-group">
 <label>Hotel Types</label>
 <select class="form-control" name="hotel_type">
 	<option value="All">All Hotels</option>
 	<?php foreach($hotel_types as $type):?>
    <option><?=$type->hotel_type;?></option>
 	<?php endforeach;?>

 </select>
 </div>

 <div class="col-md-6 form-group">
 <label>State/County</label>
 <select class="form-control" name="hotel_city">
 	<option value="All">All States</option>
 	<?php foreach($states as $type):?>
    <option><?=$type->hotel_state;?></option>
 	<?php endforeach;?>

 </select>
 </div>

 <div class="col-md-6 form-group">
 <label>Report Type</label>
 <select class="form-control" name="report_type">
 	<option>Pdf</option>
 	<option>Excel</option>

 </select>
 </div>

 <div class="col-md-6 form-group">
 <label>Action</label>
 <select class="form-control" name="action">
 	<option>Genarate</option>
 	<option>Email</option>

 </select>
 </div>
  <div class="col-md-6 form-group">
  <button class="btn btn-primary">Complete</button>

  </div>
	


</form>
	

</div>