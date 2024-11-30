@extends('front.main')
@section('breadcrumb')
<!-- Breadcrumb -->
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Property Listing</li>
            </ol>
        </div>
        <!-- end Breadcrumb -->
@stop
@section('content')




<div style="clear: both;"></div>
                    <section id="results">
                        <header><h1>Service Provider Registration</h1></header>
                        
                        

                        <section id="properties">
                        <form action="<?=$url?>" method="post">
                            
                         <?=csrf_field();?>
                        
                        <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>Name</label>
                         <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Email Address</label>
                         <input type="text" name="email" class="form-control">
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>ID Number/Passport</label>
                         <input type="text" name="id_number" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Telephone</label>
                         <input type="text" name="telephone" class="form-control">
                        </div>
                        </div>

                         <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>Nationality</label>
                         <input type="text" name="nationality" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Resident Country</label>
                         <input type="text" name="current_country" class="form-control">
                        </div>
                        </div>



                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>Location</label>
                         <input type="text" name="location" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Town</label>
                         <input type="text" name="town" class="form-control">
                        </div>
                        </div>



                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>Postal Address</label>
                         <input type="text" name="postal_address" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Type</label>
                        <select class="form-group" name="type">
                            <option>Electrician</option>
                            <option>Carpenter</option>
                            <option>Mason</option>
                            <option>Plumber</option>
                            <option>Welder</option>
                            <option>Glazer</option>
                            <option>Plasterer</option>
                            <option>Painter</option>
                            <option>Roofing</option>
                             <option>Interior Designer</option>
                        </select>
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>1st Referee</label>
                         <input type="text" name="first_ref" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Telephone</label>
                         <input type="text" name="ref_one_phone" class="form-control">
                        </div>
                        </div>


                        <div class="col-md-12">
                        <div class="col-md-6 form-group">
                         <label>2nd Referee</label>
                         <input type="text" name="second_ref" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                         <label>Telephone</label>
                         <input type="text" name="ref_two_phone" class="form-control">
                        </div>
                        
                        
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-6 form-group pull-right">
                        <button class="btn btn-info">Submit</button>

                        </div>
                        </div>



                         


                        

                         

                          


                       




                          
                        </div><!-- /.row-->
                        

              </form>
                       
                      

                      

                        </section><!-- /#properties-->
                    </section><!-- /#results -->

@endsection
