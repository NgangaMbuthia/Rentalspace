  
  @extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Supplies</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Quatation</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Supplier Module</a></li>
        <li><a href="<?=url('/backend/v-notice/index')?>"></span>Supplier list</a></li>
        <li class="active">Create</li>
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
@include('supplier::suppliers.s_head')
<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Registed Suppliers List</h6>

                  


                </div>
                
              <div class="panel-body">
               <div class="row">
                
               <div class="btn-group">
              <a type="button" class="btn btn-info" target="_blank" href="<?=url('/supplier/supplier/add_new')?>">Add New Supplier</a>
              <a type="button" class="btn btn-success"  href="<?=url('/supplier/supplier/update/'.$model->id)?>"  >Update Details</a>
              <a href="<?=url('/supplier/supplier/index')?>" type="button" class="btn btn-danger">View Supplier List</a>
             
                
              </div>

                 
              </div>
              <div class="row">
              <p>
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">Identification Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Address Details</a></li>
                       <li><a href="#highlighted-justified-tab4" data-toggle="tab">Contact Details</a></li>
                        <li><a href="#highlighted-justified-tab3" data-toggle="tab">Bank Details</a></li>
                         <li><a href="#highlighted-justified-tab5" data-toggle="tab">Director Details</a></li>

                     
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                        <tr>
                          <td>Legal Name</td>
                          <td><?=$model->legal_name?></td>
                        </tr>
                         <tr>
                          <td>Other Names</td>
                          <td><?=$model->trading_name?></td>
                        </tr>
                        <tr>
                          <td>Country of Orgin</td>
                          <td><?=$model->country_of_origin?></td>
                        </tr>
                        <tr>
                          <td>Service Type</td>
                          <td><?=$model->service_type?></td>
                        </tr>
                        <tr>
                          <td>V.A.T Number</td>
                          <td><?=$model->vat?></td>
                        </tr>
                        <tr>
                          <td>Core Commodity</td>
                          <td><?=$model->core_commodity?></td>
                        </tr>
                        <tr>
                          <td>Supplier Category</td>
                          <td><?=$model->supplier_type?></td>
                        </tr>
                        
                        
                          
                          

                        </table>
                          
                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab2">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <tr>
                        
                        <th>Physical Address</th>
                        <th><?=$model->address_line;?></th>
                        </tr>
                        <tr>
                        <td>Telephone</td>
                        <td><?=$model->telephone;?></td>
                        </tr>


                        <tr>
                        <td>Alt Telephone</td>
                        <td><?=$model->alt_phone;?></td>
                        </tr>

                        <tr>
                        <td>Email</td>
                        <td><?=$model->email;?></td>
                        </tr>

                         <tr>
                        <td>Website</td>
                        <td><?=$model->website;?></td>
                        </tr>
                        <tr>
                        <td>City</td>
                        <td><?=$model->city;?></td>
                        </tr>

                        <tr>
                        <td>location</td>
                        <td><?=$model->location;?></td>
                        </tr>
                        <tr>
                        <td>Street</td>
                        <td><?=$model->street;?></td>
                        </tr>

                        <tr>
                        <td>Bulding</td>
                        <td><?=$model->bulding;?></td>
                        </tr>
                          

                        </table>
                          

                        </div>
                      </div>

                        <div class="tab-pane" id="highlighted-justified-tab4">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <tr>
                        <td>Contact Name</td>
                        <td><?=$model->contact_name;?></td>
                        </tr>


                        <tr>
                        <td>Position</td>
                        <td><?=$model->contact_position;?></td>
                        </tr>

                        <tr>
                        <td>Contact Telephone</td>
                        <td><?=$model->contact_phone?></td>
                        </tr>

                         <tr>
                        <td>Contact Postal Address</td>
                        <td><?=$model->contact_postal_address;?></td>
                        </tr>

                        <tr>
                        <td>Contact Email Address</td>
                        <td><?=$model->contact_email;?></td>
                        </tr>
                        
                          

                        </table>
                        </div>
                      </div>


                      <div class="tab-pane" id="highlighted-justified-tab3">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <tr>
                        <td>Bank Name</td>
                        <td><?=$model->bank_name;?></td>
                        </tr>


                        <tr>
                        <td>Branch</td>
                        <td><?=$model->branch;?></td>
                        </tr>

                        <tr>
                        <td>Account Name</td>
                        <td><?=$model->account_name?></td>
                        </tr>

                         <tr>
                        <td>Account Number</td>
                        <td><?=$model->account_number;?></td>
                        </tr>
                        
                          

                        </table>
                        </div>
                      </div>

                      <div class="tab-pane" id="highlighted-justified-tab5">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                        <thead>
                          <tr class="info">
                          <th>#</th>
                          <th>Name</th>
                          <th>Identification</th>
                          <th>Number</th>
                          <th>Country of Origin</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php  $i=1;foreach($directors as $dir):?>
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$dir->name;?></td>
                        <td><?=$dir->identification;?></td>
                        <td><?=$dir->identifaction_number;?></td>
                        <td><?=$dir->country;?></td>
                          

                        </tr>


                        <?php $i++; endforeach;?>
                          
                        </tbody>
                        


                       
                        
                          

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

              @stop

               


