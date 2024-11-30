<?php 
 use App\Helpers\Helper;
 ?>
<div class="sidebar-category">
						<div class="category-title">
							<span>Tenants Contacts</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								

								<?php foreach($models as $model):?>

								<li class="media">
									<div class="media-left">
										<a href="#"><img src="{{asset('/assets/images/k.png')}}" class="img-xs img-circle" alt=""></a>
									</div>

									<div class="media-body media-middle">
										<?=$model->user->name;?><br>
										<?=$model->user->profile->telephone;;?>
										<?=$model->user->email;;?><p>
                                         <strong>
                                         	<?=$model->space->property->title;;?>
                                         </strong> &nbsp;-

                                         <?=$model->space->title;;?>
										


									</div>

									
									
								</li>
							<?php endforeach;?>
							</ul>
						</div>

							
					</div>