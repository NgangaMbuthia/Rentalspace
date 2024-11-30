	
	@extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Supplies</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Quatation</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Supplier Module</a></li>
        <li><a href="<?=url('/backend/v-notice/index')?>"></span>Supplier list</a></li>
        <li class="active">Create</li>
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
@include('supplier::suppliers.s_head')
<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Create New Product(s) Quatations</h6>

                  


                </div>
                
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12">
                
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Quatation Format</label>
                  <div class="col-sm-9">
                      <label class="radio-inline"> <input type="radio" name="format" id="seasonSummer" value="summer" checked> Multiple Suppliers-One Product</label>
                      <label class="radio-inline"> <input type="radio" name="format" id="seasonWinter" value="winter" > One Supplier-Several Products</label>
                      
                  </div>
              </div>
              </div>
              <div class="multiple-supplier hidden">
              <p>
             
                 

                 <div class="col-md-12">
                  <hr style="width:100%;">
                 <b> <i><h7>This Format is used when you want several suppliers to respond to price of one product</h7></i></b>
                 <p>
                 <div class="col-md-3">
                 <label>Product Name</label>
                 <select class="form-control" name="product_name[]" id="product-name">
                 <option value>--Select Product---</option>
                  <?php foreach($products as $product):?>
                    <option><?=$product->core_commodity;?></option>

                  <?php endforeach;?>
                   
                 </select>
                   
                 </div>
                  <div class="col-md-3">
                 <label>Quantity</label>
                 <input type="text" name="quantity[]" class="form-control">
                   
                 </div>
                 <div class="col-md-3">
                 <label>Units</label>
                 <select class="form-control" name="unit">
                   <option>Bags</option>
                   <option>Kilograms</option>
                   <option>Meters</option>
                   <option>Tonnes</option>
                   <option>Feets</option>
                 </select>
                   
                 </div>

                  <div class="col-md-3">
                 <label>Supply Date</label>
                 <input type="text" name="supply_date[]" class="form-control datepicker-menus" id="datepicker">
                   
                 </div>
                 

                 </div>
                 
                 <div class=" col-md-12 supplie-container hidden" style="margin-top: 5%;">
                 <div class="table-responsive">
                   <table class="table table-hover table-bordered">
                   <thead>
                   <tr class="success">
                   <th colspan="7" class="text-center">Select Commodities Supplier On The Portal Who will receive this quatation Request</th>
                   
                  </tr>
                   <tr class="success">
                   <th><input type="checkbox" id="checklist"></th>
                   <th>Supplier Name</th>
                   <th>Product</th>
                   <th>Supplier Phone</th>
                   <th>City</th>
                   <th>Country</th>
                   <th>V.A.T</th>
                  </tr>
                     
                   </thead>

                   
                   <tbody id="table-body">

                   <tr class="col-md-12 kenyad">
                   <td colspan="4">
                   <img  style="margin-left: 50%;" src="{{ asset('assets/images/show.gif')}}" alt="Real">
                     
                   </td>

                 
                   
                 </tr>

                   

                   
                     
                   </tbody>
                     

                   </table>
                   
                 </div>
                 </div>
                 <div class="clearfix"></div>
                 <div class="col-md-12" style="margin-top:6%;">

                 <button class="btn btn-success">Send Quatation</button>
                   

                 </div>
              </div>
                <div class="single-supplier hidden">
                <div class="col-md-12">
                 <hr style="width:100%;">
                 <b> <i><h7>This Format is used when you want to send quatation for several items to one known supplier</h7></i></b>
                 <p>

                <div class="col-md-3 form-group">
                <label>Supplier Name</label>
                <select class="form-control select" name="supplier_id">
                  
                </select>
                  
                </div>

                <div class="col-md-3 form-group">
                <label>Supplier V.A.T</label>
                <input type="text" name="vat" id="vat" class="form-control">
                  
                </div>
                <div class="col-md-3 form-group">
                <label>Supplier Telephone</label>
                <input type="text" name="vat" id="vat" class="form-control">
                  
                </div>

                <div class="col-md-3 form-group">
                <label>Supply Date</label>
                <input type="text" name="supliy_date" id="supply-date" class="form-control datepickers" id="supply-date">
                  
                </div>
              </div>

               <div class="col-md-12" style="margin-top:2%;">
               <div class="col-md-12">
                 <button class="btn btn-default" id="add-product"><span class="glyphicon glyphicon-plus "></span>Add Products</button>
                
               </div>
               <p>
               <div class="product-holder">
               <div class="row">
               <div class="col-md-12">
               <div class="col-md-3 form-group">
               <label>Product Name</label>
               <select class="form-control" name="product-name[]">
                 
               </select>
                 
               </div>

                <div class="col-md-3 form-group">
               <label>Quantity</label>
               <input type="text" name="quantity[]" class="form-control">
                 
               </div>

               <div class="col-md-3 form-group">
               <label>Units</label>
               <select class="form-control" name="unit[]">
                   <option>Bags</option>
                   <option>Kilograms</option>
                   <option>Meters</option>
                   <option>Tonnes</option>
                   <option>Feets</option>
                 </select>
                 
               </div>
               <div class="col-md-3 form-group">
               <label></label>
               <button class="btn btn-default remove-product" style="margin-top:12%;"><span class="glyphicon glyphicon-remove"></span></button>
                 
               </div>
                 

               </div>
               </div>
               </div>


                
               




               </div>



                </div>
              </div>
              </div>

              @stop
              @push('scripts')

  
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
  <script>
  $( function() {
    $( "#datepicker,#supply-date" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });
  } );
  </script>


