  
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
 <div class="col-md-12">
     <div class="col-md-12">
             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Booking Requests For Properties</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                    

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                           <th>Property</th>
                            <th>Unit</th>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>EntryDate</th>
                            <th>Status</th>
                            <th>DateBooked</th>
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
              </div>

              @stop
               @push('scripts')
           <script>
             $("#property-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("backend/properties/fetch_bookings")?>',
                        columns: [
                   {data: 'title', name: 'properties.title'},
                    {data: 'number', name: 'spaces.number'},
                    {data:'name',name:'bookings.name'},
                    {data:'phone',name:'bookings.phone'},
                    //{data: 'email', name: 'bookings.email'},
                    {data:'expected_entry',name:'bookings.expected_entry'},
                    {data: 'booking_status', name: 'bookings.booking_status'},
                    {data: 'created_at', name: 'bookings.created_at'},
                    {data: 'action', name: 'bookings.updated_at'},
                    
                   
                    
                ],
            });
           </script>
           @endpush

