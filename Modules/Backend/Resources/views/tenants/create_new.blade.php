<div class="row">
	
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		 <div class="col-md-12 form-group">
		 	<label>Property</label>
		 	<select name="property_id" id="property" class="form-control" required>
		 		<option value="">--Select Property---</option>
		 		<?php foreach($properties as $prop):?>
                   <option value="{{$prop->id}}">{{$prop->title}}</option>
		 		 <?php endforeach;?>
		 		
		 	</select>
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Unit</label>
		 	<select name="unit" id="unit" class="form-control" required>
		 		<option value="">---Select Unit---</option>
		 		<option value="All">All</option>

		 		
		 		
		 	</select>
		 	
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Amount</label>
		 	<input type="text" name="amount" class="form-control" required>
		 </div>
		 <div class="col-md-12 form-group">
		 	<label>Description</label>
		 	<textarea name="Description" class="form-control" required></textarea>
		 </div>
		 <div class="col-md-12 form-group">
		 	<button class="btn btn-primary">Create</button>
		 </div>
    </form>


</div>
<script type="text/javascript">
	$("#property").on("change",function(e){
		e.preventDefault();

		 var value=$(this).val();
		var url="<?=url('/backend/payment/tenants/fatutaPro')?>/"+value;
		
		 $.get(url,function(data){

        $("#unit").html(data);

		 })

	})
</script>