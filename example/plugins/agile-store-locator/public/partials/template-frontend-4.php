<?php


$class=(isset($all_configs['css_class']))? ' '.$all_configs['css_class']: '';

if($all_configs['display_list'] == '0' || $all_configs['first_load'] == '3' || $all_configs['first_load'] == '4')
  $class .= ' map-full';



//add sl-full-star height
$class .= ' '.$all_configs['full_height'];

$default_addr = (isset($all_configs['default-addr']))?$all_configs['default-addr']: '';


$container_class    = (isset($all_configs['sl-full-star_width']) && $all_configs['sl-full-star_width'])? 'container-fluid': 'container';
$geo_btn_class      = ($all_configs['geo_button'] == '1')?'asl-geo icon-direction':'icon-search';
$geo_btn_text       = ($all_configs['geo_button'] == '1')?__('Current Location', 'asl_locator'):__('Search', 'asl_locator');
$search_type_class  = ($all_configs['search_type'] == '1')?'asl-search-name':'asl-search-address';
$panel_order        = (isset($all_configs['map_top']))?$all_configs['map_top']: '2';

?>
<style type="text/css">
    .asl-cont .table,
    .asl-cont .table * {border-color: #A994BD !important;}

    .sl-table-toggle {display: inline-block !important;margin-left: 10px;font-size: 14px;cursor: pointer;}
    .sl-table-toggle span:first-child {display: block;}
    .sl-table-toggle span:last-child {display: none;}

    .sl-table-toggle.actv span:first-child {display: none;}
    .sl-table-toggle.actv span:last-child {display: block;}
</style>

<section id="asl-storelocator" class="asl-cont asl-template-4 asl-layout-<?php echo $all_configs['layout']; ?> asl-bg-<?php echo $all_configs['color_scheme'].$class; ?> asl-text-<?php echo $all_configs['font_color_scheme'] ?>">
    <?php if($all_configs['gdpr'] == '1'): ?>
    <div class="sl-gdpr-cont">
        <div class="gdpr-ol"></div>
        <div class="gdpr-ol-bg"></div>
        <div class="gdpr-box">
          <p><?php echo esc_attr__( 'Due to the GDPR, we need your consent to load data from Google, more information in our privacy policy.', 'asl_locator') ?></p>
          <a class="btn btn-asl" id="sl-btn-gdpr"><?php echo esc_attr__( 'Accept','asl_locator') ?></a>
        </div>
    </div>
    <?php endif; ?>
    <div class="asl-overlay" id="map-loading">
        <div class="white"></div>
        <div class="sl-loading">
          <i class="animate-sl-spin icon-spin3"></i>
          <?php echo esc_attr__('Loading...', 'asl_locator') ?>
        </div>
    </div>
    <div class="asl-search">
        <div class="sl-container">
            <div class="sl-row">
                <div class="pol-12">
                    <div class="asl-search-inner">
                        <div class="sl-form">
                            <div class="asl-addr-search">
                                <input type="text" value="<?php echo $default_addr ?>" id="sl-main-search" class="form-control" placeholder="<?php echo esc_attr__( 'Enter your address', 'asl_locator') ?>" />
                                <a class="sl-search">
                                    <svg version="1.1" class="current-color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="500px" height="500px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
                                    <path d="M402.2,390l-74.7-74.8c46.1-56.2,37.9-139.2-18.4-185.3S169.9,92,123.8,148.2S86,287.4,142.2,333.5
                                          c48.5,39.8,118.4,39.8,166.9,0l74.7,74.7c5,5.1,13.2,5.1,18.3,0l0,0c5-4.9,5.1-13,0.2-18C402.3,390.1,402.2,390,402.2,390L402.2,390
                                          z M226.2,337c-58,0-104.9-47-104.9-105s47-104.9,105-104.9s104.9,47,104.9,105C331.1,290,284.1,337,226.2,337z"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="asl-geo" title="<?php echo esc_attr__('Current Location', 'asl_locator') ?>">
                                <a><svg class="current-color" fill="#000000" height="48" viewBox="0 0 24 24" width="48" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20.94 11c-.46-4.17-3.77-7.48-7.94-7.94V1h-2v2.06C6.83 3.52 3.52 6.83 3.06 11H1v2h2.06c.46 4.17 3.77 7.48 7.94 7.94V23h2v-2.06c4.17-.46 7.48-3.77 7.94-7.94H23v-2h-2.06zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="sl-filter-ddl d-none d-sm-block">
                                <a>
                                    <?php echo esc_attr__( 'Filter Option','asl_locator') ?>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="current-color" width="500" height="500" viewBox="0 0 500 500" fill="#A994BD"><polygon points="324 252 193.6 382 178 366.4 292.7 252 178 137.6 193.6 122 " transform="matrix(1.6 0 0 1.6 -150 -150)"></polygon></svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="sl-filter-ddl d-block d-sm-none">
                            <a>
                                <?php echo esc_attr__( 'Filter Option','asl_locator') ?>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="current-color" width="500" height="500" viewBox="0 0 500 500" fill="#A994BD"><polygon points="324 252 193.6 382 178 366.4 292.7 252 178 137.6 193.6 122 " transform="matrix(1.6 0 0 1.6 -150 -150)"></polygon></svg>
                                </span>
                            </a>
                        </div>
                        <div class="asl-filter-sec">
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="asl-map">
        <div class="map-image">
            <div id="asl-map-canv" class="asl-map-canv"></div>
            <?php include ASL_PLUGIN_PATH.'public/partials/_agile_modal.php'; ?>
            <?php include ASL_PLUGIN_PATH.'public/partials/_agile_contact_modal.php'; ?>
        </div>
    </div>
    <div class="asl-sec asl-panel">
        <!-- Direction Container -->
        <div class="directions-cont hide">
            <div class="agile-modal-header">
                <button type="button" class="close"><span aria-hidden="true">×</span></button>
                <h4><?php echo esc_attr__( 'Store Direction', 'asl_locator') ?></h4>
            </div>
            <div class="rendered-directions" style="direction: ltr;"></div>
        </div>
        <!-- Slider Container -->
        <div class="container">
            <div class="sl-row">
                <div class="pol-12">
                    <div class="asl-inner">
                        <div class="sviper-container">
                            <div class="sviper-wrapper sl-list">
                            </div> 
                        </div>
                        <div class="sviper-button-next">
                            <svg version="1.1" class="current-color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="500px" height="500px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
                            <path d="M76.3,236c-2.7,2.7-4.2,6.3-4.3,10.1c0,3.8,1.5,7.4,4.3,10.1l91.8,91.6c5.7,5.6,14.8,5.6,20.5,0s5.7-14.8,0-20.4l0,0
                                  l-67.2-66.9h293.2c7.9,0,14.4-6.4,14.4-14.3s-6.4-14.4-14.4-14.4l0,0H121.4l67.2-67c5.7-5.6,5.7-14.8,0-20.4
                                  c-5.7-5.6-14.8-5.6-20.5,0L76.3,236z"></path>
                            </svg> 
                        </div>
                        <div class="sviper-button-prev">
                            <svg version="1.1" class="current-color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="500px" height="500px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
                            <path d="M76.3,236c-2.7,2.7-4.2,6.3-4.3,10.1c0,3.8,1.5,7.4,4.3,10.1l91.8,91.6c5.7,5.6,14.8,5.6,20.5,0s5.7-14.8,0-20.4l0,0
                                  l-67.2-66.9h293.2c7.9,0,14.4-6.4,14.4-14.3s-6.4-14.4-14.4-14.4l0,0H121.4l67.2-67c5.7-5.6,5.7-14.8,0-20.4
                                  c-5.7-5.6-14.8-5.6-20.5,0L76.3,236z"></path>
                            </svg>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the table-->
    <div class="sl-container">
        <h3 class="mb-3 text-center"><?php echo esc_attr__( 'Die Top 10 Abnehmen im Liegen Standorte','asl_locator'); ?><a class="sl-table-toggle"><span><?php echo esc_attr__( 'Hide Table','asl_locator'); ?></span><span><?php echo esc_attr__( 'Show Table','asl_locator'); ?></span></a></h3>
        <div class="sl-row">
            <div class="pol">
                <table id="sl-tbl-rating" class="table table-bordered">
                    <thead>
                        <tr>
                          <th scope="pol">&nbsp;</th>
                          <th scope="pol"><?php echo esc_attr__( 'Standorte','asl_locator'); ?></th>
                          <th scope="pol"><?php echo esc_attr__( 'Bewertung','asl_locator'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>      
            </div>
        </div>
    </div>
</section>
<!-- This plugin is developed by "Agile Store Locator for WordPress" https://agilestorelocator.com -->

<script type="text/javascript">

/**
 * [asl_get_ratings description]
 * @return {[type]} [description]
 */
function asl_get_ratings(_callback) {

    jQuery.ajax({
        url: ASL_REMOTE.ajax_url,
        data: {action: 'asl_store_ratings'},
        type: 'GET',
        dataType: 'json',
        success: function(_data) {

            _callback.call(this, _data);
        }
    });
}

/**
 * [make_sl_table description]
 * @param  {[type]} _stores  [description]
 * @param  {[type]} _ratings [description]
 * @return {[type]}          [description]
 */
function make_sl_table(_stores) {

    var table_html = '';

    for(var s in _stores) {

        
        table_html += '<tr><td>'+(parseInt(s)+1)+'</td><td>'+_stores[s].props_.title+'</td><td>'+_stores[s].props_.rating+'</td></tr>';
    }

    if(!_stores.length) {
        table_html += '<tr><td colspan="3"><?php echo esc_attr__( 'No Rating Found!','asl_locator'); ?></td></tr>';
    }

    document.querySelector('#sl-tbl-rating tbody').innerHTML = table_html;
};


var all_ratings = null;

/**
 * [top_rated_stores Find the top 10 rated stores]
 * @return {[type]} [description]
 */
function top_rated_stores(all_stores) {


    if(!all_ratings) {
        return;
    }
    
    //  Get only the stores that have ratings
    var stores_with_rating = all_stores.filter(function(store){
        
        if(all_ratings[store.props_.id]) {

            store.props_['rating'] = parseFloat(all_ratings[store.props_.id]);

            return true;
        }

        return null;
    });


    //  Sort them with Average rating
    stores_with_rating.sort(function(a,b) {

        return (a.props_['rating'] < b.props_['rating']) ? 1 : ((b.props_['rating'] < a.props_['rating']) ? -1 : 0);
    });


    //  Limit by 10
    stores_with_rating = stores_with_rating.slice(0, 10);

    //   Prepare the table
    make_sl_table(stores_with_rating);
};

/**
 * [add_slide_toggle show/hide the table]
 */
function add_slide_toggle() {

    var table = document.querySelector('#sl-tbl-rating');
        
    //  Add the slideToggle
    jQuery('.sl-table-toggle').bind('click', function(){
        jQuery(this).toggleClass('actv');
        jQuery(table).slideToggle();
    });

};

/**
 * [asl_event_hook description]
 * @param  {[type]} _event [description]
 * @return {[type]}        [description]
 */
function asl_event_hook(_event) {

    if(_event.type == 'init') {

        add_slide_toggle();

        //  Get all the ratings
        asl_get_ratings(function(_ratings) {

            all_ratings = _ratings;

            top_rated_stores(_event.data);
        });
    }

    if(_event.type == 'change') {

        top_rated_stores(_event.data);
    }
}

</script>