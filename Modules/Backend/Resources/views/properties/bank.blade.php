<div class="row">
<div class="col-md-12">
<form action="<?=$url;?>" method="post" id="bank-form">

<div class="col-md-6 form-group">
<label>Bank Name</label>
<input type="text" value="<?=$model->bank_name?>" name="bank_name" class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>Branch</label>
<input type="text" value="<?=$model->branch?>" name="branch" class="form-control" />
</div>

<div class="col-md-6 form-group">
<label>Account Name</label>
<input type="text" value="<?=$model->account_name?>" name="account_name" class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>Account Number</label>
<input type="text" value="<?=$model->account_number?>" name="account_number" class="form-control" />
</div>

<div class="col-md-6 form-group">
<label>Paybill Number</label>
<input type="text" value="<?=$model->paybill?>" name="paybill" class="form-control" />
</div>
<div class="col-md-6 form-group">
<label>M-Pesa Mobile</label>
<input type="text" value="<?=$model->mpesa_phone?>" name="mpesa_phone" class="form-control" />
</div>
<div class="col-md-12">
<?=csrf_field();?>
<button class="btn btn-primary submit-my-phone" data-form="bank-form" data-title="update this Bank Details">Update</button>
	

</div>
	

</form>

	

</div>
	

</div>