<script type="text/javascript">
  
 $('body').on('click',".datepicker", function(){
    $(this).datepicker();
});
   $("#product-name").on("change",function(){
      $(".supplie-container").removeClass("hidden");
      $(".kenyad").removeClass("hidden");
       var value=$(this).val();
        var length=value.length;
         if(length>0){
          var url="<?=url('supplier/supplier/product_supplier')?>/"+value;
            $.post(url,function(data){
              $(".kenyad").addClass("hidden");
              $("#table-body").html("");
              $("#table-body").html(data);
          
            });
         }
        
   });


    $("#checklist").change(function() {
    if(this.checked) {
    $('.my-checklist').attr('checked', true);
        //Do stuff
    }else{
      $('.my-checklist').attr('checked', false);
      
    }
});


    $('input[type=radio][name=format]').on('change', function() {
       var value=$(this).val();
      switch($(this).val()) {
         case 'summer':
         $(".single-supplier").addClass("hidden");
             $(".multiple-supplier").removeClass("hidden");
             //$(".single-supplier").removeClass("hidden");
             break;
         case 'winter':
              $(".multiple-supplier").addClass("hidden");
              $(".single-supplier").removeClass("hidden");
             break;
     }
});


   $('body').on('focus',".datepicker,.supply-date", function(){
    $(this).datepicker();
});

/*bootbox.confirm("Confirm Your are isabyd", function(s){
  alert(s);
});*/

//bootbox.alert("Please fill all the required details.");
          

        
       
$(".multiple-supplier").removeClass("hidden");

$("#add-product").on('click',function(e){
  e.preventDefault();
   var html='<div class="row">'
            +'<div class="col-md-12">'
            +'<div class="col-md-3 form-group">'
            +'<label>Product Name</label>'
             +'<select class="form-control" name="product_name[]">'
                 
              +'</select>'
                 
              +'</div>'

              +'<div class="col-md-3 form-group">'
               +'<label>Quantity</label>'
               +'<input type="text" name="quantity[]" class="form-control">'
                 
               +'</div>'

               +'<div class="col-md-3 form-group">'
               +'<label>Units</label>'
               +'<select class="form-control" name="unit[]">'
                  +'<option>Bags</option>'
                   +'<option>Kilograms</option>'
                   +'<option>Meters</option>'
                   +'<option>Tonnes</option>'
                   +'<option>Feets</option>'
                 +'</select>'
                 
               +'</div>'
               +'<div class="col-md-3 form-group">'
               +'<label></label>'
               +'<button class="btn btn-default remove-product" style="margin-top:12%;"><span class="glyphicon glyphicon-remove"></span></button>'
                 
               +'</div>'
                 

               +'</div>'
               +'</div>';

            $(".product-holder").append(html)

});

  $('body').on('click','.remove-product',function(e){
     e.preventDefault();
      var son=$(this).parent().parent();
     var record = bootbox.confirm("Confirm You want to remove this product from quatation List", function (res) {
     if (res == true) {
         
        $(son).remove();
     } else {
         
     }
     
    
 });

     
});


</script>
@endpush


