<?php

use App\Helpers\Helper;
?>

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-fixed">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                

                                <?php if(isset(auth::user()->avatar)):?>
                        <img src="<?=Helper::getFileUrl();?>" alt="" class="img-circle img-sm">
                     <?php else:?>

                     <img src="{{asset('/assets/images/k.png')}}" alt="" class="img-circle img-sm">

                     <?php endif;?></a>
                                <div class="media-body">
                                <?php if(Entrust::hasRole("Provider")):?>
                                    <span class="media-heading text-semibold"><?=Auth::User()->getprovider->name;?></span>
                                <?php else:?>
                                  <span class="media-heading text-semibold"><?=Auth::User()->name;?></span>

                                <?php endif;?>


                                    
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a href="#"><i class="icon-cog3"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">

                                <!-- Main -->
                                <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                <li><a href="<?=url('home')?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                                <?php if(Entrust::hasRole("Renter")):?>
                                <li>
                                    <a href="#"><i class="icon-users4"></i> <span>Spaces Management</span></a>
                                    <ul>
                                        <li><a href="<?=url('/tenants/list/spaces?status=Active')?>">Current Spaces</a></li>
                                        <li><a href="<?=url('/tenants/list/spaces?status=InActive')?>">Previous Spaces</a></li>
                                         
                                          
                                       
                                    </ul>
                                </li>

                                <li>
                                    <a href="#"><i class="icon-calculator"></i> <span>Invoices Management</span></a>
                                    <ul>
                                        <li><a href="<?=url('/tenants/invoices/index?status=Pending')?>">Pending Invoices</a></li>
                                         <li><a href="<?=url('/tenants/invoices/index?status=Paid')?>">Paid Invoices</a></li>
                                        
                                         <li><a href="<?=url('/tenants/invoices/index?status=Cancelled')?>">Cancelled Invoices</a></li>
                                        
                                         <li><a href="<?=url('/tenants/invoices/index?status=Overdue')?>">Over Due Invoices</a></li>

                                         <li><a href="<?=url('/tenants/invoices/index')?>">Archieved Invoices</a></li>
                                        
                                        
                                        </ul>
                                </li>


                                   <li>
                                    <a href="#"><i class="icon-cash3"></i> <span>Manage Payments</span></a>
                                    <ul>
                                       
                                       
                                        <li><a href="<?=url('/tenants/invoice/payment')?>">Submit New Payment</a></li>
                                              <li><a href="<?=url('/tenants/payment/submitted')?>">submitted Payments</a></li>

                                        <li><a href="<?=url('/tenants/payment/additions')?>">Approved Payments</a></li>

                                        <li><a href="<?=url('/tenants/payment/history')?>">Tenants Transaction</a></li>

                                        <li><a href="<?=url('/tenants/payment/deductions')?>">Charged Payments</a></li>
                                          <li><a href="<?=url('/tenants/payment/monthly-summary')?>">Monthly Summary</a></li>

                                  

                                        </ul>
                                    </li>


                                     <li>
                                    <a href="#"><i class="icon-list"></i> <span>Asset Management</span></a>
                                    <ul>
                                       

                                        <li><a href="<?=url('/tenants/registed/items?type=Vehicle')?>">Registered Vehicles</a></li>

                                        <li><a href="<?=url('/tenants/registed/items?type=Electronics')?>"> Registered Electronics</a></li>

                                        <li><a href="<?=url('/tenants/registed/items?type=Pet')?>">Registered Pets</a></li>

                                        <li><a href="<?=url('/tenants/registed/items')?>">All Items</a></li>

                                        </ul>
                                    </li>

                                     <li>
                                    <a href="#"><i class="icon-stack2"></i> <span>Utility Bills</span></a>
                                    <ul>
                                       

                                        <li><a href="<?=url('/tenants/utility-bills/index')?>">Utility Bills</a></li>

                                        <li><a href="<?=url('/tenants/utility-bills/statistics?year='.date('Y'))?>">Payment Statistics</a></li>


                                        </ul>
                                    </li>


                                <li>
                                    <a href="#"><i class="icon-calculator"></i> <span>Repair Module</span></a>
                                    <ul>
                                        <li><a href="<?=url('/tenants/repair/create_request')?>">Request For Repairs</a></li>
                                        <li><a href="<?=url('/tenants/repair/request/index')?>">Repair Requests</a></li>


                                         <li><a href="<?=url('/tenants/repairs/index')?>">Repair Inccured</a></li>
                                        
                                         
                                        
                                        
                                        </ul>
                                </li>


                               


                            <?php endif;?>
                                <?php if(Entrust::hasRole("Admin")):?>
                                
                                <li>
                                    <a href="#"><i class="icon-stack2"></i> <span>Providers & Agents</span></a>
                                    <ul>
                                         <li><a href="<?=url('/backend/add/provider')?>">Add Agent/Property Owners</a></li>
                                        <li><a href="<?=url('/backend/provider/list')?>">Property Providers </a></li>
                                        <li><a href="<?=url('/serviceproviders/providers/index')?>">Service Providers </a></li>

                                        <li><a href="<?=url('/backend/Providers/Spaces')?>">Provider Spaces </a></li>


                                         <li><a href="<?=url('/send/invoices/index')?>">Send Invoices </a></li>

                                        
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-envelop"></i> <span>Bulk SMS and Emails</span></a>
                                    <ul>
                                         
                                        <li><a href="<?=url('/backend/sms/index/approve')?>">Pending Approvals </a></li>
                                        
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-stack2"></i> <span>Property Management</span></a>
                                    <ul>
                                   
                                        <li><a href="<?=url('/backend/property/admin/index')?>">View Properties</a></li>
                                        
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-users4"></i> <span>User Management</span></a>
                                    <ul>
                                        <li><a href="<?=url('/admin/user/adduser')?>">Add New Users</a></li>
                                        <li><a href="<?=url('/admin/user/viewuser')?>">View System Users</a></li>
                                         
                                        <li><a href="<?=url('/admin/role/index')?>">View System Roles</a></li>
                                          
                                       
                                    </ul>
                                </li>

                                <li>
                                    <a href="#"><i class="icon-users4"></i> <span>Hospitality Providers</span></a>
                                    <ul>
                                        
                                        <li><a href="<?=url('/hotels/supplier/index')?>">Suppliers List</a></li>
                                         
                                       
                                          
                                       
                                    </ul>
                                </li>

                                 <li>
                                    <a href="#"><i class="icon-list"></i> <span>Hotels</span></a>
                                    <ul>
                                         <li><a href="<?=url('/hotels/hotel/types')?>">Hotel Types</a></li>
                                        <li><a href="<?=url('/hotels/admin/hotels')?>">Hotel Listings</a></li>

                                         <li><a href="<?=url('/hotels/admin/package-categories')?>">Package Categories</a></li>

                                         <li><a href="<?=url('/hotels/admin/package-categories')?>">Package Audience</a></li>
                                         
                                        
                                          
                                       
                                    </ul>
                                </li>

                                 


                                 <li>
                                    <a href="#"><i class="icon-stack2"></i> <span> Configurations</span></a>
                                    <ul>
                                         <li><a href="<?=url('/backend/category/management/index')?>">Manage Categories</a></li>
                                        <li><a href="<?=url('/backend/category/management/sub_index');?>">Manage Sub Categories</a></li>

                                        <li><a href="<?=url('/backend/module/index');?>">System Modules</a></li>

                                        <li><a href="<?=url('/backend/module/subscriptions');?>">Provider SubScriptions</a></li>

                                        <li><a href="<?=url('/backend/system/currencies');?>">System Currencies</a></li>
                                           <li><a href="<?=url('/backend/system/invoice-components');?>">System Charges</a></li>
                                        
                                        
                                    </ul>
                                </li>
                                  <?php endif;?>


                                  <?php if(Entrust::hasRole("Guard")):?>

                                     <li>
                                    <a href="<?=url('/security/visitor/create')?>"><i class="icon-stack2"></i> <span>Visitors CheckIn</span></a>
                                    </li>

                                    <li>
                                    <a href="<?=url('/security/visitor/checkout')?>"><i class="icon-stack2"></i> <span>Visitors CheckOut</span></a>
                                    </li>


                                    <li>
                                    <a href="<?=url('/security/visitor/create')?>"><i class="icon-stack2"></i> <span>Tenant CheckOut</span></a>
                                    </li>

                                    


                                <li>
                                    <a href="#"><i class="icon-list"></i> <span>Incidents Management</span></a>
                                    <ul>
                                        
                                        
                                        <li><a href="<?=url('/security/incident/report')?>">Report Incident</a></li>

                                         <li><a href="<?=url('/security/incident/list/index?type=Person')?>">Reported By Me</a></li>
                                        
                                        <li><a href="<?=url('/security/incident/list/index?type=Property')?>">Current Property Incidents</a></li>



                                        
                                    </ul>
                                </li>

                                <li>
                                    <a href="#"><i class="icon-list"></i> <span>Visitors Reports</span></a>
                                    <ul>
                                        
                                        <li><a href="<?=url('/security/view/reports/visitors/index?type=Month')?>">This Months Visitors</a></li>
                                        
                                        <li><a href="<?=url('/security/view/reports/visitors/index?type=Year')?>">This Year</a></li>

                                         <li><a href="<?=url('/security/view/reports/visitors/index')?>">All Visitors</a></li>

                                        
                                    </ul>
                                </li>

                                   


                                     



                                      <?php endif;?>
                                  <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")  || Entrust::hasRole("Caretaker")):?>
                                  <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                 <li class="hidden">
                                    <a href="#"><i class="icon-cog"></i> <span>Property Settings</span></a>
                                    <ul>
                                        <li><a href="<?=url('/backend/provider/amentities')?>">Ammentities List</a></li>
                                        <li><a href="<?=url('/backend/provider/UtilityList')?>">Property Charges</a></li>
                                       
                                       
                                        
                                    </ul>
                                </li>

                                <li>
                                    <a href="#"><i class="icon-stack2"></i> <span>Property Management</span></a>
                                    <ul>
                                        <li class="hidden"><a href="<?=url('/backend/property/add')?>">Add Property</a></li>
                                        

                                        <li><a href="<?=url('/backend/property/index')?>">View All Properies</a></li>
                                         <li><a href="<?=url('/backend/templates/create')?>">Create Template</a></li> 
                                        <li><a href="<?=url('/backend/templates/index')?>">Spaces Templates</a></li> 
                                        <li><a href="<?=url('/backend/space/add')?>">Add Spaces</a></li>
                                        
                                        <li><a href="<?=url('/backend/space/listView')?>"> view Spaces</a></li>
                                        <li class="hidden"><a href="<?=url('/backend/space/listView?status=Free')?>">Free Spaces</a></li>

                                        <li><a href="<?=url('/backend/spaces/bookings')?>">Space Bookings</a></li>
                                      


                                         
                                        
                                    </ul>
                                </li>


                                  
                                 <li>
                                    <a href="#"><i class="icon-grid"></i> <span>Utility Bills</span></a>
                                    <ul>
                                        
                                        
                                        
                                         <li><a href="<?=url('/backend/utility-bills/create')?>">Record Utility Bills</a></li>

                                         <li><a href="<?=url('/backend/utility-bills/index')?>">Utility Bills</a></li>

                                        
                                    </ul>
                                </li>
                                 <?php endif;?>


                                <li>
                                    <a href="<?=url('/backend/tenant/dashboard')?>"><i class="icon-users4"></i> <span>Tenants  Management</span></a>
                                    <ul>
                                        <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                         <li><a href="<?=url('/backend/tenant/dashboard')?>">Tenant Dashboard</a></li>

                                        <li><a href="<?=url('/backend/tenants/create')?>">Add New Tenant</a></li>

                                        
                                    <?php endif;?>
                                        <li><a href="<?=url('/backend/tenants/listView')?>">View All Tenants</a></li>
                                      <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                                        <li class="hidden"><a href="<?=url('/backend/tenants/nonstudents')?>">Non Student Tenants</a></li>

                                        <li class="hidden"><a href="<?=url('/backend/tenants/students')?>">View Student Tenants</a></li>

                                         <li class="hidden"><a href="<?=url('/backend/tenants/emergency_contact')?>">Emergency Contacts</a></li>
                                         <li class="hidden"><a href="<?=url('/backend/tenants/registered_items')?>">Registered Items</a></li>

                                          <li><a href="<?=url('/backend/tenants/lease_expiry')?>"> Lease Expiries</a></li>

                                           <?php endif;?>
                                        
                                        
                                    </ul>
                                </li>

                                <li class="hidden">
                                    <a href="#"><i class="icon-calculator"></i> <span>Tenants Reports</span></a>
                                    <ul>
                                        <li><a href="<?=url('/backend/repair/add_new')?>">Tenants List Reports</a></li>
                                        <li><a href="<?=url('/backend/repair/index')?>">Archieved Invoices</a></li>
                                        
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>

                     
                                 <li>
                                    <a href="#"><i class="icon-list"></i> <span>Vacation Notices</span></a>
                                    <ul>
                                        
                                         <li><a href="<?=url('/backend/v-notice/index')?>">View Notice</a></li>

                                         <li><a href="<?=url('/backend/tenants/Vacate')?>">Vacate Tenants</a></li>

                                         <li><a href="<?=url('/backend/tenants/Vacated')?>">Vacated Tenants</a></li>
                                        
                                         
                                        
                                        
                                        </ul>
                                </li>
                                 <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                 <li>
                                    <a href="#"><i class="icon-calculator"></i> <span>Invoices Management</span></a>
                                    <ul>
                                        <li><a href="<?=url('/backend/invoices/index?status=Pending')?>">Pending Invoices</a></li>
                                         <li><a href="<?=url('/backend/invoices/index?status=Paid')?>">Paid Invoices</a></li>
                                        
                                         <li><a href="<?=url('/backend/invoices/index?status=Cancelled')?>">Cancelled Invoices</a></li>
                                        
                                         <li><a href="<?=url('/backend/invoices/index?status=Overdue')?>">Over Due Invoices</a></li>

                                         <li><a href="<?=url('/backend/invoices/index')?>">Archieved Invoices</a></li>

                                          <li class="hidden"><a href="<?=url('/backend/payment-reminder/index')?>">Send Payment Reminders</a></li>
                                        
                                        
                                        </ul>
                                </li>
                                <li class="hidden">
                                    <a href="#"><i class="icon-stack2"></i> <span>Booking Management</span></a>
                                    <ul>
                                        
                                        <li><a href="layout_navbar_sidebar_fixed.html">View new Bookings</a></li>
                                        
                                        
                                    </ul>
                                </li>
                                 <?php endif;?>
                                 <li>
                                    <a href="#"><i class="icon-cash3"></i> <span>Tenants Payments</span></a>
                                    <ul>
                                        <li ><a href="<?=url('/backend/make/bulkpayment')?>">Add Monthly Payment</a></li>

                                        <li><a href="<?=url('/backend/submitted/payments')?>">Submitted Payment</a></li>
                                         <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                        <li><a href="<?=url('/backend/payment/history')?>">Tenants Transaction</a></li>


                                        <li><a href="<?=url('/backend/payment/Periodics')?>">Period Payments</a></li>

                                     
                                        <li><a href="<?=url('/backend/payment/tenants/charges')?>">Tenants Charges</a></li>
                                          <li><a href="<?=url('/backend/payment/tenants/summary')?>">Monthly Summaries</a></li>
                                      <?php endif;?>
                                        

                                        
                                        
                                        
                                    </ul>
                                </li>
                                 <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                                 <li >
                                    <a href="#"><i class="icon-users4"></i> <span>User Management</span></a>
                                    <ul>
                                        
                                        <li><a href="<?=url('/backend/User/Create')?>">Add New User</a></li>
                                        <li><a href="<?=url('/backend/User/Index')?>">User List</a></li>
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>
                                 <?php endif;?>
                                 <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                                 <li class="hidden">
                                    <a href="#"><i class="icon-envelop"></i> <span>Bulk SMS and Emails</span></a>
                                    <ul>
                                        
                                        <li><a href="<?=url('/backend/message/sent/create')?>">Bulk Sms &amp; Emails</a></li>
                                        <li><a href="<?=url('/message/sent/items')?>">Sent SMS</a></li>
                                        <li><a href="<?=url('/backend/message/groups/index')?>">Manage Groups</a></li>
                                        <li><a href="<?=url('/backend/message/contact/index')?>">Manage Contact</a></li>
                                        <li><a href="<?=url('/backend/message/account/top-up')?>">Recharge Acccount</a></li>
                                         <li><a href="#">Manage Notifications</a></li>
                                        
                                        
                                        
                                    </ul>
                                </li>
                                 <?php endif;?>

                                  <li class="hidden">
                                    <a href="#"><i class="icon-alignment-unalign"></i> <span>Maintanance Module</span></a>
                                    <ul>

                                        <li><a href="<?=url('/backend/repair/requests/index')?>">Repairs Requests</a></li>

                                       <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>
                                        <li><a href="<?=url('/backend/repair/add_new')?>">Add Space Repairs</a></li>
                                           <?php endif;?>
                                        <li><a href="<?=url('/backend/repair/index')?>">Repair List</a></li>

                                        <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                        <li><a href="<?=url('/backend/repair/repairitems/index')?>">Repair Items</a></li>


                                         <li><a href="<?=url('/backend/repair/index')?>">Job Requests</a></li>
                                         <?php endif;?>


                                        
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>
                                 <?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider")):?>

                                  <li class="hidden">
                                    <a href="#"><i class="icon-bucket"></i> <span>Supp && Procurement</span></a>
                                    <ul>
                                        <li><a href="<?=url('/supplier/supplier/add_new')?>">Add Supplier</a></li>
                                        <li><a href="<?=url('/supplier/supplier/index')?>">Supplier List</a></li>
                                        <li><a href="<?=url('/supplier/supplies/index')?>">Supplies Management</a></li>

                                        <li><a href="<?=url('/supplier/quatations/index')?>">Quatation Management</a></li>

                                     </ul>
                                 </li>

                                 <li class="hidden">
                                    <a href="#"><i class="icon-lock"></i> <span>Security Module</span></a>
                                    <ul>
                                       <li><a href="<?=url('/security/visitors/view/index')?>">Visitors List</a></li>

                                        <li><a href="<?=url('/security/gate/index')?>">View Gates</a></li>
                                        <li><a href="<?=url('/security/guard/index')?>">View Guards</a></li>
                                        

                                        <li><a href="<?=url('/security/guards/assignments')?>">Current Gate Assignments</a></li>

                                     </ul>
                                 </li>

                                 <li class="hidden">
                                    <a href="#"><i class="icon-bars-alt "></i> <span>System Statistics</span></a>
                                    <ul>
                                        <li><a href="<?=url('/backend/property/statistics')?>">Property Statistics</a></li>

                                        <li><a href="<?=url('/backend/repair/add_new')?>">Tenants Statistics</a></li>
                                        <li><a href="<?=url('/backend/repair/index')?>">Spaces Statistics</a></li>

                                        <li><a href="<?=url('/backend/invoice/statistics')?>">Invoice Statistics</a></li>


                                        <li class=""><a href="layout_navbar_sidebar_fixed.html">Repairments Analysis</a></li>
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>
                             
                                 <?php endif;?>

                                <li>
                                    <a href="#"><i class="icon-images2"></i> <span>Gallery</span></a>
                                    <ul>
                                        <li><a href="<?=url('/backend/property/gallery')?>">View Uploaded Images</a></li>

                                        
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>

                                
                                 <?php endif;?>
                                 
                                <?php if(Entrust::can("manage-hotels")):?>
                                     <li>
                                    <a href="#"><i class="icon-list"></i> <span>Manage Hotels</span></a>
                                    <ul>
                                        <li><a href="<?=url('/hotels/hotel/create')?>">Add Hotels</a></li>

                                        <li><a href="<?=url('/hotels/hotel/index')?>">Hotel List</a></li>
                                        </ul>
                                </li>

                            <?php endif;?>

                            <?php if(Entrust::can("manage-hotel-rooms")):?>
                                     <li>
                                    <a href="#"><i class="icon-list"></i> <span>Manage Hotel Rooms</span></a>
                                    <ul>
                                        <li><a href="<?=url('/hotels/room/create')?>">Add Rooms</a></li>

                                        <li><a href="<?=url('/hotels/rooms/index')?>">Room List</a></li>
                                        </ul>
                                </li>

                            <?php endif;?>

                             <?php if(Entrust::can("manage-packages")):?>
                                     <li>
                                    <a href="#"><i class="icon-list"></i> <span>Manage Packages</span></a>
                                    <ul>
                                        <li><a href="<?=url('/serviceproviders/job/requests?status=Pending')?>">Add Package</a></li>

                                        <li><a href="<?=url('/serviceproviders/job/requests')?>">Package List</a></li>
                                        </ul>
                                </li>

                            <?php endif;?>


                             <?php if(Entrust::can("manage-hotel-rooms")):?>
                                     <li>
                                    <a href="#"><i class="icon-list"></i> <span>Manage Bookings</span></a>
                                    <ul>
                                        <li><a href="<?=url('/serviceproviders/job/requests?status=Pending')?>">Add Package</a></li>

                                        <li><a href="<?=url('/serviceproviders/job/requests')?>">Package List</a></li>
                                        </ul>
                                </li>
                                  <li>
                                    <a href="#"><i class="icon-hammer-wrench"></i> <span>Account Settings</span></a>
                                    <ul>
                                        <li><a href="<?=url('/hotels/rooms/room-types')?>">List of Room Types</a></li>

                                        <li><a href="<?=url('/hotels/room/bed-types')?>">List of Bed Types</a></li>

                                        <li><a href="<?=url('/hotels/amentities/index')?>">List of Amentities</a></li>

                                        <?php if(Entrust::hasRole("Hotel")):?>
                                            <li><a href="<?=url('/hotels/hotel/update_profile')?>">Update Hotel Details</a></li>

                                        <?php endif;?>






                                        </ul>
                                </li>


                                <li>
                                    <a href="#"><i class="icon-images2"></i> <span>Gallery</span></a>
                                    <ul>
                                        <li><a href="<?=url('/hotels/supplier/gallery')?>">Uploaded Images</a></li>

                                        <li><a href="<?=url('/hotels/supplier/hotel/gallery')?>">Hotel Images</a></li>


                                        <li><a href="<?=url('/hotels/supplier/gallery')?>">Room Images</a></li>

                                        
                                       
                                        
                                        
                                        
                                    </ul>
                                </li>

                            <?php endif;?>







                                 <?php if(Entrust::hasRole("serviceProvider")):?>

                                    <li>
                                    <a href="#"><i class="icon-list"></i> <span>Job Requests</span></a>
                                    <ul>
                                        <li><a href="<?=url('/serviceproviders/job/requests?status=Pending')?>">Pending Job Request</a></li>

                                        <li><a href="<?=url('/serviceproviders/job/requests')?>">All Job Request</a></li>
                                        </ul>
                                </li>



                                  <?php endif;?>
                                
                           </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->