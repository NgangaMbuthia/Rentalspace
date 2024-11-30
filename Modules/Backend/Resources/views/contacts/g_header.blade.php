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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Bulk Sms <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/message/sent/create')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Send SMS/Email</a></li>

                        <li><a href="<?=url('/backend/message/scehduled/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Scheduled Sms/Emails</a></li>
                        <li><a href="<?=url('/message/sent/items')?>"><span class="icon-list"></span> &nbsp;&nbsp;Send Items</a></li>
                        
                        
                         
                       
                       
                       
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Contact Management<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        <li><a data-title="Add New Contact"    class=" reject-modal" data-url="<?=url('/backend/message/contact/create')?>">Create New</a></li>
                        <li><a href="<?=url('/backend/message/contact/import')?>">Import Contacts</a></li>

                        <li data-url="<?=url('/backend/message/contact/search')?>"
                        data-title="Search Contact In My Active Database" class="reject-modal"><a href="#">Search For Contact</a></li>
                      
                        
                        
                         <li class="divider"></li>
                         <li><a href="<?=url('/backend/message/contact/index')?>">View Contact List</a></li>
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Group Management<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a data-title="Create New Contact Group" class=" reject-modal" data-url="<?=url('/backend/group/create')?>" >Create New</a></li>
                        <li><a href="<?=url('/backend/message/groups/index')?>">View Available Groups</a></li>
                      
                        
                        
                         <li class="divider"></li>
                         <li><a href="<?=url('/backend/message/groups/statistics')?>">Analytics</a></li>
                        
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Account Topups<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a href="<?=url('/backend/message/account/top-up')?>">Recharge Your Account</a></li>
                        <li><a href="<?=url('/backend/message/account/top-up/history')?>">Topup History</a></li>
                      
                        
                        
                         <li class="divider"></li>
                         <li><a href="<?=url('/backend/message/account/top-up/analytics/'.date('Y'))?>">Analytics</a></li>
                        
                       
                      </ul>
                    </li>

                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Analytics<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       
                        
                        
                         <li class="divider"></li>
                          <li><a href="<?=url('/backend/message/account/top-up/analytics/'.date('Y'))?>">Monthly  Sending Analytics</a></li>
                        
                       
                      </ul>
                    </li>
                    
                    
                    
                     
                  </ul>

                  <div class="navbar-right">
                    <p class="navbar-text">Sort:</p>
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#"><i class="icon-sort-alpha-asc position-left"></i> Asc</a></li>
                      <li><a href="#"><i class="icon-sort-alpha-desc position-left"></i> Desc</a></li>

                    </ul>
                  </div>

                </div>

                
              </div>
              <!-- /invoice grid options -->

  </div>