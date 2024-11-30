<div class="row">
<div class="table-responsive">
	

<table class="table table-bordered table-striped">
<thead>
<tr class="success">
<th>#</th>
<th>Charge Name</th>
<th>Effective From</th>
<th>Amount</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php $i=1;foreach($models as $mod):?>
<tr>
	<td><?=$i;?></td>
	<td><?=$mod->charge_name;?></td>
	<td><?=$mod->effective_from;?></td>
	<td><?=$mod->amount;?></td>
	<td><?=$mod->status;?></td>
	

</tr>
<?php $i++;endforeach;?>
	
</tbody>
</table>

<div class="clearfix"></div>


<h4>Deposit: <?=$deposit?> <span class="pull-right">Monthly Dues: <?=$monthly?></span></h4> 


	</div>

</div>