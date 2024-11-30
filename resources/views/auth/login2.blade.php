<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Qooetu</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/siteAssets/css/base.min.css')}}">
</head>
<body>
<div class="container page">
    
        <div class="top-section">
            <div class="wrap row">
            <div class="logo"><a href="<?=url('/application')?>"><img src="{{asset('/siteAssets/assets/qooetu-logo.svg')}}" alt=""></a></div>
            <div class="links">
                <ul class="social">
                    <li class="instagram"><a href="#" >Instagram</a></li>
                    <li class="twitter"><a href="#" >Twitter</a></li>
                    <li class="facebook"><a href="#">Facebook</a></li>
                </ul>
                <a href="#" class="login">Login / Signup</a>
            </div>
            </div>
        </div>
    <header class="row">
        <div class="wrap row">
            <h2>Discover Your Perfect investment</h2>
        <nav>
            <ul>
                <li class="active"><a href="#">Buy</a></li>
                <li><a href="#">Sell</a></li>
                <li><a href="#">Rent</a></li>
                <li><a href="#">Commercial</a></li>
                <li><a href="#">Residential</a></li>
                <li><a href="#">Mortgage</a></li>
            </ul>
        </nav>
        
    </header>

    </div>
    <div class="wrap row login">
        <div class="tabs">
            <ul class="navigation">
                <li><a href="<?=url('/login')?>">
                    <span>Already a member</span>
                    Login
                </a></li>
                <li><a href="<?=url('/register')?>">
                    <span>Not a member yet?</span>
                    Register
                </a></li>
            </ul>
            <div class="content">
                <div id="login">
                        <div class="col">
                        <form action="<?=url('/login')?>" method="post">

                        <?=csrf_field();?>
                        <label for="email">
                        <input type="email" name="email" placeholder="Email Address"></label>
                        <label for="password">
                        <input type="password" name="password" placeholder="Password"></label>
                        <button type="submit">Sign In</button>
                    </form></div>
                    <div class="details col">
                        <h3>Login with</h3>
                        <ul class="social-login">
                            <li class="facebook"><a href="#">
                                Facebook
                            </a></li>
                            <li class="twitter"><a href="#">
                                Twitter
                            </a></li>
                        </ul>
                        <a href="#register" class="link">
                    <span>Not a member yet?</span>
                    Register
                </a>
                    </div>
                    </div>
                <div id="register">Register</div>
            </div>
        </div>
    </div>
    
<section class="content">
        
        <div class="wrap row">
            
            <h3 class="title">Popular Houses For Sale</h3>

            
            <ul class="properties-list">
                    <li class="eq slide">
                        <div class="img">
                            <a href="">
                            <img src="{{asset('/siteAssets/assets/hdm.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                720,000
                            </div>
                            <div class="location">
                                Watamu, Mombasa Kenya
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>4<span>bd</span> </li>
                                    <li>4<span>ba</span> </li>
                                    <li>2,413<span>sqft</span> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="eq slide">
                        <div class="img">
                            <a href="">
                            <img src="{{asset('/siteAssets/assets/hdm.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                720,000
                            </div>
                            <div class="location">
                                Watamu, Mombasa Kenya
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>4<span>bd</span> </li>
                                    <li>4<span>ba</span> </li>
                                    <li>2,413<span>sqft</span> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="slide eq">
                        <div class="img">
                            <a href="">
                            <img src="{{asset('/siteAssets/assets/hdm.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                720,000
                            </div>
                            <div class="location">
                                Watamu, Mombasa Kenya
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>4<span>bd</span> </li>
                                    <li>4<span>ba</span> </li>
                                    <li>2,413<span>sqft</span> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="slide eq">
                        <div class="img">
                            <a href="">
                            <img src="{{asset('/siteAssets/assets/hdm.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                720,000
                            </div>
                            <div class="location">
                                Watamu, Mombasa Kenya
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>4<span>bd</span> </li>
                                    <li>4<span>ba</span> </li>
                                    <li>2,413<span>sqft</span> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
        </div>
        <div class="stats row">
            <div class="wrap row">
                <ul>
                    <li>
                        3,352
                        <span>HOMES FOR SALE</span>
                    </li>
                    <li>64
                        <span>Acres of land</span>
                    </li>
                    <li>
                        3,352
                        <span>HOMES FOR SALE</span>
                    </li>
                    <li>
                        3,352
                        <span>HOMES FOR SALE</span>
                    </li>
                    <li>
                        3,352
                        <span>HOMES FOR SALE</span>
                    </li>
                </ul>
            </div>
        </div>

</section>
<footer class="row">
    
        

        
        <div class="follow row">
            <div class="wrap row">
                <span>Follow Us for News and Updates</span>
                <ul class="social">
                    <li class="instagram"><a href="#" >Instagram</a></li>
                    <li class="twitter"><a href="#" >Twitter</a></li>
                    <li class="facebook"><a href="#">Facebook</a></li>
                </ul>
                <div class="row">
                        <nav>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Locations</a></li>
                                <li><a href="#">Feedback</a></li>
                                <li><a href="#">Media Room</a></li>
                                <li><a href="#">Privacy / Terms</a></li>
                                <li><a href="#">SiteMap</a></li>
                            </ul>
                        </nav>

                </div>

            </div>
        </div>
        <div class="cpy row">
            <div class="wrap row">
                <span>Copyright 2017 Qooetu</span>
                <div class="privacy">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                </div>
            </div>
        </div>
        
</footer>
</div>
    


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

 <script src="{{asset('/siteAssets/jrange/demo/prism/prism.js')}}"></script>

    <script src="{{asset('/siteAssets/jrange/jquery.range.js')}}"></script>
<script type="text/javascript">
    $("#type").on("change",function(e){
        e.preventDefault();
        var value=$(this).val();
         if(value.length>0){
            var url="<?=url('/application/fetch/category')?>/"+value;
              $.get(url,function(data){
                 $("#category").html("");
                 $("#category").html(data);

              });
         }

    });


    $(document).ready(function(){
            
            $('.range-slider').jRange({
                from: 250000,
                to: 900000,
                step: 1,
                scale: [260500,500000,750000,900000],
                format: '%s',
                width: 300,
                theme:'theme-green',
                showLabels: true,
                isRange : true,
                snap: true
            });
        });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK9h8dBeuvTh0WiXq-r3pRXZmienja0YI&v=3.exp&libraries=places"></script>

<script type="text/javascript">

   $(function(){
      var path = [];
         var myOptions = {
            zoom : 10,
            center : new google.maps.LatLng(-1.3044564, 36.7073077),
            mapTypeId : google.maps.MapTypeId.ROADMAP
          }
          //var map = new google.maps.Map(document.getElementById("map"), myOptions);
          var latLngBounds = new google.maps.LatLngBounds();
          var directionsDisplay;
          var directionsService = new google.maps.DirectionsService();
          directionsDisplay = new google.maps.DirectionsRenderer();
          //directionsDisplay.setMap(map);
          var start=new google.maps.LatLng();
          var end=new google.maps.LatLng();
          var startMarker=new google.maps.Marker();
          var latLngBounds = new google.maps.LatLngBounds();
    

        var placeSearch, autocomplete1,autocomplete2,autocomplete3,autocomplete4;
        var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
        };



         function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete1 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete1')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete1.addListener('place_changed', GetLatlong);

        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete2')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete2.addListener('place_changed', GetLatlong2);

        autocomplete3 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete12')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete3.addListener('place_changed', GetLatlong22);



        autocomplete4 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete22')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete4.addListener('place_changed', GetLatlong23);
      }

initAutocomplete();

      });
</script>
</body>
</html>