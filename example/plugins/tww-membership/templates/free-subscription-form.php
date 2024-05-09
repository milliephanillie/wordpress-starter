<?php
/**
 * Template for the free subscription form
 *
 * @package TWWForms
 */
?>
<div class="tww-registration-wrapper">
    <form id="tww-registration-free">
        <div class="tww-input-group">
            <div class="tww-form-field">
                <label for="email">Email *</label>
                <input id="tww-plus-email" type="email" value="" placeholder="Email" />
            </div>
        </div>
        <div class="tww-registration-submit">
            <button class="btn-tww-registration" type="submit">
                <div id="tww-plus-button-loader" class="button-loader button-loader-absolute">
                    <?php
                        // if (file_exists(TWW_FORMS_PLUGIN . 'resources/assets/images/icons/loader-rings-white.svg')) {
                        //     echo file_get_contents(TWW_FORMS_PLUGIN . 'resources/assets/images/icons/loader-rings-white.svg');
                        // } else {
                        //     echo 'Loading...';
                        // }
                    ?>
                </div> 
                <span id="tww-plus-subscribe-button-text">Subscribe</span>
            </button>
            <div id="registration-success" class="success-message tww-form-error"> </div>
        </div>
    </form>
</div>