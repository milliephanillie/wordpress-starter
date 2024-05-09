<div id="agile-modal-direction" class="agile-modal fade">
    <div class="agile-modal-backdrop-in"></div>
    <div class="agile-modal-dialog in">
        <div class="agile-modal-content">
            <div class="sl-form-group d-flex justify-content-between">
                <h4><?php echo esc_attr__('Get Your Directions', 'asl_locator') ?></h4>
                <button type="button" class="close-directions sl-close" data-dismiss="agile-modal" aria-label="Close">&times;</button>
            </div>
            <div class="sl-form-group">
                <label for="frm-lbl"><?php echo esc_attr__('From', 'asl_locator') ?>:</label>
                <input type="text" class="form-control frm-place" id="frm-lbl" placeholder="<?php echo esc_attr__('Enter a Location', 'asl_locator') ?>">
            </div>
            <div class="sl-form-group">
                <label for="frm-lbl"><?php echo esc_attr__('To', 'asl_locator') ?>:</label>
                <input readonly="true" type="text"  class="directions-to form-control" id="to-lbl" placeholder="<?php echo esc_attr__('Prepopulated Destination Address', 'asl_locator') ?>">
            </div>
            <div class="sl-form-group mb-0">
                <label class="checkbox-inline">
                    <input type="radio" name="dist-type"  id="rbtn-km" value="0"> <?php echo esc_attr__('KM', 'asl_locator') ?>
                </label>
                <label class="checkbox-inline">
                    <input type="radio" name="dist-type" checked id="rbtn-mile" value="1"> <?php echo esc_attr__('Mile', 'asl_locator') ?>
                </label>
            </div>
            <div class="sl-form-group mb-0">
                <button type="submit" class="btn btn-default btn-submit"><?php echo esc_attr__('GET DIRECTIONS', 'asl_locator') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="asl-geolocation-agile-modal" class="agile-modal fade">
  <div class="agile-modal-backdrop-in"></div>
  <div class="agile-modal-dialog in">
    <div class="agile-modal-content">
      <?php if($all_configs['prompt_location'] == '2'): ?>
      <div class="sl-form-group d-flex justify-content-between">
        <h4><?php echo esc_attr__('LOCATE YOUR GEOPOSITION', 'asl_locator') ?></h4>
        <button type="button" class="close-directions sl-close" data-dismiss="agile-modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="sl-form-group">
        <div class="sl-row">
        <div class="pol-lg-9">
          <input type="text" class="form-control" id="asl-current-loc" placeholder="<?php echo esc_attr__('Your Address', 'asl_locator') ?>">
        </div>
        <div class="pol-lg-3 pl-lg-0">
          <button type="button" id="asl-btn-locate" class="btn btn-block btn-default"><?php echo esc_attr__('LOCATE', 'asl_locator') ?></button>
        </div>
        </div>
      </div>
      <?php else: ?>
      <div class="sl-form-group d-flex justify-content-between">
        <h5><?php echo esc_attr__('Use my location to find the closest Service Provider near me', 'asl_locator') ?></h5>
        <button type="button" class="close-directions sl-close" data-dismiss="agile-modal" aria-label="Close" aria-hidden="true">&times;</button>
      </div>
      <div class="sl-form-group text-center mb-0">
        <button type="button" id="asl-btn-geolocation" class="btn btn-block btn-default"><?php echo esc_attr__('USE LOCATION', 'asl_locator') ?></button>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div id="asl-desc-agile-modal" class="agile-modal fade">
  <div class="agile-modal-backdrop-in"></div>
  <div class="agile-modal-dialog in">
    <div class="agile-modal-content">
      <div class="sl-row">
        <div class="pol-md-12">
          <div class="sl-form-group d-flex justify-content-between">
            <h4 class="sl-title"></h4>
            <button type="button" class="close-directions sl-close" data-dismiss="agile-modal" aria-label="Close">&times;</button>
          </div>
          <p class="sl-desc"></p>
        </div>
      </div>
    </div>
  </div>
</div>