<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12 form-group">
		 	<label>Property</label>
		 	<select name="property_id" class="form-control" id="Property" required>
		 		<option value="">---Select Property---</option>
		 		 <?php foreach($properties as $property):?>
                    <option value="<?=$property->id;?>"><?=$property->title;?></option>
		 		 <?php endforeach;?>
		 	</select>
		 	
		 </div>
		 <div class="col-md-6 form-group">
		 	<label>Year</label>
		 	<select name="year" class="form-control" required>
		 		
		 		 <?php foreach($years as $property):?>
                    <option><?=$property->year;?></option>
		 		 <?php endforeach;?>
		 	</select>
		 	
		 </div>
		  <div class="col-md-6 form-group">
		 	<label>Month</label>
		 	<select name="month" class="form-control" required>
		 		
		 		 <?php foreach($months as $property):?>
                    <option><?=$property->month;?></option>
		 		 <?php endforeach;?>
		 	</select>
		 	
		 </div>
		   <div class="col-md-12 form-group">
              <button class="btn btn-primary">Genarate</button>
		   </div>
		

	</form>
	
</div>



<script type="text/javascript">


	$("#Property").select2();
</script>