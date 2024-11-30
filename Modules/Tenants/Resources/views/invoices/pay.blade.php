@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/tenants/invoices/index')?>">Invoice Payment</a></li>
       
        <li class="active">Submit Payment</li>
  </ul>

@stop
<style type="text/css">
    .select2{
        width:100%;
    }
</style>


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Submit Payment</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=$url?>" method="post"  enctype="multipart/form-data">



                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label>Unit</label>
                                    <select class="form-control" name="space_id" id="property">
                                    <option value="">--Select Unit--</option>
                                     <?php foreach($spaces as $space):?>
                                      <option value="<?=$space->space->id?>"><?=$space->space->number?></option>
                                     <?php endforeach;?>
                                    
                                        

                                    </select>
                                  
                                     @if ($errors->has('level'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('level') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <input type="text" class="form-control" id="space" readonly>
                                  
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            </div>
                        <div class="row">
                            
                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Invoice Number</label>
                                    <select class="form-control" name="invoice_id"  id="invoice">
                                     <option value="">----Select Invoice ----</option>

                                       <?php foreach($invoices as $invoice):?>
                                     <option <?php if($invoice->id==$id):?>selected <?php endif;?> value="<?=$invoice->id?>"><?=$invoice->invoice_number?></option>
                                      <?php endforeach;?>
                                     
                                        

                                    </select>
                                  
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('expected_repair_date') ? ' has-error' : '' }}">
                                    <label> Payment Date</label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control datepicker-menus"  id="datepicker" placeholder="Pick a date&hellip;" name="payment_date" value="{{old('repair_date')}}" required>
                                        </div>
                                  
                                     @if ($errors->has('payment_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('payment_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                            </div>
                            
                        
                        

                         <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Payment Method</label>
                                     <select name="method" required class="form-control" id="method">
                                     <option value="">--Select Method---</option>
                                     <option>BankSlip</option>
                                     <option>Cheque</option>
                                     <option>Mobile Money</option>
                                    
                                         

                                     </select>
                                  
                                     @if ($errors->has('priority'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('priority') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('expected_repair_date') ? ' has-error' : '' }}">
                                    <label>Reference Number</label>
                                      <input type="text" class="form-control"  name="ref_no"  required value="{{old('ref_no')}}">
                                  
                                     @if ($errors->has('expected_repair_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expected_repair_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('amount_paid') ? ' has-error' : '' }}">
                                    <label>Invoice Amount</label>
                                      <input type="text" class="form-control"  readonly id="invoiceAmount">
                                  
                                     @if ($errors->has('amount_paid'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('amount_paid') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('amount_paid') ? ' has-error' : '' }}">
                                    <label>Amount Paid</label>
                                      <input type="text" class="form-control"  name="amount_paid">
                                  
                                     @if ($errors->has('amount_paid'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('amount_paid') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                   </div>

                                      <div class="row hidden cash-cheque">
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                 <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Attached Scanned Copy</label>
                                    <input type="file" name="file_name" >
                                      
                                  
                                     @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif

                                </div>

                               </div>
                           </div>
                              
                               

                              <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Payment  Description</label>
                                    <textarea class="form-control" rows="4" name="description" required ></textarea>
                                      
                                  
                                     @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               </div>
                              
                              

                        
                    

                        
                        

                        
                      <div class="row">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit"  class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus"></i></b> Save Submit</button> 
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
<script type="text/javascript">
  


   


    $("#property").on("change",function(){
      var id=$("#property").val();
      var length=id.length;


      if(length>=1){

        var url="<?=url('/backend/fetch/property')?>/"+id;
         $.post(url,function(data){
             
            $("#space").val(data);

         });

         var url="<?=url('/tenants/fetch/spaceInvoice')?>/"+id;
          $.get(url,function(data){
            $("#invoice").html("");
          $("#invoice").html(data);


          });


           


       
      }

      
    });


    $("#invoice").on("change",function(e){
        e.preventDefault();
        var value=$(this).val();
          var url='<?=url("/tenants/invoice/GetInvoiceAmount")?>/'+value;
          $.get(url,function(data){
          $("#invoiceAmount").val(data);

          });

    })


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


    


     $('body').on('focus',".datepicker", function(){
    $(this).datepicker();
});


 $("body").on('change',"#method",function(e){
    e.preventDefault();
    var value=$(this).val();
     if(value=="Cheque" || value=="BankSlip")
     {
         $(".cash-cheque").removeClass("hidden");
     }else{
        $(".cash-cheque").addClass("hidden");
     }

 })
     

        
       



</script>
@endpush
