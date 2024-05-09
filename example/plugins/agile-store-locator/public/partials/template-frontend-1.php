<?php

$geo_btn_class      = ($all_configs['geo_button'] == '1')? 'asl-geo icon-direction-outline':'icon-search';
$search_type_class  = ($all_configs['search_type'] == '1')? 'asl-search-name':'asl-search-address';
$panel_order        = (isset($all_configs['map_top']))? $all_configs['map_top']: '2';


$ddl_class      = '';


$class = (isset($all_configs['css_class']))? ' '.$all_configs['css_class']: '';

if($all_configs['display_list'] == '0' || $all_configs['first_load'] == '3' || $all_configs['first_load'] == '4')
  $class .= ' map-full';

if($all_configs['pickup'] || $all_configs['ship_from'])
  $class .= ' sl-pickup-tmpl';

if($all_configs['full_width'])
  $class .= ' full-width';

if(isset($all_configs['full_map']))
  $class .= ' map-full-width';

if($all_configs['advance_filter'] == '0')
  $class .= ' no-asl-filters';

if($all_configs['advance_filter'] == '1' && $all_configs['layout'] == '1')
  $class .= ' asl-adv-lay1';

if($all_configs['tabs_layout'] == '1') {

  $ddl_class  .= ' asl-tabs-ddl pol-12 pol-lg-12 pol-md-12 pol-sm-12';
  $class      .= ' sl-category-tabs';
}

//add Full height
$class .= ' '.$all_configs['full_height'];

$layout_code        = ($all_configs['layout'] == '1'  || $all_configs['layout'] == '2')? '1': '0';
$default_addr       = (isset($all_configs['default-addr']))?$all_configs['default-addr']: '';
$container_class    = (isset($all_configs['full_width']) && $all_configs['full_width'])? 'sl-container-fluid': 'sl-container';
?>
<style type="text/css">
  <?php echo $css_code; ?>
  .asl-cont .onoffswitch .onoffswitch-label .onoffswitch-switch:before {content: "<?php echo esc_attr__('OPEN', 'asl_locator') ?>" !important;}
  .asl-cont .onoffswitch .onoffswitch-label .onoffswitch-switch:after {content: "<?php echo esc_attr__('ALL', 'asl_locator') ?>" !important;}
  @media (max-width: 767px) {
  #asl-storelocator.asl-cont .asl-panel {order: <?php echo $panel_order ?>;}
  }
