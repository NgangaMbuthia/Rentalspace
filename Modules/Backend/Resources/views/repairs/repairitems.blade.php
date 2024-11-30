  
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
<style type="text/css">
       td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}

  </style>
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/repair/index')?>"></span>Repairs</a></li>
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
@include('backend::repairs.r_header')

<div class="row">

             
          <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Repair Items</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="history-table" class="table table-hover table-striped" style="width:100%;">
                    <thead>
                    <tr class="info">
                    <th>#</th>
                    <th>Property</th>
                 
                    
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Total Cost</th>
                    <th>Repair Code</th>
                   
                    
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach($models as $model):?>
                   <tr data-key-review="<?=$model->id;?>">
                   <td class="details-control"></td>
                    <td><?=$model->space->property->title;?></td>
                    <td><?=$model->space->number;?></td>
                    <td><?=$model->type;?></td>
                    <td><?=$model->total_cost;?></td>
                    <td><?=$model->repair_code;?></td>
                    <td><?=$model->repair_date;?></td>
                      



                    </tr>




                  <?php $i++;endforeach;?>
                     



                      </tbody>

                  </table>



                  </div>

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
            <script type="text/javascript">

    



     function format ( dataSource ) {
        
      var html="";


        $.each( dataSource, function( x, y ) {
            var key=y;

        var url='<?=url("/backend/repair/repair_items/");?>/'+key;
            html += '<div class="row"><div class="col-md-12 table-responsive"><table class="table table-hover table-striped" cellpadding="5" cellspacing="0" border="0" style="margin-left:1%;">'
           +'<thead><tr class="success">'
           +'<th>#</th><th>Date<th>Item</th>'
                            +'<th>Quantity</th>'
                             +'<th>Total Cost</th>'
                            +'<th>Supplier</th>'
                           
                             +'<th>Receit Number</th>'
                            
                             +'</tr></thead><tbody>';
    
        $.ajax({
          url:url,
          async:false,
          dataType:'json'
        }).done(function(data){
          var i=1;
          $.each( data, function( key, y ) {
                  var myurl="<?=url('tourist/profile/viewpackagebooking?id=')?>"+y.id;
                  
                  var url_to="<?=url('/customer/booking/cancel')?>/"+y.type+"/"+y.id;
                   var status=y.status;
                    if(status=="Pending"){
                        var action='<a class="customer-popup"title="Cancel This Booking"  data-href='+url_to+' data-title="Booking Details"><span class="btn btn-xs btn-primary customer-popup confirm-reverse" style="cursor:pointer" data-title="Booking Details">View Details</span></a> ';
                    }else{
                        var action='<a class="customer-popup"title="Cancel This Booking"  data-href='+url_to+' data-title="Booking Details"><span class="btn btn-xs btn-primary customer-popup confirm-reverse" style="cursor:pointer" data-title="Booking Details">View Details</span></a> ';
                    }
                   
                    html +='<tr><td>'+i+'<td><a href="'+myurl+'">'+y.suppliy_date+'</a> </td>' 
                          +'<td>'+y.item+'</td>' 
                          +'<td>'+y.weight+'</td>' 
                          +'<td>'+y.h_b+'</td>' 
                          +'<td>'+y.b_p+'</td>' 
                          +'<td>'+y.pallor+'</td>' 
                         
                          +'</tr>';
                           
                          i++;



             
        });
        });

            
        });
   
return html += '</tbody></table></div></div>';  
    }


    var table = $('#history-table').DataTable();

     // Add event listener for opening and closing details
      $('#history-table').on('click', 'td.details-control', function (e) {

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

