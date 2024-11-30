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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Payment Type <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/tenants/create')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Rent Payment</a></li>

                        <li><a href="<?=url('/backend/tenants/listView')?>"><span class="icon-list"></span> &nbsp;&nbsp;Repair Payment</a></li>
                        <li><a href="<?=url('/backend/tenants/listView')?>"><span class="icon-list"></span> &nbsp;&nbsp;Deposit Payment</a></li>
                        
                        
                         
                       
                       
                       
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> Charged Amounts<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        <li><a href="<?=url('/backend/tenants/lease_expiry?status=monthly')?>">For This Month</a></li>
                        <li><a href="<?=url('/backend/tenants/lease_expiry?status=year')?>">To For This Year</a></li>
                      
                        
                        
                         <li class="divider"></li>
                         <li><a href="<?=url('/backend/tenants/lease_expiry')?>">All Credits</a></li>
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Paid Amounts<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a href="<?=url('/backend/tenants/lease_expiry?status=monthly')?>">For This Month</a></li>
                        <li><a href="<?=url('/backend/tenants/lease_expiry?status=year')?>">To For This Year</a></li>
                      
                        
                        
                         <li class="divider"></li>
                         <li><a href="<?=url('/backend/tenants/lease_expiry')?>">All Credits</a></li>
                        
                       
                      </ul>
                    </li>
                    
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-pdf"></i>Reports<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Export to Excel</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Export to PDF</a></li>
                        <li><a href="#">Other Format</a></li>
                       
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