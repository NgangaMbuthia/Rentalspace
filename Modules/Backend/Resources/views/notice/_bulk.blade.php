<div class="row">
	<div class="col-md-12">
		
	
	<form action="{{$url}}" method="post">
		 <?=csrf_field()?>
		<div class="table-responsive">
			<table class="table table-bordered" id="Vacate">
				<thead>
					<tr class="info">
						<th>#</th>
						<th>Unit</th>
						<th>Tenant Name</th>
						<th>Entry Date</th>
						<th>Balance</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($models as $model):?>
						<tr>
							<td><input type="checkbox" name="tenantid[]" value="{{$model->id}}"></td>
							<td>{{$model->number}}</td>
							<td>{{$model->name}}</td>
							<td>{{$model->entry_date}}</td>
							<td>{{$model->balance}}<input type="hidden" name="balance[]" value="{{$model->balance}}"></td>

							

						</tr>

					 <?php endforeach;?>
				</tbody>
				
			</table>
			
		</div>

		<div class="col-md-12 form-group" style="margin-top: 2%">

			<button class="btn btn-primary">Complete</button>
			
		</div>
		
	</form>

</div>
	

</div>
