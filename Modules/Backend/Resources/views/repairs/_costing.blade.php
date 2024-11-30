<div class="row">
<?php if($invoice):?>
<strong><a href="<?=url('/backend/invoice/view/'.$invoice->id)?>">Invoice Number : <?=$model->invoice_number;?> </a> </strong> <small class="pull-right">Status :

 <?php if($invoice->status=="Pending"):?>
 	<label class="label label-warning"><?=$invoice->status?></label>

 <?php elseif($invoice->status=="Paid"):?>
<label class="label label-success"><?=$invoice->status?></label>
<?php elseif($invoice->status=="Overdue"):?>
<label class="label label-danger"><?=$invoice->status?></label>
<?php else:?>
 <label class="label label-info"><?=$invoice->status?></label>
 <?php endif;?>



<?php endif;?>
</small><br>
<strong>Total Repair Cost :<?=$model->total_cost;?> </strong><br>
<strong >Technical Fee :<?=$model->technician_fee;?></strong>

<div class="table-responsive" style="margin-top:1%;">
<table class="table table-bordered table-hover table-striped">
<thead>
<tr class="success">
<th colspan="6" class="text-center">Items Used For Repair</th>

	
</tr>
<tr class="success">
<th>ID</th>
<th>Item</th>
<th>#</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>Total</th>


	
</tr>
	
</thead>
<tbody>
<?php $i=1;foreach($model->items as $item):?>
<tr>

<td><?=$i;?></td>

<td><?=ucwords($item->item_name)?></td>
<td><ul class="list list-unstyled text-right">
														
					<li class="dropdown">
						
						<a href="#" class="label bg-info-400 dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">

						   <?php if($item->supplier_id):?>

						   	<li class="active"><a href="<?=url('/supplier/supplier/view/'.$supplier->details($item->supplier_id)->id)?>"><i class="icon-alert"></i>Supplier:
							 <?=($item->supplier_id)? $supplier->details($item->supplier_id)->legal_name:"Not Set"?>
							 </a></li>

						   	<?php else:?>

						   		<li class="active"><a href="#"><i class="icon-alert"></i>No Set
							 </a></li>


						   <?php endif;?>


							
							<li><a href="#"><i class="icon-alert"></i> Receit #:
                            <?=(isset($item->receit_number))? $item->receit_number:"Not Set"?>
							</a></li>
							<li><a href="#"><i class="icon-calendar3"></i>Date:
                            <?=(isset($item->date_supplied))? $item->date_supplied:"Not Set"?>

							</a></li>
							<li class="divider"></li>
							
							<li><a href="#"><i class="icon-checkmark3"></i>
                             <?=($item->is_paid=="Yes")? "Paid":"Not Paid"?>
							</a></li>
						</ul>
					</li>
					</ul></td>

<td><?=$item->unit_price;?></td>
<td><?=$item->quantity;?></td>
<td><?=$item->unit_price*$item->quantity;?></td>

	

</tr>


<?php $i++; endforeach;?>
<tr>
<td colspan="5" class="text-center">Total For Items Used</td>
<td><?=$model->total_cost-$model->technician_fee?></td>
	
</tr>
	

</tbody>
	

</table>
	

</div>

	

</div>