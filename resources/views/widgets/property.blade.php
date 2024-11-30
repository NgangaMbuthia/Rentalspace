 <?php
 use App\Helpers\Helper;
 ?>

 <ul class="properties-list">
              <?php foreach($properties as $property):?>
                    <li class="eq slide">
                        <div class="img">
                            <a href="">
                            <img src="<?=Helper::getPropertyCoverImage($property->id)?>" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency"><?=$property->currency?></span>
                                720,000
                            </div>
                            <div class="location">
                             <?=$property->title;?>
                             <?=$property->location;?>
                                
                            </div>
                            <div class="properties">
                                <ul>
                                     <li><?=$property->type;?> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                     <?php endforeach;?>
                    
                   
                   
                </ul>