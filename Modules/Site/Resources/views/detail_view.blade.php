
<?php 
use App\Helpers\Helper;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=config('app.name')?>| Single Properties</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('/siteAssets/css/base.min.css')}}">
</head>
<body>
<div class="container page">
    
        <div class="top-section">
            <div class="wrap row">
            <div class="logo"><a href="<?=url('/')?>"><img src="{{asset('/siteAssets/assets/qooetu-logo.svg')}}" alt=""></a></div>
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

    </div>
    
<section class="content single">

        <div class="wrap row">
            <div class="row">
            <div class="maincol">
            <h1 class="title">
                <?=$model->name;?>
            </h1>
            <div class="breadcrumbs">
                <a href="#">Home</a> > <a href="#">Sale</a>  > <span><?=$model->name;?></span>
            </div>
        
            </div>
            <aside class="sidebar">
                <div class="pagination">
                    <a href="#">Prev</a>
                    <a href="#">Next</a>
                </div>
                
            </aside>
            </div>
            </div>
            <div class="single-highlight">
            <div class="wrap row">
            
                <div class="maincol">
                    <ul class="property-tags">
                        <li class="new">New</li>
                        <li>For Sale - Active</li>
                    </ul>
                    <div class="slider-parent">
                    <ul class="slider row">
                    <?php foreach($model->images as $image) { ?>
                    
                    <li class="slide">
                        <div class="img">
                            <a href="">
                            <img src="<?=Helper::getFilePath($image->image_id);?>" alt="">
                            </a>
                        </div>
                    
                    </li>
                    <?php }?>
                    
                    
                    
                </ul>
                <ul class="thumb-slider row">
                     <?php foreach($model->images as $image) { ?>
                    
                    <li class="slide">
                        <div class="img">
                            <a href="#">
                            <img src="<?=Helper::getFilePath($image->image_id);?>" alt="">
                            </a>
                        </div>
                    
                    </li>
                    <?php }?>
                    
                    
                    
                </ul>
                </div>
                </div>
                <aside class="sidebar">

                    <div class="widget">
                        <div class="property-specs">
                                <ul>
                                    <li class="eq">4<span>bd</span> </li>
                                    <li class="eq">4<span>ba</span> </li>
                                    <li class="eq">2,413<span>sqft</span> </li>
                                </ul>
                            </div>
                    </div>
                    
                    <div class="widget enquire row">
                    <h3 class="title">Enquire about Property</h3>
                        <form action="">
                            <input type="text" placeholder="Enter Full Name">
                            <input type="email" placeholder="Enter Email Address">
                            <input type="text" placeholder="Enter Phone Number">
                            <textarea>I'm interested in Lorem ipsum dolor sit amet, consectetur adipisicing elit</textarea>
                            <button type="submit">Contact Provider</button>

                        </form>
                    </div>
                
                </aside>
            </div>
            </div>
            <div class="wrap row">
                <div class="maincol">
                    <div class="property-meta">
                        <div class="col map">
                            <span></span>
                            <a href="#">Show on Map</a>
                        </div>
                        <div class="col">
                            Location
                            <strong><?=$model->area?></strong>
                        </div>
                        <div class="col">
                            <div class="price">
                                <span class="currency">KES</span>
                                <?=number_format($model->plot_price);?>
                            </div>
                        </div>
                    </div>
                    <h3 class="title">
                        Property Details for <?=$model->name;?>
                    </h3>
                    <div class="property-meta">
                        <div class="col">
                            <span>Status</span>
                            <?=$model->plot_status;?>
                        </div>
                        <div class="col">
                            <span>Listed</span>
                             <?=$model->created_at->diffForHumans();?>
                        </div>
                        <div class="col">
                            <span>Size</span>
                            <?=$model->plot_size;?>
                        </div>
                        <div class="col">
                            <span>Country</span>
                             <?=$model->country;?>
                        </div>
                    </div>
                    <div class="excerpt">
                        <?=$model->description;?>
                    </div>
                    <h3 class="title">Property Features</h3>
                    <div class="row">
                        <h4>Utilities</h4>
                        <ul class="features">
                            <li>Public Water</li>
                            <li>City Sewer</li>
                        </ul>
                    </div>
                    <div class="row">
                        <h4>Utilities</h4>
                        <ul class="features">
                            <li>Public Water</li>
                            <li>City Sewer</li>
                        </ul>
                    </div>
                    <h3 class="title">
                        Similar Homes For Sale <?=$model->name;?>
                    </h3>
                    <ul class="properties-list similar">
                    <?php for ($i=0; $i < 6 ; $i++) { ?>
                    
                    <li class="eq slide">
                        <div class="img">
                            <a href="">
                            <img src="{{asset('/siteAssets/assets/hdm.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="desc">
                            <div class="in">
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
                            <div class="links">
                                <a href="#" class="readmore">View Details</a>
                                
                            </div>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                    
                    
                    
                </ul>
                </div>
                <aside class="sidebar">
                    <div class="widget">
                    <h3 class="title">Search more  properties</h3>
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
                    <form action="">
                        <label for="location">
                            <input type="text" placeholder="location">
                        </label>
                        <div class="row dcol">
                        <label for="min-price">
                            <span>Min Price</span>
                            <select name="min-price" id="">
                                <option value="">Any</option>
                                <option value="">1,000</option>
                                <option value="">10,000</option>
                                <option value="">20,000</option>
                            </select>
                        </label>
                        <label for="max-price">
                            <span>Max Price</span>
                            <select name="max-price" id="">
                                <option value="">Any</option>
                                <option value="">1,000</option>
                                <option value="">10,000</option>
                                <option value="">20,000</option>
                            </select>
                        </label>
                        </div>
                        <label for="Property Type">
                            <span>Property Type</span>
                            <select name="max-price" id="">
                                <option value="">Any</option>
                                
                            </select>
                        </label>
                        <button type="submit">
                            Search Inventory
                        </button>
                    </form>
                    </div>
                    <div id="sell" class="in"></div>
                    <div id="rent" class="in"></div>
                    <div id="land" class="in"></div>
                </div>
            </div>
        </div>
                    </div>
                        <div class="widget">
                        <h3 class="title">Popular Searches in Watamu</h3>
                        <ul class="tags list">
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">dolor sit</a></li>
                            <li><a href="#">adipisicing elit</a></li>
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
            <div class="wrap row">
            <h3 class="title">Popular Houses For Sale</h3>
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
</body>
</html>