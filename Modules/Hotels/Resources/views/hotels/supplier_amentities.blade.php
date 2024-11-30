  
  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/hotel/hotels/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Hotels</span></a>
                <a href="<?=url('/hotels/rooms/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Rooms</span></a>
                                <a href="<?=url('hotel/bookings/index');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Bookings</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/hotels/amentities/index')?>"></span>Available Amentities</a></li>
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
@include('hotels::hotels.s_header')

<div class="row">

@include('hotels::hotels.s_sub_header')

             
              
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Available Amentities</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="contact-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
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
             $("#contact-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("hotels/hotels/fetch_supplier_amentities")?>',
                        columns: [
                    {data: 'id', name: 'supplier_amentities.id'},
                    {data:'name',name:'supplier_amentities.name'},
                    {data:'category',name:'supplier_amentities.category'},
                    
                   {data: 'action', name: 'supplier_amentities.created_at',searchable:false},
                    
                ],
            });
           </script>
           @endpush
