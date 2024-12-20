
  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/hotels/admin/hotels')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Hotels</span></a>
                <a href="<?=url('/hotels/supplier/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>SUppliers</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Tour Operators</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/hotels/hotel/types')?>"></span>Hotel Types</a></li>
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
@include('hotels::hotels.h_header')

<div class="row">

@include('hotels::hotels.sub_header')
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Hotels Under Your Account</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="contact-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Supplier</th>
                            <th>Room Name</th>
                            <th>Capacity</th>
                            <th>Bed Type</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Occupants</th>
                            
                           
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
             $("#contact-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("hotels/hotels/fetch_admin_rooms")?>',
                        columns: [
                    {data:'id',name:'hotel_rooms.id'},
                    {data:'name',name:'service_suppliers.name'},
                     {data:'room_name',name:'hotel_rooms.room_name'},
                    {data:'room_capacity',name:'hotel_rooms.room_capacity'},
                    {data:'bed_type',name:'hotel_rooms.bed_type'},
                    {data:'currency',name:'hotel_rooms.currency'},
                    {data:'local_price_off_peak_night',name:'hotel_rooms.local_price_off_peak_night'},
                    {data:'occupants',name:'hotel_rooms.occupants'},
                    
                    
                    
                   
                    
                ],
            });
           </script>
           @endpush

