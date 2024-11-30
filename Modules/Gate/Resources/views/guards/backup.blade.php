  
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
                  <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

@include('gate::gates.g_head')

<div class="row">
          <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Guard Management </h6>
                </div>
                
              <div class="panel-body">

                             <div class="row">
            <div class="col-md-12">
              <form method="POST" id="search-form" role="form">
      <div class="form-group col-md-2">
        <label>Property</label>
        <select class="form-control" id="role" name="branch_id">
           <option> </option>
           <?php foreach($properties as $role):?>
            <option value="<?=$role->title?>"><?=$role->title?></option>

           <?php endforeach;?>
          
        </select>

      </div>
      <div class="form-group col-md-2">
        <label>Gate</label>
        <select class="form-control" id="gates" name="branch_id">
           <option> </option>
           
          
        </select>

      </div>
      <div class="form-group col-md-2">
        <label>Guard</label>
        <select class="form-control" id="guards" name="guards">
           <option> </option>
           
          
        </select>

      </div>
      

      <div class="form-group col-md-2">
        <label>Telephone</label>
         <input type="text" class="form-control" name="mobile" id="name" placeholder="Mobile Number">

      </div>

      <div class="form-group col-md-2">
        <label>Start Date</label>
         <input type="datepicker" id="datepicker" name="created_at" class="form-control" />

      </div>


      
      
   <div class="form-group col-md-2">
        <label>End Date</label>
         <input type="datepicker" id="datepicker" name="created_at" class="form-control" />

      </div>
     

     
    </form>
      </div>
            </div>


                  <div class="table-responsive">
                  

                    <table id="guard-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Property</th>
                            <th>Gate</th>
                            <th>Guard</th>
                            <th>Mobile</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                            </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
           <script>


               $("#role").on("change",function(e){

                e.preventDefault();
                var property=$(this).val();

                 var url="<?=url('/security/find/gates')?>/"+property;
                  $.post(url,function(data){

                     $("#gates").html(data);


                  });

                 });



                   $("#role").on("change",function(e){
                
                      oTable.draw();
                      e.preventDefault();

                 });


               $("#gates").on("change",function(e){
                e.preventDefault();
                var gate=$(this).val();

                 var url="<?=url('/security/find/guards')?>/"+gate;

              
                  $.post(url,function(data){

                     $("#guards").html(data);

                });    });
             

             var oTable = $('#guard-table').DataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
            
            "<'row'<'col-xs-12't>>"+
            "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ url("security/assignments/fetch_assigns")}}',
            data: function (d) {
               
                d.property = $("#role").val();
                d.gates = $("#gates").val();
                d.guards=$("#guards").val();
                d.branch_id=$('#fetch-branches').val();
                d.date_created=$("#datepicker").val();
                d.status=$("#status").val();
            }
        },
           columns: [
            {data: 'rownum', name: 'rownum',searchable:false},
            {data: 'title', name: 'properties.title'},
            {data: 'gate_name', name: 'gate_gates.name'},
            {data: 'name', name: 'users.name'},
            {data: 'telephone', name: 'telephone'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            
            {data: 'action', name: 'action',searchable:false},
       


        ],
      
    });


              $( "#datepicker" )
        .datepicker({

          maxDate:0,
          changeMonth: true,
          dateFormat:"yy-mm-dd",
          numberOfMonths: 1,
          onSelect: function(){
             oTable.draw();
        e.preventDefault();

          },
        });

         $('#category-container,#fetch-branches,#fetch-counties,#status,#role').on('change', function(e) {
           
        oTable.draw();
        e.preventDefault();
    });


          $('#email,#name').on('input', function(e) {
            
              oTable.draw();
        e.preventDefault();
         });

           </script>

           
           @endpush

