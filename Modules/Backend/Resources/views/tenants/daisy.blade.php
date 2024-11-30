	
	@extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<style type="text/css">
    th, td { white-space: nowrap; }
</style>
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
				<li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
				<li class="active">Index</li>
</ol>
<ul class="breadcrumb-elements">
              <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-gear position-left"></i>
                  Settings
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="<?=url('/backend/property/statistics')?>"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')
@include('backend::tenants.t_head')
<div class="row" style="margin-top:2%;">
              
                
              </div>

             <div class="panel panel-white">

             <div class="panel-heading">
              <h6 class="panel-title">Current Tenants Under {{$property->title}}</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
               
                
              <div class="panel-body">
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
              <th>Deposit</th>
              <th>Total</th>
              <th>Method</th>
              <th>ReceiptNo</th>
              <th>UnitId</th>
              
              </tr>
            </thead>
            <tbody>
               <?php foreach($models as $model):?>
                <tr>
               
                  <td style="width:70px;">{{$model->number}}  <input type="hidden" name="tenantId[]" value="{{$model->tenant_id}}">  <input type="hidden" name="spaceId[]" value="{{$model->space_id}}"> <input type="hidden" name="spaceId[]" value="{{$model->space_id}}"></td>
                  <td>{{$model->floor}}</td>
                  <td style="width:50px;"><input style="width:85px;"  type="text" name="amountDue[]" value="{{abs($model->balance)}}"></td>
                  <td><input type="date" class="paydate" name="datepaid[]" style="width:100px;"></td>
                    <td><input type="text" class="rent_deposit rent" name="rent[]" style="width:100px;"></td>
                        <td><input type="text"  class="rent_deposit deposit"  name="deposit[]" style="width:100px;"></td>
                   <td><input type="number" name="amountpaid[]" style="width:85px;" class="amountPaid paid"></td>
                    <td><select name="method[]" style="width:70px;" class="method">
                      <option value="">---Select Method---</option>
                      <option>Cash</option>
                      <option>Bank</option>
                      <option>Direct</option>
                      <option>Mpesa</option>

                    </select></td>
                   <td><input type="text" name="refNumber[]" class="refNumber"></td>
                   <td>{{$model->space_id}}</td>
                </tr>


               <?php endforeach;?>

            

            </tbody>

            </table>
          </div>

          <div class="row" style="margin-top: 1%">
            <legend>Property Monthly Expenses</legend>

            <div class="col-md-12">
              <div class="col-md-3 form-group">
               <button class="btn btn-warning" id="AddExpense">Add Expense</button>
             </div>
            </div>
               <div class="expense-continer">
                 
               <?php if(sizeof($expenses)>0):?>
                 <?php foreach($expenses as $expense):?>

                  <div class="col-md-12">
              <div class="col-md-3 form-group">
                <label>Expense Name</label>
                <input type="text" name="expenseName[]" value="{{$expense->expense_name}}" class="form-control">
                
              </div>
              <div class="col-md-3 form-group">
                <label>Expense Date</label>
                <input type="date" value="{{ $expense->expense_date}}" name="expensedate[]" class="form-control expensedate">
                
              </div>
              <div class="col-md-3 form-group">
                <label>Expense Amount</label>
                <input type="text" value="{{$expense->amount}}" name="expenseAmount[]" class="form-control expenseamount">
                
              </div>
              <div class="col-md-3 form-group">
                <label>remove</label><br>
                <button class="btn btn-danger removeme"><span class="fa fa-remove"></span>Delete</button>
                
              </div>
             
            </div>


                 <?php endforeach;?>


                 <?php else:?>
                   <div class="col-md-12">
              <div class="col-md-3 form-group">
                <label>Expense Name</label>
                <input type="text" name="expenseName[]" class="form-control">
                
              </div>
              <div class="col-md-3 form-group">
                <label>Expense Date</label>
                <input type="date" name="expensedate[]" class="form-control expensedate">
                
              </div>
              <div class="col-md-3 form-group">
                <label>Expense Amount</label>
                <input type="text" name="expenseAmount[]" class="form-control expenseamount">
                
              </div>
              <div class="col-md-3 form-group">
                <label>remove</label><br>
                <button class="btn btn-danger removeme"><span class="fa fa-remove"></span>Delete</button>
                
              </div>
             
            </div>


                 <?php endif;?>
           

          </div>
          <h4>Total Exepense :<span id="TotalExpense"></span></h4>
              <hr>
            

          </div>


              <div class="col-md-12">
                <button class="btn btn-primary">Submit</button>
                
              </div>

               </form>

              </div>

              </div>

              @stop
                  @push('scripts')

            <script type="text/javascript">
              $('#ItemID').on('keyup change', function () {
   oTable.column(0).search($(this).val()).draw();
});
              
            </script>
           <script>



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

            

             var old_amount="<?=$amount_paid?>";

               $("body").on("input",".rent_deposit",function(e){
                e.preventDefault();
                var rent=$(this).parent().parent().find(".rent").val();
                var deposit=$(this).parent().parent().find(".deposit").val();
                  if(rent=="")
                  {
                    rent=0;
                  }
                  if(deposit=="")
                  {
                    deposit=0;
                  }
                 var total=parseFloat(rent)+parseFloat(deposit);
                 $(this).parent().parent().find(".paid").val(total);

                  $(this).parent().parent().find(".paydate").attr("required",true);
                      $(this).parent().parent().find(".method").attr("required",true);
                  CalculateTotalCost();

               });
              



             $("body").on("input",".amountPaid",function(e){
              e.preventDefault();
              
               CalculateTotalCost();
             })



             function CalculateTotalCost() {

    //var table = document.getElementById('docTable');

    var items =  document.getElementsByClassName("amountPaid");

    
    var sum = 0;

    $('.amountPaid').each(function(){
       if(this.value=="")
       {
       sum += 0;
       }else{
        sum += parseFloat(this.value);
       }
    
});
   $("#NowAmount").val(sum);
   var total_paid=old_amount+sum;
  
   var expected=$("#Current").val();
   var balance=expected-sum;
  

  $("#Balance").val(balance);




    

   
  
    
    

    
    
}

           </script>
           <script type="text/javascript">

             $("#AddExpense").on("click",function(e){
              e.preventDefault();

              var html='<div class="col-md-12">'
                      +' <div class="col-md-3 form-group">'
                +'<label>Expense Name</label>'
                +'<input type="text" name="expenseName[]" class="form-control">'
                +'</div>'
                +'<div class="col-md-3 form-group">'
                +'<label>Expense Date</label>'
                +'<input type="date" name="expensedate[]" class="form-control expensedate">'
                +'</div>'
                +'<div class="col-md-3 form-group">'
                +'<label>Expense Amount</label>'
                +'<input type="text" name="expenseAmount[]" class="form-control expenseamount">'
                +'</div>'
                +'<div class="col-md-3 form-group">'
                +'<label>remove</label><br>'
              +'<button class="btn btn-danger removeme"><span class="fa fa-remove"></span>Delete</button>'
                +'</div>'
                +'</div>';
             $(".expense-continer").append(html);

             });

              $("body").on('click','.removeme',function(e){
             var item=$(this).parent().parent();
             $(item).remove();
           

          });


             $('body').on('focus',".expensedate", function(){
    $(this).datepicker();
});

              $("body").on("input",".expenseamount",function(e){
                e.preventDefault();
                CalculateTotalExpense();

              });


              function CalculateTotalExpense()
              {

    var items =  document.getElementsByClassName("expenseamount");
    var sum = 0;

    $('.expenseamount').each(function(){
       if(this.value=="")
       {
       sum += 0;
       }else{
        sum += parseFloat(this.value);
       }
    
});
      $("#TotalExpense").html("");
      $("#TotalExpense").html(sum);

              }


              CalculateTotalExpense();
             

           </script>
           @endpush

