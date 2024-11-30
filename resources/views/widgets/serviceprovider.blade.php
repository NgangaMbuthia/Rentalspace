              <ul>
                <?php foreach($service_providers as $service):?>
                  <li>
                    <a href="<?=url('/application/service-provider/details/'.$service->id)?>">
                    <span class="img"><img src="{{asset('/siteAssets/assets/user-avatar.png')}}" alt=""></span>
                    <span class="title"><?=$service->user->name;?>,<?=$service->type?></span></a>
                    </li>
                <?php endforeach;?>
                  </ul>