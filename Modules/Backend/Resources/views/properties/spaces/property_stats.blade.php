@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>">Provider List</a></li>
        <li><a href="<?=url('/backend/space/listView')?>">Spaces List</a></li>
        <li class="active">Property Statistics</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Property Statistics</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr class="info">
                           <th>#</th>
                           <th>Category</th>
                           <th>No of Properties</th>
                            </tr>
                            </thead>
                            <?php $i=1; foreach($categories as $catogory):?>
                            <tr>
                            <td><?=$i;?></td>
                            <td><?=$catogory->name?></td>
                            <td><?=$catogory->property->count();?></td>
                                

                            </tr>


                            <?php $i++; endforeach;?>

                                

                            </table>
                                

                            </div>
                  
                    
                           </div>
            </div>
            <div class="clearfix"></div>


            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-statistics position-left"></i>Property Statistics</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr class="info">
                           <th>#</th>
                           <th>Nature</th>
                           <th>No of Properties</th>
                            </tr>
                            </thead>
                            <?php $i=1; foreach($subcateories as $catogory):?>
                            <tr>
                            <td><?=$i;?></td>
                            <td><?=$catogory->name?></td>
                            <td><?=$catogory->property->count();?></td>
                                

                            </tr>


                            <?php $i++; endforeach;?>

                                

                            </table>
                                

                            </div>
                  
                    
                           </div>
            </div>




@endsection

@push('scripts')


@endpush
