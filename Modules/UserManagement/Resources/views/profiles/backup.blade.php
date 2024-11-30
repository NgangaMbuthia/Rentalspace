@extends('layout.main')

@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Management</a></li>
				<li><a href="javascript:;">List View</a></li>
				<li class="active">Add New User</li>
</ol>
@stop
@section('content')
<div class="row"> 
	<div class="panel panel-info" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                               
                            </div>
                            <h4 class="panel-title">User Account Setup Wizard</h4>
                        </div>
                        <div class="panel-body">

                                                     <form action="<?=url('/admin/profile/store')?>" method="POST" data-parsley-validate="true" name="form-wizard">
								<div id="wizard">
									<ol>
										<li>
										    Identification 
										    <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small>
										</li>
										<li>
										    Contact Information
										    <small>Tell us how we can contact you</small>
										</li>
										<li>
										    Location Information
										    <small>Tell us how we can contact you </small>
										</li>
										<li>
										   Profile
										    <small>Provide a passport size photo that will be used as your avatar.</small>
										</li>
									</ol>
									<!-- begin wizard step-1 -->
									<div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">Identification</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">

                                                     {{ csrf_field() }}
													<div class="form-group block1">
														<label>Full Name</label>
														<input type="text" name="name" placeholder="Name" class="form-control" data-parsley-group="wizard-step-1" required value="<?=$user->name;?>" />
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>ID/Passport Number</label>
														<input type="text" name="id_number" placeholder="1234567" class="form-control" data-parsley-group="wizard-step-1" 
                                                        data-parsley-type="number" 
														required value="<?=$user->profile->id_number;?>"/>
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Gender</label>
														<select name="gender" class="form-control" data-parsley-group="wizard-step-1" required>
														<option>Male</option>
														<option>Female</option>
															

														</select>
														
													</div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-1 -->
									<!-- begin wizard step-2 -->
									<div class="wizard-step-2">
										<fieldset>
											<legend class="pull-left width-full">Contact Information</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Phone Number</label>
														<input type="text" name="telephone" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="number" required value="<?=$user->profile->telephone?>" />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Email Address</label>
														<input type="email" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="email" required  value="<?=$user->email?>"/>
													</div>
                                                </div>
                                                <div class="col-md-4">
													<div class="form-group">
														<label>Postal Address</label>
														<input type="text" name="postal_address" placeholder="4296-30200" class="form-control" data-parsley-group="wizard-step-2"  required value="<?=$user->profile->postal_address?>" />
													</div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
										</fieldset>
									</div>
									<!-- end wizard step-2 -->
									<!-- begin wizard step-3 -->
									<div class="wizard-step-3">
										<fieldset>
											<legend class="pull-left width-full">Location Information</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <div class="controls">
                                                            <input type="text" name="country" placeholder="Britain" class="form-control" data-parsley-group="wizard-step-3" required value="<?=$user->profile->country?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <div class="controls">
                                                            <input type="text" name="city" placeholder="London" class="form-control" data-parsley-group="wizard-step-3" required 
                                                            value="<?=$user->profile->city?>"

                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Timezone</label>
                                                        <div class="controls">
                                                            <input type="text" name="timezone" placeholder="Timezone" class="form-control" value="<?=$user->profile->timezone?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                        </fieldset>
									</div>
									<!-- end wizard step-3 -->
									<!-- begin wizard step-4 -->
									<div>
									    <div class="row text-center">
									    
									    <p>
									    <div class="col-md-2" style="margin-left:30%;"> 
									         <h3>Profile Photo</h3>
									       <p>
									       <div class="profile-image" id="thumbnil">

                            <img id="imagefile" src="{{asset('/assets/img/k.png')}}"   width="225" height="225" />
                            <i class="fa fa-user hide"></i>
                        </div>
                        <!-- end profile-image -->
                        <div class="m-b-10">
                            <a href="#modal-message" class="btn btn-warning btn-block btn-sm" data-toggle="modal" id="uploadmodal">Change Picture</a>
                            <div class="hidden change-picture">
                                <input type="hidden" name="fileid" id="filename" value='' />

                            </div>
                        </div>
									    	
						</div>
                                            
                                           
                                            <p><button class="btn btn-success btn-lg" role="submit" >Save Details</button></p>
                                        </div>
									</div>
									<!-- end wizard step-4 -->
								</div>
							</form>
	
		
				
				
				
				
		</div>

		
		</div>
	</div>


	        <!-- #modal-message -->
                            <div class="modal modal-message fade" id="modal-message">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Modal Message Header</h4>
                                        </div>
                                        <div class="modal-body">
                                             <form id="fileupload" action="{{url('/file/upload')}}" method="POST" enctype="multipart/form-data">
                                                <div class="row fileupload-buttonbar">
                                                    <div class="col-md-7">
                                                        <span class="btn btn-success fileinput-button">
                                                            <i class="fa fa-plus"></i>
                                                            <span>Add files...</span>
                                                            <input type="file" name="files[]" multiple>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary start">
                                                            <i class="fa fa-upload"></i>
                                                            <span>Start upload</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning cancel">
                                                            <i class="fa fa-ban"></i>
                                                            <span>Cancel upload</span>
                                                        </button>
                                                        <button type="button" class="btn btn-danger delete">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                        <!-- The global file processing state -->
                                                        <span class="fileupload-process"></span>
                                                    </div>
                                                    <!-- The global progress state -->
                                                    <div class="col-md-5 fileupload-progress fade">
                                                        <!-- The global progress bar -->
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                        </div>
                                                        <!-- The extended global progress state -->
                                                        <div class="progress-extended">&nbsp;</div>
                                                    </div>
                                                </div>
                                                <!-- The table listing the files available for upload/download -->
                                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn btn-sm btn-primary">Save Changes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

@stop
@push('scripts')

	<link href="{{ asset('/assets/plugins/bootstrap-wizard/css/bwizard.min.css')}}" rel="stylesheet" id="theme" />
	<link href="{{ asset('/assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" id="theme" />

   <script src="{{ asset ('/assets/plugins/parsley/dist/parsley.js') }}" type="text/javascript"></script>
	<script src="{{ asset ('/assets/plugins/bootstrap-wizard/js/bwizard.js') }}" type="text/javascript"></script>

	<script src="{{ asset ('/assets/js/form-wizards-validation.demo.min.js') }}" type="text/javascript"></script>
   <script type="text/javascript">
	
	$(document).ready(function() {
			FormWizardValidation.init();

    });


	   
  </script>





@endpush