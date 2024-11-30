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
                        <li class="reject-modal" data-title="Add New Supplier"   data-url="<?=url('/hotels/supplier/create')?>"><a href="#"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>

                        <li><a href="<?=url('/hotels/supplier/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Suppliers list</a></li>

                       
                      
             
                       
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-delicious position-left"></i>Manage Hotels<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        
                        <li><a href="<?=url('/hotels/hotel/types')?>">Hotel Types</a></li>


                        <li><a href="<?=url('/hotels/admin/hotels')?>">Hotel List</a></li>
                        <li><a href="<?=url('/hotels/admin/rooms')?>">Hotel Rooms</a></li>
                       
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-joomla position-left"></i>Tour Operators<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a href="<?=url('/backend/plots/create')?>">Create New</a></li>
                        <li><a href="<?=url('/backend/plots/index')?>">Tour Operators</a></li>
                     
                      <li><a href="<?=url('/backend/plots/index?status=Sold')?>">Payment History</a></li>
                        <li><a href="<?=url('/backend/plots/index?status=Sold')?>">Add Package Category</a></li>
                       <li><a href="<?=url('/backend/plots/index?status=Sold')?>">Package Categories</a></li>

                        <li><a href="<?=url('/backend/plots/index?status=Sold')?>">Package Audience</a></li>
                       
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-graph position-left"></i>Analytics<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/backend/property/spaces/statistics')?>">Supplier Statistics</a></li>
                        <li><a href="<?=url('/backend/property/statistics/'.date('Y'))?>">Tour Operators Analysis</a></li>
                        <li><a href="<?=url('/backend/property/repairs/statistics/'.date('Y'))?>">Hotels Statistics</a></li>
                       
                        
                       
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-pdf position-left"></i> Reports<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        <li><a href="<?=url('/backend/reports/properties/xls')?>">Properties Reports</a></li>
                        <li><a href="<?=url('/backend/reports/spaces/export/pdf_reports')?>" target="_new">Spaces Pdf Reports</a></li>
                      <li><a href="<?=url('/backend/reports/spaces/export/xls')?>">Spaces Excel Reports</a></li>
                      <li><a href="<?=url('/backend/reports/plots/export/xls')?>">Plots Reports</a></li>
                      <li><a href="<?=url('/backend/reports/plots/export/xls')?>">Properties Space Statistics</a></li>
                       
                        
                       
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