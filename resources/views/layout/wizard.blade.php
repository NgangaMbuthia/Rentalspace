<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/default/wizard_stepy.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Oct 2016 18:44:10 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title><?php if(isset($page_title)): echo $page_title; else: echo 'Real Estate Management'; endif;?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">

       <link href="{{ asset('assets/css/bootstrap-tour.min.css')}}" rel="stylesheet" type="text/css">

        

  
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>


      <script type="text/javascript" src="{{ asset('assets/js/bootstrap-tour.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/wizards/stepy.min.js')}}"></script>
    

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
   <script type="text/javascript" src="{{asset('assets/js/bootbox.js')}}"></script>
   

    <script type="text/javascript" src="{{ asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/wizard_stepy.js')}}"></script>
     


    <!-- Start of file upload css -->
    <script type="text/javascript">
     var imageid;
     var inputid;   
     var mode;
     var images = [];
     var imageids = [];
     var dataid;
     var dataurl;
     var baseurl='<?php echo url('/'); ?>';
    </script>

    <script type="text/javascript">
        var uploadurl="<?php echo url('/backend/file/upload'); ?>";
    </script>


<link rel="stylesheet" href="{{ asset ('file_upload/css/style.css') }}">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{{ asset ('file_upload/css/jquery.fileupload.css') }}">
<link rel="stylesheet" href="{{ asset ('file_upload/css/jquery.fileupload-ui.css') }}">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="{{ asset ('css/jquery.fileupload-noscript.css') }}"></noscript>
<noscript><link rel="stylesheet" href="{{ asset ('css/jquery.fileupload-ui-noscript.css') }}"></noscript>
<!-- End of file upload css -->


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
                 <div class="content" style="padding: 0 30px 30px 30px I!important">
                    <div class="row">
                        <div class="col-md-12">
                            @include('layout.notification')
                    @yield('content')
                            
                            
                        </div>
                       
                             
                        
                    </div>


                </div>

                     <div class="modal fade" id="county-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
                <div class="modal-dialog">
                  <div class="modal-content">


                  


                    
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                      <h4 class="modal-title" > <i class="icon-menu7"></i>
                          &nbsp;&nbsp;<hk id="my-header">
                      Give Reason(s)</hk></h4>
                    </div>
                    <hr>
                    
                    <div class="modal-body" id="load-county-details">

                        
                    </div>               
                   
                     
                  </div>
                </div>
              </div>

      
              <!-- /page content -->

    </div>
     
    <!-- /page container -->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyflu9VBn7oE8Km3RPqLGWpQ3oAr00OgU&libraries=places"></script>

@stack('scripts') 

<!-- Start of file upload JS -->

<script src="{{ asset('js/form-multiple-upload.demo.min.js')}}"></script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ asset('file_upload/js/vendor/jquery.ui.widget.js') }}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset('file_upload/js/jquery.iframe-transport.js') }}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload.js') }}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-process.js') }}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-image.js') }}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-audio.js') }}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-video.js') }}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-validate.js') }}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{ asset('file_upload/js/jquery.fileupload-ui.js') }}"></script>
<!-- The main application script -->

<script type="text/javascript">


 $(document).on("click",".uploadmodalwidget",function(){


    'use strict';

    if($("#fileupload").hasClass("initialized"))
    {

    }
    else
    {
     $("#fileupload").addClass("initialized"); 
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: uploadurl,
        type:'POST',
        dataType:'json'
    }).bind('fileuploaddone', function (e, data) {
      //console.log();
      $.each(data.result.files, function(index, file) {
        if(mode=="multiple")
                                {
                                    if(file.ext=='pdf')
                                    {
                                        var html_image_multiple="<div class='superbox-list'>"+
                                            "<img src='"+base+"/img/pdf.png' style='width:100px;height: 75px;' class='superbox-img' />"+

                                        "<div class='input-group'>"+
                                            "<span class='input-group-addon'>"+
                                                "<input data-url='"+file.url+"' data-id='"+file.id+"' type='checkbox' name='icons[]'>"+
                                            "</span>"+
                                            "<a href='#' class='form-control btn btn-primary btn-sm'>View</a>"+
                                        "</div>"+

                                        "</div>";
                                    }
                                    else
                                    {
                                        var html_image_multiple="<div class='superbox-list'>"+
                                            "<img src='"+file.url+"' style='width:100px;height: 75px;' class='superbox-img' />"+

                                        "<div class='input-group'>"+
                                            "<span class='input-group-addon'>"+
                                                "<input data-url='"+file.url+"' data-id='"+file.id+"' type='checkbox' name='icons[]'>"+
                                            "</span>"+
                                            "<input type='text' readonly class='form-control' value='Select'>"+
                                        "</div>"+

                                        "</div>";
                                    }
                                    
                                        $("#gallery-manager").prepend(html_image_multiple);
                                }
                                else
                                {
                                    if(file.ext=='pdf')
                                    {
                                        var html_image_multiple="<div class='superbox-list'>"+
                                            "<img src='"+base+"/img/pdf.png' style='width:100px;height: 75px;' class='superbox-img' />"+

                                        "<div class='input-group'>"+
                                            "<span class='input-group-addon'>"+
                                                "<input data-url='"+file.url+"' data-id='"+file.id+"' type='radio' name='icon'>"+
                                            "</span>"+
                                            "<a href='#' class='form-control btn btn-primary btn-sm'>View</a>"+
                                        "</div>"+

                                        "</div>";
                                    }
                                    else
                                    {
                                        var html_image_single="<div class='superbox-list'>"+
                                            "<img src='"+file.url+"' style='width:100px;height: 75px;' class='superbox-img' />"+

                                        "<div class='input-group'>"+
                                            "<span class='input-group-addon'>"+
                                                "<input data-url='"+file.url+"' data-id='"+file.id+"' type='radio' name='icon'>"+
                                            "</span>"+
                                            "<input type='text' readonly class='form-control' value='Select'>"+
                                        "</div>"+

                                        "</div>";
                                    }
                                    
                                        $("#gallery-manager").prepend(html_image_single);
                                }
      });
                                
                                        


                                

      //$(".files").html("");

      
    });


    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } 
    else 
    {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }
    }

 });




