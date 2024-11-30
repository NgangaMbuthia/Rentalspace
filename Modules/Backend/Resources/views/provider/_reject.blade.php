<div class="row">
	 <form action="<?=$url?>" method="post">
	 	 <?=csrf_field();?>
	 	 <div class="col-md-12 form-group">
	 	 	<label>Give Reason</label>
	 	 	<textarea name="reason" class="form-control" required rows="5"><?=$model->reason?></textarea>
	 	 	
	 	 </div>
	 	 <div class="col-md-12 form-group">
            <button class="btn btn-primary">Complete</button>
	 	 </div>
	 	
	 </form>
	
</div>