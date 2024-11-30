  
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
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li><a href="<?=url('/backend/properties/Expenses')?>"></span>Expense Management</a></li>
        <li class="active">Units</li>
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
@include('backend::properties.t_head')
<div class="row">
          <div class="col-md-12">

            
            <p>
              <a href="<?=url('/backend/properties/NewExpenses')?>" class="btn btn-primary">Add Expense</a>
            </p>
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Properties Expense Management </h6>
                </div>
                
              <div class="panel-body">
                <div class="col-md-12">
                  <form action="{{url()->current()}}" method="post">
                     <?=csrf_field()?>

                     <div class="col-md-12">
                      <div class="col-md-6 form-group">
                        <label>Property</label>
                        <select name="property" class="form-control" id="property">
                    <option value="">--Select Property---</option>
                       <?php foreach($properties as $proporty):?>
                           <option value="<?=$proporty->id;?>"><?=$proporty->title;?></option>
                       <?php endforeach;?>
                  </select>
                        
                      </div>
                       
                     </div>
                     <div class="col-md-12" style="margin-top: 1%">
            <legend>Property Monthly Expenses</legend>

            <div class="col-md-12">
              <div class="col-md-3 form-group">
               <button class="btn btn-warning" id="AddExpense">Add Expense</button>
             </div>
            </div>
               <div class="expense-continer">
                 
               
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


                
           

          </div>
          <h4>Total Exepense :<span id="TotalExpense"></span></h4>
              <hr>
            

          </div>
          <div class="col-md-12">
               <div class="col-md-12">
                <button class="btn btn-primary">Submit</button>

               </div>

            
          </div>



                    

                  </form>
                  

                </div>
                  

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
           <script>

            $("#property").select2();

  

            
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

