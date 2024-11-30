
			<div class="sidebar  sidebar-default">
				<div class="sidebar-content">

					<!-- Sidebar search -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Search</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<form action="#">
								<div class="has-feedback has-feedback-left">
									<input type="search" class="form-control" placeholder="Search">
									<div class="form-control-feedback">
										<i class="icon-search4 text-size-base text-muted"></i>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /sidebar search -->


					<!-- Action buttons -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Action buttons</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<div class="row">
								<div class="col-xs-6">
								<?php if(Entrust::hasRole("Admin")):?>
									<a href="<?=url('/backend/provider/list')?>" class="btn bg-teal-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-git-branch"></i> <span>Agents</span></a>
								<?php endif;?>
									<button class="btn bg-purple-300 btn-block btn-float btn-float-lg" type="button"><i class="icon-mail-read"></i> <span>Messages</span></button>
								</div>
								<?php if(Entrust::hasRole("Admin")):?>
								 <div class="col-xs-6">
									<button class="btn bg-warning-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-stats-bars"></i> <span>Constructors</span></button>
									
									<a  href="<?=url('/admin/user/viewuser')?>" class="btn bg-blue btn-block btn-float btn-float-lg" type="button"><i class="icon-people"></i> <span>Users</span></a>
                                 </div>
                                 

                                
								<?php endif;?>
							</div>
						</div>
					</div>
					<!-- /action buttons -->


					<!-- Sub navigation -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Navigation</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding">
							<ul class="navigation navigation-alt navigation-accordion">
							<?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Provider") ):?>
								<li class="navigation-header">Adminstrative Tasks</li>
								
									<li><a href="<?=url('/backend/space/add')?>"><i class="icon-googleplus5"></i>Add New Spaces</a></li>

									<li><a href="<?=url('/backend/property/add')?>"><i class="icon-googleplus5"></i>Add Property</a></li>
									<li><a href="<?=url('/backend/tenants/create')?>"><i class="icon-googleplus5"></i>Add Tenants</a></li>

							
								
								
								<li class="navigation-header">Adminstative View</li>
								<li><a href="<?=url("/backend/property/index")?>"><i class="icon-files-empty"></i> View Properties</a></li>
								<li><a href="<?=url('/backend/tenant/dashboard')?>"><i class="icon-file-plus"></i> View Tenants</a></li>
								<li><a href="<?=url('/backend/space/listView')?>"><i class="icon-file-check"></i>View Spaces</a></li>
								<li class="navigation-divider"></li>


							<?php endif;?>

							<?php if(Entrust::hasRole("Admin")):?>
								<li class="navigation-header">Adminstrative Tasks</li>
								
								<li><a href="<?=url('/admin/user/adduser')?>"><i class="icon-googleplus5"></i> Create New User Account</a></li>
								<li><a href="<?=url('/backend/add/provider')?>"><i class="icon-googleplus5"></i>Add New Providers</a></li>
								

									<li><a href="<?=url('/admin/role/addrole')?>"><i class="icon-googleplus5"></i>Add System Role</a></li>

							
								
								
								<li class="navigation-header">Adminstative View</li>
								<li><a href="<?=url('/admin/user/viewuser')?>"><i class="icon-users4"></i> All Portal Users</a></li>
								<li><a href="<?=url('/admin/role/index')?>"><i class="icon-users2"></i> Portal Gropups/Roles</a></li>
								<li><a href="#"><i class="icon-unlocked"></i>Poral Permissions/Rights</a></li>
								<li class="navigation-divider"></li>
								<?php endif;?>
								
								
								<li><a href="#"><i class="icon-cog3"></i> Settings</a></li>
								<li class="navigation-divider"></li>
							</ul>
						</div>
					</div>
					<!-- /sub navigation -->


					<!-- Online users -->
					<div class="sidebar-category">

					<?php if(Entrust::hasRole("Admin")):?>
						<div class="category-title">
							<span>Online users</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face1.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">James Alexander</a>
										<span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-success"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face2.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
										<span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-danger"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face3.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Margo Baker</a>
										<span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-success"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face4.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
										<span class="text-size-mini text-muted display-block">Neenah, WI.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-warning"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face5.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Richard Vango</a>
										<span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-grey-400"></span>
									</div>
								</li>
							</ul>
						</div>

					<?php endif;?>

					<?php if(Entrust::hasRole("Agents") || Entrust::hasRole("Providerss") ):?>
						<div class="category-title">
							<span>Online Bookings</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face1.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">James Alexander</a>
										<span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-success"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face2.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
										<span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-danger"></span>
									</div>
								</li>

								<li class="media">
									<a href="#" class="media-left"><img src="{{asset('assets/images/demo/users/face3.jpg')}}" class="img-sm img-circle" alt=""></a>
									<div class="media-body">
										<a href="#" class="media-heading text-semibold">Margo Baker</a>
										<span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
									</div>
									<div class="media-right media-middle">
										<span class="status-mark border-success"></span>
									</div>
								</li>

								
							</ul>
						</div>

					
					</div>
					<?php endif;?>
					<!-- /online-users -->


					<!-- Latest updates -->
					<div class="sidebar-category hidden ">
						<div class="category-title">
							<span>Latest updates</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								<li class="media">
									<div class="media-left">
										<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
									</div>

									<div class="media-body">
										Drop the IE <a href="#">specific hacks</a> for temporal inputs
										<div class="media-annotation">4 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
									</div>
									
									<div class="media-body">
										Add full font overrides for popovers and tooltips
										<div class="media-annotation">36 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
									</div>
									
									<div class="media-body">
										<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
										<div class="media-annotation">2 hours ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
									</div>
									
									<div class="media-body">
										<a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
										<div class="media-annotation">Dec 18, 18:36</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
									</div>
									
									<div class="media-body">
										Have Carousel ignore keyboard events
										<div class="media-annotation">Dec 12, 05:46</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- /latest updates -->


					<!-- Filter -->
					<div class="sidebar-category hidden">
						<div class="category-title">
							<span>Filter</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<form action="#">
								<div class="form-group">
									<div class="checkbox checkbox-switchery checkbox-right switchery-xs">
										<label class="display-block">
											<input type="checkbox" class="switchery" checked="checked">
											Free People
										</label>	
									</div>

									<div class="checkbox checkbox-switchery checkbox-right switchery-xs">
										<label class="display-block">
											<input type="checkbox" class="switchery">
											GAP
										</label>
									</div>

									<div class="checkbox checkbox-switchery checkbox-right switchery-xs">
										<label class="display-block">
											<input type="checkbox" class="switchery" checked="checked">
											Lane Bryant
										</label>
									</div>

									<div class="checkbox checkbox-switchery checkbox-right switchery-xs">
										<label class="display-block">
											<input type="checkbox" class="switchery" checked="checked">
											Ralph Lauren
										</label>
									</div>

									<div class="checkbox checkbox-switchery checkbox-right switchery-xs">
										<label class="display-block">
											<input type="checkbox" class="switchery">
											Liz Claiborne
										</label>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /filter -->

                      	<?php if(Entrust::hasRole("Admin")):?>
					<!-- Contacts -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Agents Contacts</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								<li class="media">
									<div class="media-left">
										<a href="#">
											<img src="{{asset('assets/images/demo/users/face11.jpg')}}" class="img-xs img-circle" alt="">
											<span class="badge badge-info media-badge">6</span>
										</a>
									</div>

									<div class="media-body media-middle">
										Rebecca Jameson
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list text-nowrap">
											<li>
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start chat</a></li>
													<li><a href="#"><i class="icon-phone2 pull-right"></i> Make a call</a></li>
													<li><a href="#"><i class="icon-mail5 pull-right"></i> Send mail</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-statistics pull-right"></i> Statistics</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#">
											<img src="{{asset('assets/images/demo/users/face25.jpg')}}" class="img-xs img-circle" alt="">
											<span class="badge badge-info media-badge">9</span>
										</a>
									</div>

									<div class="media-body media-middle">
										Walter Sommers
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list text-nowrap">
											<li>
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start chat</a></li>
													<li><a href="#"><i class="icon-phone2 pull-right"></i> Make a call</a></li>
													<li><a href="#"><i class="icon-mail5 pull-right"></i> Send mail</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-statistics pull-right"></i> Statistics</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#"><img src="{{asset('assets/images/demo/users/face10.jpg')}}" class="img-xs img-circle" alt=""></a>
									</div>

									<div class="media-body media-middle">
										Otto Gerwald
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list text-nowrap">
											<li>
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start chat</a></li>
													<li><a href="#"><i class="icon-phone2 pull-right"></i> Make a call</a></li>
													<li><a href="#"><i class="icon-mail5 pull-right"></i> Send mail</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-statistics pull-right"></i> Statistics</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#"><img src="{{asset('assets/images/demo/users/face14.jpg')}}" class="img-xs img-circle" alt=""></a>
									</div>

									<div class="media-body media-middle">
										Vince Satmann
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list text-nowrap">
											<li>
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start chat</a></li>
													<li><a href="#"><i class="icon-phone2 pull-right"></i> Make a call</a></li>
													<li><a href="#"><i class="icon-mail5 pull-right"></i> Send mail</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-statistics pull-right"></i> Statistics</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</li>

								<li class="media">
									<div class="media-left">
										<a href="#"><img src="{{asset('assets/images/demo/users/face24.jpg')}}" class="img-xs img-circle" alt=""></a>
									</div>

									<div class="media-body media-middle">
										Jason Leroy
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list text-nowrap">
											<li>
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-more2"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start chat</a></li>
													<li><a href="#"><i class="icon-phone2 pull-right"></i> Make a call</a></li>
													<li><a href="#"><i class="icon-mail5 pull-right"></i> Send mail</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-statistics pull-right"></i> Statistics</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					<?php endif;?>
					<?php if(Entrust::hasRole("Agentsss") || Entrust::hasRole("Provider") ):?>

							 @widget('tenants',['count' => 10,'type'=>'notification'])

					<?php endif;?>
					<!-- /contacts -->

				</div>
			</div>
