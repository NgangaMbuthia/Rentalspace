<div class="row">
<form action="" method="post">
<?=csrf_field();?>
<div class="col-md-6 form-group">
<label>Property</label>
<select class="form-control" required name="property_id" id="property-id">
<?php foreach($properties as $model):?>
<option><?=$model->title;?></option>
<?php endforeach;?>
</select>
</div>

<div class="col-md-6 form-group">
<label>Gate</label>
<select class="form-control" required name="property_id" id="gate-id">

</select>
</div>
<div class="col-md-6 form-group">
<label>Start Date</label>
<input type="text" name="start_date" class="form-control datepicker" id="datepicker">
</div>

<div class="col-md-6 form-group">
<label>End Date</label>
<input type="text" name="end_date" class="form-control datepicker" id="end-date">
</div>
	


</form>
	



</div>


<script type="text/javascript">
	
	 $("#property-id").on("change",function(e){


                e.preventDefault();
                var property=$(this).val();


                 var url="<?=url('/security/find/gates')?>/"+property;
                  $.post(url,function(data){


                     $("#gate-id").html(data);


                  });

                 });


	    
    $( "#datepicker" )
        .datepicker({

          maxDate:0,
          changeMonth: true,
          dateFormat:"yy-mm-dd",
          numberOfMonths: 1,
          
        });



</script>


