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
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Gates<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a  class="reject-modal" data-url="<?=url('/security/gate/create')?>" ><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>

                        <li><a href="<?=url('/security/gate/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Gate List</a></li>
                        
                       
                        
                         
                       
                       
                       
                       
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Guards<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                        
                        <li class="reject-modal" data-title="Add New Guard"
                         data-url="<?=url('/security/guards/create')?>"  

                        ><a data-href="<?=url('/supplier/quatation/create')?>">Add Guards</a></li>
                        <li><a href="<?=url('/security/guard/index')?>">View Guards</a></li>
                        <li data-title="Assign Guards To Gates" class="reject-modal" data-url="<?=url('/security/gate/create')?>"><a href="<?=url('/security/guards/assign')?>">Assign Guards</a></li>
                         <li><a href="<?=url('/security/guards/assignments')?>">Guards Assignments</a></li>
                        
                        
                         
                        
                       
                      </ul>
                    </li>

                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> Visitors <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                      <li><a href="<?=url('/security/visitors/view/index?type=Active')?>">Currently Inside</a></li>
                        <li><a href="<?=url('/security/visitors/view/index?type=Week')?>">Last 1 Week Visitors</a></li>
                        
                        <li><a href="<?=url('/security/visitors/view/index?type=Month')?>">This Month Months</a></li>
                        <li><a href="<?=url('/security/visitors/view/index?type=Year')?>">This Year</a></li>
                        <li><a href="<?=url('/security/visitors/view/index')?>">Full List</a></li>
                        
                        
                        
                         <li class="divider"></li>

                         <li class="reject-modal" data-title="Perform Advanced Visitor Search" data-url="<?=url('/security/visitors/advanced/search')?>"><a >Advanced Report</a></li>
                         
                        
                       
                      </ul>
                    </li>

                   
                     
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Visitors Assets  <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        
                       
                        <li><a href="<?=url('/security/visitors/vehicles/index')?>">Vehicles</a></li>
                        <li><a href="<?=url('/security/visitors/electronics/index')?>">Electronics</a></li>
                        
                       
                      </ul>
                    </li>
                   
                   

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Analytics<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/security/visitors/statistics/tabulated')?>">Tabulated</a></li>
                        <li><a href="<?=url('/security/visitors/statistics/graphical')?>">Graphical Representation</a></li>
                        </ul>
                    </li>
                    
                    
                     
                  </ul>

                  

                </div>

                
              </div>
              <!-- /invoice grid options -->

  </div>