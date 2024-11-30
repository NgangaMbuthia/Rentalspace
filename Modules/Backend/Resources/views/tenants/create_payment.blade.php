@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/view/rent/payments')?>">Payments Management</a></li>
       
        <li class="active">Make New Tenant Payment</li>
  </ul>

@stop


@section('content')


<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary" href="<?=url('/backend/make/bulkpayment')?>">Add Bulk Payment</a>
    <button class="btn btn-success">Import Payment</button>
    </div>

    
    

</div>
 <div class="clearfix"></div>
<p></p>
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-credit-card position-left"></i>Add New Payment</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=url('/backend/payment/store')?>" method="post" enctype="multipart/form-data">
                        <div class="row">


                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Invoice Number</label>
                                       <input type="text" class="form-control" name="invoice" placeholder="Invoice #"   id="invoice-number" value="{{old('invoice')}}"/>
                                    
                                  
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Date Billed</label>
                                       <input type="text" class="form-control datepicker-menus" name="date-billed" placeholder="Date Billed"  readonly  id="date-billed" value="{{old('date-billed')}}"/>
                                    
                                  
                                     @if ($errors->has('date-billed'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date-billed') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>



                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    
                                     <input type="text" class="form-control "   placeholder="Property Name" name="property_id"  id="property" value="{{old('property_id')}}" readonly>
                                  
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Space(Unit) Number</label>
                                   

                                    <input type="text" class="form-control "   placeholder="Unit" name="space_id"  id="spaces" value="{{old('space_id')}}" readonly>
                                  
                                     @if ($errors->has('space_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('space_id') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            </div>
                            
                           
                      
                       

                        
                        <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Full Name</label>
                                     <input type="text" class="form-control" name="name" placeholder="Full Names"  readonly id="name" value="{{old('name')}}"/>
                                  
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                                    <label>ID Number</label>
                                     <input type="text" class="form-control" name="id_number" placeholder="ID Number"  readonly  value="{{old('id_number')}}" id="id_number"/>
                                  
                                     @if ($errors->has('id_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('id_number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                        
                        </div>
                          <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email Address</label>
                                     <input type="text" class="form-control" name="email" placeholder="Email Address" readonly id="email" value="{{old('email')}}" />
                                  
                                     @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>Telephone Number (Start with Country Code eg +254)</label>
                                     <input type="text" class="form-control" name="phone" placeholder="Phone Number" readonly value="{{old('phone')}}" id="phone" />
                                  
                                     @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                        
                        </div>

                        <div class="row">
                              

                               
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('payment_mode') ? ' has-error' : '' }}">
                                    <label>Payment Mode</label>
                                     <select class="form-control" name="payment_mode" id="method" >
                                         <option value=" ">--Select Mode---</option>
                                         <option>Bankslip</option>
                                         <option>Cheque</option>
                                         <option>Cash</option>
                                         <option>MPesa</option>
                                         <option>Paybal</option>
                                         <option>Others</option>

                                     </select>
                                  
                                     @if ($errors->has('payment_mode'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('payment_mode') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('reference_number') ? ' has-error' : '' }}">
                                    <label>Transaction Number</label>
                                     <input type="text" class="form-control" name="reference_number" placeholder="Transaction Number" id="transaction-number" value="{{old('reference_number')}}" />
                                  
                                     @if ($errors->has('reference_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('reference_number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                        
                        </div>

                         <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('credit') ? ' has-error' : '' }}">
                                    <label>Invoice Amount</label>
                                     <input type="text" class="form-control"  placeholder="Amount" value="{{old('credit')}}" id="amount" readonly />
                                  
                                     @if ($errors->has('credit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('credit') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 hidden">
                                <div class="form-group {{ $errors->has('credit') ? ' has-error' : '' }}">
                                    <label>Amount Paid</label>
                                     <input type="text" class="form-control number" placeholder="Amount" value="{{old('credit')}}" id="MyAmount"  readonly/>
                                  
                                     @if ($errors->has('credit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('credit') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 hidden">
                                <div class="form-group {{ $errors->has('credit') ? ' has-error' : '' }}">
                                    <label>Invoice Balance</label>
                                     <input type="text" class="form-control number" placeholder="Amount" value="{{old('credit')}}" id="balance" readonly />
                                  
                                     @if ($errors->has('credit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('credit') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('credit') ? ' has-error' : '' }}">
                                    <label>Transaction Amount</label>
                                     <input type="text" class="form-control number" name="credit" placeholder="Amount" value="{{old('credit')}}" id="amountpaid" />
                                  
                                     @if ($errors->has('credit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('credit') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group {{ $errors->has('transaction_date') ? ' has-error' : '' }}">
                                    <label> Transaction  Date</label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control datepicker-menus"  id="datepicker" placeholder="Pick a date&hellip;" name="transaction_date" value="{{old('transaction_date')}}">
                                        </div>
                                  
                                     @if ($errors->has('transaction_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('transaction_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden receipt">
                                <div class="form-group {{ $errors->has('receipt') ? ' has-error' : '' }}">
                                    <label> Upload Scanned Receipt</label>
                                    <input type="file" name="receipt" class="form-control" id="receipt">
                                      
                                  
                                     @if ($errors->has('receipt'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('receipt') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>


                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Brief Description</label>
                                    <textarea class="form-control" rows="4" name="description" id="description" ></textarea>
                                      
                                  
                                     @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-md-12">

                                <button id="synbtn" class="btn btn-info"><span class="fa fa-refresh"></span>Perform Payment Breakdown</button>
                                   
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 payment hidden">
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Payment Breakdown</label>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="info">
                                                <th>ID</th>
                                                <th>ItemName</th>
                                                <th>Amount</th>
                                                <th>Piad</th>
                                                <th>Bal</th>
                                                <th>Amount</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="invoice-table">
                                            
                                        </tbody>
                                        
                                    </table>

                                </div>
                               </div>
                        
                        </div>

                        
                        

                        
                      <div class="row hidden payment">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit"  class="btn btn-primary btn-labeled btn-labeled-right ml-10"><b><i class="icon-check"></i></b> Save Payments Details</button> 
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}">

</script>
<link href="{{ asset('/assets/css/jquery.auto-complete.css')}}" rel="stylesheet" type="text/css" />
<script  type="text/javascript" src="{{ asset('/assets/css/jquery.auto-complete.js') }}" ></script>
<script type="text/javascript">
    $("#property").on("change",function(){
      var id=$("#property").val();
      var length=id.length;


      if(length>=1){
        var url="<?=url('/backend/fetch/occupied/property_spaces')?>/"+id;
         $.post(url,function(data){
            $("#spaces").html(data);

         });
       
      }

      
    });


    $("#spaces").on('change',function(){
        var id=$(this).val();
        if(id.length>0){
            var url="<?=url('backend/fetch/tenant_details')?>/"+id;
            $.getJSON(url,function(data){
             $("#name").val(data.name);
             $("#id_number").val(data.id_number);
             $("#email").val(data.email);
             $("#phone").val(data.phone);
            });
        }

    });

    


     $("#invoice-number").autoComplete({
  minChars: 3,
  source: function(term, response){
 try { xhr.abort(); } catch(e){}
  xhr = $.getJSON("{{url('/backend/verify-invoice')}}", { term: term }, function(data){
  response(data);
  });
  },
  renderItem: function (item, search){
        search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
        var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
        return '<div class="autocomplete-suggestion" data-id="'+item[5]+'"   data-address="'+item[11]+'"  data-name="'+item[4]+'"  data-gender="'+item[1]+'"  data-email="'+item[6]+'"   data-telephone="'+item[7]+'"   data-country="'+item[12]+'"  data-invoice_number="'+item[0]+'"    data-company_address="'+item[3]+'"  data-property="'+item[2]+'"     data-emp-license="'+item[4]+'"     data-emp-status="'+item[5]+'"   data-description="'+item[9]+'"    data-amount="'+item[8]+'"   data-val="'+search+'"> '+item[4].replace(re, "<b>$1</b>")+'</div>';
    },
   onSelect: function(e, term, item){
     $("#invoice-number").val(item.data('invoice_number'));
      $("#placeofbirth").val(item.data('country'));
      $("#phone").val(item.data('telephone'));
      $("#email").val(item.data('email'));
      $("#date-billed").val(item.data('gender'));
      $("#name").val(item.data('name'));
      $("#id_number").val(item.data('id'));
      $("#description").val(item.data('description'));
      $("#amount").val(item.data('amount'));
      $("#spaces").val(item.data('company_address'));
      $("#property").val(item.data('property'));
        
          
       }
  
  });

      var invoice_id="<?=$invoice_id?>";
        if(invoice_id>0)
        {
          var url="<?=url('/backend/invoice/GetTenantDetails')?>/"+invoice_id;
          $.getJSON(url,function(data){
            
          $("#invoice-number").val(data.invoice_number);
          $("#phone").val(data.telephone);
          $("#email").val(data.email);
          $("#date-billed").val(data.date_billed);
          $("#name").val(data.name);
          $("#id_number").val(data.id_number);
          $("#amount").val(data.invoice_amount);
          $("#spaces").val(data.space);
          $("#property").val(data.property);
           $("#MyAmount").val(data.amount_paid);
          $("#description").val(data.description);
          $("#balance").val(data.balance);
         

    
      
          })
        }




     $("body").on("input","#amount",function(e){
        e.preventDefault();
        alert(e);

     });

     $("#invoice-number").on('input',function(e){
          var lenth=$(this).val().length;

            if(lenth<5){
                $("#placeofbirth").val("");
              $("#phone").val("");
              $("#email").val("");
              $("#date-billed").val("");
              $("#name").val("");
              $("#id_number").val("");
              $("#description").val("");
              $("#amount").val("");
              $("#spaces").val("");
              $("#property").val("");

            }

     });


      $("#method").on("change",function(e){
        e.preventDefault();
         var value=$(this).val();
        
           if(value=="Cheque" || value=="Bankslip")
           {
             $(".receipt").removeClass("hidden");
             $("#receipt").attr('required',true);
           }else{
                if(value=="Cash")
                {
                    $("#transaction-number").val("<?=strtoupper(str_random(8));?>");
                    $("#transaction-number").attr("readonly",true);

                }
                else{
                     $("#transaction-number").attr("readonly",false);
                }
             $(".receipt").addClass("hidden");
             $("#receipt").attr('required',false);
           }

           
           


      });


        $("#synbtn").on("click",function(e){
            e.preventDefault();
            var invoice_number=$("#invoice-number").val();
              
           
            
             
           var url="<?=url('/backend/make/getInvoiceComponent')?>";

            $.get(url,{'Number':invoice_number},function(data){
              
               $(".payment").removeClass("hidden");
                 $("#invoice-table").html("");
                $("#invoice-table").html(data);

            });
        });


       $("body").on("keydown",".number",function(e){
                
      var key = e.keyCode ? e.keyCode : e.which;
    if ( isNaN( String.fromCharCode(key) ) && key != 8 && key != 46  &&key != 190 &&key !=110 &&key !=37 &&key !=39) return false;


      });



</script>
@endpush
