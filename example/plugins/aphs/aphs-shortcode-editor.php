<!DOCTYPE html>
<html>
	<head>
	<title>Hover Sounds shortcode editor</title>


      <style type="text/css">
            
            .aphs-admin{
                padding: 0px 10px 20px 10px;
            }
            #aphs-tab-shortcode-content textarea{
                width: 100%;
            }

            /* tabs */
            .aphs-tab-header{
                overflow: hidden;
                background-color: #f1f1f1;
                list-style-type: none;
                padding: 0;
            }
            .aphs-tab-header li{
                background-color: #f1f1f1;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 10px 13px;
                transition: 0.3s;
                text-decoration: none;
                margin: 0;
            }
            .aphs-tab-header li:hover,
            .aphs-tab-active{
                background-color: #ddd!important;
            }
            .aphs-tab-content{
                display: none;
                padding-left: 10px;
            }
            .aphs-tab-inner-content{
                border: 1px solid #cbcbcb;
                padding: 10px;
                margin-bottom: 10px;
            }
            .aphs-sound-upload{
                margin: 10px 0;
            }
            #id-url-pairs-sound-add{
                margin-top: 5px;
            }
            .aphs-sound-section-orig{
                display: none;
            }
            .aphs-sound-section{
                margin: 5px 0;
            }

      </style>


      <script src='<?php echo includes_url("js/jquery/jquery.js"); ?>'></script>

      <script>

      (function($){
            $(document).ready(function($) {

                  //general

                  var tabs = $('#aphs-shortcode-tabs');

                  tabs.find('.aphs-tab-header li').click(function(){
                      var tab = $(this), id = tab.attr('id');

                      if(!tab.hasClass('aphs-tab-active')){ 
                        tabs.find('.aphs-tab-header li').removeClass('aphs-tab-active');  
                        tab.addClass('aphs-tab-active');
                        tabs.find('.aphs-tab-content').hide();

                        tabs.find($('#'+ id + '-content')).show();
                      }
                  });

                  tabs.find('.aphs-tab-header li').eq(0).addClass('aphs-tab-active');
                  tabs.find('.aphs-tab-content').eq(0).show();

                 //sound in post editor cursor 

                  $('#aphs-sound-upload-to-post-editor').on( 'click', function() {

                        var parent_window = window.parent.window,
                        editor = window.parent.tinymce.activeEditor

                        var custom_uploader = parent_window.wp.media({
                              library:{
                                  type: "audio/*"
                              }
                        })

                        custom_uploader.on("select", function(){

                              var attachment = custom_uploader.state().get("selection").first().toJSON();
                              var s = ' data-hover-sound="'+attachment.url+'" '
                         
                              editor.execCommand('mceInsertContent', false, s);

                              editor.windowManager.close();

                        })
                        .open();

                  });

                  //id url pairs

                   var id_url_pairs_field = $('#id-url-pairs-field'),
                   id_url_pairs_sound_add = $('#id-url-pairs-sound-add')

                   id_url_pairs_sound_add.on( 'click', function() {

                        var section = id_url_pairs_field.find('.aphs-sound-section-orig').clone().removeClass('aphs-sound-section-orig')

                        section.find('input').val('')

                        section.insertBefore(id_url_pairs_sound_add)    

                   }).click();

                   id_url_pairs_field.on( 'click', '.id-url-pairs-sound-remove', function() {

                        $(this).closest('.aphs-sound-section').remove()

                   });

                   id_url_pairs_field.on( 'click', '.id-url-pairs-sound-upload', function() {

                        var btn = $(this)

                        var parent_window = window.parent.window,
                        editor = window.parent.tinymce.activeEditor

                        var custom_uploader = parent_window.wp.media({
                              library:{
                                  type: "audio/*"
                              }
                        })

                        custom_uploader.on("select", function(){

                            var attachment = custom_uploader.state().get("selection").first().toJSON();
                            
                            btn.closest('.aphs-sound-section').find('.id-url-pairs-sound-url').val(attachment.url)
 
                        })
                        .open();

                   });

                   var id_url_pairs_shortcode = $('#id-url-pairs-shortcode').on( 'click', function() {

                        id_url_pairs_shortcode.select()

                        document.execCommand("copy");

                   })

                   $('#id-url-pairs-get-shortcode').on( 'click', function() {

                        var id_arr = '', url_arr = ''

                        id_url_pairs_field.find('.aphs-sound-section:not(.aphs-sound-section-orig)').each(function(){

                            var field = $(this),
                            id = field.find('.id-url-pairs-sound-id').val(),
                            url = field.find('.id-url-pairs-sound-url').val()

                            if(id != '' && url != ''){

                                id_arr += id + ','
                                url_arr += url + ','

                            }
                        })

                        if(id_arr.length){

                            id_arr = id_arr.slice(0, -1)//remove last comma
                            url_arr = url_arr.slice(0, -1)

                            var s = '[aphs id="'+id_arr+'" url="'+url_arr+'"]'

                            id_url_pairs_shortcode.val(s)

                        }else{

                            var msg = $('#id-url-pairs-no-sounds-warning').val()
                            alert(msg)

                        }

                   });




            });
      })(jQuery)

      </script>

