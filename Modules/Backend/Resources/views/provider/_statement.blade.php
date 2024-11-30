<div class="row">
  


<table class="table table-striped" id="Paytable">
	<thead>
		<tr class="info">
      
			
      <th>Transaction Date</th>
      <th>Title</th>
      <th>Description</th>
      <th>Ref No</th>
      <th>Credit</th>
      <th>Debit</th>
      <th>Balance</th>
   
                            
			
		</tr>
	</thead>
	
</table>

           <script>
             $("#Paytable").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/Property/LandloadPay/".$id."?start_date=".$StartDate."&end_date=".$EndDate)?>',
                      columns: [
                  //{data: 'id', name: 'tenants.id'},
                  
                  {data:'tran_date',name:'tran_date'},
                  {data: 'Description', name: 'Description'},
                  {data: 'other_details', name: 'other_details'},
                  {data: 'ref_no', name: 'ref_no'},
                  {data:'debit',name: 'debit'},
                  {data:'credit',name: 'credit'},
                  {data: 'balance', name: 'balance'},

              ],
               dom: '<"html5buttons"B>lTfgitp',

        buttons: [
                 
            { extend: 'copy'},

                    {extend: 'csv'},
                     {extend: 'excel', title: 'Landload Statement For '+'<?=$property->title?> As From <?=date('Y-M-d',strtotime($StartDate))?>  To  <?=date('Y-M-d',strtotime($EndDate))?>  '},
                    {extend: 'pdf', title: 'Landload Statement', orientation: 'landscape',pageSize: 'A4',messageBottom: 'Designed and Developed By Isanyad',

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
           </div>
         