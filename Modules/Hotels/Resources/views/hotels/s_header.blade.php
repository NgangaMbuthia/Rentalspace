<div class="container-detached">
            <div class="content-detached">

              <!-- Invoice grid options -->
              <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                  <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-filter">
                  
                  <ul class="nav navbar-nav">

                     
                   
                 <?php if(Entrust::can("manage-hotels")):?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i>Manage Hotels <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=url('/hotels/hotel/create')?>"><span class="icon-googleplus5"></span> &nbsp;&nbsp;Create New</a></li>

                        <li><a href="<?=url('/hotels/hotel/index')?>"><span class="icon-list"></span> &nbsp;&nbsp;Hotel list</a></li>

                       </ul>
                    </li>
                  <?php endif;?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-delicious position-left"></i>Hotel Rooms<span class="caret"></span></a>
                      <ul class="dropdown-menu">

                          <li><a href="<?=url('/hotels/room/create')?>">Add Rooms</a></li>
                        
                          <li><a href="<?=url('/hotels/rooms/index')?>">Hotel Rooms</a></li>
                        
                        <li><a href="<?=url('/hotels/rooms/room-types')?>">Hotel Types</a></li>


                        
                      
                       
                        
                       
                      </ul>
                    </li>

                   
                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-joomla position-left"></i>Account Settings<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                       <li><a href="<?=url('/hotels/rooms/room-types')?>">Room Types</a></li>
                        <li><a href="<?=url('/hotels/room/bed-types')?>">Bed Types</a></li>
                        <li><a href="<?=url('/hotels/amentities/index')?>">Amentities List</a></li>
                     
                      
                       
                        
                       
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
                        
                        <?php if(Entrust::can("manage-hotels")):?>
                        <li class="reject-modal" data-title="Report Genarator" data-url="<?=url('/hotels/hotel/reports')?>"><a href="">Hotel List</a></li>
                      <?php endif;?>
                        <li class="reject-modal" data-title="Report Genarator" data-url="<?=url('/hotels/rooms/reports')?>"><a href="#" target="_new">Room List</a></li>
                          <li><a href="<?=url('/hotels/amentities/reports')?>" target="_new">Amentities Lists</a></li>
                          <li><a href="<?=url('/hotels/bed_types/reports')?>" target="_new">Bed Types</a></li>

                          <li><a href="<?=url('/hotels/roomtypes/reports')?>" target="_new">Room Types</a></li>
                     
                       
                        
                       
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