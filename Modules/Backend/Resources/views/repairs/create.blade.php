@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/view/rent/payments')?>">Payments Management</a></li>
       
        <li class="active">Make New Tenant Payment</li>
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
                                    <h6 class="panel-title"><i class="icon-credit-card position-left"></i>Add New Repairs</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=url('/backend/repair/store')?>" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <select class="form-control" name="property_id" id="property">
                                    <option value="">--Select Property--</option>
                                    <?php foreach($properties as $property):?>
                                     <option value="<?=$property->id?>">{{$property->title}}-- {{$property->location}}</option>

                                    <?php endforeach;?>
                                        

                                    </select>
                                  
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Space Number/Name</label>
                                    <select class="form-control" name="space_id"  id="spaces">
                                     <option value="">----Select Space Number/Name ----</option>
                                        

                                    </select>
                                  
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
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Repair Type</label>
                                     <input type="text" class="form-control" name="type" placeholder="Repair Type" value="{{old('type')}}" />
                                  
                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('repair_date') ? ' has-error' : '' }}">
                                    <label> Repair  Date</label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control datepicker-menus"  id="datepicker" placeholder="Pick a date&hellip;" name="repair_date" value="{{old('repair_date')}}">
                                        </div>
                                  
                                     @if ($errors->has('repair_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('repair_date') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                   </div>
                               <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('technician') ? ' has-error' : '' }}">
                                    <label>Technician</label>
                                     <input type="text" class="form-control" name="technician" placeholder="Repair Type" value="{{old('type')}}" />
                                  
                                     @if ($errors->has('technician'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('technician') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label>Responsible Person</label>
                                     <select class="form-control" name="responsible_person" id="responsible-person" required>
                                     <option value="">--Select Responsible Person</option>
                                     <option value="Landloard">Landload/Agent</option>
                                     <option value="Tenant">Tenant/Renter</option>
                                         

                                     </select>
                                  
                                     @if ($errors->has('responsible_person'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('responsible_person') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>



                               </div>


                                <div class="row hidden" id="ticketing">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('technician_fee') ? ' has-error' : '' }}">
                                    <label>Repair Ticket</label>
                                     <input type="text" id="ticket-number" class="form-control" name="ticket_number" placeholder="Ticket Number" value="{{old('technician_fee')}}" />
                                  
                                     @if ($errors->has('technician_fee'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('technician_fee') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('total_cost') ? ' has-error' : '' }}">
                                    <label>Date Repair Request</label>
                                     <input type="text" class="form-control" placeholder=""  id="date-created"readonly value="{{old('total_cost')}}" />
                                   
                                     @if ($errors->has('total_cost'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('total_cost') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                               





                                </div>



                                <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('technician_fee') ? ' has-error' : '' }}">
                                    <label>Service Fee</label>
                                     <input type="text" class="form-control" name="technician_fee" placeholder="Service  Fee" value="{{old('technician_fee')}}" />
                                  
                                     @if ($errors->has('technician_fee'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('technician_fee') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('total_cost') ? ' has-error' : '' }}">
                                    <label>Total Fee</label>
                                     <input type="text" class="form-control" name="total_cost" placeholder="Total Repair Cost" value="{{old('total_cost')}}" />
                                  
                                     @if ($errors->has('total_cost'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('total_cost') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                               





                                </div>

                              <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>Repair Description</label>
                                    <textarea class="form-control" rows="4" name="description" ></textarea>
                                      
                                  
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

                               <div class="form-group">
                                        <label class="display-block text-semibold">Were any Items Bought to Facilitate this repair ?</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="items_bought" class="styled radio-inline" checked="checked" value="No">
                                            No
                                        </label>

                                        <label class="radio-inline" style="margin-left:15%;">
                                            <input type="radio" name="items_bought" class="styled radio-inline" value="Yes">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                               </div>
                               <div class="row ficha hidden">
                           
                                  <div class="repair-item-adder" style="margin-bottom:5%;">
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                   <button type="button"  id="add-more-repair-items" class="btn bg-teal pull-right"><b><i class="glyphicon glyphicon-plus "></i></b> Add Repair Items</button> 
                                   </div>

                                  </div>
                                <div class="mtoto" id="add-more-repair-item">


                                 <div class="repair-item">

                                 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                 <div class="form-group">
                                    <label>Item Name</label>
                                     <input type="text" class="form-control" name="item_name[]" placeholder="Item Name"  />
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                 <div class="form-group">
                                    <label>Unit Price </label>
                                     <input type="text" class="form-control" name="unit_price[]" placeholder="Unit Price"  />
                                  </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                 <div class="form-group">
                                    <label>Quantity</label>
                                     <input type="text" class="form-control" name="quantity[]" placeholder="Quantity"  />
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                 <div class="form-group">
                                    <label>Supplier Name</label>
                                    <select class="form-control select" name="supplier_id[]">
                                      
                                     </select>
                                     
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                 <div class="form-group">
                                    <label>Receipt NO (Optional)</label>
                                     <input type="text" class="form-control " name="receipt[]" placeholder="Receipt No"  />
                                    </div>
                                </div>



                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                 <div class="form-group">
                                    <label>Date Supplied</label>
                                     <input type="text" class="form-control datepicker" name="supply_date[]" placeholder="Date Supplied"  />
                                    </div>
                                </div>



                                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                 <div class="form-group">
                                    <label>Delete</label>
                                     <button class="btn btn-danger dalete-repair-items" type="button">
                                     <span class="glyphicon glyphicon-remove"></span></button>
                                    </div>
                                </div>



                                </div>
                                <div class="clearfix"></div>

                                </div>





                               </div>

                        
                    

                        
                        

                        
                      <div class="row">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit"  class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus"></i></b> Save Repair Details</button> 
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

      $("#responsible-person").on('change',function(){

        var id=$(this).val();
        if(id.length>0){
           if(id=="Tenant"){
            $("#ticketing").removeClass("hidden");
        }else{
         $("#ticketing").addClass("hidden");
        }
              

        }

    });


      $("#ticket-number").autoComplete({
  minChars: 3,
  source: function(term, response){
 try { xhr.abort(); } catch(e){}
  xhr = $.getJSON("{{url('/backend/verify-ticket')}}", { term: term }, function(data){
  response(data);
  });
  },
  renderItem: function (item, search){
        search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
        var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
        return '<div class="autocomplete-suggestion" data-id="'+item[1]+'"   data-ticket="'+item[1]+'"  data-date_created="'+item[2]+'"  data-gender="'+item[1]+'"   data-val="'+search+'"> '+item[1].replace(re, "<b>$1</b>")+'</div>';
    },
   onSelect: function(e, term, item){
     $("#ticket-number").val(item.data('ticket'));
      $("#date-created").val(item.data('date_created'));
      
        
          
       }
  
  });


    $(".styled").on('click',function(){
      var them=($("input[name=items_bought]:checked").val());


       if(them=="Yes"){
        
        $(".ficha").removeClass("hidden");
          
         
       }else{

         $(".ficha").addClass("hidden");
         
       }
     

    });



   

    $("body #add-more-repair-items").on('click',function(e){
        e.preventDefault();

        var html='<div class="repair-item">'
                  +'<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">'
                  +'<div class="form-group">'
                  +'<label>Item Name</label>'
                  +'<input type="text"  id="item-name" class="form-control" name="item_name[]" placeholder="Item Name"  />'
                  +'</div>'
                  +'</div>'

                  +'<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">'
                  +'<div class="form-group">'
                  +'<label>Unit Price </label>'
                  +'<input type="text" class="form-control" name="unit_price[]" placeholder="Unit Price"  />'
                  +'</div>'
                  +'</div>'
                
                  +'<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">'
                  +'<div class="form-group">'
                  +'<label>Quantity</label>'
                  +'<input type="text" class="form-control" name="quantity[]" placeholder="Quantity"  />'
                  +'</div>'
                  +'</div>'
                  +'<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">'
                  +'<div class="form-group">'
                  +'<label>Supplier Name</label>'
                  +'<select class="form-control select" name="supplier_id[]">'                       
                 +'</select>'
                  +'</div>'
                  +'</div>'
                  +'<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">'
                  +'<div class="form-group">'
                  +'<label>Receipt NO (Optional)</label>'
                  +'<input type="text" class="form-control" name="receipt[]" placeholder="Receipt No"  />'
                  +'</div>'
                  +'</div>'
                  +'<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">'
                  +'<div class="form-group">'
                  +'<label>Date Supplied</label>'
                  +'<input type="text" class="form-control datepicker" name="supply_date[]" placeholder="Date Supplied"  />'
                 
                  +'</div>'
                  +'</div>'
                  +'<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">'
                  +'<div class="form-group">'
                  +'<label>Delete</label>'
                  +'<button class="btn btn-danger dalete-repair-item" type="button">'
                  +'<span class="glyphicon glyphicon-remove"></span></button>'
                  +'</div>'
                  +'</div>'

                 +'</div>';

                 $("#add-more-repair-item").append(html);
             });

      $("body").on('click','.dalete-repair-item',function(e){
             var item=$(this).parent().parent().parent();
             $(item).remove();

          });


     $('body').on('focus',".datepicker", function(){
    $(this).datepicker();
});

           var url="<?=url('/supplier/supplier/fetch')?>";
 var token ="<?=csrf_token();?>";

       $('body').on('click',".select", function(){
       $(this).select2({
        minimumInputLength: 3,
          ajax: {
          url: url,
          dataType: 'json',
          delay: 250,
          method:'POST',
          data: function (params) {
            return {
            q: params.term, // search term
            page: params.page,
            _token:token
            };
         },
         processResults: function (data,page) {
          
         // parse the results into the format expected by Select2.
         // since we are using custom formatting functions we do not need to
         // alter the remote JSON data
          results = [];

          $.each(data.results, function(index, item){
               
                results.push({
                    id: item['id'],
                    text: item['name'],
                });
            });




           return {
            results: results,
       
       };
          },
           
         
        }
});

 
});


        
       



</script>
@endpush
