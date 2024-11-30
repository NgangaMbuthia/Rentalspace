@extends('layout.wizard')
@section('header')
<div class="heading-elements">
  <div class="heading-btn-group">
    <a href="<?=url()->current();?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Account</span></a>
    <a href="<?=url()->current();?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Profile</span></a>

  </div>
</div>
@stop
@section('breadcrumb')

<ol class="breadcrumb pull-left">
 <li><a href="#">Home</a></li>
 <li><a href="<?=url()->current();?>"></span>Account</a></li>
 <li class="active">Profile</li>
</ol>
<ul class="breadcrumb-elements">
  <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="icon-gear position-left"></i>
      Settings
      <span class="caret"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-right">
      <li><a href="<?=url('/account/settings')?>"><i class="icon-user-lock"></i> Account security</a></li>
      <li><a href="<?=url('/backend/property/statistics')?>"><i class="icon-statistics"></i> Analytics</a></li>
      <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i> Accessibility</a></li>
      <li class="divider"></li>
      <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
    </ul>
  </li>
</ul>

@stop

@section('content')
<div class="alert alert-warning">
  <h4>Dear <?=$model->name?> </h4>
   Your account has been <?=$model->status?> because of the following reason<p>
      <strong>  {!!$model->reason!!} </strong><p>


    Kindly contact 0708236804

  
</div>



@stop