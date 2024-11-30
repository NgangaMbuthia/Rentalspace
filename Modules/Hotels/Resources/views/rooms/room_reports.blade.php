<div class="row">
<form action="<?=$url?>" method="post">
 <?=csrf_field();?>
 <div class="col-md-4 form-group">
 <label>Hotel</label>
 <select class="form-control" name="hotel_name">
 	<option value="">All Hotels</option>
 	<?php foreach($hotels as $hotel):?>
    <option><?=$hotel->hotel_name;?></option>
 	<?php endforeach;?>

 </select>
 </div>

 <div class="col-md-4 form-group">
 <label>Room Name</label>
 <select class="form-control" name="room_name">
 	<option value="">All Rooms</option>
 	<?php foreach($room_names as $hotel):?>
    <option><?=$hotel->room_name;?></option>
 	<?php endforeach;?>

 	

 </select>
 </div>
  <div class="col-md-4 form-group">
 <label>Bed Type</label>
 <select class="form-control" name="bed_type">
 	<option value="">All Bed Types</option>
 	<?php foreach($bed_types as $bed):?>
    <option><?=$bed->bed_type;?></option>
 	<?php endforeach;?>
 </select>
 </div>
   <div class="col-md-4 form-group">
 <label>Room Status</label>
 <select class="form-control" name="current_status">
 	<option value="">All Room Status</option>
 	<?php foreach($status as $stat):?>
    <option><?=$stat->current_status;?></option>
 	<?php endforeach;?>
 </select>
 </div>

 <div class="col-md-4 form-group">
 <label>Report Format</label>
 <select class="form-control" name="report_type">
 	<option>Pdf</option>
 	<option>Excel</option>

 </select>
 </div>

 <div class="col-md-4 form-group">
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