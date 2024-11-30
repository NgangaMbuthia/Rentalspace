<div class="row">
<table class="table table-bordered table-striped">
<?php if($model->invoice):?>
<tr>
<td>Invoice Number</td><td colspan="2"><?=$model->invoice->invoice_number?></td>
</tr>

<tr>
<td>Invoice Status</td><td colspan="2">
 <?php if($model->invoice->status=="Paid"):?>
 	<label class="label label-success">Paid</label>
 	<a href="<?=url('/backend/invoice/view/'.$model->invoice->id)?>" class="glyphicon glyphicon-eye-open  pull-right"></a>

 <?php elseif($model->invoice->status=="Pending"):?>
 	<label class="label label-warning">Pending</label>
 	<a href="<?=url('/backend/invoice/view/'.$model->invoice->id)?>" class="glyphicon glyphicon-eye-open  pull-right"></a>

  <?php elseif($model->invoice->status=="Overdue"):?>
 	<label class="label label-danger">Overdue</label> 
 	<a href="<?=url('/backend/invoice/view/'.$model->invoice->id)?>" class="glyphicon glyphicon-eye-open  pull-right"></a>
  <?php else:?>

  <label class="label label-info"><?=$model->status?></label>
  <a href="<?=url('/backend/invoice/view/'.$model->invoice->id)?>" class="glyphicon glyphicon-eye-open  pull-right"></a>
 <?php endif;?>
	

</td>
</tr>
<?php endif;?>
<tr>
<td>Ref No</td><td colspan="2"><?=$model->reference_number;?></td>
</tr>

<tr>
<td>Transaction  ID</td><td colspan="2"><?=$model->system_transaction_number;?></td>
</tr>
<tr>
<td>Amount</td><td colspan="2"><?=($model->credit>0)? $model->credit:$model->debit;?></td>
</tr>

<tr>
<td>Transaction Fee</td><td colspan="2"><?=$model->fee_charges;?></td>
</tr>
<tr>
<td>Transaction Type</td><td colspan="2"><?=$model->type;?></td>
</tr>
<tr>
<td>Transaction Date</td><td colspan="2"><?=date('dS M,Y',strtotime($model->transaction_date));?></td>
</tr>
<tr>
<td>Description</td><td colspan="2"><?=$model->description?></td>
</tr>
</table>
</div>