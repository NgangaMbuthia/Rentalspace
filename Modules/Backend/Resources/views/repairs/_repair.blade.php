<div class="row">
<div class="table-responsive">
<div class="col-md-12">
 <table class="table table-striped table-bordered">
   <thead>
   <tr class="info">
   <th class="text-center" colspan="4">Repair Details</th>
   </tr>
   	

   </thead>
   <tbody>
   <tr>
   <td><b>Property</b></td>
   <td><?=$model->space->property->title;?></td>

   <td><b>Unit</b></td>
   <td><?=$model->space->number;?></td>
   </tr>

   <tr>
   <td><b>Repair Code</b></td>
   <td><?=$model->repair_code;?></td>

   <td><b>Invoice Number</b></td>
   <td><?=$model->invoice_number;?></td>
   </tr>

   <tr>
   <td><b>Type</b></td>
   <td><?=$model->type;?></td>

   <td><b>Person Responsible</b></td>
   <td><?=$model->person_responsible;?></td>
   </tr>
   <tr>
   <td><b>Sevice Fee</b></td>
   <td><?=$model->technician_fee;?></td>

   <td><b>Total Cost</b></td>
   <td><?=$model->total_cost;?></td>
   </tr>
   <tr>
   <td><b>Repair Date</b></td>
   <td><?=$model->repair_date;?></td>

   <td><b>Service Person</b></td>
   <td><?=$model->job_done_by;?></td>
   </tr>
   
   	
   </tbody>
 	

 </table>

</div>
	
</div>
	

</div>