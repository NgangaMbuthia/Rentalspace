<div class="row">
	<div class="col-md-12">

		<form action="<?=$url?>" method="post">
			<?=csrf_field();?>
		<div class="col-md-6 form-group">
			<label>Tenant Name</label>
			<input type="text" value="<?=$model->user->name?>" class="form-control">
			
		</div>
		
		<div class="col-md-6 form-group">
			<label>Unit Number/Name</label>
			<input type="text" value="<?=$model->space->property->title?>" class="form-control">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Unit Number/Name</label>
			<input type="text" value="<?=$model->space->number?>" class="form-control">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Invoice Number</label>
			<input type="text" name="invoice_number" value="<?=$model->invoice_number?>" class="form-control">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Date Invoices</label>
			<input type="text" value="<?=$model->issue_date?>"  readonly class="form-control">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Amount</label>
			<input type="text" name="credit"  value="<?=$model->amount?>" class="form-control" >
			
		</div>
		<div class="col-md-6 form-group">
			<label>Transaction Number</label>
			<input type="text" name="reference_number"  class="form-control" required>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Transaction Date</label>
			<input type="text" class="form-control datepicker-menus"  id="datepicker" placeholder="Pick a date&hellip;" name="transaction_date" value="{{old('transaction_date')}}">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Transaction Date</label>
			<select class="form-control" name="payment_type"  required>
                                         <option value=" ">--Select Mode---</option>
                                         <option>Rent</option>
                                         <option>Repair</option>
                                         <option>Deposit</option>
                                         <option>Advanced</option>
                                         <option>Other</option>
                                        

                                     </select>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Method of Payment</label>
			<select class="form-control" name="payment_mode" >
                                         <option value=" ">--Select Mode---</option>
                                         <option>Bankslip</option>
                                         <option>Cheque</option>
                                         <option>Cash</option>
                                         <option>MPesa</option>
                                         <option>Paybal</option>
                                         <option>Others</option>

                                     </select>
			
		</div>

		<div class="col-md-12 form-group">
			<label>Method of Payment</label>
			<textarea class="form-control" rows="2" name="description" id="description" ></textarea>
			
		</div>
		<div class="col-md-12 form-group">
			<button class="btn btn-primary">Pay</button>
		</div>
		

			
		</form>
		
	</div>
	
</div>
@push('scripts')
<script type="text/javascript">
	$("#datepicker").datepicker({
    beforeShow: function(input, inst) {
        $(document).off('focusin.bs.modal');
    },
    onClose:function(){
        $(document).on('focusin.bs.modal');
    },
    changeYear: true,
    changeMonth: true,
    dateFormat:"yy-mm-dd",
    maxDate:0,
    
});
</script>
@endpush