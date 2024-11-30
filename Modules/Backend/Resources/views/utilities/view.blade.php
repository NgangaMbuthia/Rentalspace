<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<tr>
					<th>Old Meter(Water)  Reading</th>
					<td><?=$model->old_w_reading?></td>

					<th>New Meter(Water)  Reading</th>
					<td><?=$model->current_w_reading?></td>
				</tr>
				<tr>
					<th>Water Units Used</th>
					<td><?=$model->water_used_units?></td>

					<th>Unit Price</th>
					<td><?=$agent->unit_price_water?></td>
				</tr>
					<tr>
					<th>Water Cost</th>
					<td><?=$model->w_payment_amount?></td>

					<th>Payment Status</th>
					<td><?=$model->w_payment_status?></td>
				</tr>

				<tr>
				  <th>Old Power Reading</th>
					<td><?=$model->old_e_reading?></td>

					<th>New Power Reading</th>
					<td><?=$model->current_e_reading?></td>
				</tr>

				<tr>
					<th>Power Units Used</th>
					<td><?=$model->electricity_used_units?></td>

					<th>Unit Price</th>
					<td><?=$agent->unit_price_electricity?></td>
				</tr>
				<tr>
					<th>Power Cost</th>
					<td><?=$model->e_payment_amount?></td>

					<th>Payment Status</th>
					<td><?=$model->e_payment_status?></td>
				</tr>
					<tr>
					<th>Total Utility Bill</th>
					<td><?=number_format($model->w_payment_amount+$model->e_payment_amount,2)?></td>

					<th>Payment Ref No</th>
					<td><?=(isset($model->w_payment_ref))?$model->w_payment_ref:"Not Set";?></td>
				</tr>

					<tr>
					<th>Reading Date</th>
					<td><?=$model->reading_date?></td>

					<th>Period</th>
					<td><?=$model->month.",".$model->year?></td>
				</tr>
					
				
				

			</table>
			
		</div>
		

	</div>
	

</div>