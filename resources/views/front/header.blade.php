    <!-- Navigation -->
    <div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact">

                   <figure><strong>Phone:</strong>+254 719-289-389, +254 708-236-804</figure>
                    <figure><strong>Email:</strong>info@qooetu.com</figure>
                </div>
                <div class="user-area">
                    <div class="actions">
                        
                        <a href="create-account.html" class="promoted"><strong>Buy Modules</strong></a>
                        <a href="<?=url('/login');?>">Sign In</a>

                    
                </div>
                <div class="user-area">
                    
                    <div class="language-bar">
                        <a href="#" class="active"><img src="{{ asset('front/assets/img/flags/gb.png')}}" alt=""></a>
                        <!-- <a href="#"><img src="{{ asset('front/assets/img/flags/de.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('front/assets/img/flags/es.png')}}" alt=""></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <header class="navbar" id="top" role="banner">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand nav" id="brand">
                        <a href="index-google-map-fullscreen.html"><img src="{{ asset('front/assets/img/logo.png')}}" alt="brand"></a>
                    </div>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                    <ul class="nav navbar-nav">
                        <li><a href="<?=url('/application');?>">Home</a></li>
                        <li><a href="contact.html">Properties</a></li>
                        
                        

                        <li class="has-child"><a href="#">Agents & Agencies</a>
                            <ul class="child-navigation">
                                <li><a href="agents-listing.html">Agents Listing</a></li>
                                <li><a href="agent-detail.html">Agent Detail</a></li>
                                <li><a href="agencies-listing.html">Agencies Listing</a></li>
                                <li><a href="agency-detail.html">Agency Detail</a></li>
                            </ul>
                        </li>

                        <li class="has-child"><a href="#">Hotel Rooms</a>


                       

                            <ul class="child-navigation">
                                <li><a href="about-us.html">Available Hotels</a></li>
                                <li><a href="about-us.html">Conference Facilities</a></li>
                                <li><a href="agent-detail.html">Register As Service Provider</a></li>
                                
                                <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                               
                            </ul>
                        </li>

                        <li class="has-child"><a href="#">Plots and Lands</a>
                            <ul class="child-navigation">
                                <li><a href="about-us.html">Available Hotels</a></li>
                                <li><a href="about-us.html">Conference Facilities</a></li>
                                
                               
                            </ul>

                        </li>
                       
                        
                       

                        <!-- <li><a href="submit.html">Submit</a></li> -->
                        <li class="has-child"><a href="#">Company</a>
                            <ul class="child-navigation">
                                <li><a href="{{url('/about')}}">About</a></li>
                                <li><a href="{{url('/services')}}">Services</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>


                    </ul>
                </nav><!-- /.navbar collapse-->
                <div class="add-your-property">
                    <a href="submit.html" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">Add Your Property</span></a>
                </div>
            </header><!-- /.navbar -->
        </div><!-- /.container -->
    </div><!-- /.navigation -->
    <!-- end Navigation -->
    </div>