


<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    
    <title><?php if(isset($page_title)): echo $page_title; else: echo 'Real Estate Management'; endif;?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset ('/assets/js/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset ('/assets/js/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css">
     
    <!-- /global stylesheets -->
    @stack('styles')
    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>

    <script src="{{ asset ('/assets/js/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/nicescroll.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/widgets.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/effects.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/extensions/mousewheel.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/globalize/globalize.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/globalize/cultures/globalize.culture.de-DE.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/globalize/cultures/globalize.culture.ja-JP.js')}}"></script>


    
    <script type="text/javascript" src="{{asset('assets/js/plugins/uploaders/fileinput.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/color/spectrum.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
     <script type="text/javascript" src="{{asset('assets/js/pages/dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/jqueryui_forms.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('assets/js/pages/layout_fixed_custom.js')}}"></script>



     <style type="text/css">
        
        .help-block{
            color:red;
        }
    </style>

  
    
    <script type="text/javascript" src="{{ asset('assets/js/pages/jqueryui_forms.js')}}"></script>


      <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/form_checkboxes_radios.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/pages/components_modals.js')}}"></script>

       
   
<script src="{{ asset ('/assets/js/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset ('/assets/js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <!-- /theme JS files -->
    
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
    $(document).ajaxStart(function() {
        /* Stuff to do when an AJAX call is started and no other AJAX calls are in progress */
        //$("#overlay").show();
    }).ajaxComplete(function(event, xhr, settings) {
        /* executes whenever an AJAX request completes */
        //$("#overlay").hide();
    });
</script>

</head>


<body class="navbar-top">
@include('layout.header')
<!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">
        @include('layout.sidebar')    
        <!-- Main content -->
            <div class="content-wrapper">
                

                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?=(isset($page_title))? $page_title:'Real Estate Management';?></span></h4>
                        </div>
                        @yield('header')
                        
                    </div>

                    <div class="breadcrumb-line">

                      @yield('breadcrumb')
                       

                        
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                            @include('layout.notification')
                    @yield('content')
                    </div>
                </div>
                </div>

                @include('layout.right_sidebar')    
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


























                        <div id="modal_iconified" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Modal with icons</h5>
                </div>

                <div class="modal-body">
                  <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                            <span class="text-semibold">Here we go!</span> Example of an alert inside modal.
                            <button type="button" class="close" data-dismiss="alert">×</button>
                        </div>

                  <h6 class="text-semibold"><i class="icon-law position-left"></i> Sample heading with icon</h6>
                  <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>

                  <hr>

                  <p><i class="icon-mention position-left"></i> Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                  <button class="btn btn-primary"><i class="icon-check"></i> Save</button>
                </div>
              </div>
            </div>
          </div>  





@stack('scripts')  
<script type="text/javascript">



    $.ajaxSetup({
                headers:{ "X-csrf-Token":$("meta[name=_token]").attr("content")}
                });

  $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat:"yy-mm-dd",
    });



  $(document).on('click','.reject-modal',function(){

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


   $(".delete-record").on("click",function(){
     var name=$(this).attr("data-name");
         var x=confirm("Confirm you want to delete this "+name);
          if(x==true)
          {
            var url=$(this).attr("data-href");
            var url_to=$(this).attr("data-redirect-to");
             $.post(url,function(){

              window.location.href=url_to;
             });
          }


     });





</script> 




@stack('uploadscrits')



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

 $(document).on("click","#uploadmodal",function(){

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
                                
                                        


                                
      $(".files").html("");
      
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

$("ul li").on("click", function() {
    $("li").removeClass("active");
    $(this).addClass("active");
  });

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
                    //console.log(imageid);
                    $("#"+inputid).val(dataid);
                    $("#"+imageid).attr("src",dataurl);
                }
                
                $("#modal-message").modal('hide');
            });

</script>
</body>
</html>
