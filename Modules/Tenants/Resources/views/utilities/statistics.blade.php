
  @extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/tenants/utility-bills/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Utility Bills</span></a>
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
                 
                </ul>
              </li>
            </ul>
@stop

@section('content')

<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Utility Bill Management Center </h6>

                  


                </div>
                
              <div class="panel-body">




                  <div class="row">




                   
            
           
              <div class="table-responsive">

              <table id="charge-table" class="table table-hover table-striped table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
                <th>Month</th>
                 <?php foreach($months as $key):?>
                  <th><?=$key;?></th>
                 <?php endforeach;?>
             </tr>
            </thead>
            <tbody>
              <tr>
                <td>Water Bill</td>
                <?php foreach($months as $key):?>
                  <td><?=$model->getWaterAmount($key,$year);?></td>
                 <?php endforeach;?>
              </tr>

              <tr>
                <td>Power Bill</td>
                <?php foreach($months as $key):?>
                  <td><?=$model->getPowerAmount($key,$year);?></td>
                 <?php endforeach;?>
              </tr>

               
            
            



            </tbody>
            <tfoot>
              <tr>
                <td>Total</td>
                <?php foreach($months as $key):?>
                  <td><?=$model->getsumAmount($key,$year);?></td>
                 <?php endforeach;?>
              </tr>
              
            </tfoot>

            </table>



              </div>
               </div>

              </div>

              </div>

              @stop
  @push('scripts')
           <script>
             $("#charge-table").dataTable();
           </script>
           @endpush

