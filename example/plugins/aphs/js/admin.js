jQuery(document).ready(function($) {

	"use strict"




	var _body = $('body'),
	_doc = $(document),
    preloader = $('#aphs-loader'),
    aphsform = $('#aphsform'),
    customCssInited,
    options = $.parseJSON(aphs_data.options),
    empty_src = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'


    for (var key in options) {
        if(options[key] == '0')options[key] = false; 
    }




    //custom css
    var codeEditor;
    function initCustomCss(){
        if(document.getElementById("aphs_custom_css_field")){
            jQuery(document).ready(function(){
                codeEditor = CodeMirror.fromTextArea(document.getElementById("aphs_custom_css_field"), {
                    lineNumbers: true,
                    mode: 'css',
                    lineWrapping:true                       
                });
            });
        }
        customCssInited = true;
    }




	//settings tabs

    var general_tabs = $('#aphs-general-tabs');

    general_tabs.find('.aphs-tab-header div').on('click', function(){
        var tab = $(this), id = tab.attr('id');

        if(!tab.hasClass('aphs-tab-active')){ 
            general_tabs.find('.aphs-tab-header div').removeClass('aphs-tab-active');  
            tab.addClass('aphs-tab-active');
            general_tabs.find('.aphs-tab-content').hide();

            $('#'+ id + '-content').show();
            if(id == 'aphs-tab-custom-css' && !customCssInited)initCustomCss();

            
        }
    });

    general_tabs.find('.aphs-tab-header div').eq(0).click()



    var iconTable = $('#aphs-icon-table')

    //upload icon
    iconTable.on('click', '.aphs-upload-icon', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'image'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();
            
            //add image url
            button.closest('.aphs-icon-field').find('.aphs-icon-value').val(attachment.url)

            //add image
            button.closest('.aphs-icon-field').find('.aphs-img-preview').attr('src', attachment.url)

        })
        .open();
    });

    //remove icon
    iconTable.on('click', '.aphs-remove-icon', function(e){
        e.preventDefault();

        var button = $(this)

        //remove icon url
        button.closest('.aphs-icon-field').find('.aphs-icon-value').val('')

        //remove image
        button.closest('.aphs-icon-field').find('.aphs-img-preview').attr('src', empty_src)

      
    });





    
    
    //save options

    var isSubmit;
    $('#aphs-save-options-submit').on('click', function (){

        if(isSubmit)return false;//prevent double submit
        isSubmit = true;

        preloader.show();


        var player_options = {};
        $.each(aphsform.serializeArray(), function(i, field) {

            if(field.name != 'featuredPostTypes[]' ) player_options[field.name] = field.value;

        });

        //https://stackoverflow.com/questions/7335281/how-can-i-serializearray-for-unchecked-checkboxes
        aphsform.find("input:checkbox:not(:checked)").map(function() {
            player_options[this.name] = "0";
        });


        var arr = []
        $('.featuredPostTypes').each(function() {
            if(this.value != '' && this.checked)arr.push(this.value); 
        });
        player_options['featuredPostTypes'] = arr;


        console.log(player_options)
     
        var postData = [
            {name: 'action', value: 'aphs_save_options'},
            {name: 'security', value: aphs_data.security},
            {name: 'player_options', value: JSON.stringify(player_options)}
        ];

        $.ajax({
            url: aphs_data.ajax_url,
            type: 'post',
            data: postData,
            dataType: 'json',   
        }).done(function(response){
            console.log( response)

            preloader.hide();
            isSubmit = false;

        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText, textStatus, errorThrown);
            preloader.hide();
            isSubmit = false;
        });

        return false;
    });






	


	
	//############################################//
	/* shortcode */
	//############################################//


	var featuredShortcode = $('#aphs_featured_shortcode'),
    post_id = featuredShortcode.attr('data-post-id')

    var shortcode = '[aphs_featured featured_enabled="1" post_id="'+post_id+'"]';

    featuredShortcode.val(shortcode);

    $('#aphs-featured-shortcode-copy').on('click', function(){
        featuredShortcode.select();
        try{
            document.execCommand("copy");
        }catch(er){}
    })




    //############################################//
    /* category video */
    //############################################//

    //preview

    var catFeaturedPreview = $('#aphs-category-featured-preview'),
    removeCatFeatured = $('#aphs-category-remove-featured').on('click', function(){
        
        catFeaturedPreview.html('')
        catFeaturedUrl.val('')

        return false;
    });

    //url

    var catFeaturedUrl = $('#aphs_category_featured_url').on('input', function() {
   
        var v = $(this).val()

        if(!isEmpty(v)){
            var type = getVideoType(v)
            if(type){
                setVideoPreview(type, v, catFeaturedPreview);
            }
            
        }

    });

    catFeaturedUrl.trigger('input')//trigger change

    $('#aphs-category-upload-featured').on('click', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'video, audio'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            if(attachment.type == 'video' || attachment.type == 'audio'){
                setVideoPreview(attachment.type, attachment.url, catFeaturedPreview)
                catFeaturedUrl.val(attachment.url)
            }

        })
        .open();
    });






    //############################################//
    /* product video */
    //############################################//

    var featuredType = $('#aphs_featured_type')

    //preview

    var featuredPreview = $('#aphs-featured-preview'),
    removeFeatured = $('#aphs-remove-featured').on('click', function(){
        
        featuredPreview.html('')
        featuredUrl.val('')

        return false;
    });

    //url

    var featuredUrl = $('#aphs_featured_url').on('input', function() {
   
        var v = $(this).val()

        if(!isEmpty(v)){
            var type = getVideoType(v)
            if(type){
                setVideoPreview(type, v, featuredPreview)

                if(type != 'audio' & type != 'video'){
                    //create thumbs for yt, vimeo...

                    if(options.autoFetchThumbnails){

                        getThumb(v, type)
                        .then((data) => {
                            //console.log(data)

                            poster.val(data)
                            poster.trigger('input')//trigger change
                            
                        })
                        .catch((error) => {
                            console.log(error)
                        })

                    }
                }

                if(featuredType.length)featuredType.val(type)
              
            }
            
        }

    });

    featuredUrl.trigger('input')//trigger change

    //upload url

    $('#aphs-upload-featured').on('click', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'video, audio'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            if(attachment.type == 'video' || attachment.type == 'audio'){

                setVideoPreview(attachment.type, attachment.url, featuredPreview)

                featuredUrl.val(attachment.url)
                if(featuredType.length)featuredType.val(attachment.type)
            }

        })
        .open();
    });




    //poster

    var posterPreview = $('#aphs-featured-poster-preview'),
    poster = $('#aphs_featured_poster').on('input', function() {
console.log(poster.val())
        var img = $('<img class="aphs-featured-poster-preview-img" src="'+poster.val()+'" />')

        posterPreview.html(img)

    });

    var removeFeatufedPoster = $('#aphs-remove-featured-poster').on('click', function(e){

        posterPreview.html('')
        poster.val('')

    });

    $('#aphs-upload-featured-poster').on('click', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'image'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            poster.val(attachment.url)

            poster.trigger('input')//trigger change

        })
        .open();
    });

    if(poster.val() != '') poster.trigger('input')//trigger change


    //lightbox url

    var lightboxUrl = $('#aphs_featured_lightbox_url')

    $('#aphs-upload-lightbox-url').on('click', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : '*'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            lightboxUrl.val(attachment.url)

        })
        .open();
    });


    //overlay icon

    var overlayIcon = $('#aphs_featured_overlay_icon')

    $('#aphs-upload-overlay-icon').on('click', function(e){
        e.preventDefault();

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'image'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            overlayIcon.val(attachment.url)

        })
        .open();
    });



    
    

    //############################################//
    /* product gallery images */
    //############################################//

    _doc.on('click', '.aphs-edit-product-image', function(){

        var id = $(this).attr('data-id')

        var uploader = wp.media({
            library : {
                type : 'image'
            },
            multiple: false 
        })
        .on('open', function() {

            var selection = uploader.state().get('selection');
            selection.add(wp.media.attachment(id));

        });        

        uploader.open();

        return false;

    })

    //upload product gallery video

    _doc.on('click', '#aphs_featured_url_add_upload', function(){

        var uploader = wp.media({
            library : {
                type : 'video'
            },
            multiple: false 
        })
        .on('select', function() {

            var attachment = uploader.state().get('selection').first().toJSON();

            $('.aphs_featured_url_add_field').val(attachment.url)

        });        

        uploader.open();

    })

    var productGalleryTable = $('#aphs-product-gallery-table')

    productGalleryTable.find('.aphs-product-gallery-featured-url').each(function(){

        var item = $(this), v = item.val()

        //create videos on start
        if(!isEmpty(v)){
            var type = getVideoType(v)
            if(type){
                var element = item.closest('.aphs-product-gallery-item').find('.aphs-product-gallery-featured-preview')
                setVideoPreview(type, v, element)
            }
            
        }

        //create videos on input
        item.on('input', function() {
   
            var v = $(this).val()

            if(!isEmpty(v)){
                var type = getVideoType(v)
                if(type){

                    var element = item.closest('.aphs-product-gallery-item').find('.aphs-product-gallery-featured-preview')
                    setVideoPreview(type, v, element)

                    //update attachment video url
                    updateProductGalleryImageMeta(item.closest('.aphs-product-gallery-item').attr('data-attachment-id'), v)
                  
                }
                
            }

        });

    })

    function updateProductGalleryImageMeta(attachment_id, url){
        console.log('updateProductGalleryImageMeta')

        var postData = [
            {name: 'action', value: 'aphs_save_product_gallery_image_meta'},
            {name: 'featured_url', value: url},
            {name: 'attachment_id', value: attachment_id},
            {name: 'security', value: aphs_data.security},
        ];

        $.ajax({
            url: aphs_data.ajax_url,
            type: 'post',
            data: postData,
            dataType: 'json',  
        }).done(function(response) {
            
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        });  

    }

    //remove video
    productGalleryTable.on('click', '.aphs-product-gallery-featured-remove', function(){

        var item  = $(this).closest('.aphs-product-gallery-item')

        item.find('.aphs-product-gallery-featured-url').val('')
        item.find('.aphs-product-gallery-featured-preview').html('') 

        //update attachment video url
        updateProductGalleryImageMeta(item.closest('.aphs-product-gallery-item').attr('data-attachment-id'), '')

    })

    //upload video
    productGalleryTable.on('click', '.aphs-product-gallery-featured-upload', function(){

        var item = $(this).closest('.aphs-product-gallery-item')

        var button = $(this),
        uploader = wp.media({
            library : {
                type : 'video, audio'
            },
            multiple: false 
        })
        .on('select', function() {
            var attachment = uploader.state().get('selection').first().toJSON();

            if(attachment.type == 'video' || attachment.type == 'audio'){
                var element = item.find('.aphs-product-gallery-featured-preview')
                setVideoPreview(attachment.type, attachment.url, element)

                item.find('.aphs-product-gallery-featured-url').val(attachment.url)

                //update attachment video url
                updateProductGalleryImageMeta(item.attr('data-attachment-id'), attachment.url)
            }

        })
        .open();

    })




    //alternative eproduct gallery

    
    var enableOnProductPage = $('#enableOnProductPage').change(function() {
        if($(this).is(":checked")) {
            $('#aphs-inner-table-product-alternative').show()
        }else{
            $('#aphs-inner-table-product-alternative').hide()
        }      
    });

    //check on start
    if(enableOnProductPage.is(":checked")){
        $('#aphs-inner-table-product-alternative').show()
    }


	//############################################//
	/* helpers */
	//############################################//

    function getThumb(url, type){

        return new Promise((resolve, reject) => {

            if(type == 'youtube'){
                var video_id = parseYoutubeUrl(url),
                thumb = "https://i3.ytimg.com/vi/"+video_id+"/"+options.youtubeThumbSize+".jpg"

                resolve(thumb);
            }
            else if(type == 'vimeo'){
                var video_id = parseVimeoUrl(url)

                $.ajax({
                    type:'GET',
                    url: 'http://vimeo.com/api/v2/video/' + video_id + '.json',
                    jsonp: 'callback',
                    dataType: 'jsonp',
                }).done(function (data) {

                    var orig = data[0].thumbnail_large,
                    t1 = orig.substr(0,orig.lastIndexOf('_')+1),
                    t3 = orig.substr(orig.lastIndexOf('.')),
                    t2 = options.vimeoThumbSize.substr(0,options.vimeoThumbSize.lastIndexOf('x'))

                    thumb = t1 + t2 + t3;

                    resolve(thumb);
                    
                }).fail(function (jqXHR, textStatus) {
                    reject(jqXHR.responseText)
                });

            }
            else if(type == 'dm'){
                var video_id = parseDmUrl(url)

                $.ajax({
                    type:'GET',
                    url: 'https://api.dailymotion.com/video/'+video_id+'?fields=thumbnail_large_url',
                    jsonp: 'callback',
                    dataType: 'jsonp',
                }).done(function (data) {

                    thumb = data.thumbnail_large_url;

                    resolve(thumb);

                }).fail(function (jqXHR, textStatus) {
                    reject(jqXHR.responseText)
                });

            }

        });
    }

    function setVideoPreview(type, url, element){

        if(type == 'video'){
            var str = $('<video class="aphs-featured-preview" controls="" src="'+url+'"></video>')
        }
        else if(type == 'audio'){
            var str = $('<audio class="aphs-featured-preview" controls="" src="'+url+'"></audio>')
        }
        else{

            if(url.indexOf('dailymotion') > -1){
                if(url.indexOf('embed') == -1) url = 'https://www.dailymotion.com/embed/video/'+parseDmUrl(url)
            }
            else if(url.indexOf('youtube') > -1){    
                if(url.indexOf('embed') == -1) url = 'http://www.youtube.com/embed/'+parseYoutubeUrl(url)
            }

            var str = '<iframe class="aphs-featured-preview" width="100%" height="auto" src="'+url+'" frameborder="0" allowfullscreen></iframe>';
        }
        
        element.html(str)
    }


    function getVideoType(v){

        var type;

        if(v.indexOf('youtube') > -1){
            type = 'youtube'
        }
        else if(v.indexOf('vimeo') > -1){
            type = 'vimeo'
        }
        else if(v.indexOf('dailymotion') > -1){
            type = 'dm'
        }
        else{
            //try to detect if user manually enters url
            if(audioList.indexOf(v) > -1)type = 'audio'
            else type = 'video'
          
        }

        return type;

    }

    //get thumb

    function parseYoutubeUrl(url){

        var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            return match[2];
        } else {
            console.log('APHS wrong youtube embed url?')
            //error
        }
    }

    function parseVimeoUrl(a){
        var r = /(videos|video|channels|\.com)\/([\d]+)/;
        return a.match(r)[2];
    }

    function parseDmUrl(url){

        var regExp = /video\/([^_]+)/;
        var match = url.match(regExp);
        if (match) {
            return match[1];
        }else{
            console.log('APHS wrong dailymotion embed url?')
        }

    }

	function isEmpty(str){
		return (str.length === 0 || !str.trim());
	}

	function selectText(element) {
		var doc = document, text = element, range, selection;    
		if (doc.body.createTextRange) { //ms
			range = doc.body.createTextRange();
			range.moveToElementText(text);
			range.select();
		} else if (window.getSelection) { //all others
			selection = window.getSelection();        
			range = doc.createRange();
			range.selectNodeContents(text);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}



});
