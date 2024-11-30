@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb pull-left">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/tenants/listView')?>">Tenants List</a></li>
        
        <li class="active">Detailed View/<?=$model->id?></li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Tenants Details</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                      <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">Basic Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Tenancy Details</a></li>
                      <li><a href="#highlighted-justified-e-contact" data-toggle="tab">Emergency Contact</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Details<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#highlighted-justified-tab-payments" data-toggle="tab">Payments Details</a></li>
                          <li><a href="#highlighted-justified-tab-occupants" data-toggle="tab">Occupants List</a></li>
                           <li><a href="#highlighted-justified-tab-registered-item" data-toggle="tab">Registered Items</a></li>

                           <?php if($model->type=="Student"):?>
                          <li><a href="#highlighted-justified-tab-student" data-toggle="tab">College/University Details</a></li>
                        <?php elseif($model->type=="Employed"):?>

                          <li><a href="#highlighted-justified-tab-employer" data-toggle="tab">Employer Details</a></li>



                        <?php endif;?>
                        </ul>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td>Full Name</td>
                          <td><?=$model->user->name?></td>
                        </tr>
                         <tr>
                          <td>Email Address</td>
                          <td><?=$model->user->email?></td>
                        </tr>
                        <tr>
                          <td>Telephone</td>
                          <td><?=$model->user->profile->telephone?></td>
                        </tr>
                        <tr>
                          <td>ID Number</td>
                          <td><?=$model->user->profile->id_number?></td>
                        </tr>
                        <tr>
                          <td>Profile Status</td>
                          <td><?=$model->user->profile->status?></td>
                        </tr>

                         <tr>
                          <td>Postal Address</td>
                          <td><?=$model->user->profile->postal_address?></td>
                        </tr>
                        <tr>
                          <td>City</td>
                          <td><?=$model->user->profile->city?></td>
                        </tr>

                        <tr>
                          <td>Nationality</td>
                          <td><?=$model->user->profile->country?></td>
                        </tr>

                        <tr>
                          <td>Gender</td>
                          <td><?=$model->user->profile->gender?></td>
                        </tr>

                        <tr>
                          <td>Economical Activity</td>
                          <td><?=$model->type?></td>
                        </tr>

                        

                        
                        
                          
                          

                        </table>
                          
                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab2">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <tr>
                        <td>Property Name:</td>
                        <td><?=$model->space->property->title?></td>
                         </tr>

                         <tr>
                        <td>Property Category:</td>
                        <td><?=$model->space->property->category->name?></td>
                         </tr>


                         <tr>
                        <td>Property Type:</td>
                        <td><?=$model->space->property->subcategory->name?></td>
                         </tr>

                         <tr>
                        <td>Space Number:</td>
                        <td><?=$model->space->number?></td>
                         </tr>


                         <tr>
                        <td>Space Name:</td>
                        <td><?=$model->space->title?></td>
                         </tr>
                          
                         <tr>
                        

                         <tr>
                        <td>Has Smokers:</td>
                        <td><?=$model->has_smokers?> </td>
                         </tr>

                         <tr>
                        <td>Lease Start Date:</td>
                        <td><?=$model->entry_date?> </td>
                         </tr>
                         <tr>
                        <td>Lease End Date:</td>
                        <td><?=$model->expected_end_date?> </td>
                         </tr>
                         <?php foreach($model->charges as $charge):?>
                          <tr>
                        <td><?=ucwords($charge->charge_name)?></td>
                        <td><?=$charge->amount?> </td>
                         </tr>


                         <?php endforeach;?>


                         
                         

                        </table>
                          

                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-e-contact">
                        <div class="table-responsive">
                        <h4>Emergency Contact</h4>
                        <table class="table table-bordered table-hover">

                        <tr>
                        <td>Contact Name:</td>
                        <td><?=$contact->name?></td>
                         </tr>

                         <tr>
                        <td>Contact Email:</td>
                        <td><?=$contact->email?></td>
                         </tr>


                         <tr>
                        <td>Contact Telephone:</td>
                        <td><?=$contact->phone?></td>
                         </tr>

                         <tr>
                        <td>Contact Postal Address:</td>
                        <td><?=$contact->postal_address?></td>
                         </tr>

                         <tr>
                        <td>Contact Postal Code:</td>
                        <td><?=$contact->postal_code?></td>
                         </tr>

                         <tr>
                        <td>Relationship:</td>
                        <td><?=$contact->relationship?></td>
                         </tr>





                        </table>
                        </div>
                        </div>





                         <div class="tab-pane" id="highlighted-justified-tab-occupants">
                        <div class="table-responsive">
                        <h4>Other Occupants</h4>
                       
                        <button data-title="Add New Space Occupants"   data-url="<?=url('/backend/tenant/add_occupants/'.$model->id)?>"   class="btn btn-primary reject-modal">Add Occupant <i class="icon-user position-right"></i></button>


                         
                        <p>
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>#</th>
                        <th>Name</th>
                        <th>Identification</th>
                        <th>Number</th>
                        <th>Age</th>
                        <th>Action</th>
                          
                        </tr>

                        <?php $i=1; foreach($occupants as $key):?>
                          <tr>
                          <td><?=$i?></td>
                          <td><?=$key->name;?></td>
                          <td><?=$key->identification;?></td>
                          <td><?=$key->number;?></td>
                          <td><?=$key->age;?></td>
                          <td>
                          <a style="cursor:pointer;"  title="Update This Record" class="reject-modal"
                                data-title="Edit Occupant Details"   data-url="<?=url('/backend/tenants/edit_occupant/'.$key->id)?>"

                           ><span class="glyphicon glyphicon-pencil"></span></a>
                           <a data-href="<?=url('/backend/occupant/delete/'.$key->id)?>" class="delete-record" style="margin-left:10%;" data-redirect-to="<?=url('/backend/tenant/view/'.$model->id)?>" data-name="Occupant" ><span class="icon-trash"></span></a>
                            
                          </td>
                          

                            

                          </tr>


                        <?php $i++; endforeach;?>


                        </table>



          <!-- /iconified modal -->
                        </div>
                        </div>



                        <div class="tab-pane" id="highlighted-justified-tab-registered-item">
                        <div class="table-responsive">
                        <h4>Registered Items</h4>
                        <button data-title="Add New Item"   data-url="<?=url('/backend/tenant/add_item/'.$model->id)?>"   class="btn btn-primary reject-modal">Add Item <i class="icon-video-camera position-right"></i></button>

                        <p>
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>#</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Number</th>
                        
                        <th>Action</th>
                          
                        </tr>

                        <?php $i=1; foreach($items as $item):?>
                          <tr>
                          <td><?=$i?></td>
                          <td><?=$item->type;?></td>
                          <td><?=$item->name;?></td>
                          <td><?=$item->number;?></td>
                          
                          <td>
                           <a style="cursor:pointer;"  title="Update This Item" class="reject-modal"
                                data-title="Edit Item Details"   data-url="<?=url('/backend/tenants/edit_item/'.$item->id)?>">
                                <span class="glyphicon glyphicon-pencil"></span></a>
                            <a data-href="<?=url('/backend/item/delete/'.$item->id)?>" class="delete-record" style="margin-left:10%;" data-redirect-to="<?=url('/backend/tenant/view/'.$model->id)?>" data-name="Item" ><span class="icon-trash"></span></a>
                            
                          </td>
                          

                            

                          </tr>


                        <?php $i++; endforeach;?>


                        </table>
                        </div>
                        </div>
                         <?php if($model->type=="Student"):?>
                         <div class="tab-pane" id="highlighted-justified-tab-student">
                        <div class="table-responsive">
                        <h4>University/College Details</h4>


                        <table class="table table-bordered table-hover">

                        <tr>
                        <td>Institution Name:</td>
                        <td><?=$model->student->institution_name?></td>
                         </tr>

                         <tr>
                        <td>Course Title:</td>
                        <td><?=$model->student->course_title?></td>
                         </tr>


                         <tr>
                        <td>Admission Number:</td>
                        <td><?=$model->student->reg_number?></td>
                         </tr>

                         <tr>
                        <td>Year of Study:</td>
                        <td><?=$model->student->year_of_study?></td>
                         </tr>

                         <tr>
                        <td>Course Duration:</td>
                        <td><?=$model->student->course_duration?></td>
                         </tr>
                         </table>
                         </div>
                        </div>

                      <?php endif;?>


                      <?php if($model->type=="Employed"):?>
                         <div class="tab-pane" id="highlighted-justified-tab-employer">
                        <div class="table-responsive">
                        <h4>Employer Details</h4>


                        <table class="table table-bordered table-hover">

                        <tr>
                        <td>Employer Name:</td>
                        <td><?=$model->employer->employer_name?></td>
                         </tr>

                         <tr>
                        <td>Job  Title:</td>
                        <td><?=$model->employer->job_title?></td>
                         </tr>


                         <tr>
                        <td>Contact Name:</td>
                        <td><?=$model->employer->contact_name?></td>
                         </tr>

                         <tr>
                        <td>Contact telephone:</td>
                        <td><?=$model->employer->contact_phone?></td>
                         </tr>

                         
                         </table>
                         </div>
                        </div>

                      <?php endif;?>






                      <div class="tab-pane" id="highlighted-justified-tab-payments">
                       <div class="table-responsive">
                        <h4>Payment History</h4>
                       
                        <table class="table table-bordered table-hover">
                        <tr class="info">
                        <th>#</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Reference No</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Payment Mode</th>
                        
                        
                        
                          
                        </tr>

                        <?php $i=1; foreach($payments as $payment):?>
                          <tr>
                          <td><?=$i?></td>
                          <td><?=$payment->transaction_date;?></td>
                          <td><?=$payment->type;?></td>
                          <td><?=$payment->reference_number;?></td>
                          <td><?=$payment->credit;?></td>
                          <td><?=$payment->debit;?></td>
                          <td><?=$payment->payment_mode;?></td>
                         
                          

                            

                          </tr>


                        <?php $i++; endforeach;?>


                        </table>
                        </div>
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
