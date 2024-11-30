<?php
use App\Helpers\Helper;
?><!-- Main navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">

            <a class="navbar-brand" href="<?=url('home')?>"><img src="{{asset('logo_white.png')}}" alt="Real" style="height: 30px;"></a>


            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>
<div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                
                @widget('notification',['count' => 6,'type'=>'notification'])

            </ul>

            <p class="navbar-text"><span class="label bg-success">Online</span></p>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/images/flags/gb.png')}}" class="position-left" alt="">
                        English
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu ">
                        <li><a class="deutsch"><img src="{{ asset('assets/images/flags/de.png')}}" alt=""> Swahili</a></li>
                        <li class="hidden"><a class="ukrainian"><img src="{{ asset('assets/images/flags/ua.png')}}" alt=""> Українська</a></li>
                        <li><a class="english"><img src="{{ asset('assets/images/flags/gb.png')}}" alt=""> English</a></li>
                        <li  class="hidden"><a class="espana"><img src="{{ asset('assets/images/flags/es.png')}}" alt=""> España</a></li>
                        <li  class="hidden"><a class="russian"><img src="{{ asset('assets/images/flags/ru.png')}}" alt=""> Русский</a></li>
                    </ul>
                </li>

                 @widget('notification',['count' => 4,'type'=>'message'])

                

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                     <?php if(isset(auth::user()->avatar)):?>
                        <img src="<?=Helper::getFileUrl();?>" alt="" class="img-circle img-sm">
                     <?php else:?>

                     <img src="{{asset('/assets/images/k.png')}}" alt="" class="img-circle img-sm">

                     <?php endif;?>
                        <?php if(Entrust::hasRole("Provider")):?>
                        <span><?=\Auth::User()->getprovider->name;?></span>
                    <?php else:?>
                      <span><?=\Auth::User()->name;?></span>
                    <?php endif;?>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                      <?php if(Entrust::hasRole("Admin")):?>
                        <li><a href="<?=url('admin/profile/update')?>"><i class="icon-user-plus"></i> My profile</a></li>

                      <?php elseif(Entrust::hasRole("serviceProvider")):?>

                        <li><a href="<?=url('serviceproviders/profile/update')?>"><i class="icon-user-plus"></i> My profile</a></li>



                      <?php endif;?>
                         <?php if(Entrust::hasRole("Provider")):?>
                        <li><a href="<?=url('/backend/provider/account')?>"><i class="icon-coins"></i> My balance</a></li>
                          <?php else:?>
                         <li><a href="#"><i class="icon-coins"></i> My balance</a></li>

                          <?php endif;?>
                        <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=url('/account/settings')?>"><i class="icon-cog5"></i> Account settings</a></li>
                          <li><a href="<?=url('admin/profile/update')?>"><i class="icon-user-plus"></i>Accont profile</a></li>
                        <li><a href="<?=url('/logout')?>"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->
