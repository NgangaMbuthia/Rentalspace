<table class="table table-striped" id="Paytable">
	<thead>
		<tr class="info">
      <th>Action</th>
			<th>Unit</th>
			<th>Tenant</th>
			<th>Amount Paid</th>
			<th>Ref Number</th>
			<th>Date</th>
			
		</tr>
	</thead>
	
</table>

           <script>
             $("#Paytable").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/Property/fetchMyPay/".$id."?start_date=".$StartDate."&end_date=".$EndDate)?>',
                      columns: [
                  {data: 'action', name: 'action',searchable:false,orderable:false},
                  {data: 'number', name: 'spaces.number'},
                  {data:'name',name:'users.name'},
                  {data:'debit',name: 'debit'},
                  {data:'reference_number',name: 'reference_number'},
                  {data: 'transaction_date', name: 'transaction_date'},
              ],
               
           
             });
           </script>
         