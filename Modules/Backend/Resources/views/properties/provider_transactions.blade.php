  
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

             
             
              
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Provider/Agent Transactions</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                              <th>#</th>
                            <th>AccType</th> 
                            <th>AccName</th>
                            <th>TranDate</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Ref No</th>
                            <th>RecordDate</th>
                           
                            
                           
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
             $("#property-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("backend/provider/fetch_provider_transaction/".$type)?>',
                        columns: [
                    {data: 'id', name: 'provider_accounts.id'},
                    {data: 'account_type', name: 'provider_accounts.account_type'},
                    {data: 'account_name', name: 'provider_accounts.account_name'},
                    {data:'tran_date',name:'provider_transactions.tran_date'},
                    {data:'amount',name:'provider_transactions.amount'},
                    {data:'balance',name:'provider_transactions.balance'},
                    {data:'ref_no',name:'provider_transactions.ref_no'},
                    {data:'created_at',name:'provider_transactions.created_at'},
                  
                    
                ],
                dom: '<"html5buttons"B>lTfgitp',

        buttons: [
                  'selectAll',
                              'selectColumns',
                                'selectNone',
            { extend: 'copy'},

                    {extend: 'csv'},
                     {extend: 'excel', title: 'Provider Transaction List'},
                    {extend: 'pdf', title: 'Provider Transaction List', orientation: 'landscape',pageSize: 'A4',messageBottom: 'Designed and Developed By Isanyad',

                  },
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    },
                       {extend: 'colvis',text: "Set Visible",class:"btn btn-primary"},
                   /* {
                extend: 'print',
                text: 'Print all (not just selected)',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            },*/

                  
        ],
           select: true,

             columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],
           colReorder: true
            });
           </script>
           @endpush

