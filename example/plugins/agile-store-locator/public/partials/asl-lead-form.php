<?php

?>
<section class="asl-cont asl-lead-cont">
  <form id="asl-lead-form" class="asl-lead-form" novalidate method="post" onsubmit="return false">
  <div class="asl-wrapper mt-3">
    <div class="sl-container">
      <article class="sl-form-box">
        <div class="sl-top-title">
          <h3><?php echo esc_attr__( 'Find a Dealer','asl_locator') ?></h3>
          <p><?php echo esc_attr__( 'Are you ready to Experience the Difference? Just fill out the form below and one of our helpful Bintelli Representatives will find your nearest dealer and get you in contact!','asl_locator') ?></p>
        </div>
        <div class="sl-row justify-content-center">
          <div class="pol-md-7 pol-sm-12">
            <div class="sl-row">
              <div class="pol-md-6 pol-sm-6 sl-name-field">
                <div class="sl-form-group">
                  <input type="text" name="name"  required data-pristine-required-message="<?php echo esc_attr__( 'Please enter your name','asl_locator') ?>" placeholder="<?php echo esc_attr__( 'Full Name','asl_locator') ?>" class="form-control sl-form-fields">
                </div>
              </div>
              <div class="pol-md-6 pol-sm-6 sl-email-field">
                <div class="sl-form-group">
                  <input type="email" name="email" required data-pristine-required-message="<?php echo esc_attr__( 'Please enter valid email','asl_locator') ?>" placeholder="<?php echo esc_attr__( 'Email','asl_locator') ?>" class="form-control sl-form-fields">
                </div>
              </div>
              <div class="pol-md-6 pol-sm-6 sl-phone-field">
                <div class="sl-form-group">
                  <input type="tel" name="phone" required data-pristine-required-message="<?php echo esc_attr__( 'Please enter phone number','asl_locator') ?>" placeholder="<?php echo esc_attr__( 'Phone Name','asl_locator') ?>" class="form-control sl-form-fields">
                </div>
              </div>
              <div class="pol-md-6 pol-sm-6 sl-zip-field">
                <div class="sl-form-group">
                  <input type="text" name="postal_code" required data-pristine-required-message="<?php echo esc_attr__( 'Please enter zip code','asl_locator') ?>" placeholder="<?php echo esc_attr__( 'Zip Code','asl_locator') ?>" class="form-control sl-form-fields">
                </div>
              </div>
              <div class="pol-12 sl-message-field">
                <div class="sl-form-group">
                  <textarea name="message" placeholder="<?php echo esc_attr__( 'Message','asl_locator') ?>" class="form-control sl-form-fields"></textarea>
                </div>
              </div>
              <div class="pol-12 text-center">
                <a data-loading-text="<?php echo esc_attr__( 'Submitting...','asl_locator') ?>" class="sl-submit-btn" id="sl-lead-save"><?php echo esc_attr__( 'Submit','asl_locator') ?></a>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
  </div>
</form>
</section>