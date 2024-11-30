@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>">Provider List</a></li>
        <li><a href="<?=url('/backend/space/listView')?>">Spaces List</a></li>
        <li class="active">Add Space</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i> Space Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                      <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">Basic Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Occupants Lists</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Details<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#highlighted-justified-tab3" data-toggle="tab">Space Gallery</a></li>
                          <li><a href="#highlighted-justified-tab4" data-toggle="tab">Space Repairs</a></li>
                          <li><a href="#highlighted-justified-tab4" data-toggle="tab">Other Details</a></li>
                        </ul>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td>Space Number</td>
                          <td><?=$model->number?></td>
                        </tr>
                         <tr>
                          <td>Space Name</td>
                          <td><?=$model->title?></td>
                        </tr>
                        <tr>
                          <td>Currency</td>
                          <td><?=$model->currency?></td>
                        </tr>
                        <tr>
                          <td>Monthly Rate</td>
                          <td><?=$model->unit_price?></td>
                        </tr>
                        <tr>
                          <td>Status</td>
                          <td><?=$model->status?></td>
                        </tr>
                        <?php if(strlen($model->no_of_bedrooms)):?>
                         <tr>
                          <td>Number of BedRooms</td>
                          <td><?=$model->no_of_bedrooms?></td>
                        </tr>

                         <tr>
                          <td>Number of BathRooms</td>
                          <td><?=$model->no_of_bathrooms?></td>
                        </tr>

                      <?php endif;?>
                          
                          

                        </table>
                          
                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab2">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                          
                        </tr>
                          

                        </table>
                          

                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab3">
                        DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab4">
                        Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')

<script type="text/javascript">
   
</script>
@endpush
