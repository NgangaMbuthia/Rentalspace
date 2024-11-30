<div class="row">
  <hr>
  


<table class="table table-striped" id="Paytable">
	<thead>
		<tr class="info">
      
			
      <th>Landlord</th>
      <th>Telephone</th>
      <th>Credit</th>
      <th>Debit</th>
      <th>Amount Due</th>
      
   
                            
			
		</tr>
	</thead>
	
</table>

           <script>
             $("#Paytable").dataTable({
              processing: true,
              serverSide: true,
              pageLength:250,
              aaSorting: [[4, 'desc']],
              ajax: '<?=url("backend/landlord/LandloadPay/".$year."?month=".$month)?>',
                      columns: [
                  //{data: 'id', name: 'tenants.id'},
                  
                  {data:'name',name:'name'},
                  {data: 'telephone', name: 'telephone'},
                  
                  
                  {data:'debit',name: 'debit'},
                  {data:'credit',name: 'credit'},
                  {data: 'amount_duel', name: 'amount_duel'},

              ],
               dom: '<"html5buttons"B>lTfgitp',

        buttons: [
                 
            { extend: 'copy'},

                    {extend: 'csv'},
                     {extend: 'excel', title: 'Landload Statement  '},
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
         