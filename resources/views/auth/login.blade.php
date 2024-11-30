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
    <div class="wrap row login">
        <div class="tabs">
            <ul class="navigation">
                <li><a href="#login">
                    <span>Already a member</span>
                    Login
                </a></li>
                <li><a href="#register">
                    <span>Not a member yet?</span>
                    Register
                </a></li>
            </ul>
            <div class="content">
                <div id="login">
                        <div class="col">
                        <form action="{{url('/login')}}" method="post">
                        <?=csrf_field();?>
                        <label for="email">
                        <input type="text" name="login" placeholder="Username / Email Address"></label>
                        <label for="password">
                        <input type="password" name="password" placeholder="Password"></label>
                        <div class="g-recaptcha" data-sitekey="6LfHwVIUAAAAAG-PA1L6JDh730eazUGOugIEI-cC"></div>
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
<script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>