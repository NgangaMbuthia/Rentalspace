<?php 
use App\Helpers\Helper;
?>

@extends('layout.main')
<style type="text/css">
    .select2{
        width:100%;
    }
</style>



@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
        
        <li><a href="<?=url()->current();?>"></span>Bulk Payment</a></li>
        <li class="active">Bulk </li>
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

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Bulk Payments</h6>
                </div>
                
              <div class="panel-body">


                

                <div class="col-md-4 form-group">
                 
                  <select name="property" class="form-control" id="property">
                    <option value="">--Select Property---</option>
                       <?php foreach($properties as $proporty):?>
                           <option value="<?=$proporty->id;?>"><?=$proporty->title;?></option>
                       <?php endforeach;?>
                  </select>
                  
                </div>
                <div class="col-md-4 form-group">
                 
                 <button class="btn btn-primary" id="loadUnits">Load Units</button>
                  
                </div>
                 <div class="clearfix"></div>
                 <div class="loader hidden" id="Loader">
                   <center><img src="{{asset('loading.gif')}}" width="500" height="230"></center> 
                 </div>
                <div class="row" id="tabledata">
                 
                 
                  
                </div>

              

              </div>

              </div>

              @stop
              @push('scripts')
              <script type="text/javascript">


                $("#property").select2();


             $("#loadUnits").on("click",function(e){
              e.preventDefault();
               var property=$("#property").val();
                  if(property.length>0)
                  {
                    $("#Loader").removeClass("hidden");
                     $("#tabledata").addClass("hidden");
                    var url="<?=url('/backend/make/getPropertyUnits')?>/"+property;
                    $.get(url,function(data){
                      $("#Loader").addClass("hidden");
                      $("#tabledata").removeClass("hidden");
                      $("#tabledata").html(data);


                    })
                  }


                
                


             });


                 $("#property").on("change",function(e){
                   var property=$(this).val();
                    if(property.length>0)
                    {
                     var url="<?=url('/backend/make/bulkloadTenants')?>/"+property;
                      $.get(url,function(data){
                        $("#property-body").html(data);


                      })
                    }

                 })

                 

              </script>

             
           <script>





            

             var old_amount="<?=@$amount_paid?>";

               $("body").on("input",".rent_deposit",function(e){
                e.preventDefault();
                var rent=$(this).parent().parent().find(".rent").val();
                var deposit=$(this).parent().parent().find(".deposit").val();
                var water=$(this).parent().parent().find(".water").val();
                var garbage=$(this).parent().parent().find(".garbage").val();
                 

                  if(rent=="")
                  {
                    rent=0;
                  }
                  if(deposit=="")
                  {
                    deposit=0;
                  }
                  if(water=="")
                  {
                    water=0;
                  }
                   if(garbage=="")
                  {
                    garbage=0;
                  }



                 var total=parseFloat(rent)+parseFloat(deposit)+parseFloat(water)+parseFloat(garbage);
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

