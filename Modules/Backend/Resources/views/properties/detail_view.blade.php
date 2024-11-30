<?php 
use App\Helpers\Helper;
?>

@extends('layout.wizard')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>">Available Properties</a></li>
        
        <li class="active">View/<?=$model->id?></li>
  </ul>

@stop


@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li><a href="<?=url('/backend/space/listView')?>"></span>Space Management</a></li>
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
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')
@include('backend::properties.t_head')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i> Property Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                      <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">General Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Current Tenants</a></li>
                      <li><a href="#highlighted-justified-spaces" data-toggle="tab">Spaces Lists</a></li>
                         <li><a href="#highlighted-justified-tab6" data-toggle="tab">Property Gellery</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Details<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                        
                         <li><a href="#highlighted-justified-tab4" data-toggle="tab">Property Repairs</a></li>
                         
                          <li><a href="#highlighted-justified-amentities" data-toggle="tab">Property Amentities</a></li>
                         
                       

                          
                        </ul>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td>Property</td>
                          <td><?=$model->title?></td>
                        </tr>
                         <tr>
                          <td>Category</td>
                          <td><?=$model->category->name?></td>
                        </tr>
                        <tr>
                          <td>Type</td>
                          <td><?=$model->subcategory->name?></td>
                        </tr>

                        <tr>
                          <td>Location </td>
                          <td><?=$model->location?></td>
                        </tr>
                        <tr>
                          <td>Town</td>
                          <td><?=$model->town?></td>
                        </tr>
                        <tr>
                          <td>Agent Commission</td>
                          <td><?=$model->town?></td>
                        </tr>
                        <tr>
                          <td>Postal Address</td>
                          <td><?=$model->postal_address?></td>
                        </tr>
                        <tr>
                          <td>Managed By</td>
                          <td><?=$model->managed_by?></td>
                        </tr>
                        <tr>
                          <td>Manager Phone </td>
                          <td><?=$model->manager_phone?></td>
                        </tr>
                        <tr>
                          <td>Manager Email</td>
                          <td><?=$model->Manager_email?></td>
                        </tr>
                        <tr>
                          <td>Manager Postal Address</td>
                          <td><?=$model->manager_postal?></td>
                        </tr>
                        <tr>
                          <td>No of Units</td>
                          <td><?=$model->spaces->count();?></td>
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
                           
                           <a target="_blank" href="<?=url('/backend/property/tenants_list/'.$model->id)?>" class="btn btn-danger pull-right">Export To PDF</a>
                           <br>
                            <div class="clearfix"></div>
                        <div class="table-responsive" style="margin-top:2%;">
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Lease Start Date</th>
                        <th>Lease End Date</th>
                        <th>Status</th>
                        <th>Deposit</th>
                        <th>Monthly Dues</th>
                        
                        <th>Balance</th>
                        </tr>
                       
                        <tbody>
                        <?php $i=1;foreach($occupants as $occupant):?>
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$occupant->user->name?></td>
                        <td><?=$occupant->number?></td>
                        <td><?=$occupant->entry_date?></td>
                        <td><?=$occupant->expected_end_date?></td>
                        <td><?=$occupant->current_status?></td>
                        <td> <?=$occupant->getDeposit($occupant->space_id);?></td>
                        <td>
                         <a style="cursor:pointer;"  title="View Charge Breakdown" class="reject-modal"
                                data-title="Payment Break Down"   data-url="<?=url('/backend/tenants/charge_break/'.$occupant->space_id)?>">
                                <?=$occupant->getAmountPaid($occupant->user_id,$occupant->space_id);?>
                                  
                                </a>

                        </td>


                        <td><?=$occupant->getBalance($occupant->space_id);?></td>

                          



                        </tr>


                        <?php $i++;endforeach;?>
                          
                        </tbody>
                         </table>
                          

                        </div>
                      </div>

                       <div class="tab-pane" id="highlighted-justified-amentities">
                        <?php if(sizeof($model->amentities)):?>
                          <ol>
                            
                            <?php foreach($model->amentities as $amen):?>
                              <li><?=$amen->name;?></li>

                            <?php endforeach;?>
                          </ol>
                        <?php else:?>
                        <h4>This Property Does Not Have Any Amentities.</h4>
                          <?php endif;?>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-spaces">
                       <?php if(sizeof($model->spaces)):?>
                      <div class="table-responsive"> 
                      <table class="table table-bordered table-hover">
                      <thead>
                        <tr class="info">
                        <th>ID</th>
                        <th>Unit Number</th>
                        <th>Unit Name</th>
                        <th>Status</th>
                        <th>Total Tenants</th>
                        <th>Total Income</th>

                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;foreach($model->spaces as $space):?>
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$space->number?></td>
                        <td><?=$space->title?></td>
                        <td><?=$space->status?></td>


                         <td style="cursor:pointer;color:blue;"  title="View Tenants Details" class="reject-modal"
                                data-title="Tenency History"   data-url="<?=url('/backend/space/tenancy/'.$space->id)?>">


                        
                                <?=$space->tenants->count();?>
                                  
                                </td>
                         <td><?=$space->getAmount($space->id);?></td>
                          
                        </tr>
                        
                      <?php $i++; endforeach;?>
                      </tbody>
                        



                      </table>
                      </div>








                        <?php else:?>
                        <h4>This Property Does Not Have Any Amentities.</h4>
                          <?php endif;?>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab4">
                       <?php if(sizeof($model->repairs)>0):?>

                         <div class="clearfix"></div>

                        <div class="table-responsive" style="margin-top: 3%;"> 
                      <table class="table table-bordered table-hover" id="reapir">
                      <thead>
                        <tr class="info">
                        <th>#</th>
                        <th>Unit Number</th>
                        <th>Date</th>

                        <th>Responsible</th>
                        <th>Total Cost</th>
                        <th>Techinical Fee</th>
                        
                        <th>Repair Code</th>
                       </tr>
                      </thead>
                      <tbody>
                       <?php $i=1; foreach($model->repairs as $repair):?>
                       <tr>
                       <td><?=$i;?></td>
                          <td><?=$repair->space->number;?></td>
                       <td><?=$repair->repair_date;?></td>
                       <td><?=$repair->person_responsible;?></td>
                       <td
                       style="cursor:pointer;color:blue;"  title="View Repair Costings" class="reject-modal"
                                data-title="Repair Costings"   data-url="<?=url('/backend/space/repair/'.$repair->id)?>" 

                        ><?=$repair->total_cost;?></td>
                       <td
                         style="cursor:pointer;color:blue;"  title="View Technicians Fee" class="reject-modal"
                                data-title="Work Technician"   data-url="<?=url('/backend/space/repair_technician/'.$repair->id)?>"

                       ><?=$repair->technician_fee;?></td>
                     
                        <td><?=$repair->repair_code;?></td>
                         

                       </tr>



                        <?php $i++; endforeach;?>


                      </tbody>
                      </table>
                      </div>



                       <?php else:?>

                        <h4>No Repairs To Display</h4>

                       <?php endif;?>
                      </div>


                      <div class="tab-pane" id="highlighted-justified-tab6">
                       <?php if(sizeof($model->images)>0):?>

                         <div class="clearfix"></div>

                        <div class="table-responsive" style="margin-top: 3%;"> 
                        <?php foreach($model->images as $image):



  ?>

  <div class="col-lg-4 col-sm-6">
              <div class="thumbnail">
                <div class="thumb">
                  <img src="{{Helper::getFilePath($image->image_id)}}" alt="dhjdj" style="height:180px;">
                  <div class="caption-overflow">
                    <span>
                      <a href="{{Helper::getFilePath($image->image_id)}}" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                      <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                    </span>
                  </div>
                </div>
              </div>
            </div>

      <?php endforeach;?>
                      </div>



                       <?php else:?>

                        <h4>No Repairs To Display</h4>

                       <?php endif;?>
                      </div>
                      





                    </div>
                  </div>
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')

<script type="text/javascript">
    $('#reapir').DataTable();
</script>
@endpush
