<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field();?>
<div class="col-md-6 form-group">
<label>Ticket No</label>
<input type="text" name="ticket" class="form-control"  value="<?=$model->repair_ticket;?>"  />
 </div>

 <div class="col-md-6 form-group">
<label>Type</label>
<input type="text" name="type" class="form-control"  value="<?=$model->type;?>"  />
 </div>


 <div class="col-md-6 form-group">
<label>Expected Repair Date</label>
<input type="text" name="job_start_date" class="form-control"  value="<?=$model->expected_repair_date;?>"  />
 </div>

 

 <div class="col-md-6 form-group">
<label>Budget</label>
<input type="text" name="job_start_date" class="form-control"   />
 </div>

  <div class="col-md-6 form-group">
<label>Method</label>
<select class="form-control">
	<option>Send To Individual</option>
	<option>Broadcast</option>
</select>
 </div> 
 <div class="col-md-6 form-group">
<label>Service Number</label>
<input type="text" name="job_start_date" class="form-control"   />
 </div>


  <div class="col-md-12 form-group">
<label>Job Description</label>
<textarea name="job_description" class="form-control" rows="6"></textarea>


</div>
<div class="col-md-12">
	<button class="btn btn-primary">Create</button>
</div>


 
	



</form>
	
</div>