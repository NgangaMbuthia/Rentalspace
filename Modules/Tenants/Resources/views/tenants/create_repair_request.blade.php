@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/tenants/repair/create_request')?>">Repairs</a></li>
       
        <li class="active">Create Request</li>
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
                                    <h6 class="panel-title">Create New Repair Request</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=$url?>" method="post">



                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label>Unit</label>
                                    <select class="form-control" name="space_id" id="property">
                                    <option value="">--Select Property--</option>
                                     @foreach($spaces as $space)
                                    <option value="{{$space->id}}">{{$space->number}} ( {{$space->title}})</option>
                                   
                                     @endforeach
                                        

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
                                    <input type="text" class="form-control" id="space">
                                  
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
                                <div class="form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                                    <label>Category</label>
                                    <select class="form-control" name="level" id="property">
                                    <option value="">--Select Property--</option>
                                    <option>Emergency Repair</option>
                                    <option>Urgent Repair</option>
                                    <option>Routine Repair</option>
                                    
                                        

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
                                    <label>Type</label>
                                    <select class="form-control" name="type"  id="type">
                                     <option value="">----Select Space Type ----</option>
                                     <option>Electrical Wiring</option>
                                     <option>Handymen</option>
                                     <option>House Keeping</option>
                                     <option>Home Wiring</option>
                                     <option>Heating Ventilation and Air Conditioning</option>
                                     <option>Plumbing</option>
                                     <option>Smoke Alarm</option>
                                     <option>Door and Window Repairs</option>
                                     <option>Others</option>
                                        

                                    </select>
                                  
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
                                    <label>Priority</label>
                                     <select name="priorty" required class="form-control">
                                     <option value="">--Select Priority---</option>
                                     <option>High</option>
                                     <option>Medium</option>
                                     <option>Urgent</option>
                                     <option>Low</option>
                                         

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
                                    <label> Repair  Date</label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control datepicker-menus"  id="datepicker" placeholder="Pick a date&hellip;" name="expected_repair_date" value="{{old('repair_date')}}">
                                        </div>
                                  
                                     @if ($errors->has('expected_repair_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('expected_repair_date') }}</strong>
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
<script type="text/javascript">
  


   


    $("#property").on("change",function(){
      var id=$("#property").val();
      var length=id.length;


      if(length>=1){

        var url="<?=url('/backend/fetch/property')?>/"+id;
         $.post(url,function(data){
             
            $("#space").val(data);

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


    


     $('body').on('focus',".datepicker", function(){
    $(this).datepicker();
});

     

        
       



</script>
@endpush
