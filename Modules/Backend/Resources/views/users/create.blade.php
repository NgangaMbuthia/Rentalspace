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
<div class="alert alert-info">
  <h4>Hello <?=$user->name?> !</h4>
    <strong>You need to complete your account profile for you to use this backend effectively.The information captured  is treated as private and confidential.Kindly Provide <strong> <b>Avalid email address</b></strong>  to facilite system invoicing</strong>

  
</div>

<div class="panel panel-white">
  <div class="panel-heading">
    <h6 class="panel-title"><i class="icon-users position-left"></i>Tenant Account Configuration</h6>
  </div>

  <div class="panel-body">





    <form   class="stepy-validation" role="form" action="<?=$url;?>"  method="post">
        {{csrf_field()}}
      


 <fieldset title="2">
        <legend class="text-semibold">Genaral Details</legend>
      

        <div class="row">
          <div class="col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Full Name" required value="<?=$user->name?>">
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Email Address" required value="<?=$user->email?>">
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif

            </div>
          </div>
            
          </div>

           <div class="col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required value="<?=$user->username?>" required>
              @if ($errors->has('username'))
              <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Telephone</label>
            <input type="text" name="telephone" class="form-control" placeholder="Telephone" required value="<?=$user->profile->telephone?>" required>
              @if ($errors->has('telephone'))
              <span class="help-block">
                <strong>{{ $errors->first('telephone') }}</strong>
              </span>
              @endif

            </div>
          </div>
            
          </div>

             <div class="col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Town</label>
            <input type="text" name="town" class="form-control" placeholder="Town" required value="<?=$user->profile->city?>">
              @if ($errors->has('town'))
              <span class="help-block">
                <strong>{{ $errors->first('town') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Street</label>
            <input type="text" name="street" class="form-control" placeholder="Street" required value="<?=$user->profile->street?>">
              @if ($errors->has('street'))
              <span class="help-block">
                <strong>{{ $errors->first('street') }}</strong>
              </span>
              @endif

            </div>
          </div>
            
          </div>

            <div class="col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>ID/Passport/Company Registration Number</label>
            <input type="text" name="id_number" class="form-control" placeholder="ID Number" required value="<?=$user->profile->id_number?>">
              @if ($errors->has('id_number'))
              <span class="help-block">
                <strong>{{ $errors->first('id_number') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Gender</label>
         <select name="gender" class="form-control" required>
          <option value="">--Select Gender---</option>
          <option>Male</option>
          <option>Female</option>
           
         </select>
              @if ($errors->has('street'))
              <span class="help-block">
                <strong>{{ $errors->first('street') }}</strong>
              </span>
              @endif

            </div>
          </div>
            
          </div>

            
             
             
         
          
       </div>
 

 <div class="clearfix"></div>
</fieldset>

 <fieldset title="3">
        <legend class="text-semibold">Emergecy Contacts</legend>
        

        <div class="row">
          <div class="col-md-6 form-group">
                              <label>Name</label>
                              <input type="text" name="emargecy_name" class="form-control">
                              
                             </div>
                              <div class="col-md-6 form-group">
                              <label>Relationship</label>
                             <select name="relationship" class="form-control" required>
                              <option value="">---Select relationship---</option>
                              <option>Brother</option>
                              <option>Sister</option>
                              <option>Parent</option>
                              <option>Spouse</option>
                              <option>Guardian</option>
                              <option>Business Patner</option>
                              <option>Workmate</option>
                               
                             </select>
                              
                             </div>
                             <div class="col-md-6 form-group">
                              <label>Telephone</label>
                              <input type="text" name="emergency_phone" class="form-control" >
                              
                             </div>
                              <div class="col-md-6 form-group">
                              <label>Email Address</label>
                              <input type="email" name="emergency_email" class="form-control" >
                              
                             </div>
        </div>
        <div class="clearfix"></div>
</fieldset>








      <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
    </form>

  </div>
</div>









@endsection

@push('scripts')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript" src="{{asset('/js/jquery.timepicker.js')}}"></script>
 <link rel="stylesheet" type="text/css" href="{{asset('/js/jquery.timepicker.css')}}" />
 <script type="text/javascript">

   $("#encrypt").on("change",function(e){
    e.preventDefault();
    var value=$(this).val();
     if(value=="Yes")
     {
      $(".method").removeClass("hidden");
      $("#method").attr("required",true);

     }else{
      $(".method").addClass("hidden");
      $("#method").attr("required",false);
     }

   });


    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });

    $('#setTimeExample').timepicker({ 'timeFormat': 'H:i:s' });

    var value="<?=$user->encrypt_invoice?>";
      if(value=="Yes")
     {
      $(".method").removeClass("hidden");
      $("#method").attr("required",true);

     }else{
      $(".method").addClass("hidden");
      $("#method").attr("required",false);
     }
  

 </script>


 @endpush