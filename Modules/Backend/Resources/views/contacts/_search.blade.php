<div class="row">
<form action="<?=$url?>" method="post">
<?=csrf_field();?>
 <div class="form-group col-md-5">
 <label>Search By</label>
 <select class="form-control" name="param">
 <option value="name">Name</option>
 <option value="email">Email</option>
 <option value="mobile">Mobile Number</option>
 	

 </select>
 	
 </div>

 <div class="form-group col-md-2">
 <label>Operand</label>
 <select class="form-control" name="operand">
 <option>=</option>
 <option value="like">like</option>
 
 	

 </select>
 	
 </div>
  

 <div class="form-group col-md-5">
 <label>Search Value</label>
 <input type="text" name="value" class="form-control" required>
 	
 </div>

 <div class="form-group col-md-12">
  <button class="btn btn-info">Search</button>
 	
 </div>
	

</form>
	

</div>