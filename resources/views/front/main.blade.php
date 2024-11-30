<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('front/assets/fonts/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap-select.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/jquery.slider.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}" type="text/css">

    <title>Qooetu | Home</title>

</head>

<body class="page-sub-page page-listing page-grid page-search-results" id="page-top">
<!-- Wrapper -->
<div class="wrapper">
@include('front.header')
 <!-- Page Content -->
    <div id="page-content">
        @yield('breadcrumb')
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                @yield('content')
                </div>
                @include('front.sidebar')
            </div>
        </div>
    </div>
    <!-- End Page Content -->

@include('front.footer')

</div>
<!-- End of wrapper -->


<script type="text/javascript" src="{{ asset('front/assets/js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/smoothscroll.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jshashtable-2.1_src.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jquery.numberformatter-1.2.3.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/tmpl.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jquery.dependClass-0.1.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/draggable-0.1.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jquery.slider.js')}}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/custom.js')}}"></script>
<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->


</body>
</html>