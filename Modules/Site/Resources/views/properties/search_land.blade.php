
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
                <a href="<?=url('/login')?>" class="login">Login / Signup</a>
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
    <div class="wrap row">
        <div class="search-widget">
            <div class="tabs">
                <ul class="navigation">
                    <li><a href="#buy">Buy</a></li>
                    <li><a href="#sell">Sell</a></li>
                    <li><a href="#rent">Rent</a></li>
                    <li><a href="#land">Land</a></li>
                </ul>
                <div class="content">
                    <div id="buy" class="in">
                    
                    </div>
                    <div id="sell" class="in"></div>
                    <div id="rent" class="in"></div>
                    <div id="land" class="in"></div>
                </div>
            </div>
        </div>
        
        
        </div>
    </div>
    
<section class="content">

        <div class="wrap row">
            <div class="row">
            <div class="maincol">
            <div class="breadcrumbs">
                <a href="#">Mombasa</a> > <span>Watamu</span>
            </div>
            <div class="res-stats">
                <span class="found">2,990 Houses found</span>
                <label class="select"><select name="" id="" class="sort">
                    <option value="">Sort by Relevance</option></label>
                </select>
            </div>
            </div>
            <aside class="sidebar">
                <ul class="viewswitch">
                    <li class="active"><a href="#">List</a></li>
                    <li><a href="#">Map</a></li>
                </ul>
            </aside>
            </div>
            <div class="row">
                <div class="maincol">
                    <ul class="properties-list rows">
                    <?php foreach($models as $model):?>
                    
                    <li class="eq slide">
                        <div class="img eq">
                            <a href="<?=url('/application/property/details/'.$model->id)?>">
                            <img src="<?=Helper::getPlotCoverImage($model->id,"random")?>" alt="">
                            </a>
                        </div>
                        <div class="desc eq">
                            <div class="in">
                            <div class="price">
                                <span class="currency">kes</span>
                                 <?=$model->plot_price;?>
                            </div>
                            <div class="location">
                                <?=$model->name;?>, <?=$model->state;?> <?=$model->country;?>
                            </div>
                            <div class="properties">
                                <ul>
                                    <li><?=$model->plot_size?><span></span> </li>
                                    
                                </ul>
                            </div>
                            <div class="links">
                                <a href="<?=url('/application/property/details/'.$model->id)?>" class="readmore">View Details</a>
                                <a href="<?=url('/application/property/details/'.$model->id)?>">Contact Us</a>
                            </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                    
                    
                    
                </ul>
                </div>
                <aside class="sidebar">
                    <div class="widget cover">
                        <h3 class="title">Popular Locations in <strong>Kenya</strong></h3>
                        <ul class="link list">
                          <?php foreach($models as $model):?>
                            <li><a href="#"><?=$model->name;?></a></li>
                        <?php endforeach;?>
                            
                        </ul>
                    </div>
                    <div class="widget">
                        <h3 class="title">Popular Searches </h3>
                        <ul class="tags list">
                            <?php foreach($models as $model):?>
                            <li><a href="#"><?=$model->name;?></a></li>
                        <?php endforeach;?>


                            
                            
                        </ul>
                    </div>
                    <div class="widget">
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
                        <option value="">
                            General 2
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
                </aside>
            </div>
            <h3 class="title">Popular Properties</h3>

            @widget('property',['count' => 10,'type'=>'message'])
           
        </div>
         <div class="stats row">
            <div class="wrap row">
                 @widget('mycounter',['count' => 10,'type'=>'message'])
            </div>
        </div>

</section>
<footer class="row">
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