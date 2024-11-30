
  @extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/utility-bills/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Utility Bills</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url()->current();?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url()->current();?>"></span>Utilities</a></li>
       
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
@include('backend::utilities.p_head')
<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Properties Utility Bill Management Center </h6>

                  


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="charge-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>Action</th>
              <th>Unit</th>
              <th>Tenant</th>
              <th>ReadingDate</th>
              <th>W-Reading</th>
              <th>W-Used</th>
              <th>W-Amount</th>
              <th>P-Reading</th>
              <th>P-Used</th>
              <th>P-Amount</th>
          
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
             $("#charge-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("backend/utility-bills/fetch_bills")?>',
                      columns: [

                  {data: 'action', name: 'utility_bills.created_at'},
                  {data: 'number', name: 'spaces.number'},
                  {data: 'name', name: 'users.name'},
                 {data:'reading_date',name:'utility_bills.reading_date'},
                 //{data:'old_w_reading',name:'utility_bills.old_w_reading'},
                  {data:'current_w_reading',name:'utility_bills.current_w_reading'},
                  {data:'water_used_units',name:'utility_bills.water_used_units'},
                  {data:'w_payment_amount',name:'utility_bills.w_payment_amount'},
                    {data:'current_e_reading',name:'utility_bills.current_e_reading'},
                  {data:'electricity_used_units',name:'utility_bills.electricity_used_units'},
                  {data:'e_payment_amount',name:'utility_bills.e_payment_amount'},
                
              ],
             });
           </script>
           @endpush

