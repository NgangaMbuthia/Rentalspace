<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Property</th>
					<th><?=$model->property->title?></th>
					
				</tr>
				<tr>
					<th>Type</th>
					<th><?=$model->template->name?></th>
					
				</tr>
				<tr>
					<th>Floor</th>
					<th><?=$model->floor?></th>
				</tr>
				<tr>
					<th>Unit</th>
					<th><?=$model->number?></th>
				</tr>
				<tr>
					<th>Water Metre Number</th>
					<th><?=$model->water_meter_number?></th>
				</tr>
				<tr>
					<th>Power Metre Number</th>
					<th><?=$model->electricity_meter_number?></th>
				</tr>
					<tr>
					<th>Standard Rent</th>
					<th><?=number_format($model->unit_price);?></th>
				</tr>
				<tr>
					<th>Status</th>
					<th><?=$model->status;?></th>
				</tr>
				
			</table>
			
		</div>
		
	</div>
	
</div>