</script>
<script type="text/javascript">

   $(".uploadmodalwidget").on("click",function(){

                $(".files").html("");
                $("#gallery-manager").html("");

                inputid=$(this).attr("data-inputid");
                mode=$(this).attr("data-mode");
                imageid=$(this).attr("data-divid");


                var url="<?=url('backend/file/fetch')?>";
                $.post(url).done(function(data){
                    var data=$.parseJSON(data);          
                    if(mode=="multiple")
                    {
                       // imageid=$(this).attr("data-divid");
                        $.each(data, function(key,value){
                            if(value.extention=="pdf")
                            {
                                var html_image_multiple="<div class='superbox-list'>"+
                                        "<img src='"+baseurl+"/img/pdf.png' style='width:100px;height: 75px;' class='superbox-img' />"+
                                        "<div class='input-group'>"+
                                        "<span class='input-group-addon'>"+
                                            "<input data-url='"+baseurl+"/uploads/"+value.filename+"' data-id='"+value.id+"' type='checkbox' name='icon'>"+
                                        "</span>"+
                                            "<a href='#' class='form-control'>View</a>"+
                                        "</div>"+

                                        "</div>";
                            }
                            else
                            {
                                var html_image_multiple="<div class='superbox-list'>"+
                                "<img src='"+baseurl+"/uploads/"+value.filename+"' style='width:100px;height: 75px;' class='superbox-img' />"+
                                    "<div class='input-group'>"+
                                        "<span class='input-group-addon'>"+
                                            "<input data-url='"+baseurl+"/uploads/"+value.filename+"' data-id='"+value.id+"' type='checkbox' name='icon'>"+
                                        "</span>"+
                                        "<input type='text' readonly class='form-control' value='Select'>"+
                                    "</div>"+
                                "</div>";
                            }
                            
                            $("#gallery-manager").prepend(html_image_multiple);  

                            //console.log(value);
                        });
                    }
                    else
                    {
                        
                        $.each(data, function(key,value){

                            var html_image_single="<div class='superbox-list'>"+
                                "<img src='"+baseurl+"/uploads/"+value.filename+"' style='width:100px;height: 75px;' class='superbox-img' />"+
                                    "<div class='input-group'>"+
                                        "<span class='input-group-addon'>"+
                                            "<input data-url='"+baseurl+"/uploads/"+value.filename+"' data-id='"+value.id+"' type='radio' name='icon'>"+
                                        "</span>"+
                                        "<input type='text' readonly class='form-control' value='Select'>"+
                                    "</div>"+
                                "</div>";

                            $("#gallery-manager").prepend(html_image_single); 
                            //console.log(value);
                        });
                    }
                    //console.log(data);
                });


              });

    $("#insert_image").on("click",function(){

                if(mode=="multiple")
                {
                    images=[];
                    imagesids=[];
                    $("#gallery-manager input:checkbox:checked").each(function(){ 
                        images.push($(this).attr('data-url')); 
                        imageids.push($(this).attr('data-id'));
                    });


                    $.each(images, function(index, item) {
                        
                        var html_image="<div style='float: left;' class='col-md-2'><div class='superbox-list' style='width:100%;'>"+
                                "<span title='Delete Image' class='close delete_image' data-id='"+imageids[index]+"' style='opacity:.9;float: left;width:100%;color: red'>x</span>"+
                                "<img src='"+item+"' style='width:200px;height: 100px;' class='superbox-img' />"+
                                "</div><div>";

 
                        $("#"+imageid).prepend(html_image);         

                    });

                    var ids="";

                      var images = $("#"+inputid).val();
                      if(images !="")
                      {
                          var temp = new Array();
                          temp = images.split(',');
                          
                          $.each(temp, function( index, value ) {
                            if(value !="")
                            {
                              ids=ids+value+",";
                            }
                            
                          });  
                      }
                                          

                    $.each(imageids, function(index, item) {
                        
                        ids=ids+item+",";
                        //console.log(imageid);                               
                    });
                    //console.log(ids);
                    $("#"+inputid).val(ids);    
                    //$("#"+inputid).val(new_array);
                }
                else
                {

                    dataurl=$("#gallery-manager input:radio:checked").attr('data-url');
                    dataid = $("#gallery-manager input:radio:checked").attr('data-id');                      
                    console.log(imageid);

                    $("#"+inputid).val(dataid);
                    $("#"+imageid).attr("src",dataurl);
                }
                
                $("#modal-message").modal('hide');
            });

