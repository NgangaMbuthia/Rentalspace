@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">Visitors</a></li>
        <li class="active">Create</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-user position-left"></i>Visitor Details</h6>
                                </div>
                                
                            <div class="panel-body">


                             <form action="<?=$url?>" method="post">
                             {{csrf_field()}}

                            <div class="col-md-12 panel panel-default">
                             

                            <div class="panel-body">
                            <div class="row">
                           

                            <div class="col-md-6 form-group">
                            <label>ID NUMBER</label>
                            <input type="text" name="visitor[id_number]" required class="form-control" id="id-number">
                            </div>
                            <div class="col-md-6 form-group">
                            <label>NAMES</label>
                            <input type="text" id="name" name="visitor[name]" class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                            <label>EMAIL ADDRESS</label>
                            <input type="text" id="email" name="visitor[email_address]" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                            <label> TELEPHONE</label>
                            <input type="text" id="phone" name="visitor[mobile]" class="form-control">
                            </div>


                            <div class="col-md-6 form-group">
                            <label>HOST NAME</label>
                            <select id="host-id" name="visitor[host_id]" class="form-control">
                            <option value="">--Select Host--</option>
                            <?php foreach($tenants as $tenant):?>
                                <option value="{{$tenant['id']}}">{{$tenant['name']}}</option>


                            <?php endforeach;?>
                                

                            </select>
                            
                            </div>
                            <div class="col-md-6 form-group">
                            <label>HOST TELEPHONE</label>
                            <input type="text" id="telephone" class="form-control">
                            </div>

                            <div class="col-md-12 form-group">
                            <label>VISIT REASON</label>
                            <textarea class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 form-group">
                            <label>HAS VEHICLE</label>
                            <select id="vehicles" name="has_vehicle" required class="form-control">
                            <option value="">--Select One--</option>
                            <option>No</option>
                            <option>Yes</option>
                                

                            </select>
                            </div>

                            <div class="col-md-6 form-group">
                            <label>HAS  ELECTRONICS</label>
                            <select id="electronic"  name="has_electronics" required class="form-control">
                            <option value="">--Select One--</option>
                            <option>No</option>
                            <option>Yes</option>
                                

                            </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="hidden" id="vehicle-container">
                                
                                 @include('gate::visitor.vehicles')
                            </div>
                            <div class="clearfix"></div>

                             <div class="hidden" id="item-container">
                                
                                 @include('gate::visitor.electronics')
                            </div>

                           



                                

                            </div>






                                
                            </div>


                            <div class="col-md-12">

                            <button class="btn btn-info">Save Details</button><p>
                                


                            </div>
                            </form>
                                

                            </div>

                            
                  
                               </div>
            <div class="clearfix"></div>
            </div>



@endsection
@push('scripts')
<script type="text/javascript">
  $("#electronic").on("change",function(e){
      var value=$(this).val();
        if(value=="Yes"){
            $("#item-container").removeClass("hidden");
        }else{
           $("#item-container").addClass("hidden");  
        }

  });


  $("#vehicles").on("change",function(e){
      var value=$(this).val();
        if(value=="Yes"){
            $("#vehicle-container").removeClass("hidden");
        }else{
           $("#vehicle-container").addClass("hidden");  
        }

  });

   $("#host-id").on("change",function(e){
     var id=$(this).val();
      var url="<?=url('security/user/get_telephone')?>/"+id;
        $.post(url,function(data){
             $("#telephone").val(data);

        });

   });

   $("#id-number").on("input",function(){
      var id=$(this).val();
      var length=id.length;
         if(length>=6){
             var url="<?=url('/security/user/get_visitor_details')?>/"+id;
              
             $.post(url,function(data){
                 data=JSON.parse(data);
              $("#name").val(data.name);
              $("#email").val(data.email);
              $("#phone").val(data.mobile);


             });
         }else{
             $("#name").val("");
              $("#email").val("");
              $("#phone").val("");
         }
   });
    


</script>



@endpush




