<div class="container-detached">
            <div class="content-detached">

              <!-- Invoice grid options -->
              <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                  <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-filter">
                  
                  <ul class="nav navbar-nav">


                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Properties <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/property/add')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>

                        <li><a href="<?=url('/backend/property/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Properties list</a></li>

                        <li><a href="<?=url('/backend/property/managers/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Properties Managers</a></li>
                        <li><a href="<?=url('/backend/properties/transaction')?>"><span class="icon-list"></span> &nbsp;&nbsp;Property Transactions</a></li>


                        <li> <a href="<?=url('/backend/space/add')?>"><span class="icon-list"></span> Create New Space</a></li>
                        <li><a href="<?=url('/backend/space/listView')?>"><span class="icon-list"></span>  All Spaces/Units</a></li>
                        <li><a href="<?=url('/backend/space/listView?status=Occupied')?>"><span class="icon-list"></span> Occupied Spaces/Units</a></li>
                        <li><a href="<?=url('/backend/space/listView?status=Free')?>"><span class="icon-list"></span>  Free Spaces/Units</a></li>
                         <li><a href="<?=url('/backend/space/listView?status=OnNotice')?>">
                         <span class="icon-list"></span> On Notice Spaces/Units</a></li>

                          <li><a href="<?=url('/backend/templates/index')?>">
                         <span class="icon-list"></span>Spaces Templates</a></li>
                        
             
                       
                       
                      </ul>
                    </li>

                     
                   

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Tenants <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                        <li><a href="<?=url('/backend/tenants/create')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>
                         <?php endif;?>

                        <li><a href="<?=url('/backend/tenants/listView')?>"><span class="icon-list"></span> &nbsp;&nbsp;Tenant List</a></li>
                        
                        <li><a href="<?=url('/backend/tenants/emergency_contact')?>">
           <span class=" icon-alert"></span> &nbsp;&nbsp;
                        Emergency Contacts</a></li>
                         <li><a href="<?=url('/backend/v-notice/index')?>">
                  <span class="icon-file-pdf"></span> &nbsp;&nbsp;

                         

                         Vacation Notices</a></li>

                           <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                         
                       
                       <li class="divider"></li>
                        <li><a href="<?=url('/backend/tenant/dashboard')?>">
                       <span class="icon-switch2"></span> &nbsp;&nbsp;
                        Dashboard</a></li>
                           <?php endif;?>
                       
                       
                      </ul>
                    </li>
                <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                         
                   

                   
                     <li class="dropdown hidden" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Tenants Assets<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/tenants/registered_items')?>">View List</a></li>
                        <li class="divider"></li>
                        
                        <li><a href="<?=url('/backend/tenants/registered_items')?>">Edit List</a></li>
                        
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>invoices  <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a data-url="{{url('/backend/payment/CreateNewInvoice')}}"  class="reject-modal" data-title="Create Invoice" href="#">create Invoice</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=url('/backend/invoices/index?status=Pending')?>">Pending Invoices</a></li>
                        <li><a href="<?=url('/backend/invoices/index?status=Paid')?>">Paid Invoices</a></li>
                        <li><a href="<?=url('/backend/invoices/index?status=Cancelled')?>">Cancelled Invoices</a></li>
                        <li><a href="<?=url('/backend/invoices/index?status=Overdue')?>">Overdue Invoices</a></li>
                        
                        <li><a href="<?=url('/backend/invoices/index')?>">View Invoices</a></li>
                        
                       
                      </ul>
                    </li>
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cash3"></i>Tenant Payments<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       
                        <li><a href="{{url('/backend/make/bulkpayment')}}">Bulk Payment</a></li>
                        <li class="divider"></li>
                         <li><a href="{{url('/backend/make/payments')}}">Single Payment</a></li>
                        <li class="divider"></li>
                         <li><a href="{{url('/backend/submitted/payments')}}">Submit Payment</a></li>
                        <li><a href="{{url('/backend/payment/history')}}">Payment List</a></li>
                          <li><a href="{{url('/backend/payment/Periodics')}}">Periodic  Report</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/backend/payment/tenants/summary')}}">Monthly Summary</a></li>
                        <li><a href="{{url('/backend/payment/tenants/summary')}}">Monthly Payment Breakdown</a></li>
                       
                      </ul>
                    </li>
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cash3"></i>Landload Payments<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a class="reject-modal" data-url="{{url('/backend/Landload/CreatePayment')}}" data-title="Pay Loadload">Pay Landload</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/backend/Landload/Payments')}}">Payment History</a></li>
                        
                        <li><a href="{{url('/backend/Landload/Statement')}}">Statement</a></li>
                       
                      </ul>
                    </li>

                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-pdf"></i>Reports<span class="caret"></span></a>
                      <ul class="dropdown-menu">

                         <li><a href="<?=url('/backend/property/spaces/statistics')?>">Space/Unit Statistics</a></li>
                        <li><a href="<?=url('/backend/property/statistics/'.date('Y'))?>">Property Payments</a></li>
                        <li><a href="<?=url('/backend/property/repairs/statistics/'.date('Y'))?>">Property Repairs</a></li>


                         <li><a href="<?=url('/backend/reports/properties/xls')?>">Properties Reports</a></li>
                        <li><a href="<?=url('/backend/reports/spaces/export/pdf_reports')?>" target="_new">Spaces Pdf Reports</a></li>
                      <li><a href="<?=url('/backend/reports/spaces/export/xls')?>">Spaces Excel Reports</a></li>
                      <li><a href="<?=url('/backend/reports/plots/export/xls')?>">Plots Reports</a></li>
                      <li><a href="<?=url('/backend/reports/plots/export/xls')?>">Properties Space Statistics</a></li>



                      
                       
                      </ul>
                    </li>
                  <?php endif;?>
                    
                     
                  </ul>

                  <div class="navbar-right">
                    
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#"><i class="icon-sort-alpha-asc position-left"></i> </a></li>
                      

                    </ul>
                  </div>

                </div>

                
              </div>
              <!-- /invoice grid options -->

  </div>