  @extends('layout.main')


  <style type="text/css">
       td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}

  </style>
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
       <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/module/index')?>">System Modules</a></li>
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
                  
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i>Change Password</a></li>
                  <li class="divider"></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

              <div class="row">
              <div class="col-md-12">
                
              
              

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"></i>System Modules Subscriptions</h6>
                </div>
                
              <div class="panel-body">

               

   <div class="row">
            
            <div class="table-responsive">
          <table id="Subscriptions-table" class="table table-hover table-bordered"  style="width:100%;">
                                <thead>
                                    <tr class="info" >
                                      <td>#</td>
                                      <th>Name</th>
                                      
                                      <th>Telephone</th>
                                      <th>Postal Address</th>
                                      <th>City</th>
                                      <th>Date Created</th>
                                       </tr>
                                </thead>
                                <tbody>
                                 <?php foreach($models as $model):?>
                                 <tr data-key-review="<?=$model->id;?>">
                                <td class="details-control"></td>
                                 <td><?=$model->name?></td>
                                 <td><?=$model->telephone?></td>
                                 <td><?=$model->postal_address?></td>
                                 <td><?=$model->town?></td>
                                   <td><?=date('Y-m-d',strtotime($model->created_at))?></td>
                                   


                                 </tr>


                                 <?php endforeach;?>
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


function format ( dataSource ) {
        
      var html="";


        $.each( dataSource, function( x, y ) {
            var key=y;

        var url='<?=url("/backend/propvider/get_my_modules/");?>/'+key;
            html += '<div class="row"><div class="col-md-12 table-responsive">'
             +'<table class="table table-bordered table-striped" cellpadding="5" cellspacing="0" border="0" style="margin-left:1%;">'
              +'<thead><tr class="warning">'
              +'<th>ID</th><th>Module</th>'
              +'<th>Amount</th>'
              +'<th>Date</th>'
              +'<th>Expiry Date</th>'
              +'<th>Status</th>'
              +'</tr></thead>'
              +'<tbody>';
    
        $.ajax({
          url:url,
          async:false,
          dataType:'json'
        }).done(function(data){
          var i=1;
          $.each( data, function( key, y ) {
                  var myurl="#";
                  
                  var url_to="<?=url('/customer/booking/cancel')?>/"+y.type+"/"+y.id;
                   var status=y.status;
                    if(status=="Pending"){
                        var action='<a class="customer-popup"title="Cancel This Booking"  data-href='+url_to+' data-title="Booking Details"><span class="btn btn-xs btn-primary customer-popup confirm-reverse" style="cursor:pointer" data-title="Booking Details">View Details</span></a> ';
                    }else{
                        var action='<a class="customer-popup"title="Cancel This Booking"  data-href='+url_to+' data-title="Booking Details"><span class="btn btn-xs btn-primary customer-popup confirm-reverse" style="cursor:pointer" data-title="Booking Details">View Details</span></a> ';
                    }
                   
                    html +='<tr><td>'+i+'<td><a href="'+myurl+'">'+y.module+'</a> </td>' 
                          +'<td>'+y.amount+'</td>' 
                          +'<td>'+y.date+'</td>' 
                           +'<td>'+y.edate+'</td>' 
                          +'<td>'+y.status+'</td>' 
                           
                         
                          +'</tr>';
                           
                          i++;



             
        });
        });

            
        });
   
return html += '</tbody></table></div></div>';  
    }


    var table = $('#Subscriptions-table').DataTable();

     // Add event listener for opening and closing details
      $('#Subscriptions-table').on('click', 'td.details-control', function (e) {

       e.preventDefault();
       
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format({
                  'key-review' : tr.data('key-review')
              })).show();
              tr.addClass('shown');
          }
          });

        
  
  </script>
@endpush