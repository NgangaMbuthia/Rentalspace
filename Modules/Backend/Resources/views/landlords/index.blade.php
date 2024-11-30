  
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

  <style type="text/css">
  
  th, td { white-space: nowrap; }
</style>

             
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>List Of Landlords</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>Action</th>
                            <th>#</th>
                             <th>Full Name</th>
                            <th>Telephone</th>
                            <th>Email address</th>
                            <th>Postal Address</th>
                            <th>Status</th>
                            <th>Properties</th>
                          </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>
                <script id="details-template" type="text/x-handlebars-template">
                        <div class="label label-info">Propeerty List</div>
                        <table class="table details-table" id="posts-@{{id}}">
                            <thead>
                                <tr class="warning">
                                    <th>Property Name</th>
                                    <th>Property Type</th>
                                    <th>Location</th>
                                    <th>Rate</th>
                                    <th>Total Spaces</th>
                                    <th>Occupied </th>
                                    <th>Empty </th>
                                   
                                   

                                   

                                </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th colspan="3"></th>
                                   <th>Total</th>
                                    <th></th>
                                     <th></th>
                                     <th></th>
                              </tr>
                            </tfoot>
                        </table>
                       </script>

              </div>
              </div>

              @stop
               @push('scripts')
           <script>

                  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



             var template = Handlebars.compile($("#details-template").html());

            var  oTable= $("#property-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("backend/landlords/fetchList")?>',
                        columns: [
                    {data: 'action', name: 'action',searchable:false,orderable:false},
                    {
                "className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent": ''
            },
                    {data: 'name', name: 'name'},
                    {data:'telephone',name:'telephone'},
                     {data:'email',name:'email'},
                    {data:'postal_address',name:'postal_address'},
                    {data:'status',name:'status'},
                    {data: 'number', name: 'number'},
                     ],
            });


       $('#property-table tbody').on('click', 'td.details-control', function () {
          
      
        var tr = $(this).closest('tr');

        var row = oTable.row(tr);

        var tableId = 'posts-' + row.data().id;
     


        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

    function initTable(tableId, data) {
           
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
            {data: 'title', name: 'title'},
            {data: 'type', name: 'type'},
            {data: 'location', name: 'location'},
            {data: 'agent_fee', name: 'agent_fee'},
            {data: 'total_spaces', name: 'total_spaces'},
            {data: 'occupied_spaces', name: 'occupied_spaces'},
            {data: 'free_spaces', name: 'free_spaces'},
            
            ],
            dom: 'Bfrtip',
        buttons: [
            
            'excelHtml5',
            'csvHtml5',
            {extend: 'pdf', title: 'Properties',
            
            orientation: 'landscape',
              footer: true,


          },
            {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }}
        ],

           "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 totalsale = api
                .column( 5)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


                totalBails = api
                .column( 6)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                  
 
 
 


               
 
            // Update footer
            
             $( api.column( 4).footer() ).html(numberWithCommas(total));
             $( api.column( 5).footer() ).html(numberWithCommas(totalsale));
             $( api.column( 6).footer() ).html(numberWithCommas(totalBails));
             
        }
      


        })
    }




           </script>
           @endpush