</style>
<div id="asl-storelocator" class="storelocator-main asl-cont asl-template-1 asl-layout-<?php echo $layout_code; ?> asl-bg-<?php echo $all_configs['color_scheme_1'].$class; ?> asl-text-<?php echo $all_configs['font_color_scheme'] ?>">
  <div class="asl-wrapper">
    <div class="<?php echo $container_class ?>">
      <?php if($all_configs['gdpr'] == '1'): ?>
      <div class="sl-gdpr-cont">
          <div class="gdpr-ol"></div>
          <div class="gdpr-ol-bg">
            <div class="gdpr-box">
              <p><?php echo esc_attr__( 'Due to the GDPR, we need your consent to load data from Google, more information in our privacy policy.', 'asl_locator') ?></p>
              <a class="btn btn-asl" id="sl-btn-gdpr"><?php echo esc_attr__( 'Load Store Locator','asl_locator') ?></a>
            </div>
          </div>
      </div>
      <?php endif; ?>
      <div class="Filter_section">
        <div class="sl-row">
          <div class="sl-form-group search_filter">
            <label><?php echo esc_attr__( 'Search Location', 'asl_locator') ?></label>
            <div class="sl-search-group d-flex">
               <input type="text" value="<?php echo $default_addr ?>" data-submit="disable"  tabindex="2" id="auto-complete-search" placeholder="<?php echo esc_attr__( 'Enter a Location', 'asl_locator') ?>"  class="<?php echo $search_type_class ?> form-control isp_ignore">
               <button type="button" class="span-geo"><i class="<?php echo $geo_btn_class ?>" title="<?php echo ($all_configs['geo_button'] == '1')?__('Current Location','asl_locator'):__('Search Location','asl_locator') ?>"></i></button>
            </div>
          </div>
          <div class="sl-form-group range_filter hide asl-ddl-filters">
            <label><?php echo esc_attr__( 'In', 'asl_locator') ?></label>
            <div class="rangeFilter asl-filter-cntrl">
              <input id="asl-radius-slide" type="text" class="span2" />
              <span class="rad-unit"><?php echo esc_attr__( 'Radius', 'asl_locator') ?>: <span id="asl-radius-input"></span><span id="asl-dist-unit"><?php echo esc_attr__( 'KM','asl_locator') ?></span></span>
            </div>
          </div>
          <div class="sl-form-group Status_filter">
            <div class="asl-filter-cntrl">
               <div class="onoffswitch">
                  <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="asl-open-close" checked>
                  <label class="onoffswitch-label" for="asl-open-close">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
                  </label>
               </div>
            </div>
          </div>
        </div>
        <div class="asl-advance-filters hide">
          <div class="sl-row">
            <?php if($all_configs['search_2']): ?>
            <div class="sl-form-group search_filter asl-name-search">
              <div class="asl-filter-cntrl">
                <p class="mb-2"><?php echo esc_attr__( 'Search Name', 'asl_locator') ?></p>
                <div class="sl-search-group">
                  <input type="text" tabindex="2"  placeholder="<?php echo esc_attr__( 'Search Name', 'asl_locator') ?>"  class="asl-search-name form-control isp_ignore">
                </div>
              </div>
            </div>
            <?php endif ?>
            <?php if($all_configs['show_categories']): ?>
            <div class="<?php echo $ddl_class ?> sl-form-group asl-ddl-filters">
                <div class="asl-filter-cntrl">
                  <label class="asl-cntrl-lbl"><?php echo $all_configs['category_title']  ?></label>
                  <div class="sl-dropdown-cont" id="categories_filter">
                  </div>
                </div>
            </div>
            <?php endif ?>
            <?php if($filter_ddl): ?>
            <?php foreach ($filter_ddl as $a_filter):?>
            <div class="<?php echo $ddl_class ?> sl-form-group asl-ddl-filters">
                <div class="asl-filter-cntrl">
                  <label class="asl-cntrl-lbl"><?php echo esc_attr__( $a_filter, 'asl_locator') ?></label>
                  <div class="sl-dropdown-cont" id="<?php echo $a_filter ?>_filter">
                  </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="sl-row">
        <div class="pol-12">
            <div class="sl-main-cont">
                <div class="sl-row no-gutters sl-main-row">
                    <div id="asl-panel" class="asl-panel pol-md-5 pol-lg-4 asl_locator-panel">
                        <div class="asl-overlay" id="map-loading">
                            <div class="white"></div>
                            <div class="sl-loading">
                              <i class="animate-sl-spin icon-spin3"></i>
                              <?php echo esc_attr__('Loading...', 'asl_locator') ?>
                            </div>
                        </div>
                        <!-- list -->
                        <div class="asl-panel-inner">
                            <div class="top-title Num_of_store">
                              <span><?php echo $all_configs['head_title'] ?>: <span class="count-result">0</span></span>
                              <a class="asl-print-btn"><span><?php echo esc_attr__('PRINT', 'asl_locator') ?></span><span class="asl-print"></span></a>
                            </div>
                            <div class="sl-main-cont-box">
                              <div id="asl-list" class="sl-list-wrapper">
                                <ul id="p-statelist" class="sl-list">
                                </ul>
                              </div>
                            </div>
                        </div>
                        <div class="directions-cont hide">
                            <div class="agile-modal-header">
                                <button type="button" class="close"><span aria-hidden="true">×</span></button>
                                <h4><?php echo esc_attr__( 'Store Direction', 'asl_locator') ?></h4>
                            </div>
                            <div class="rendered-directions" id="asl-rendered-dir" style="direction: ltr;"></div>
                        </div>
                    </div>
                    <div class="pol-md-7 pol-lg-8 asl-map">
                        <div class="map-image">
                            <div id="asl-map-canv" class="asl-map-canv"></div>
                            <?php include ASL_PLUGIN_PATH.'public/partials/_agile_modal.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- This plugin is developed by "Agile Store Locator by WordPress" https://agilestorelocator.com -->