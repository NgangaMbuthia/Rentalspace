<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Qooetu: Single Properties</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('/siteAssets/css/base.min.css')}}">
</head>
   <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59d49b04c28eca75e4623fc8/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
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

	</div>
	
<section class="content single">

		<div class="wrap row">
			<div class="row">
			<div class="maincol">
			
			<div class="breadcrumbs">
				<a href="#">Home</a> > <a href="#">Sale</a>  > <span>Lorem ipsum dolor sit amet,</span>
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
			<div class="provider-header">
			<div class="wrap row">
			
				<div class="provider-photo">
					<img src="{{asset('/siteAssets/assets/profile_user.jpg')}}" alt="">
				</div>
				<div class="details">
					<div class="nav row">
					<a href="#" class="contacts">Contact Info</a>
					<ul class="navigation">
						
						<li><a href="#">About The Provider</a></li>
						<li><a href="#">Ratings and Reviews</a></li>
						<li><a href="#">Listing Activity</a></li>
					</ul>
					</div>
					<div class="user-details">
					<h1><?=$model->user->name;?></h1>
					<p><strong>Primary Location</strong><?=$model->location;?></p>
					<div class="rating">
						<ul class="ratings">
							<li class="full"></li>
							<li class="full"></li>
							<li class="full"></li>
							<li></li>
							<li></li>
						</ul>
						<strong>5</strong> (Based on 1 Review)
					</div>
					</div>
				</div>
			</div>
			</div>
			<div class="wrap row">
				<div class="about-provider">
					<div class="col">
						<h3 class="title">About <?=$model->user->name;?>(<?=$model->type?>)</h3>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
					<div class="col">
						<div class="about-meta">
							<div class="item">
							<h4>Years of Experience</h4>
							</div>
							<div class="item">
								<h4>Price Range</h4>
								KES 10,000 - 200000
							</div>
							<div class="item spec">
								<h4>Specializations</h4>
								quis nostrud exercitation, Lorem, Excepteur sint, occaecat 
cupidatat non, quis nostrud exercitation, Lorem, 
Excepteur sint, occaecat cupidatat non
							</div>
						</div>
					</div>
				</div>
				<div class="maincol">
					
					<div class="property-meta">
						<div class="col">
							<span>Status</span>
							Active
						</div>
						<div class="col">
							<span>Member Since</span>
							30 Days Ago
						</div>
						
					</div>
					<div class="excerpt">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
					
					<h3 class="title">
						Listing Activity
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