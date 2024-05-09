<?php 

	$playbackMethod = array(    
	    'hover' => 'hover',
	    'click' => 'click'
	);



	$current_options = get_option('aphs_player_options');
	$default_options = aphs_getOptions();
	$options = $current_options + $default_options;





	//custom css
	$customCss = $options['customCss'];

?>

<div class="wrap">

	<form action="" id="aphsform" method="post">

	<div class="aphs-admin">

	<div id="aphs-general-tabs">

        <div class="aphs-tab-header">
        	<div id="aphs-tab-audio"><?php esc_html_e('General', APHS_TEXTDOMAIN); ?></div>
            <div id="aphs-tab-ga"><?php esc_html_e('Google Analytics', APHS_TEXTDOMAIN); ?></div>
            <div id="aphs-tab-custom-css"><?php esc_html_e('Custom CSS', APHS_TEXTDOMAIN); ?></div>
            <div id="aphs-tab-shortcode"><?php esc_html_e('Shortcodes', APHS_TEXTDOMAIN); ?></div>
        </div>

        <div id="aphs-tab-audio-content" class="aphs-tab-content">

			<h3><?php esc_html_e('Playback settings', APHS_TEXTDOMAIN); ?></h3>

			<table class="form-table">

                <tr>
                    <th><?php esc_html_e('Playback method', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <select name="playbackMethod">
                            <?php foreach ($playbackMethod as $key => $value) : ?>
                                <option value="<?php echo($key); ?>" <?php if(isset($options['playbackMethod']) && $options['playbackMethod'] == $key) echo 'selected' ?>><?php echo($value); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="info"><?php esc_html_e('How to trigger audio play action. On desktop browsers it can be hover or click, on mobile its always click.', APHS_TEXTDOMAIN); ?></p>
                    </td>
                </tr>
              
                <tr>
                    <th><?php esc_html_e('Playback rate', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <input type="number" name="playbackRate" step="0.1" value="<?php echo($options['playbackRate']); ?>">
                        <p class="info"> <?php esc_html_e('Audio playback rate', APHS_TEXTDOMAIN); ?> <a href="https://developer.mozilla.org/en-US/docs/Web/API/HTMLMediaElement/playbackRate" target="_blank">https://developer.mozilla.org/en-US/docs/Web/API/HTMLMediaElement/playbackRate</a></p>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('Rewind on hover', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <label><input name="rewindOnHover" type="checkbox" value="1" <?php if(isset($options['rewindOnHover']) && $options['rewindOnHover'] == "1") echo 'checked' ?>> <?php esc_html_e('Rewind audio on hover to beginning.', APHS_TEXTDOMAIN); ?></label>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('Loop sound', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <label><input name="loop" type="checkbox" value="1" <?php if(isset($options['loop']) && $options['loop'] == "1") echo 'checked' ?>> <?php esc_html_e('Loop sound on finish.', APHS_TEXTDOMAIN); ?></label>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('Allow multiple sounds to play simultaneously', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <label><input name="allowMultipleSoundsAtOnce" type="checkbox" value="1" <?php if(isset($options['allowMultipleSoundsAtOnce']) && $options['allowMultipleSoundsAtOnce'] == "1") echo 'checked' ?>> <?php esc_html_e('Works when playback method is click.', APHS_TEXTDOMAIN); ?></label>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('Start sound time', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <input type="number" name="startTime" min="0" value="<?php echo($options['startTime']); ?>">
                        <p class="info"><?php esc_html_e('Specify sound global start time in seconds. Each sound will start at that time.', APHS_TEXTDOMAIN); ?></p>
                    </td>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('End sound time', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <input type="number" name="endTime" min="0" value="<?php echo($options['endTime']); ?>">
                        <p class="info"><?php esc_html_e('Specify sound global end time in seconds. Each sound will end at that time.', APHS_TEXTDOMAIN); ?></p>
                    </td>
                    </td>
                </tr>

            </table>    

            <h3><?php esc_html_e('Override WordPress audio', APHS_TEXTDOMAIN); ?></h3>

            <table class="form-table">

                <tr valign="top">
                    <th><?php esc_html_e('Override WordPress single audio', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <label><input name="overrideWpAudio" type="checkbox" value="1" <?php if(isset($options['overrideWpAudio']) && $options['overrideWpAudio'] == "1") echo 'checked' ?>> <?php esc_html_e('Create toggle buttons from WordPress single audio embeds.', APHS_TEXTDOMAIN); ?></label>
                    </td>
                </tr>

                <tr valign="top">
                    <th><?php esc_html_e('Override WordPress audio additional classes', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <label><input name="overrideWpAudioClass" type="text" value="<?php echo($options['overrideWpAudioClass']); ?>">
                        <p class="info"><?php esc_html_e('Specify additional classes for WordPress audio overrides.', APHS_TEXTDOMAIN); ?></p>
                    </td>
                </tr>

            </table>

            <h3><?php esc_html_e('Icons', APHS_TEXTDOMAIN); ?></h3>

			<table class="form-table" id="aphs-icon-table">

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Toggle button Play Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['togglePlayIcon']) ? esc_html($options['togglePlayIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="togglePlayIcon" id="togglePlayIcon" value="<?php echo($options['togglePlayIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Toggle button Pause Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['togglePauseIcon']) ? esc_html($options['togglePauseIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="togglePauseIcon" id="togglePauseIcon" value="<?php echo($options['togglePauseIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Inline Play Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['inlinePlayIcon']) ? esc_html($options['inlinePlayIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="inlinePlayIcon" id="inlinePlayIcon" value="<?php echo($options['inlinePlayIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Inline Pause Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['inlinePauseIcon']) ? esc_html($options['inlinePauseIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="inlinePauseIcon" id="inlinePauseIcon" value="<?php echo($options['inlinePauseIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Image Volume Off Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['volumeOffIcon']) ? esc_html($options['volumeOffIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="volumeOffIcon" id="volumeOffIcon" value="<?php echo($options['volumeOffIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Image Volume On Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['volumeOnIcon']) ? esc_html($options['volumeOnIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="volumeOnIcon" id="volumeOnIcon" value="<?php echo($options['volumeOnIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Speech Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['speechIcon']) ? esc_html($options['speechIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="speechIcon" id="speechIcon" value="<?php echo($options['speechIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Speech Slow Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img class="aphs-img-preview" src="<?php echo (isset($options['speechSlowIcon']) ? esc_html($options['speechSlowIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="speechSlowIcon" id="speechSlowIcon" value="<?php echo($options['speechSlowIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

                <tr class="aphs-icon-field">
                    <th><?php esc_html_e('Speech Aid Icon', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <div class="aphs-img-preview-wrap">
                            <img iclass="aphs-img-preview" src="<?php echo (isset($options['speechAidIcon']) ? esc_html($options['speechAidIcon']) : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D'); ?>" alt="">
                        </div>
                        <input type="text" class="aphs-icon-value" name="speechAidIcon" id="speechAidIcon" value="<?php echo($options['speechAidIcon']); ?>">
                        <button type="button" class="aphs-upload-icon"><?php esc_html_e('Upload', APHS_TEXTDOMAIN); ?></button>
                        <button type="button" class="aphs-remove-icon"><?php esc_html_e('Remove', APHS_TEXTDOMAIN); ?></button>
                    </td>
                </tr>

            </table>

           
        
		</div>

        <div id="aphs-tab-ga-content" class="aphs-tab-content">

            <p><?php esc_html_e('Activate Google Analytics so you can track click on sounds inside Google Analytics dashboard.', APHS_TEXTDOMAIN); ?></p>

            <table class="form-table">
                
                <tr valign="top">
                    <th><?php esc_html_e('Use Google Analytics', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <select name="useGa">
                            <option value="0" <?php if(isset($options['useGa']) && $options['useGa'] == "0") echo 'selected' ?>><?php esc_html_e('no', APHS_TEXTDOMAIN); ?></option>
                            <option value="1" <?php if(isset($options['useGa']) && $options['useGa'] == "1") echo 'selected' ?>><?php esc_html_e('yes', APHS_TEXTDOMAIN); ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th><?php esc_html_e('Google Analytics tracking ID', APHS_TEXTDOMAIN); ?></th>
                    <td>
                        <input type="text" name="gaTrackingId" value="<?php echo($options['gaTrackingId']); ?>"><br>
                        <p class="info"><?php printf(__( 'Get tracking ID <a href="%s" target="_blank">here</a>', APHS_TEXTDOMAIN), esc_url( 'https://support.google.com/analytics/answer/1008080' ));?></p>
                    </td>
                </tr>
               
            </table>

        </div>

        <div id="aphs-tab-custom-css-content" class="aphs-tab-content">

       	 	<p><?php esc_html_e('Add custom CSS', APHS_TEXTDOMAIN); ?></p>
        	<textarea name="customCss" id="aphs_custom_css_field"><?php echo($customCss); ?></textarea>

        </div>

        <div id="aphs-tab-shortcode-content" class="aphs-tab-content">

            <h3><?php esc_html_e('Standard', APHS_TEXTDOMAIN); ?></h3>

            <p><?php esc_html_e('Add shortcode in page (add ID attribute of HTML element you want to trigger sound and SOUND_URL)', APHS_TEXTDOMAIN); ?></p>

            <textarea>[aphs_sound id="ID_ATTRIBUTE" url="SOUND_URL"]</textarea>

            <p><?php esc_html_e('Or target your element directly, add attribute to HTML element:', APHS_TEXTDOMAIN); ?></p>

            <textarea>data-hover-sound="SOUND_URL"</textarea>

            <p><?php esc_html_e('If its a word, wrap it in span so you can add data-hover-sound attribute:', APHS_TEXTDOMAIN); ?></p>

            <textarea>&lt;span data-hover-sound="SOUND_URL">some text&lt;/span></textarea>
            


            <h3><?php esc_html_e('Inline links', APHS_TEXTDOMAIN); ?></h3>

            <p><?php esc_html_e('Target hyperlink elements in page and adds pause / play icons to them. Add class="aphs-link" to your anchor and SOUND_URL.', APHS_TEXTDOMAIN); ?></p>

            <textarea>&lt;a class="aphs-link" href="SOUND_URL">Song Title - Song Artist&lt;/a></textarea>

            <p><?php esc_html_e('Example in text (this text contains links to 2 sounds):', APHS_TEXTDOMAIN); ?></p>

            <textarea rows="5">Pause and play icons will automatically be attached to every song in this text. This is first sound link <a class="aphs-link" href="SOUND_URL">Song Title - Song Artist</a> ut laoreet hendrerit mi. Vestibulum in ipsum. Donec vitae lectus. Etiam commodo velit ut mi condimentum tellus tortor ut mi. Pellentesque habitant morbi tristique senectus. This is second sound link <a class="aphs-link" href="SOUND_URL">Song Title - Song Artist</a>. Class aptent taciti maecenas nec tellus, a mi ornare auctor.
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

	<p><button type="button" name="aphs-save-options-submit" id="aphs-save-options-submit" class="button button-primary" <?php disabled( !current_user_can(APHS_CAPABILITY) ); ?>><?php esc_html_e('Save Changes', APHS_TEXTDOMAIN); ?></button></p>

	</form>

</div> 


<div id="aphs-loader">
    <div class="aphs-loader-anim">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>