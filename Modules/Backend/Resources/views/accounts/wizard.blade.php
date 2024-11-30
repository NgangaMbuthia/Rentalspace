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
  <h4>Welcome <?=$model->name?> !</h4>
    <strong>You need to complete your account profile for you to use this backend effectively.The information captured  is treated as private and confidential.Also your product activation key will be required at this stage.Incase you  haven't received it,Kindly contact 0708236804</strong>

  
</div>

<div class="panel panel-white">
  <div class="panel-heading">
    <h6 class="panel-title"><i class="icon-users position-left"></i>Agent/Landload Account Configuration Stage</h6>
  </div>

  <div class="panel-body">





    <form   class="stepy-validation" role="form" action="<?=$url;?>"  method="post">
      <fieldset title="1">
        <legend class="text-semibold">Product Activation</legend>
        {{csrf_field()}}

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Product Key</label>
            <input type="text" name="auth_key" class="form-control" placeholder="Auth Key" required value="{{old('auth_key')}}">
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif

            </div>
          </div>
        </div>
        <div class="clearfix"></div>
</fieldset>


 <fieldset title="2">
        <legend class="text-semibold">Genaral Details</legend>
      

        <div class="row">
          <div class="col-md-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Business Name</label>
            <input type="text" name="name" class="form-control" placeholder="Auth Key" required value="<?=$model->name?>">
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
            <input type="text" name="email" class="form-control" placeholder="Business Email Address" required value="<?=$model->email?>">
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
              <label>Postal Address</label>
            <input type="text" name="postal_address" class="form-control" placeholder="Postal Address" required value="<?=$model->postal_address?>">
              @if ($errors->has('postal_address'))
              <span class="help-block">
                <strong>{{ $errors->first('postal_address') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Telephone</label>
            <input type="text" name="telephone" class="form-control" placeholder="Business Telephone" required value="<?=$model->telephone?>">
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
            <input type="text" name="town" class="form-control" placeholder="Town" required value="<?=$model->town?>">
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
            <input type="text" name="street" class="form-control" placeholder="Street" required value="<?=$model->street?>">
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
            <div class="form-group {{ $errors->has('building') ? ' has-error' : '' }}">
              <label>Building</label>
            <input type="text" name="building" class="form-control" placeholder="Building" required value="<?=$model->building?>">
              @if ($errors->has('building'))
              <span class="help-block">
                <strong>{{ $errors->first('building') }}</strong>
              </span>
              @endif

            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <label>Website</label>
            <input type="text" name="website" class="form-control" placeholder="Street" required value="<?=$model->website?>">
              @if ($errors->has('website'))
              <span class="help-block">
                <strong>{{ $errors->first('website') }}</strong>
              </span>
              @endif

            </div>
          </div>
            
          </div>
             
             
         
          
       </div>
 

 <div class="clearfix"></div>
</fieldset>

 <fieldset title="3">
        <legend class="text-semibold">SMS Settings</legend>
        

        <div class="row">
          <div class="col-md-6 form-group">
                              <label>SMS Provider</label>
                              <input type="text" name="sms_provider" class="form-control" value="<?=$model->sms_provider?>">
                              
                             </div>
                              <div class="col-md-6 form-group">
                              <label>Sender Name</label>
                              <input type="text" name="sms_sender_name" class="form-control" value="<?=$model->sms_sender_name?>">
                              
                             </div>
                             <div class="col-md-12 form-group">
                              <label>API URL</label>
                              <input type="text" name="sms_api_url" class="form-control" value="<?=$model->sms_api_url?>">
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>API PassKey</label>
                              <input type="text" name="passkey" class="form-control" value="<?=$model->passkey?>">
                              
                             </div>
        </div>
        <div class="clearfix"></div>
</fieldset>

 <fieldset title="4">
        <legend class="text-semibold">Emails Settings</legend>
        

        <div class="row">
           <div class="col-md-12 form-group">
                              <label>Account Main Email</label>
                              <input type="text" name="email" class="form-control" value="<?=$model->email?>" required>
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>Altenative Email(To be used for CC)</label>
                              <input type="text" name="altenative_email" class="form-control" value="<?=$model->altenative_email?>">
                              
                             </div>
                             <div class="col-md-12 form-group">
                              <label>Reply To Email</label>
                              <input type="text" name="reply_email" class="form-control" value="<?=$model->reply_email?>">
                              
                             </div>
        </div>
        <div class="clearfix"></div>
</fieldset>

 <fieldset title="5">
        <legend class="text-semibold">Invoice Settings</legend>
        

        <div class="row">
            <div class="col-md-12 form-group">
                              <label>Invoice Send Day</label>
                              <select name="invoice_send_day" class="form-control">
                                 <?php for($i=1;$i<=31;$i++):?>
                                           <option><?=$i;?></option>
                                 <?php endfor;?>

                                
                              </select>
                             
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>Invoice Send Time</label>
                              <input type="text" name="invoice_send_time" class="form-control timepicker" value="<?=$model->invoice_send_time?>" id="setTimeExample">
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>Encrypt Invioce That are Emailed</label>
                              <select name="encrypt_invoice" class="form-control" id="encrypt">
                                <option value="">--Select option---</option>
                                <option <?php if($model->encrypt_invoice=="Yes"):?>selected <?php endif;?>>Yes</option>
                                <option <?php if($model->encrypt_invoice=="No"):?>selected <?php endif;?> >No</option>
                              </select>
                              
                             </div>
                              <div class="col-md-12 form-group hidden method">
                              <label>Encrypt Method</label>
                              <select name="method" class="form-control "  id="method">
                                <option value="">---Select One---</option>
                                <option <?php if($model->method=="Telephone"):?>selected <?php endif;?> value="Telephone">Tenant Phone</option>
                                <option <?php if($model->method=="IDNumber"):?>selected <?php endif;?>  value="IDNumber">Tenant ID/Company Number</option>
                                <option <?php if($model->method=="System"):?>selected <?php endif;?>  value="System">System Generated</option>
                              </select>
                              
                             </div>
        </div>
        <div class="clearfix"></div>
</fieldset>



  <fieldset title="6">
                                <legend class="text-semibold">Utility Bills</legend>
                                


                        
                        <div class="row">
                             <div class="col-md-12 form-group">
                              <label>Water Unit Price</label>
                              <input type="text" name="unit_price_water" class="form-control" value="<?=$model->unit_price_water ?>" required>
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>Electricity Unit Price</label>
                              <input type="text" name="unit_price_electricity" class="form-control" value="<?=$model->unit_price_electricity?>">
                              
                             </div>
                              <div class="col-md-12 form-group">
                              <label>Garbage Collection</label>
                              <input type="text" name="gabbage_collection" class="form-control" value="<?=$model->gabbage_collection?>">
                              
                             </div>

                            
                        </div>

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

    var value="<?=$model->encrypt_invoice?>";
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