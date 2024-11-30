<div class="row">
	<form action="<?=url('/backend/getProperty/template')?>" method="get">
	<div class="form-group">
		<label>Property</label>
		<select name="property_id" class="form-control" required>
			<option  value="">--Select Property---</option>
			 <?php foreach($properties as $prop):?>
              <option value="<?=$prop->id?>"><?=$prop->title;?></option>
			 <?php endforeach;?>
			
		</select>
		
	</div>
	<div class="form-group">
      <button class="btn btn-primary">Download </button>
	</div>
		

	</form>
	

</div>