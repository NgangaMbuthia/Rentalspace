  
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
        
        <li class="active">Units</li>
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
                  <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')

@include('gate::gates.g_head')

<div class="row">
          <div class="col-md-12">
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Visitor Statistics For <?=date('Y');?></h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">
                  <div class="col-md-2 form-group pull-right">
                  <label>Year</label>
                  <select class="form-control">
                    <option>2017</option>
                  </select>
                    

                  </div>
                  
                  

                    <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            
                            <th>Property</th>
                            <?php foreach($months as $key=>$value):?>
                            <th><?=$key;?></th>
                          <?php endforeach;?>
                          <th>Total</th>
                            
                            
                            </tr>
                      </thead>
                      <tbody>
                      <?php foreach($properties as $property):?>
                        <tr>
                        <td><?=$property->title;?></td>

                        <?php foreach($months as $key=>$value):?>
                            <td><?=$model->statistics($property->id,$year,$value);;?></td>
                            
                          <?php endforeach;?>
                          <td><?=$model->statistics($property->id,$year,false);;?></td>




                        </tr>



                      <?php endforeach;?>
                     



                      </tbody>
                       <tfoot>
                       <tr>
                       <th><b>Total</b></th>
                       <?php foreach($months as $key=>$value):?>
                            <th><?=$model->statistics(false,$year,$value);;?></td>
                            
                          <?php endforeach;?>
                          <th> <?=$model->statistics(false,$year,false);;?></th>
                         
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
             
           </script>
           @endpush

