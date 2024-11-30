<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/wizard_stepy.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Oct 2016 18:44:10 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}"/>
    <title><?php if(isset($page_title)): echo $page_title; else: echo 'Real Estate Management'; endif;?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/validation/validate.min.js')}}"></script>

       


    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/anytime.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>

   

    <script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/wizard_stepy.js')}}"></script>
     

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('.pickadate-weekday').pickadate({
        firstDay: 1
    });
    </script>

    <script type="text/javascript">

  $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy-mm-dd",
    });

</script> 



    <!-- /theme JS files -->

</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        @include('layout.header')
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">
          @include('layout.sidebar')
            <!-- Main sidebar -->
            
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
               <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=(isset($page_title))? $page_title:'Real Estate Management';?></span></h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line">

                      @yield('breadcrumb')
                       

                        
                    </div>
                </div>
                <!-- /page header -->










                <!-- Content area -->
                 <div class="content">
                    <div class="row">
                            @include('layout.notification')
                    @yield('content')
                    </div>
                </div>

      
              <!-- /page content -->

    </div>
     
    <!-- /page container -->

</body>

@stack('scripts') 






<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/wizard_stepy.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Oct 2016 18:44:12 GMT -->
</html>

