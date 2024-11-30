
<?php
use App\Helpers\Helper;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Qooetu</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/siteAssets/css/base.min.css')}}">
    <link rel="stylesheet" href="{{asset('/siteAssets/jrange/demo/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('/siteAssets/jrange/jquery.range.css')}}">
</head>
<body class="home">
<div id="mobile-menu">
<a href="#" class="closemenu">x Close</a>
                   <ul class="navigation">
                    <li><a href="#buy">Buy</a></li>
                    <li><a href="#sell">Sell</a></li>
                    <li><a href="#rent">Rentals</a></li>
                    <li><a href="#land">Land</a></li>
                     <li><a href="#hotels">Hotels</a></li>
                     <li><a href="#deals">Travel</a></li>
                    <li><a href="#services">Services</a></li>

                </ul>
</div>
<div class="container">
    
        <div class="top-section">
            <div class="wrap row">
            <div class="logo"><a href="<?=url('/application')?>"><img src="{{asset('/siteAssets/assets/qooetu-logo.svg')}}" alt=""></a></div>
            <div class="links">
                <a href="#mobile-menu" class="openmenu">Menu</a>
                <ul class="social">
                    <li class="instagram"><a href="#" >Instagram</a></li>
                    <li class="twitter"><a href="#" >Twitter</a></li>
                    <li class="facebook"><a href="#">Facebook</a></li>
                </ul>
                <a href="<?=url('/login')?>" class="login">Login / Signup</a>
            </div>
            </div>
        </div>
    <header class="row">
        <div class="main-gallery">
            <ul class="main-slider">
                <li class="slide">
                    <div class="img"><img src="{{asset('/siteAssets/assets/mag1.jpg')}}" alt=""></div>
                    <div class="wrap row">
                    <div class="desc">
                        <h2>Discover Your Perfect investment</h2>
                        <a href="<?=url('/application/property/search')?>" class="readmore">View All Properties</a>
                    </div>
                    </div>
                    
                </li>


            </ul>
        </div>
        <div class="search-widget">
            <div class="tabs">
               
                   <ul class="navigation">
                    <li><a href="#buy">Buy</a></li>
                    <li><a href="#sell">Sell</a></li>
                    <li><a href="#rent">Rentals</a></li>
                    <li><a href="#land">Land</a></li>
                     <li><a href="#hotels">Hotels</a></li>
                     <li><a href="#deals">Travel</a></li>
                    <li><a href="#services">Services</a></li>

                </ul>
                
                <div class="content">
                    <div id="buy" class="in">
                   @include('site::widgets.buy')
                    </div>
                    <div id="sell" class="in"></div>
                    <div id="rent" class="in"></div>
                    <div id="land" class="in">
                     @include('site::widgets.land')
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="<?=url('/application/property/search')?>">Buy</a></li>
                <li><a href="#">Sell</a></li>
                <li><a href="#">Rentals</a></li>
                <li><a href="#">Lands</a></li>
                <li><a href="#">Hotels</a></li>
                <li><a href="#">Travel</a></li>

                <li><a href="#">Service Providers</a></li>
            </ul>
        </nav>
    </header>
    <div class="featured row">
            <div class="wrap row">
            <div class="ftr col-md-6 col">
                <h3 class="title">
                    Featured Properties
                </h3>
                <ul class="slider">
                    <li>
                        <div class="img">
                            <a href="<?=url('/application/property/details/'.$featured_product->id)?>">
                            <img src="<?=Helper::getPlotCoverImage($featured_product->id,"random")?>" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                <?=number_format($featured_product->plot_price)?>
                            </div>
                            <div class="location">

                            <?=$featured_product->name;?>,
                                <?=$featured_product->city;?>
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>Security</li>
                                    <li>Ready Title Deeds </li>
                                    <li>Marram Road to site </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="row subscribe">
                <h3>receive alerts on new inventory</h3>
                <div class="frm">
                <form action="">
                    <label for="">
                    <input type="email" class="email" placeholder="Your Email"></label>
                    <label for="">
                    <select name="" id="" class="jq" multiple placeholder="Categories">
                        
                        <option value="">
                            General
                        </option>
                    </select></label>
                    <label for="">
                    <input type="checkbox"> I Accept the terms and conditions</label>
                    <button type="submit">
                        Subscribe
                    </button>
                </form>
                </div>
                </div>
            </div>
            <div class="land col-md-6 col">
                <h3 class="title">
                    Land for Sale
                </h3>
                <ul class="properties-list">

                 <?php foreach($plots as $plot):
                  //dd($plot);


                 ?>
                    <li class="eq slide">
                        <div class="img">
                            <a href="<?=url('/application/property/details/'.$plot->id)?>">
                            <img src="<?=Helper::getPlotCoverImage($plot->id,"random")?>" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency">kes</span>
                                <?=number_format($plot->plot_price);?>
                            </div>
                            <div class="location">
                               <?=$plot->name;?>
                            </div>
                            <div class="properties">
                                <ul>
                                    <li>Security<span></span> </li>
                                    <li>Title Deed<span></span> </li>
                                    <li>Site Visit<span></span> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
                   
                </ul>
            </div>
            </div>

    </div>
<section class="content">
        <div class="wrap row">
            <h3 class="title">Listings</h3>
            <ul class="properties-list">

                  <?php foreach($models as $model):?>
                    <li class="eq slide">
                        <div class="img">
                            <a href="">
                            <img src="<?=Helper::getPropertyCoverImage($model->id)?>" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="price">
                                <span class="currency"><?=$model->currency;?></span>
                                <?=number_format($model->unit_price);?>
                            </div>
                            <div class="location">
                                <?=$model->title;?>, <?=$model->town?>
                                <?=$model->country?>
                            </div>

                            <div class="properties">
                                <ul>
                                    
                                    
                                   
                                    <li><?=$model->type;?> </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
                   
                   
                   
                </ul>
        </div>
        <div class="stats row">
            <div class="wrap row">
                @widget('mycounter',['count' => 10,'type'=>'message'])
            </div>
        </div>

</section>
<footer class="row">
    <div class="category-links row">
         @include('site::includes.footer')
        
</footer>
</div>
    

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('/siteAssets/js/base.min.js')}}"></script>
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

             $('.range-slider2').jRange({
                from: 50000,
                to: 19900000,
                step: 1,
                scale: [26050,500000,750000,1900000],
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