<div class="row">
	<form action="<?=$url?>" method="post">
		 <?=csrf_field();?>
		<div class="col-md-6 form-group">
			<label>Property</label>
			<select name="property_id" class="form-control" required>
				<option value="">---Select Property---</option>
				 <?php foreach($models as $property):?>
                   <option value="<?=$property->id?>"><?=$property->title?></option>
				 <?php endforeach;?>
			</select>
			
		</div>
		<div class="col-md-6 form-group">
			<label>Expense Name</label>
			<input type="text" value="<?=$model->expense_name?>" name="expense_name" class="form-control">
			
		</div>

		<div class="col-md-6 form-group">
			<label>Expense Amount</label>
			<input type="text"  value="<?=$model->amount;?>" name="amount" class="form-control number">
			
		</div>
		<div class="col-md-6 form-group">
			<label>Expense Date</label>
			<input type="text" value="<?=$model->expense_date?>" name="expense_date" class="form-control" id="datepicker">
			
		</div>
		<div class="col-md-12 form-group">
			<label>Expense Decription</label>
			<textarea class="form-control" required rows="2" name="other_descriptions"><?=$model->other_descriptions;?></textarea>
			
		</div>
			<div class="col-md-12 form-group">
            <button class="btn btn-primary"><?=($model->exists)? "Update":"Create";?></button>
			</div>
		
	</form>
	
</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $( "#datepicker" ).datepicker({
      showButtonPanel: true
    });
  </script>