</head>		
<body>

	<div class="aphs-admin aphs-bg" id="aphs-tab-shortcode-content">

            <div id="aphs-shortcode-tabs">

                  <ul class="aphs-tab-header">
                        <li id="aphs-tab-create"><?php esc_html_e('Shortcode generator', APHS_TEXTDOMAIN); ?></li>
                        <li id="aphs-tab-info"><?php esc_html_e('Examples', APHS_TEXTDOMAIN); ?></li>
                  </ul>

                  <div id="aphs-tab-create-content" class="aphs-tab-content">

                        <div class="aphs-tab-inner-content">
                            <p><?php esc_html_e('Insert sound url in post editor (upload sound and url will be inserted in post editor at cursor position)', APHS_TEXTDOMAIN); ?></p>
                            <button id="aphs-sound-upload-to-post-editor" class="aphs-sound-upload" type="button"><?php esc_html_e('Upload sound', APHS_TEXTDOMAIN); ?></button>
                        </div>
                        
                        <div class="aphs-tab-inner-content" id="id-url-pairs-field">
                            <p><?php esc_html_e('Add sounds to elements (add element ID attribute and upload sound)', APHS_TEXTDOMAIN); ?></p>
                         
                            <div class="aphs-sound-section aphs-sound-section-orig">
                               
                                <input type="text" class="id-url-pairs-sound-id" placeholder="<?php esc_attr_e('Enter element ID attribute', APHS_TEXTDOMAIN); ?>">
                                <input type="text" class="id-url-pairs-sound-url" placeholder="<?php esc_attr_e('Sound url', APHS_TEXTDOMAIN); ?>">
                                <button class="id-url-pairs-sound-upload" type="button"><?php esc_html_e('Upload sound', APHS_TEXTDOMAIN); ?></button>


                                <button type="button" class="id-url-pairs-sound-remove"><?php esc_html_e('Remove sound', APHS_TEXTDOMAIN); ?></button>
                            </div>

                            <button type="button" id="id-url-pairs-sound-add"><?php esc_html_e('Add another sound', APHS_TEXTDOMAIN); ?></button>
                         
                            <p><?php esc_html_e('Shortcode', APHS_TEXTDOMAIN); ?></p>
                            <textarea id="id-url-pairs-shortcode" rows="3"></textarea>
                            <button type="button" id="id-url-pairs-get-shortcode"><?php esc_html_e('Get shortcode', APHS_TEXTDOMAIN); ?></button>


                            <input type="hidden" id="id-url-pairs-no-sounds-warning" value="<?php esc_html_e('Add sounds before generating shortcode!', APHS_TEXTDOMAIN); ?>">

                        </div>

                  </div>

                  <div id="aphs-tab-info-content" class="aphs-tab-content">

            		<h3><?php esc_html_e('Standard', APHS_TEXTDOMAIN); ?></h3>

                        <p><?php esc_html_e('Add shortcode in page (add ID attribute of HTML element you want to trigger sound and SOUND_URL)', APHS_TEXTDOMAIN); ?></p>

                        <textarea>[aphs id="ID_ATTRIBUTE" url="SOUND_URL"]</textarea>

                        <p><?php esc_html_e('Or target your element directly, add attribute to HTML element:', APHS_TEXTDOMAIN); ?></p>

                        <textarea>data-hover-sound="SOUND_URL"</textarea>

                        <p><?php esc_html_e('If its a word, wrap it in span so you can add data-hover-sound attribute:', APHS_TEXTDOMAIN); ?></p>

                        <textarea>&lt;span data-hover-sound="SOUND_URL">some text&lt;/span></textarea>
                        


                        <h3><?php esc_html_e('Inline links', APHS_TEXTDOMAIN); ?></h3>

                        <p><?php esc_html_e('Target hyperlink elements in page and adds pause / play icons to them. Add class="aphs-link" to your anchor and SOUND_URL.', APHS_TEXTDOMAIN); ?></p>

                        <textarea>&lt;a class="aphs-link" href="SOUND_URL">Song Title - Song Artist&lt;/a></textarea>

                        <p><?php esc_html_e('Example in text (this text contains links to 2 sounds):', APHS_TEXTDOMAIN); ?></p>

                        <textarea rows="7">Some text here. This is first sound link <a class="aphs-link" href="SOUND_URL">Song Title - Song Artist</a> ut laoreet hendrerit mi. Vestibulum in ipsum. Donec vitae lectus. Etiam commodo velit ut mi condimentum tellus tortor ut mi. Pellentesque habitant morbi tristique senectus. This is second sound link <a class="aphs-link" href="SOUND_URL">Song Title - Song Artist</a>. Class aptent taciti maecenas nec tellus, a mi ornare auctor.
                        </textarea>



                        <h3><?php esc_html_e('Predefined examples', APHS_TEXTDOMAIN); ?></h3>

                        <p><?php esc_html_e('Toggle button (pause / play)', APHS_TEXTDOMAIN); ?></p>

                        <textarea>[aphs type="toggle_button" url="SOUND_URL"]</textarea>

                        <p><?php esc_html_e('Image with volume icon', APHS_TEXTDOMAIN); ?></p>

                        <textarea>[aphs type="image_with_volume" image_url="IMAGE_URL" url="SOUND_URL"]</textarea>

                        <p><?php esc_html_e('Two buttons, one for normal sound, one for slow sound', APHS_TEXTDOMAIN); ?></p>

                        <textarea>[aphs type="speech_slow" url="SOUND_URL" url_slow="SLOW_SOUND_URL"]</textarea>

                        <p><?php esc_html_e('Two buttons, one for normal sound, one for ASL / sign language video', APHS_TEXTDOMAIN); ?></p>

                        <textarea>[aphs type="speech_aid" url="SOUND_URL" url_sign="ASL_VIDEO_URL"]</textarea>

      		</div>

            </div>      

	</div>
	


	</body>
</html>