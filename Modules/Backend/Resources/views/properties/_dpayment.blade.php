<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Property</th>
					<td><?=$payment->space->property->title;?></td>
					<th>Space</th>
					<td><?=$payment->space->number;?></td>
					
				</tr>
				<tr>
					<th>Method</th>
					<td><?=$payment->payment_mode;?></td>
					<th>Ref Number</th>
					<td><?=$payment->reference_number;?></td>
					
				</tr>
				<tr>
					<th>Debit</th>
					<td><?=number_format($payment->debit);?></td>
					<th>Credit</th>
					<td><?=number_format($payment->credit);?></td>
					
				</tr>
				  <?php if($payment->invoice):?>
				<tr>
					<th>Invoice</th>
					<td><a href="<?=url('/backend/invoice/view/'.$payment->invoice->id)?>"><?=$payment->invoice->invoice_number?></a></td>
					<th>Transaction date</th>
					<td><?=date('Y-m-d',strtotime($payment->transaction_date));?></td>
					
				</tr>
			<?php endif;?>
				<tr>
					<th>Tenant Name</th>
					<td><?=$payment->tenant->user->name?></td>
					<th>Mobile</th>
					<td><?=$payment->tenant->user->profile->telephone;?></td>
					
				</tr>
				<tr>
					<th>Description</th>
					<td colspan="3"><?=$payment->description?></td>
					
					
				</tr>
				

			</table>
			
		</div>
		

	</div>
	
</div>