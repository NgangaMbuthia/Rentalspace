<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<tr>
					<th>Old Reading</th>
					<td><?=$model->old_e_reading?></td>
				</tr>
				<tr>
					<th>New Reading</th>
					<td><?=$model->current_e_reading?></td>
				</tr>
					<tr>
					<th>Used Units</th>
					<td><?=$model->electricity_used_units?></td>
				</tr>

				<tr>
					<th>Unit Price</th>
					<td><?=number_format($agent->unit_price_electricity,2)?></td>
				</tr>

				<tr>
					<th>Total Amount</th>
					<td><?=number_format($model->e_payment_amount,2)?></td>
				</tr>
				<tr>
					<th>Reading Date</th>
					<td><?=$model->reading_date?></td>
				</tr>

				<tr>
					<th>Payment Status</th>
					<td><?=$model->e_payment_status?></td>
				</tr>
				 <?php if($model->e_payment_status=="Paid"):?>

					<tr>
					<th>Ref No</th>
					<td><?=$model->e_payment_ref?></td>
				</tr>
				 <?php endif;?>
				
			</table>
			
		</div>
		
	</div>
	

</div>