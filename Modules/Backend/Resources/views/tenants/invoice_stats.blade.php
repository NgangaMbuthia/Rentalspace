@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
     <li><a href="<?=url('/backend/property/index')?>">Invoice Management</a></li>
    <li class="active">Statistics</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Invoice Status Statistics</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr class="info">
                           <th>#</th>
                           <th>Status</th>
                           <th>No of Invoices</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <td>1</td>
                            <td>Pending</td>
                            <td><?=$model->getStats($provider_id,"Pending");?></td>
                            </tr>

                            <tr>
                            <td>2</td>
                            <td>Paid</td>
                            <td><?=$model->getStats($provider_id,"Paid");?></td>
                            </tr>


                            <tr>
                            <td>3</td>
                            <td>Over Due</td>
                            <td><?=$model->getStats($provider_id,"Overdue");?></td>
                            </tr>

                             <tr>
                            <td>4</td>
                            <td>Cancelled</td>
                            <td><?=$model->getStats($provider_id,"Cancelled");?></td>
                            </tr>

                             <tr>
                            <td>5</td>
                            <td>On Hold</td>
                            <td><?=$model->getStats($provider_id,"On Hold");?></td>
                            </tr>

                            <tr>
                            <td>#</td>
                            <td>Total</td>
                            <td><?=$model->getStats($provider_id,false);?></td>
                            </tr>
                                
                            </tbody>
                            

                                

                            </table>
                                

                            </div>
                  
                    
                           </div>
            </div>
            <div class="clearfix"></div>

@endsection

@push('scripts')


@endpush
