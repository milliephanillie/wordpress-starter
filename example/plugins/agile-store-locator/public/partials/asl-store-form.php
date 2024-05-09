<?php

$default_country = (isset($all_configs['default_country']))? $all_configs['default_country']: 'null';

?>
<section class="asl-cont asl-store-form">
  <div class="sl-container">
      <div class="sl-row">
          <!-- Section Titile -->
          <div class="pol-md-12">
              <h1 class="section-title"><?php echo esc_attr__( 'Register your Store!','asl_locator') ?></h1>
              <p><?php echo esc_attr__( 'Fill up the form of your Store to register it for the approval by the administrator and it will list down in the Store Locator listing.','asl_locator') ?></p>
          </div>
      </div>
      <div class="sl-row">
          <div class="pol-md-12">
              <div id="sl-frm" class="asl-form sl-row">
                  <div class="pol-md-12">
                      <h3 class="sl-sub-title"><?php echo esc_attr__( 'STORE INFORMATION','asl_locator') ?></h3>
                  </div>
                  <!-- Name -->
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-title"><?php echo esc_attr__( 'Company','asl_locator') ?></label>
                          <input class="form-control" id="sl-title" type="text" maxlength="255" name="title">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-description"><?php echo esc_attr__( 'Name','asl_locator') ?></label>
                          <input class="form-control" id="sl-description" type="text" maxlength="255" name="description" required>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-website"><?php echo esc_attr__( 'Website URL','asl_locator') ?></label>
                          <input class="form-control" id="sl-website" type="text" maxlength="255" name="website">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-phone"><?php echo esc_attr__( 'Phone','asl_locator') ?></label>
                          <input class="form-control" id="sl-phone" type="text" maxlength="255" name="phone">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-fax"><?php echo esc_attr__( 'Fax','asl_locator') ?></label>
                          <input class="form-control" id="sl-fax" type="text" maxlength="255" name="fax">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-email"><?php echo esc_attr__( 'Email','asl_locator') ?></label>
                          <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" id="sl-email" type="text" maxlength="255" name="email">
                          <div class="help-block with-errors"><?php echo esc_attr__( 'Enter correct email address','asl_locator') ?></div>
                      </div>
                  </div>
                  <div class="pol-md-6">
                      <div class="sl-form-group sl-form-categories sl-group">
                          <label for="sl-categories" class="control-label"><?php echo esc_attr__( 'Categories','asl_locator') ?></label>
                          <select class="form-control custom-select" id="sl-categories" multiple="multiple" name="sl-categories">
                            <?php foreach($all_categories as $category): ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->category_name ?></option>
                            <?php endforeach ?>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="pol-md-12">
                      <h3 class="sl-sub-title"><?php echo esc_attr__( 'ADDRESS LOCATION','asl_locator') ?></h3>
                  </div>
                  <div id="sl-grp-street" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-street"><?php echo esc_attr__( 'Street','asl_locator') ?></label>
                          <input class="form-control" id="sl-street" type="text" maxlength="255" name="street">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-city" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-city"><?php echo esc_attr__( 'City','asl_locator') ?></label>
                          <input class="form-control" id="sl-city" type="text" maxlength="255" required name="city">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-state" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-state"><?php echo esc_attr__( 'State','asl_locator') ?></label>
                          <input class="form-control" id="sl-state" type="text" maxlength="255" name="state">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-postal_code" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-postal_code"><?php echo esc_attr__( 'Postal Code','asl_locator') ?></label>
                          <input class="form-control" id="sl-postal_code" type="text" maxlength="255" required name="postal_code">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-country" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-country"><?php echo esc_attr__( 'Country','asl_locator') ?></label>
                          <select class="form-control custom-select" id="sl-country" required name="country">
                            <option value=""><?php echo esc_attr__( 'Select','asl_locator') ?></option>
                            <?php foreach($countries as $country): ?>
                            <option <?php if($default_country && $default_country == $country->id) echo 'selected' ?> value="<?php echo $country->id ?>"><?php echo $country->country ?></option>
                            <?php endforeach ?>
                          </select>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-lat" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-lat"><?php echo esc_attr__( 'Latitude','asl_locator') ?></label>
                          <input class="form-control" id="sl-lat" type="text" maxlength="255" name="lat">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-lng" class="pol-md-6">
                      <div class="sl-form-group sl-group">
                          <label class="control-label" for="sl-lng"><?php echo esc_attr__( 'Longitude','asl_locator') ?></label>
                          <input class="form-control" id="sl-lng" type="text" maxlength="255" name="lng">
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div id="sl-grp-desc" class="pol-md-12">
                    <div class="sl-row">
                      <div class="pol-md-12">
                        <h3 class="sl-sub-title"><?php echo esc_attr__( 'Additional Data','asl_locator') ?></h3>
                      </div>
                      <?php foreach($fields as $field): 
                      $field_name  = $field['name'];
                      $field_label = $field['label'];
                      ?>
                      <div class="pol-md-6">
                        <div class="sl-form-group sl-group">
                          <label class="control-label" for="custom-f-<?php echo $field_name; ?>"><?php echo $field_label; ?></label>
                          <input type="text" id="custom-f-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>"  class="form-control">
                        </div>
                      </div>
                    <?php endforeach; ?>
                      <div class="pol-md-6">
                          <div class="sl-form-group sl-group">
                              <label for="sl-description_2" class="control-label"><?php echo esc_attr__( 'Additional Description','asl_locator') ?></label>
                              <textarea class="form-control" rows="3" id="sl-description_2"  name="description_2"></textarea>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="pol-md-12">
                    <div class="sl-form-group">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="" id="sl-agr-check" required>
                        <label class="custom-control-label" for="sl-agr-check">
                          <?php echo esc_attr__( 'I agree to terms and conditions and all the provided information is correct','asl_locator') ?>
                        </label>
                        <div class="invalid-feedback">
                          <?php echo esc_attr__( 'Please agree to register for store in the listing.','asl_locator') ?></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pol-md-12">
                      <div class="sl-form-group mt-3">
                          <a data-loading-text="<?php echo esc_attr__( 'Registering...','asl_locator') ?>" class="btn btn-default btn-primary disabled" id="sl-btn-save"><?php echo esc_attr__( 'Register','asl_locator') ?></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>