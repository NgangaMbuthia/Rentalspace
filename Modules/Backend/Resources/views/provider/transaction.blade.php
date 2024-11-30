<div class="row">
	<form action="{{$url}}" method="post">
		 <?=csrf_field();?>
		 <div class="col-md-12">
		 	<div class="col-md-6 form-group">
		 		<label>Property</label>
		 		<select name="property_id" class="form-control" required>
		 			<option value="">---Select Property---</option>
		 			 <?php foreach($properties as $property):?>
		 			 	<option value="{{$property->id}}">{{$property->title}}</option>

		 			 <?php endforeach;?>
		 			
		 		</select>

		 		
		 	</div>
		 	<div class="col-md-6 form-group">
		 		<label>Date</label>
		 		<input type="text" name="date" class="form-control" value="{{date('Y-m-d')}}" required id="PaymentDate">

		 		
		 	</div>
		 	

		 </div>
		  <div class="col-md-12">
		 	<div class="col-md-6 form-group">
		 		<label>Method</label>
		 		<select name="method" class="form-control" required id="PayMethod">
		 			<option value="">---Select Method---</option>
		 			<option>Cash</option>
		 			<option>Cheque</option>
		 			<option>Bank Slip</option>
		 			<option>M-pesa</option>
		 				<option>Transfer</option>
		 			
		 		</select>
		 		

		 		
		 	</div>
		 	<div class="col-md-6 form-group">
		 		<label>Amount</label>
		 		<input type="text" name="amount" class="form-control" required>
		 	</div>
		 </div>
		 <div class="col-md-12">
		 	<div class="col-md-6 form-group">
		 		<label>Payment Type</label>
		 		<select name="payment_type" class="form-control" required>
		 			<option>Advance</option>
		 			<option>Loan</option>
		 		
		 			<option>Monthly Remitance</option>
		 			<option>Expense</option>
		 			
		 			
		 		</select>
		 		

		 		
		 	</div>
		 	<div class="col-md-6 form-group">
		 		<label>Ref Number</label>
		 		<input type="text" name="ref_number" class="form-control" id="RefNumber" required>
		 	</div>
		 </div>
		  <div class="col-md-12">
		 	
		 	<div class="col-md-12 form-group">
		 		<label>Description</label>
		 		<input type="text" name="otherDetails" class="form-control" id="otherDetails" required>
		 	</div>
		 </div>
		 <div class="col-md-12 ">
		 	<div class="col-md-6 form-group">
		 		<button class="btn btn-primary">Submit</button>
		 	</div>

		 </div>
		

	</form>
	

</div>

<script type="text/javascript">
	

	 

      
	   $("body").on("change","#PayMethod",function(e){
	   	e.preventDefault();
	   	 var method=$(this).val();
	   	  
	   	  if(method=="Cash")
	   	  {
	   	  	var number="<?=strtoupper("Cash-".str_random(4))?>";
	   	  	 $("#RefNumber").val(number);

	   	  }else{
	   	  	$("#RefNumber").val("");
	   	  }


	   })


	    $("#PaymentDate").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });
</script>