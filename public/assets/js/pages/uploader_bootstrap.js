/* ------------------------------------------------------------------------------
*
*  # Bootstrap multiple file uploader
*
*  Specific JS code additions for uploader_bootstrap.html page
*
*  Version: 1.2
*  Latest update: Aug 10, 2016
*
* ---------------------------------------------------------------------------- */

$(function() {

    //
    // Define variables
    //

    // Modal template
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

    // Buttons inside zoom modal
    var previewZoomButtonClasses = {
        toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
        fullscreen: 'btn btn-default btn-icon btn-xs',
        borderless: 'btn btn-default btn-icon btn-xs',
        close: 'btn btn-default btn-icon btn-xs'
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
        prev: '<i class="icon-arrow-left32"></i>',
        next: '<i class="icon-arrow-right32"></i>',
        toggleheader: '<i class="icon-menu-open"></i>',
        fullscreen: '<i class="icon-screen-full"></i>',
        borderless: '<i class="icon-alignment-unalign"></i>',
        close: '<i class="icon-cross3"></i>'
    };


    //
    // AJAX upload
    //

    $(".file-input-ajax").fileinput({
        uploadUrl: uploadurl, // server upload action
        uploadAsync: false,
        maxFileCount: 5,
        initialPreview: [],
        fileActionSettings: {
            showUpload:false,
            showRemove:false,
            showZoom:false,
            showDrag:false
        },
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: modalTemplate
        },
        initialCaption: "No file selected",
        previewZoomButtonClasses: previewZoomButtonClasses,
        previewZoomButtonIcons: previewZoomButtonIcons,
    });

    $(".file-input-ajax").on("filebatchuploadsuccess",function(event, data, previewId, index){
        response = data.response;
      
        $.each(response.files,function(i,item){
            var html='<div class="col-lg-2 col-sm-3">'+
                            '<div class="thumbnail">'+
                                '<div class="thumb">'+
                                    '<img style="width: 120px;height: 115px;" src="'+item.thumbnailUrl+'" alt="">'+
                                    '<div class="caption-overflow">'+
                                        '<span>'+
                                            '<a href="'+item.thumbnailUrl+'" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>'+
                                            '<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>'+
                                        '</span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="input-group">'+
                                    '<span class="input-group-addon">'+
                                        '<input type="checkbox" data-url="'+item.thumbnailUrl+'" data-id="'+item.id+'">'+
                                    '</span>'+
                                    '<input type="text" class="form-control" readonly value="Select">'+
                                '</div>'+
                            '</div>'+
                    '</div>';

           $("#gallery_holder").prepend(html);
           $(".file-input-ajax").fileinput("reset");
                                   
           console.log(item.thumbnailUrl); 
        });
        
    });

    $("#insert_images").on("click",function(){
        $("#property_images").html("");
        var ids="";
        $("#gallery_holder .uploaded_images:checked").each(function(){
            var id=$(this).attr("data-id");
            var url=$(this).attr("data-url");
            var html='<div class="col-lg-2 col-sm-3">'+
                            '<div class="thumbnail">'+
                                '<div class="thumb">'+
                                    '<img style="width: 120px;height: 115px;" src="'+url+'" alt="">'+
                                    '<div class="caption-overflow">'+
                                        '<span>'+
                                            '<a href="'+url+'" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>'+
                                            '<a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>'+
                                        '</span>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                    '</div>';
            ids+=id+",";
                    
            $("#property_images").append(html); 
            $("#modal_large").modal("hide");
        });

        $("#img_ids").val(ids);
    });

});
