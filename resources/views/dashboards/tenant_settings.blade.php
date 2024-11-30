@extends('layout.wizard')

@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        
        <li class="active">Product Activation</li>
  </ul>

@stop
@section('content')

	 <div class="panel panel-white">
			<div class="panel-heading">
				<h6 class="panel-title"><i class="icon-shrink position-left"></i>Product Details</h6>
			</div>
			
		<div class="panel-body">

		 <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                      <li class="active"><a href="#highlighted-justified-tab1" data-toggle="tab">General Details</a></li>
                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Subscribed Modules</a></li>
                       <li><a href="#highlighted-justified-tab3" data-toggle="tab">SMS Settings</a></li>


                       <li><a href="#highlighted-justified-tab4" data-toggle="tab">Emails Settings</a></li>
                       <li><a href="#highlighted-justified-tab5" data-toggle="tab">Invoice Settings</a></li>
                         <li><a href="#highlighted-justified-tab6" data-toggle="tab">Utility Settings</a></li>



                      <li><a href="#highlighted-justified-tab2" data-toggle="tab">Password Reset</a></li>
                     
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane active" id="highlighted-justified-tab1">
                      <form action="<?=url('provider/update/'.$model->id)?>" method="post">
		   <div class="text-center">
			<div class="icon-object border-success text-success"><i class="icon-user-lock"></i></div>
			<h5 class="content-group-lg"> Provider Account Details <small class="display-block">Limited to this Account Only</small></h5>
		   </div>

										<div class="form-group has-feedback {{ $errors->has('auth_key') ? ' has-error' : '' }}">
											<label>Authorization Key</label>

											<input type="text" name="auth_key" class="form-control" placeholder="Auth Key" readonly="true" value="<?=$model->auth_key?>">

			                                @if ($errors->has('auth_key'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('auth_key') }}</strong>
			                                    </span>
			                                @endif
											<div class="form-control-feedback">

												<i class="icon-key text-muted"></i>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('provider_name') ? ' has-error' : '' }}">
												<label>Business Name</label>
													<input type="text" class="form-control"  name="provider_name" placeholder=" Business name" value="{{$model->name}}">
													 @if ($errors->has('provider_name'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('provider_name') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-user-check text-muted"></i>
													</div>
												</div>
											</div>

											 <div class="col-md-6">
											  <label>Email Address</label>
												<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
													<input type="email" class="form-control" placeholder="Business email" name="email" value="{{$model->email}}">
														@if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-envelop text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										

										<div class="row">
											<div class="col-md-6">
											  <label>Postal  Address</label>
												<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
													<input type="text" class="form-control" placeholder="BUsiness Postal Address" name="postal_address" value="{{$model->postal_address}}">
														@if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-envelop text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
												<label>Telephone</label>
													<input type="text" class="form-control" placeholder="Telephone/Mobile Number" name="phone" value="{{$model->telephone}}">
														@if ($errors->has('phone'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('phone') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-phone text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
											  <label>Street</label>
												<div class="form-group has-feedback {{ $errors->has('postal_address') ? ' has-error' : '' }}">
													<input type="text" class="form-control" placeholder="Street" name="street"  value="{{$model->street}}" >
														@if ($errors->has('postal_address'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('postal_address') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-map text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('town') ? ' has-error' : '' }}">
												<label>Town</label>
													<input type="text" class="form-control" placeholder="Town" name="town" value="{{$model->town}}">
														@if ($errors->has('town'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('town') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-city text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
											  <label>Building</label>
												<div class="form-group has-feedback {{ $errors->has('postal_address') ? ' has-error' : '' }}">
													<input type="text" class="form-control" placeholder="Building" name="building"  value="{{$model->building}}"  required>
														@if ($errors->has('postal_address'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('postal_address') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-map text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('town') ? ' has-error' : '' }}">
												<label>Website</label>
													<input type="text" class="form-control" placeholder="Website" name="website" value="{{$model->website}}">
														@if ($errors->has('website'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('website') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-station text-muted"></i>
													</div>
												</div>
											</div>
										</div>




										<div class="row">
											<div class="col-md-6">
											  <label>License Expiry Date</label>
												<div class="form-group has-feedback {{ $errors->has('postal_address') ? ' has-error' : '' }}">
													<input type="text" class="form-control" placeholder="Street"  value="{{$model->expiry_date}}" readonly>
														@if ($errors->has('postal_address'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('postal_address') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-calendar5 text-muted"></i>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group has-feedback {{ $errors->has('town') ? ' has-error' : '' }}">
												<label>No of Users</label>
													<input type="text" class="form-control" placeholder="No OF Users" value="{{$model->no_of_users}}" readonly>
														@if ($errors->has('town'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('town') }}</strong>
			                                    </span>
			                                   @endif
													<div class="form-control-feedback">
														<i class="icon-people text-muted"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="text-right">
											{{csrf_field()}}
											<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Update</button>
										</div>
										</form>


                      </div>
                       <div class="tab-pane" id="highlighted-justified-tab6">
                       	<div class="col-md-12">
                       		<h5>Utility Bill Congifurations </h5>
                       		<form action="<?=url('/account/utility_settings')?>" method="post">
                       			 <?=csrf_field();?>

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
                       			
                       			   <div class="col-md-12 form-group">
                       			   	<button class="btn btn-primary">Save Details</button>

                       			   </div>


                       		</form>



                       	</div>

                       </div>
                       <div class="tab-pane" id="highlighted-justified-tab4">
                       	<div class="col-md-12">
                       		<h5>Provider  Email Congifurations </h5>
                       		<form action="<?=url('/account/email_settings')?>" method="post">
                       			 <?=csrf_field();?>

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
                       			   <div class="col-md-12 form-group">
                       			   	<button class="btn btn-primary">Save Details</button>

                       			   </div>


                       		</form>



                       	</div>

                       </div>

                       <div class="tab-pane" id="highlighted-justified-tab3">
                       	<div class="col-md-12">
                       		<h5>Provider  Sms Congifurations </h5>

                       		<form action="<?=url('/account/sms_settings')?>" method="post">
                       			 <?=csrf_field();?>
                       			 <div class="col-md-12 form-group">
                       			 	<label>SMS Provider</label>
                       			 	<input type="text" name="sms_provider" class="form-control" value="<?=$model->sms_provider?>">
                       			 	
                       			 </div>
                       			  <div class="col-md-12 form-group">
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
                       			   <div class="col-md-12 form-group">
                       			   	<button class="btn btn-primary">Save Details</button>

                       			   </div>

                       			

                       		</form>


                       	</div>




                       </div>

                        <div class="tab-pane" id="highlighted-justified-tab5">
                       	<div class="col-md-12">
                       		<h5>Provider  Invoice Congifurations </h5>
                       		<form action="<?=url('/account/invoice_settings')?>" method="post">
                       			 <?=csrf_field();?>

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
                       			   <div class="col-md-12 form-group">
                       			   	<button class="btn btn-primary">Save Details</button>

                       			   </div>


                       		</form>



                       	</div>

                       </div>

                       <div class="tab-pane" id="highlighted-justified-tab2">

                       <div class="col-md-12">
                       <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                        <thead>
                        <tr class="success">
                        <th>#</th>
                        <th>Module</th>
                        <th>Date Subscribed</th>
                        <th>Amount</th>
                        <th>Last Renewed On</th>
                        <th>Current Status</th>
                        	

                        </tr>
                        	
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($modules as $key):?>
                        <tr>
                        <td><?=$i;?></td>
                        <td><?=$key->module->name;?></td>
                        <td><?=$key->date_subscribed;?></td>
                        <td><?=$key->amount?></td>
                        <td><?=$key->last_renewed_on;?></td>
                        <td><?=$key->status;?></td>
                        	

                        </tr>


                        <?php $i++; endforeach;?>
                        	
                        </tbody>
                        	

                        </table>
                       	

                       </div>
                       	


                       </div>


                       </div>
                     </div>

               </div>


		


		</div>
   </div>
    


 @stop
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