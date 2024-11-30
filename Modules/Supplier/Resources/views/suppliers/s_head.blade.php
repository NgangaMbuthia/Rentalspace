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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Suppliers <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/supplier/supplier/add_new')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>

                        <li><a href="<?=url('/supplier/supplier/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Supplier List</a></li>
                        
                       
                        
                         
                       
                       <li class="divider"></li>
                         <li><a href="<?=url('/backend/v-notice/index')?>">
                  <span class="glyphicon glyphicon-dashboard"></span> &nbsp;&nbsp;
                      Supplier Dashboard
                        </a></li>
                       
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Supplies<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        <li><a href="<?=url('/supplier/quatation/create')?>">Add Commodities</a></li>
                        <li><a href="<?=url('/supplier/quatation/create')?>">To Be Supplied</a></li>
                        <li><a href="
                        <?=url('/supplier/quatation/create')?>
                        ">Supplied Commodities</a></li>

                         <li><a href="
                        <?=url('/supplier/quatation/create')?>
                        ">Issue Commodities</a></li>
                        

                        <li><a href="
                        <?=url('supplier/quatation/create')?>
                        ">Current Stock</a></li>
                        
                         
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Quotations<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/supplier/quatation/create')?>">Request For Quatation</a></li>
                        
                        
                        <li><a href="#">Quatation List</a></li>
                        
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Supplier Payments  <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                       
                        <li><a href="#">Pending Payments</a></li>
                        <li><a href="#">Paid Payments</a></li>
                        
                       
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