</script>



<script type="text/javascript">
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

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.

      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete1.setBounds(circle.getBounds());

            //autocomplete2.setBounds(circle.getBounds());

          });
        }
      }

      function GetLatlong()
      {
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete1').value;

        startMarker.setMap(null);

        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#latitude").val(latitude);
                $("#longitude").val(longitude);
                //path.push(new google.maps.LatLng(latitude, longitude));
                start = new google.maps.LatLng(latitude, longitude);
                latLngBounds.extend(start);
                map.fitBounds(latLngBounds);

                var myLatLng = {lat: latitude, lng: longitude};
                startMarker = new google.maps.Marker({
                  position: myLatLng,
                  map: map,
                  title: address
                });

            }
        });
      }

      function GetLatlong2()
      {
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete2').value;

        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#dlatitude").val(latitude);
                $("#dlongitude").val(longitude);


                srcLocation = new google.maps.LatLng($("#latitude").val(), $("#longitude").val());
                dstLocation = new google.maps.LatLng($("#dlatitude").val(), $("#dlongitude").val());

                // var distance = google.maps.geometry.spherical.computeDistanceBetween(srcLocation, dstLocation)
                // console.log(distance/1000);


                var service = new google.maps.DistanceMatrixService();
                var date = new Date();
                date.setDate(date.getDate() + 1);
                var DrivingOptions = {
                departureTime: date,
                trafficModel: 'pessimistic'
                };

                service.getDistanceMatrix(
                  {
                    origins: [srcLocation],
                    destinations: [dstLocation],
                    travelMode: 'DRIVING',
                    drivingOptions : DrivingOptions,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    durationInTraffic: true,
                    avoidHighways: false,
                    avoidTolls: false
                  }, response_data);

                function response_data(responseDis, status) 
                {
                  if (status !== google.maps.DistanceMatrixStatus.OK || status != "OK")
                  {
                    console.log('Error:', status);
                  }
                  else
                  {
                    $("#destimate").text(responseDis.rows[0].elements[0].distance.text);
                    //console.log(responseDis.rows[0].elements[0]);
                    $("#testimate").text(responseDis.rows[0].elements[0].duration_in_traffic.text);
                    var time=responseDis.rows[0].elements[0].duration_in_traffic.value;

                    var hoursEstimate;
                    var priceEstimate;

                    if(time<3600)
                    {
                      hoursEstimate = 1;
                    }
                    else
                    {
                      hoursEstimate = Math.ceil(time / 3600);
                    }
                    console.log(hoursEstimate);

                    if(hoursEstimate >= 5 && hoursEstimate <=6)
                    {
                      priceEstimate=1000;
                    }
                    else
                    {
                      priceEstimate=150*hoursEstimate;
                    }

                    $("#cestimate").text(priceEstimate);
                    totalamount=priceEstimate;
                  } 
                  //console.log(responseDis.rows[0].elements[0]);
                 } 

                  end = new google.maps.LatLng(latitude, longitude);
                  latLngBounds.extend(end);
                  map.fitBounds(latLngBounds);
                  var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.WALKING
                  };
                  directionsService.route(request, function(result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                      directionsDisplay.setDirections(result);
                    } else {
                      alert("couldn't get directions:" + status);
                    }
                  });
                  
                  
                }
      });
  }

      function GetLatlong22()
      {
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete12').value;

        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#latitude2").val(latitude);
                $("#longitude2").val(longitude);

            }
        });
      }

      function GetLatlong23()
      {
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById('autocomplete22').value;

        geocoder.geocode({ 'address': address }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $("#dlatitude2").val(latitude);
                $("#dlongitude2").val(longitude);

            }
        });
      }

      initAutocomplete();
</script>
<script type="text/javascript">

    
   $(document).on('click','.reject-modal',function(e){
    e.preventDefault();

           var head=$(this).attr('data-title');
                  
               var url=$(this).attr("data-url");
                $("#load-county-details").html("");
                $("#my-header").html(" ");
                $("#my-header").html(head);
                $("#county-modal").modal("show");
            $("#load-county-details").load(url,function(data){
            $("#county-modal").modal("show");
             
          });
       });
    

</script>






<!-- End of file upload Js -->
</body>

</html>

