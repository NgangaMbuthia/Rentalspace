<?php

use App\Helpers\Helper;
?>

@extends('layout.main_sidebar')

@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/profile/update')?>">Account Managemnt</a></li>
       
        <li class="active">Profile</li>
  </ul>

@stop
@section('content')
<div>
 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Account Profile</h6>
                                </div>
                                
                            <div class="panel-body">
                            <div class="col-md-12">
                <form action="<?=url('/admin/profile/store')?>" method="POST" enctype="multipart/form-data">

                             <?=csrf_field();?>
                            <div class="row">
                            <div class="col-md-4 form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control"  required value="<?=$user->name;?>" />
                            </div>

                            <div class="col-md-4 form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="Email Address" class="form-control"  required value="<?=$user->email;?>" />
                            </div>
                            <div class="col-md-4 form-group">
                            <label>Telephone</label>
                            <input type="text" name="telephone" placeholder="Mobile Number" class="form-control"  required value="<?=$user->profile->telephone?>" />
                            </div>
                            </div>


                            <div class="row">
                            

                            <div class="col-md-4 form-group">
                            <label>ID /Passport Number</label>
                            <input type="text" name="id_number" placeholder="ID Number" class="form-control"  required value="<?=$user->profile->id_number;?>" />
                            </div>
                            <div class="col-md-4 form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                            </div>
                            <div class="col-md-4 form-group">
                                    <label>Postal Address</label>
                                    <input type="text" name="postal_address" placeholder="postal Address" class="form-control" required value="<?=$user->profile->postal_address?>" />
                                                   
                                                </div>
                            </div>

                            <div class="row">
                            

                            <div class="col-md-4 form-group">
                            <label>Country</label>
                            <input type="text" name="country" placeholder="Country" class="form-control"  required value="<?=$user->profile->id_number;?>" />
                            </div>
                            <div class="col-md-4 form-group">
                            <label>City</label>
                           <input type="text" name="city" placeholder="London" class="form-control"  required value="<?=$user->profile->city?>">
                            </div>
                            <div class="col-md-4 form-group">
                                    <label>Street</label>
                                    <input type="text" name="postal_address" placeholder="postal Address" class="form-control" required value="<?=$user->profile->postal_address?>" />
                                                   
                                                </div>
                            </div>
                            
                              <div class="row">

                              <div class="col-md-4 form-group" > 
                                        <label>Profile Photo</label>
                                          
                                           <div class="profile-image" >

                              <?php if(isset($user->avatar)):?>
                                <img src="<?=Helper::getFileUrl();?>" alt="djdhjdh" id="thumbnil"   width="150px" height="175px"  style="border-radius:5%;" />
                            
                        <?php else:?>
                         <img  src="{{asset('/assets/images/k.png')}}"  width="150px" height="175px"    style="border-radius:5%;" id="thumbnil" />
                        <?php endif;?>
                            
                        </div>
                        <!-- end profile-image -->
                        <div class="m-b-8">
                            <a class="icon-pencil" data-toggle="modal" id="uploadmodal">Change Picture</a>
                            <div class="hidden change-picture">
                               <input style="margin-top:2%;" type="file" name="avatar" class="" id="gallery-photo-add"    accept="image/*"  onchange="showMyImage(this)" />

                            </div>
                        </div>
                                            
                        </div>


                              </div>
                              <div class="row">
                              <button class="btn btn-primary">Update Profiile</button>
                                  

                              </div>




                            </form>
                                

                            </div>


                                                     
							
	
		
				
				
				
				
		</div>

		
		</div>
	</div>


	        
                           

@stop
@push('scripts')

	
   <script type="text/javascript">
     $("#uploadmodal").on("click",function(e){
        e.preventDefault();
        $(".change-picture").removeClass("hidden");
        $("#uploadmodal").addClass("hidden");


     });
       function showMyImage(fileInput) {
        
            $("#thumbnil").css({'color': 'Black',
                         'height':'175px',
                         'width':'160px',
                         'font-size':'24px',
                        

                       });

        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
	
	

	   
  </script>





@endpush