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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Repair Requests<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/repair/requests/index?status=Pending')?>">&nbsp;&nbsp;Pending Requests</a></li>
                        <li><a href="<?=url('/backend/repair/requests/index?status=Closed')?>">&nbsp;&nbsp;Closed Requests</a></li>

                        <li><a href="<?=url('/backend/repair/requests/index?status=Month')?>">&nbsp;&nbsp;This Months Requests</a></li>

                         <li><a href="<?=url('/backend/repair/requests/index?status=Year')?>">&nbsp;&nbsp;This Years Requests</a></li>

                          <li><a href="<?=url('/backend/repair/requests/index')?>">&nbsp;&nbsp;All Requests</a></li>


                        
                        
                         
                       
                       
                       
                       
                      </ul>
                    </li>
                    

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Done Reapirs<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/repair/index?type=Month')?>">&nbsp;&nbsp;This Months Repairs</a></li>

                         <li><a href="<?=url('/backend/repair/index?type=Year')?>">&nbsp;&nbsp;This Years Repairs</a></li>
                          <li><a href="<?=url('/backend/repair/index?type=All')?>">&nbsp;&nbsp;All Repairs</a></li>

                           <li><a href="<?=url('/backend/repair/index?type=All')?>">&nbsp;&nbsp;Property Repairs</a></li>
                        
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Payments and Invoices<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a href="<?=url('/backend/message/account/top-up')?>">Pending Invoices</a></li>
                        <li><a href="<?=url('/backend/message/account/top-up/history')?>">Pending Payments</a></li>

                        <li><a href="<?=url('/backend/message/account/top-up/history')?>">Paid Payments</a></li>
                      
                        
                        
                         
                        
                       
                      </ul>
                    </li>

                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Analytics<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       
                        
                        
                         <li class="divider"></li>
                          <li><a href="<?=url('/backend/message/account/top-up/analytics/'.date('Y'))?>">Monthly  Sending Analytics</a></li>
                        
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Reports<span class="caret"></span></a>
                      <ul class="dropdown-menu">

                        <li><a href="<?=url('/backend/message/account/top-up/history')?>">Export To Excel</a></li>

                        <li><a href="<?=url('/backend/message/account/top-up/history')?>">Export To PDF</a></li>
                       
                        
                        
                         
                        
                       
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