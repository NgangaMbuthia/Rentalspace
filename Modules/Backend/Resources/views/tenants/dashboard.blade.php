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
        <li><a href="<?=url('home')?>">Home</a></li>
        <li class="active">Dashboard</li>
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
<div>

<div class="row">
            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/create')?>">
              <div class="panel">
                <div class="bg-teal-800 demo-color">
                 <label style="margin-top: 19%;margin-left: 25%;width:180px;" ><span class="icon-googleplus5"> Create New</span></label>

                <span>Tenant Accounts</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/create')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>
             <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/listView')?>">
              <div class="panel">
                <div class="bg-info-800 demo-color">
                 <label style="margin-top: 19%;margin-left: 25%;width:180px;" >
                 <span class=" icon-users4">  Tenants</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/listView')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/payment/tenants/charges')?>">
              <div class="panel">
                <div class="bg-warning-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 25%;width:180px;" ><span class=" icon-graduation2"> Tenants Charges</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/payment/tenants/charges')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/emergency_contact')?>">
              <div class="panel">
                <div class="bg-indigo-800 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-phone"> Emergency Contacts</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/emergency_contact')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>


            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/occupants')?>">
              <div class="panel">
                <div class="bg-teal-600 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-people"> &nbsp;Occupants List</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/occupants')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/registered_items')?>">
              <div class="panel">
                <div class="bg-info-400 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-googleplus5"> Tenants Assets</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/registered_items')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/tenants/lease_expiry')?>">
              <div class="panel">
                <div class="bg-orange-400 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-googleplus5">Lease Expiries</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/tenants/lease_expiry')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>


            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/v-notice/index')?>">
              <div class="panel">
                <div class="bg-grey-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-googleplus5"> Vaccation Notices</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/v-notice/index')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/invoices/index')?>">
              <div class="panel">
                <div class="bg-success-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class=" icon-calculator"> Invoices</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/invoices/index')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

            <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/payment/history')?>">
              <div class="panel">
                <div class="bg-primary-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class=" icon-database">Tenant Payments</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/payment/history')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

             <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/invoices/index')?>">
              <div class="panel">
                <div class="bg-danger-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-file-pdf"> Reports</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/invoices/index')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>


             <div class="col-sm-4 col-lg-3">
            <a href="<?=url('/backend/invoices/index')?>">
              <div class="panel">
                <div class="bg-purple-300 demo-color">
                 <label style="margin-top: 19%;margin-left: 20%;width:180px;" ><span class="icon-statistics"> Analytics</span></label>

                <span>View Details</span></div>

                <div class="p-15">
                  

                  <div class="media-right">
                    <ul class="icons-list">
                      <li><a href="<?=url('/backend/invoices/index')?>" ><i class="icon-three-bars"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              </a>
            </div>

            

            

            

           
          </div>
          <!-- /palette colors -->
  

</div>

              @stop