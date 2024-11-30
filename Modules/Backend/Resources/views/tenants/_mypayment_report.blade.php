<table class="table table-striped" id="Paytable">
	<thead>
		<tr class="info">
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
                  //{data: 'id', name: 'tenants.id'},
                  {data:'name',name:'users.name'},
                 
                  {data: 'number', name: 'spaces.number'},
                  {data:'debit',name: 'debit'},
                  {data:'reference_number',name: 'reference_number'},
                  {data: 'transaction_date', name: 'transaction_date'},
              ],
               dom: '<"html5buttons"B>lTfgitp',

        buttons: [
                 
            { extend: 'copy'},

                    {extend: 'csv'},
                     {extend: 'excel', title: 'Provider Transaction List'},
                    {extend: 'pdf', title: 'Provider Transaction List', orientation: 'landscape',pageSize: 'A4',messageBottom: 'Designed and Developed By Isanyad',

                  },
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    },
                       {extend: 'colvis',text: "Set Visible",class:"btn btn-primary"},
                   /* {
                extend: 'print',
                text: 'Print all (not just selected)',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            },*/

                  
        ],
           
             });
           </script>
         