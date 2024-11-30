  
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
@include('backend::properties.t_head')
<div class="row">
 <div class="col-md-12">
     <div class="col-md-12">
      <p>
        <a  data-title="Add Expenses" data-url="<?=url('/backend/property/expense_add')?>" class="btn btn-primary reject-modal"><i class="glyphicon glyphicon-plus"></i>Add Expense</a>
      </p>
         
             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Expenses List</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                    <div class="form-group col-md12 pull-left">
                    
                      
                    </div>

                       <div class="row">
            <div class="col-md-12">
              <form method="POST" id="search-form" role="form">
      
      <div class="form-group col-md-3">
        <label>Property</label>
         <select class="form-control" id="make">
           <option></option>
            <?php foreach($properties as $property):?>
            <option><?=$property->title;?></option>
            <?php endforeach;?>
           
           
         </select>
      </div>

      <div class="form-group col-md-3">
        <label>Year</label>
         <select class="form-control" id="model">
           <option></option>
            <?php foreach($years as $year):?>
            <option><?=$year->year?></option>
            <?php endforeach;?>
         </select>

      </div>


      <div class="form-group col-md-3">
        <label>Month</label>
        <select class="form-control" id="category" name="branch_id">
          <option></option>
           <?php foreach($months as $month):?>
         <option><?=$month->month?></option>
           <?php endforeach;?>
         


           
           
          
        </select>

      </div>
     
   <div class="form-group col-md-3">
        <label>Exepnse</label>
           <select class="form-control" id="type" name="branch_id">
           <option> </option>

           <?php foreach($expenses as $month):?>
         <option><?=$month->expense_name?></option>
           <?php endforeach;?>
             
    </select>

      </div>
        
     

     
    </form>
      </div>
            </div>

                    <table id="datatable" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            
                           <th>Property</th>
                            <th>Expense</th>
                            <th>Ref No</th>
                          
                            <th>Amount</th>
                            <th>Date</th>

                            </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>

              </div>
            </div>
              </div>

              @stop
               @push('scripts')
           <script>
            
             var oTable = $('#datatable').dataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?=url("/backend/property/expense_fetch")?>',
            data: function (d) {
               
                d.type= $("#type").val();
                d.category = $("#category").val();
                d.ref_no=$("#name").val();
                d.make=$('#make').val();
                d.model=$("#model").val();
                d.status=$("#status").val();
                d.employee_type=$("#user_type").val();
            }
        },
           columns: [
            //{data: 'id', name: 'vehicles.id'},
            {data: 'title', name: 'properties.title'},
              {data: 'expense_name', name: 'property_expenses.expense_name'},
            {data: 'ref_no', name: 'property_expenses.ref_no'},
            
            {data: 'amount', name: 'property_expenses.amount'},
            {data: 'expense_date', name: 'property_expenses.expense_date'},
            
            
       


        ],
      
    });


     $("#make").on("change",function(e){

     oTable.draw();
      alert();


     })

         $('#category,#make,#model,#status,#role,#type').on('change', function(e) {
         
        oTable.draw();
        alert("gdhhgdghd");
        e.preventDefault();
    });


          $('#email,#name').on('input', function(e) {
            
              oTable.draw();
        e.preventDefault();
         });
  
           </script>
           @endpush

