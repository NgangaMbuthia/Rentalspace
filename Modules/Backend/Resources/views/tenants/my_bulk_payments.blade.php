
<style type="text/css">
    th, td { white-space: nowrap; font-size: 11px;}
</style>
<hr><br>

              <div class="row">
              <div class="col-md-12">

                <div class="col-md-2 form-group">
                  <label>Expected Amount</label>
                  <input  type="text" name="" id="Expected" value="{{$expected_amount}}">
                  
                </div>
                <div class="col-md-2 form-group">
                  <label>Current Amount Paid</label>
                  <input type="text" name="" value="{{$amount_paid}}" id="OldAmount">
                  
                </div>
                 <div class="col-md-2 form-group">
                  <label>Current Balance</label>
                  <input type="text" name="" id="Current" value="{{$expected_amount-$amount_paid}}">
                  
                </div>

                 <div class="col-md-2 form-group">
                  <label>Amount Paid Now</label>
                  <input type="text"  id="NowAmount"  readonly>
                  
                </div>


                <div class="col-md-2 form-group">
                  <label>New Balance</label>
                  <input type="text"  id="Balance"  readonly>
                  
                </div>
                
              </div>
                
              </div>
              <form action="{{$url}}" method="post">
                 <?=csrf_field();?>
              <div class="row" style="margin-bottom:0.3%">
                  <div class="col-xs-8">
     <label for="ItemID">Unit Name/Number</label>
         <div class="input-group">
             <input type="text" class="form-control" name="ItemID" id="ItemID" maxlength="15"> <span class="input-group-btn">
             <button type="button" class="btn btn-default" id="Search">SEARCH</button>
        </span>

         </div>
</div>
          
                
              </div>


                     

             
              <div class="table-responsive">

              <table  id="TanantPayment" class="table table-hover table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
          
              <th>Unit</th>
              <th>Floor</th>
              <th>AmountDue</th>
              <th>Date</th>
              
              <th>Rent</th>
              <th>Water</th>
              <th>Garbage</th>
              <th>Deposit</th>
              <th>Total</th>
              
              <th>Method</th>
              <th>ReceiptNo</th>
              <th class="hidden">UnitId</th>
              
              </tr>
            </thead>
            <tbody>
               <?php foreach($models as $model):?>
                <tr>
               
                  <td style="width:70px;">{{$model->number}}  <input type="hidden" name="tenantId[]" value="{{$model->tenant_id}}">  <input type="hidden" name="spaceId[]" value="{{$model->space_id}}"> <input type="hidden" name="spaceId[]" value="{{$model->space_id}}"></td>
                  <td>{{$model->floor}}</td>
                  <td style="width:50px;"><input style="width:60px;"  type="text" name="amountDue[]" value="{{abs($model->balance)}}"></td>
                  <td><input type="date" class="paydate" name="datepaid[]" style="width:100px;"></td>
                 
                    <td><input type="text" class="rent_deposit rent" name="rent[]" style="width:60px;" value="0"></td>
                    <td><input type="text" class="water rent_deposit" name="water[]" style="width:60px;"  value="0"></td>
                    <td><input type="text" class="garbage rent_deposit" name="garbage[]" style="width:60px;"  value="0"></td>
                    
                  
                        <td><input type="text"  class="rent_deposit deposit"  name="deposit[]" style="width:60px;"  value="0"></td>
                         <td>
                        <input type="text" name="amountpaid[]" style="width:60px;" class="amountPaid paid"  value="0" readonly></td>
                   
                    <td><select name="method[]" style="width:60px;" class="method">
                      <option value="">---Select Method---</option>
                      <option>Cash</option>
                      <option>Bank</option>
                      <option>Direct</option>
                      <option>Mpesa</option>

                    </select></td>
                   <td><input type="text" name="refNumber[]" class="refNumber" style="width: 60px;"></td>
                   <td class="hidden">{{$model->space_id}}</td>
                </tr>


               <?php endforeach;?>

            

            </tbody>

            </table>
          </div>

          


              <div class="col-md-12">
                <button class="btn btn-primary">Submit</button>
                
              </div>

               </form>
               <script type="text/javascript">
                  var oTable = $('#TanantPayment').DataTable({
  dom:            "Bfrtip",
      scrollY:        "400px",
        scrollX:        true,
        scrollCollapse: true,
        aaSorting: [[9, 'asc']],
        



    "columnDefs": [
        { "targets": [1,2,3,4,2], "searchable": false }
    ]
});



               </script>

          <script type="text/javascript">
               
              $('#ItemID').on('keyup change', function () {
   oTable.column(0).search($(this).val()).draw();
});
              
            </script>

              
     

           
       

