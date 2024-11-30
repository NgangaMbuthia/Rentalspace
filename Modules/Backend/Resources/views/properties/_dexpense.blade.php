<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Property</th>
					<td><?=$expense->property->title;?></td>
				</tr>
				<tr>
					<th>Expense Name</th>
					<td><?=$expense->expense_name;?></td>
				</tr>
				<tr>
					<th>Expense Amount</th>
					<td><?=number_format($expense->amount);?></td>
				</tr>
					<tr>
					<th>Expense Date</th>
					<td><?=date("Y-m-d",strtotime($expense->expense_date));?></td>
				</tr>
				</tr>
					<tr>
					<th>Month</th>
					<td><?=$expense->month;?></td>
				</tr>

				<tr>
					<th>Year</th>
					<td><?=$expense->year;?></td>
				</tr>
				<tr>
					<th>Record Date</th>
					<td><?=$expense->created_at;?></td>
				</tr>
				<tr>
					<th>Description</th>
					<td><?=$expense->other_descriptions;?></td>
				</tr>



				

			</table>
</div>
</div>
</div>