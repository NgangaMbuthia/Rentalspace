 
<?php use App\Helpers\Helper;?>
 <?php if($config['type']=="notification"):?>
<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-git-compare"></i>
                        <span class="visible-xs-inline-block position-right">Git updates</span>
                        <span class="badge bg-warning-400"><?=$count;?></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            System Notifications
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-sync"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                        	<?php foreach($models as $model):?>
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                </div>

                                <div class="media-body">
                                    <?=config('app.name')?> Says:<a href="#">
                                    	<?=substr($model->subject, 0,30);?></a>
                                    	<?=substr($model->content, 0,70);?>.. 
                                    <div class="media-annotation"><?=$model->created_at->diffForHumans()?></div>
                                </div>
                            </li>
                        <?php endforeach;?>

                           
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>

 <?php else:?>

 	<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <span class="badge bg-warning-400"><?=$count;?></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            Messages
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-compose"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body">
                        	 <?php foreach($models as $model):?>
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{asset('/assets/images/k.png')}}" class="img-circle img-sm" alt="">
                                    
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold"><?=$model->sender->name;?></span>
                                        <span class="media-annotation pull-right"><?=$model->created_at->diffForHumans()?></span>
                                    </a>

                                    <span class="text-muted"><?=substr($model->subject, 0,30);?>, <?=substr($model->content, 0,70);?>...</span>
                                </div>
                            </li>
                             <?php endforeach;?>

                            
                            

                            
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>






 <?php endif;?>