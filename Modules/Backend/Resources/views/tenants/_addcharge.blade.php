
<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
<div class="col-md-6">

<div class="form-group">
<label>Tenant Name</label>
<input type="text" name="name" value="<?=$model->user->name?>" class="form-control" readonly>
	
</div>



</div>
<div class="col-md-6">

<div class="form-group">
<label>Unit</label>
<input type="text"  value="<?=$model->space->number?>" class="form-control" readonly>
	
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Charge Name</label>
<input type="text" name="charge_name"  class="form-control">
	
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Charge Amount</label>
<input type="text" name="charge_amount"  class="form-control number">
	
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Short Description</label>
<textarea name="charge_description" class="form-control"></textarea>
	
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Send Notification to Tenant</label>
<select name="send_notification" class="form-control">
	<option>Yes</option>
	<option>No</option>
	
</select>
	
</div>
</div>
<div class="col-md-12">
<button class="btn btn-primary">Complete</button>
</div>
	



	

</div>
</form>
</div>
<script type="text/javascript">
	
	  $(".number").on("keydown",function(e){
      var key = e.keyCode ? e.keyCode : e.which;
    if ( isNaN( String.fromCharCode(key) ) && key != 8 && key != 46  &&key != 190 &&key !=110 &&key !=37 &&key !=39) return false;


      });

</script>