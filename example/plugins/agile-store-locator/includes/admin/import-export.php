<?php

namespace AgileStoreLocator\Admin;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

use AgileStoreLocator\Admin\Base;

/**
 * The Import/Export Manager functionality of the admin
 *
 * @link       https://agilestorelocator.com
 * @since      4.7.32
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/Admin/ImportExport
 */

class ImportExport extends Base {


  /**
   * [__construct description]
   */
  public function __construct() {
    
    parent::__construct();
  }


  /**
   * [validate_api_key Validateyour Google API Key]
   * @return [type] [description]
   */
  public function validate_api_key() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;

    //Get the API KEY
    $sql      = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);

    if(isset($configs_result) && isset($configs_result[0])) {

      $api_key    = $configs_result[0]->value;

      if($api_key) {

        //Test Address
        $street   = '1848 Provincial Road';
        $city     = 'Winsdor';
        $state    = 'ON';
        $zip      = 'N8W 5W3';
        $country  = 'Canada';

        $_address = $street.', '.$zip.'  '.$city.' '.$state.' '.$country;

        $results = \AgileStoreLocator\Helper::getLnt($_address, $api_key, true);

        $response->result = $results;

        if($results && isset($results['body'])) {

          $results  = json_decode($results['body'], true);
          
          if(isset($results['error_message'])) {

            $response->msg    = $results['error_message'];
          }
          else {

            $response->msg     = esc_attr__('Valid API Key','asl_locator'); 
            $response->success = true;  
          }
        }

        //$response->msg    = esc_attr__('API Key is Valid','asl_locator');
        
      }
      else
        $response->msg = esc_attr__('Server Google API Key is Missing','asl_locator');
    }
    else
        $response->msg = esc_attr__('Server Google API Key is not saved.','asl_locator');

    echo json_encode($response);die;
  }

  /**
   * [fill_missing_coords Fetch the Missing Coordinates]
   * @return [type] [description]
   */
  public function fill_missing_coords() {
  
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;
    $response->summary = array();

    //Get the API Key
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);
    $api_key    = $configs_result[0]->value;

    if($api_key) {

      //Get the Stores
      $stores = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores WHERE (lat = '' AND lng = '') OR (lat IS NULL AND lng IS NULL) OR !(lat BETWEEN -90.10 AND 90.10) OR !(lng BETWEEN -180.10 AND 180.10) OR !(lat REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$') OR !(lng REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$')");

      foreach($stores as $store) {

        $coordinates = \AgileStoreLocator\Helper::getCoordinates($store->street, $store->city, $store->state, $store->postal_code, $store->country, $api_key);

        if($coordinates) {

          if($wpdb->update( ASL_PREFIX.'stores', array('lat' => $coordinates['lat'], 'lng' => $coordinates['lng']),array('id'=> $store->id )))
          {
            $response->summary[] = 'Store ID: '.$store->id.", LAT/LNG Fetch Success, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code));
          }
          else
            $response->summary[] = '<span class="red">Store ID: '.$store->id.", LAT/LNG Error Save, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code)).'</span>';

        }
        else
          $response->summary[] = '<span class="red">Store ID: '.$store->id.", LAT/LNG Fetch Failed, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code)).'</span>';
        
      }

      if(!$stores || count($stores) == 0) {

        $response->summary[] = esc_attr__('Missing Coordinates are not Found in Store Listing','asl_locator');
      }

      $response->msg      = esc_attr__('Missing Coordinates Request Completed','asl_locator');
      $response->success  = true;
    }
    else
      $response->msg    = esc_attr__('Google Server API Key is Missing.','asl_locator');

  
    echo json_encode($response);die;
  }

  /**
   * [delete_import_file Delete the Import file]
   * @return [type] [description]
   */
  public function delete_import_file() {

    $file_name  = sanitize_text_field($_REQUEST['data_']);
    $response   = \AgileStoreLocator\Helper::removeFile($file_name, ASL_PLUGIN_PATH.'public/import/');

    echo json_encode($response);die;
  }


  /**
   * [upload_store_import_file Upload Store Import File]
   * @return [type] [description]
   */
  public function upload_store_import_file() {

    $response = new \stdclass();
    $response->success = false;

    $target_dir  = ASL_PLUGIN_PATH."public/import/";
    $date        = new \DateTime();

    $target_name = $target_dir . strtolower($_FILES["files"]["name"]);
    $namefile    = substr(strtolower($_FILES["files"]["name"]), 0, strpos(strtolower($_FILES["files"]["name"]), '.'));
    

    $imageFileType  = pathinfo($target_name,PATHINFO_EXTENSION);
    $target_name    = $target_dir.pathinfo($_FILES['files']['name'], PATHINFO_FILENAME).uniqid().'.'.$imageFileType;


    //  If file not found
    if (file_exists($target_name)) {
        $response->msg = esc_attr__("Sorry, file already exists.",'asl_locator');
    }
    //  Not a valid format
    else if($imageFileType != 'csv') {
        $response->msg = esc_attr__("Sorry, only CSV files are allowed.",'asl_locator');
    }
    //  Upload 
    else if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_name)) {

          $response->msg = esc_attr__("The file has been uploaded.",'asl_locator');
          $response->success = true;
    }
    //error
    else {

      $response->msg = esc_attr__('Some error occured','asl_locator');
    }

    echo json_encode($response);
    die;
  }



  /**
   * [validate_code responsible to validate the purchase code]
   * @return [type] [description]
   */
  public function validate_code() {

    $response           = new \stdclass();
    $response->success  = false;

    //  Validate the Key
    if(isset($_REQUEST['value']) && $_REQUEST['value']) {

      $code_value  = $_REQUEST['value'];
      
      //  Found
      if(strpos($code_value, '|')) {

        $codes = explode('|', $code_value);

        if($codes[1]  == crc32($codes[0])) {

          update_option('asl-compatible', $code_value);

          $response->success  = true;
          $response->message  = 'true';

          echo json_encode($response); die;
        }
        else {
          $response->hash  = crc32($codes[0]);
        }
      }
      
      $request_data = wp_remote_request('https://agilestorelocator.com/validate/index.php?v-key='.(urlencode($_REQUEST['value'])).'&v-hash='.((urlencode($_SERVER['SERVER_NAME']))));

      //  When there is an array show it
      if(is_object($request_data) && is_wp_error($request_data)) {

        $response->message  = $request_data->get_error_message();

        //update_option('asl-compatible', $_REQUEST['value']);
        echo json_encode($response); die;
      }

      if(isset($request_data['body'])) {

        $request_data   = json_decode($request_data['body'], true);

        $response->data = $request_data;

        if($request_data) {

          // Validate success
          if($request_data['success']) {
            $response->success  = true;

            update_option('asl-compatible', $code_value);
          }

          // Message
          if($request_data['message']) {

            $response->message  = $request_data['message'];
          }
        }
      }
      else {

        $response->message  = 'Failed to receive response from server';
      }
    }
    else {

      $response->data = 'Value is not valid.';  
    }

    echo json_encode($response); die;
  }
  
  /**
   * [import_store Import the Stores of CSV/EXCEL]
   * @return [type] [description]
   */
  public function import_store($_file_to_import = null, $cron_job = false) {

    
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);
    
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);
    
    global $wpdb;
    
    //$_REQUEST['data_']      = 'demo-import.csv';
    //$_REQUEST['duplicates'] = 'lat_lng';

    
    $response  = new \stdclass();
    $response->success = false;

    //  The file which will be imported
    $import_file        = ($_file_to_import)? $_file_to_import: sanitize_text_field($_REQUEST['data_']);
    $avoid_dupl_column  = (isset($_REQUEST['duplicates']) && $_REQUEST['duplicates'])?sanitize_text_field($_REQUEST['duplicates']): null;
    $duplicate_count    = 0;
    $wrong_coords_count = 0;

    //  Validate the dupl for limited columns
    if(!in_array($avoid_dupl_column, ['title', 'phone', 'email', 'lat_lng'])) {
      $avoid_dupl_column = null;
    }



    $countries     = $wpdb->get_results("SELECT id,country FROM ".ASL_PREFIX."countries");
    $all_countries = array();

    foreach($countries as $_country) {
      $all_countries[$_country->country] = $_country->id;
    }


    if(!get_option('asl-compatible')) {

      $response->summary        = array('Please provide your purchase code to proceed through purchase dialog or contact us at support@agilelogix.com');
      $response->imported_rows  = 0;
      $response->success        = true;
    
      echo json_encode($response);die;  
    }

    $wpdb->query("SET NAMES utf8");
    

    // Get the API KEY
    $api_key = null;

    $sql     = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);
    
    if($configs_result && isset($configs_result[0]))
      $api_key = $configs_result[0]->value;
    
    $response->summary = array();

    //  Input File Name
    $inputFileName  = (($cron_job)? (ASL_UPLOAD_DIR.'cron/'):ASL_PLUGIN_PATH.'public/import/').$import_file;

    //  Don't let it go when fil is missing
    if(!file_exists($inputFileName)) {
      $response->error = 'Import Error! File is missing';
      echo json_encode($response);die;
    }


    $header_columns = ['title', 'description', 'street', 'city', 'state', 'postal_code', 'country', 'lat', 'lng', 'phone', 'fax', 'email', 'website', 'is_disabled', 'logo', 'categories', 'marker_id', 'description_2', 'open_hours', 'order', 'brand', 'special'];

    $rows = null;

    try {
      
      $csv = new \AgileStoreLocator\Admin\CSV\Reader();

      $csv->getData($inputFileName);

      //  Make it associative array, and skip first row
      $csv->fillKeys($header_columns);

      //  Get the Rows
      $rows = $csv->getRows();
      //echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);die;
    }
    catch (\Exception $e) {
      
      $response->not_working = true;
      $response->success     = false;
      $response->summary     = [$e->getMessage()];
       
      //  When not a Cronjob import request
      if($_file_to_import) {
        echo json_encode($response);die;
      }
    }

    //  Get the Custom Fields
    $fields    = $this->_get_custom_fields();

    $index     = 2;
    $imported  = 0;


    //  Default language
    //$default_language = get_locale();
    
    foreach($rows as $t) {
      
      $logoid        = '0';
      $categoryerror = '';


      //  lang field
      $lang  = (isset($t['lang']) && $t['lang'])? $t['lang']: '';

      if($lang == 'en' || $lang == 'en_US' || strlen($lang) >= 13) {
        $lang = '';
      }
      

      //  Either Zip or the postal_code
      if(isset($t['zip'])) {

        $t['postal_code'] = $t['zip'];
      }

      //  Check if the Logo Name already exist, just use it
      if(isset($t['logo_name']) && trim($t['logo_name']) != '') {

        $t['logo_name'] = trim($t['logo_name']);
        
        $logoresult = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."storelogos WHERE `name` = %s", $t['logo_name']));
        
        if(count($logoresult) != 0) {

          $logoid = $logoresult[0]->id;
        }
      }

      //  When Logo is missing and we have a Logo URL, Fetch it
      if($logoid == '0' && isset($t['logo_image']) && !empty(trim($t['logo_image'])) && filter_var(filter_var($t['logo_image'], FILTER_SANITIZE_URL), FILTER_VALIDATE_URL) !== false) {

        $target_dir  = ASL_UPLOAD_DIR."Logo/";

        $extension = explode('.', $t['logo_image']);
        $extension = $extension[count($extension) - 1];

        if(in_array($extension, ['jpg', 'png', 'gif', 'svg', 'jpeg'])) {

          $logo_url  = str_replace(' ', '%20', $t['logo_image']);
          $file_name = uniqid().'.'.$extension;
          $file_path = $target_dir.$file_name;
          file_put_contents($file_path, file_get_contents($logo_url));  

          $t['logo_image'] = $file_name;
        }
      }
      

      //////////////////////////////
      ///// CREATE Brand Dropdown //
      //////////////////////////////
      $brand_ids = [];

      if($t['brand'] != '') {
        
        $brands = explode("|", $t['brand']);

        foreach ($brands as $brand) {
          
          $brand          = trim($brand);
          $brand_in_db    = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."brands WHERE lang = '$lang' AND `name` = %s", $brand));
          
          
          //  Get the ID
          if(count($brand_in_db) > 0) {

            $brand_ids[] = $brand_in_db[0]->id;

          }
          //  Add it and Save ID
          else {

            $wpdb->insert(ASL_PREFIX.'brands', array('name' => $brand, 'lang' => $lang), array('%s', '%s'));

            $response->summary[] = 'Row: '.$index.', Brand created: '.$brand;

            $brand_ids[] = $wpdb->insert_id;
          }
        }
      }

      $brand_ids = implode(',', $brand_ids);


      //////////////////////////////
      ///// CREATE Special Dropdown //
      //////////////////////////////
      $special_ids = [];

      if($t['special'] != '') {
        
        $specials = explode("|", $t['special']);

        foreach ($specials as $special) {
          
          $special          = trim($special);
          $special_in_db    = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."specials WHERE lang = '$lang' AND `name` = %s", $special));
          
          
          //  Get the ID
          if(count($special_in_db) > 0) {

            $special_ids[] = $special_in_db[0]->id;

          }
          //  Add it and Save ID
          else {

            $wpdb->insert(ASL_PREFIX.'specials', array('name' => $special, 'lang' => $lang), array('%s','%s'));

            $response->summary[] = 'Row: '.$index.', Special created: '.$special;

            $special_ids[] = $wpdb->insert_id;
          }
        }
      }

      $special_ids = implode(',', $special_ids);


      ///////////////////////////////////
      /// CREATE CATEGORY IF NOT FOUND //
      ///////////////////////////////////
      $categorys = explode("|", $t['categories']);


      if($t['categories'] != '') {
        
        foreach ($categorys as $_cat) {
          
          $_cat = trim($_cat);

          if(!$_cat)
            continue;
          
          try {
              
            $category_count = $wpdb->get_results($wpdb->prepare("SELECT count(*) AS `count` FROM ".ASL_PREFIX."categories WHERE lang = '$lang' AND category_name = %s" , $_cat));            

            //IF COUNT 0 create that category
            if($category_count[0]->count == 0) {

              $wpdb->insert(ASL_PREFIX.'categories', 
              array(
                  'category_name' => $_cat,     
                  'is_active' => 1,
                  'icon'      => 'default.png',
                  'lang'      => $lang
                ),
              array('%s','%d','%s'));

              $response->summary[] = 'Row: '.$index.', Category created: '.$_cat;
            }
          }
          catch (\Exception $e) {
              
              $response->summary[] = 'Error: '.$index.', Category error: '.$_cat.', Message:'.$e->getMessage();
          }

        }
      }


      if($t['title'] != '') {

        //  Is an Update operation or Add?
        $is_update = (isset($t['update_id']) && $t['update_id'] && is_numeric($t['update_id']))? true: false;

        //  If not an update operation check for duplication
        if(!$is_update && $avoid_dupl_column) {

          //  variables for the duplicates validation
          $dupl_sql; $dupl_param_1; $dupl_param_2;

          //  For the coordinates
          if($avoid_dupl_column == 'lat_lng') {

            $dupl_sql     = "SELECT COUNT('name') as 'count' FROM ".ASL_PREFIX."stores WHERE lat = %s AND lng = %s;";

            $dupl_param_1 = esc_sql($t['lat']);
            $dupl_param_2 = esc_sql($t['lng']);
          }
          //  For rest of the columns
          else {

            $dupl_sql = "SELECT COUNT('name') as 'count' FROM ".ASL_PREFIX."stores WHERE `%1s` = %s;";

            $dupl_param_1 = $avoid_dupl_column;
            $dupl_param_2 = sanitize_text_field($t[$avoid_dupl_column]);
          }

          //  Get count
          $dupl_results = $wpdb->get_results($wpdb->prepare($dupl_sql, $dupl_param_1, $dupl_param_2));

          //  check if the duplicate exist?
          if($dupl_results && $dupl_results[0]->count  >= 1) {

            $duplicate_count++;
            continue;
          }

          
        }


        //Check if Lat/Lng is missing and we have address
        if(!trim($t['lat']) || !trim($t['lng'])) {

          //$coordinates = ['lat' => '44.44', 'lng' => '55.55'];
          $coordinates = \AgileStoreLocator\Helper::getCoordinates($t['street'],$t['city'],$t['state'],$t['postal_code'],$t['country'],$api_key);
          
          if($coordinates) {

            $t['lat'] = $coordinates['lat'];
            $t['lng'] = $coordinates['lng'];
          }
          else
            $response->summary[] = 'Row: '.$index.", LAT/LNG Fetch Failed";
        }
        //  Validate the coordinates
        else if(!\AgileStoreLocator\Helper::validate_coordinate($t['lat'], $t['lng'])) {

          $wrong_coords_count++; 
        }
        
        
        $store_id  = null;

        //  Open Hours
        $hours_n_days = explode('|', $t['open_hours']);
        $days         = array('mon' => '0','tue'=> '0','wed'=> '0','thu'=> '0','fri'=> '0','sat'=> '0','sun'=> '0');

        foreach($hours_n_days as $_day) {

          $day_hours = explode('=', $_day);

          //is Valid Day
          if(isset($days[$day_hours[0]]) && isset($day_hours[1])) {

            $day_      = $day_hours[0];
            $dhours    = $day_hours[1];


            if($dhours === '1') {

              $days[$day_] = '1';
            }
            else if($dhours === '0') {

              $days[$day_] = '0';
            }
            //For Hours of every day
            else {

              $durations = explode(',', $dhours);

              if(count($durations) > 0) {

                //make it array
                $days[$day_] = array();

                foreach($durations as $hours) {

                  $timings = explode('-', $hours);

                  if(count($timings) == 2)
                    $days[$day_][] = trim($timings[0]).' - '.trim($timings[1]);
                }
              }
            } 
          }
        }

        $days = json_encode($days);



        //  Compile the Custom Fields
        $custom_field_data = [];
        
        foreach ($fields as $field => $f_value) {
          
          if(isset($t[$field])) {

            $custom_field_data[$field] =  $t[$field];
          }
        }

        $custom_field_data = json_encode($custom_field_data);


        //  Validating the DATA
        $marker_id   = (isset($t['marker_id']) && is_numeric($t['marker_id']))? $t['marker_id']: '1';
        $is_disabled = (isset($t['is_disabled']) && $t['is_disabled'] == '1')? '1': '0';
        $order_id    = (isset($t['order']) && is_numeric($t['order']))? $t['order']: '0';

        $phone       = substr(trim($t['phone']), 0, 50);
        $fax         = substr(trim($t['fax']), 0, 50);
        $email       = substr(trim($t['email']), 0, 100);
        $postal_code = substr(trim($t['postal_code']), 0, 100);
        

        //  Generate Slug
        
        $slug  = \AgileStoreLocator\Helper::slugify($t);

        //// Validate if It's Insert or Update by Columns Y//////
        if($is_update) {

          if($wpdb->update( ASL_PREFIX.'stores', array(
            'title' => ($t['title']),
            'description' => $t['description'],
            'street' => $t['street'],
            'city' => trim($t['city']),
            'state' => trim($t['state']),
            'postal_code' => $postal_code,
            'country' => (isset($all_countries[$t['country']]))?$all_countries[$t['country']]:'223', //for united states
            'lat' => $t['lat'],
            'lng' => $t['lng'],
            'phone' => $phone,
            'fax' => $fax,
            'email' => $email,
            'website' => $this->fixURL($t['website']),
            'is_disabled' => $is_disabled,
            'logo_id' => $logoid,
            'marker_id' => $marker_id,
            'open_hours' => $days,
            'description_2' => $t['description_2'],
            'ordr' => $order_id,
            'brand'   => $brand_ids,
            'special' => $special_ids,
            'slug' => $slug,
            'custom' => $custom_field_data
          ),array('id'=> $t['update_id'] )))
          {
            $imported++;
          }
        }
        ////Insertion
        else if($wpdb->insert( ASL_PREFIX.'stores', array(
          'title' => $t['title'], //mb_convert_encoding
          'description' => $t['description'],
          'street' => $t['street'],
          'city' => trim($t['city']),
          'state' => trim($t['state']),
          'postal_code' => $postal_code,
          'country' => (isset($all_countries[$t['country']]))?$all_countries[$t['country']]:'223', //for united states
          'lat' => $t['lat'],
          'lng' => $t['lng'],
          'phone' => $phone,
          'fax' => $fax,
          'email' => $email,
          'website' => $this->fixURL($t['website']),
          'is_disabled' => intval($is_disabled),
          'logo_id' => $logoid,
          'marker_id' => intval($marker_id),
          'open_hours' => $days,
          'description_2' => $t['description_2'],
          'ordr' => intval($order_id),
          'brand' => $brand_ids,
          'special' => $special_ids,
          'slug' => $slug,
          'lang' => $lang,
          'custom' => $custom_field_data
        )))
        {
          $imported++;
        }
        //Error
        else {
          
          $has_error = true;
          $wpdb->show_errors   = true;
          $response->summary[] = 'Row: '.$index.', Error: '.$wpdb->print_error();
        }

        //Get the ID
        $store_id = ($is_update && is_numeric($t['update_id']))?$t['update_id']:$wpdb->insert_id;
        
        /////////ADD THE CATEGORIES//////////////////
        if($store_id && $t['categories'] != '') {
          
          //  If is Update? Delete Prev Categories
          if($is_update) {
            $wpdb->query("DELETE FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$store_id);            
          }

          foreach ($categorys as $category) {
            
            $category   = trim($category);
            $categoryid = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."categories WHERE lang = '$lang' AND category_name = %s" , $category)  );
          
            if(count($categoryid) != 0) {

              $wpdb->insert(ASL_PREFIX.'stores_categories', 
              array('store_id' => $store_id,'category_id' =>  $categoryid[0]->id),
              array('%s','%s'));
            }
            else
              $response->summary[] = 'Row: '.$index.", category ".$category." not  found";
          }
        }
     

        //If No Logo is found and have image create a new Logo
        if($logoid == '0') {

          //check if logo image is provided and that exist in folder
          if(isset($t['logo_image']) && !empty(trim($t['logo_image']))) {

            $t['logo_name']    = trim($t['logo_name']);
            $target_file = $t['logo_image'];
            $target_name = $t['logo_name'];

            $wpdb->insert(ASL_PREFIX.'storelogos', 
                  array('path'=>$target_file,'name'=>$target_name),
                  array('%s','%s'));

            $logo_id = $wpdb->insert_id;

            //update the logo id to store table
            $wpdb->update(ASL_PREFIX."stores",
              array('logo_id' => $logo_id),
              array('id' => $store_id)
            );

            $response->summary[] = 'Row: '.$index.", logo created ".$t['logo_name'];
          }
          //else $response->summary[] = 'Row: '.$index.", logo ".$t['logo_name']." not found";
        }

      }

      $index++;
    }

    $response->success     = true;
    

    //  Add duplicate count in the summary
    if($duplicate_count) {

      $response->error     = esc_attr__('Duplicate rows skipped: ','asl_locator').$duplicate_count;
      $response->summary[] = $response->error;
      $response->success   = false;
    }


    //  Wrong coordinates count
    if($wrong_coords_count) {

      $response->success   = false;
      $response->error    .= esc_attr__('Error! Wrong coordinates, invalid stores: ','asl_locator').$wrong_coords_count;
    }

    
    $response->imported_rows = $imported;

    //  It is done via the cronjob return the response
    if($_file_to_import) {
      return $response;
    }
    
    echo json_encode($response);die;  
  }

  /**
   * [export_store export Excel fo Stores]
   * @return [type] [description]
   */
  public function export_store() {

    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 0);
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //  With Store Id for Update?
    $with_update_id  = (isset($_REQUEST['with_id']) && $_REQUEST['with_id'] == '1')? true: false;
    $with_logo_image = (isset($_REQUEST['logo_image']) && $_REQUEST['logo_image'] == '1')? true: false;

    $stores = null;
    

    try {

      //  Stores Data
      $stores = $wpdb->get_results("SELECT `s`.`id`,  `s`.`title`,  `s`.`description`,  `s`.`street`,  `s`.`city`,  `s`.`state`,  `s`.`postal_code`,  `c`.`country`,  `s`.`lat`,  `s`.`lng`,  `s`.`phone`,  `s`.`fax`,  `s`.`email`,  `s`.`website`,  `s`.`description_2`,  `s`.`logo_id`,  `s`.`marker_id`,  `s`.`is_disabled`,   `s`.`open_hours`, `s`.`ordr`, `s`.`brand`,`s`.`special`, `s`.`custom`, `s`.`created_on`, `s`.`lang`  FROM ".ASL_PREFIX."stores s LEFT JOIN ".ASL_PREFIX."countries c ON s.country = c.id ORDER BY s.`id`");
  
    }
    catch (\Exception $e) {
        
      echo $e->getMessage();die;
    }    

    //  CSV Instance
    $csv = new \AgileStoreLocator\Admin\CSV\Reader();
    
      
    
    //  Header titles
    $headers = ['title', 'description', 'street', 'city', 'state', 'postal_code', 'country', 'lat', 'lng', 'phone', 'fax', 'email', 'website', 'is_disabled', 'logo', 'categories', 'marker_id', 'description_2', 'open_hours', 'order', 'brand', 'special', 'lang'];
    
    //  With Update ID?
    if($with_update_id) {
      
      $headers[] = 'update_id';
    }
    
    //  Rows to be exported
    $all_rows = [];

    //  Get the Custom Field Schema
    $fields       = $this->_get_custom_fields();



    /////////////////////
    //  Get the Brands //
    /////////////////////
    $brands    = $wpdb->get_results( "SELECT id, name FROM ".ASL_PREFIX."brands");

    $brand_list = [];

    foreach ($brands as $b) {      
      $brand_list[$b->id] = $b;
    }

    //////////////////////
    // Get the Specials //
    //////////////////////
    $specials    = $wpdb->get_results( "SELECT id, name FROM ".ASL_PREFIX."specials");

    $special_list = [];

    foreach ($specials as $b) {
      $special_list[$b->id] = $b;
    }

    //  Loop over the stores data
    foreach ($stores as $value) {

      $logo_name  = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = %d", $value->logo_id) ); 

      $category   = "";
      
      //  Get the Categories of that Store
      $categories = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."categories RIGHT JOIN ".ASL_PREFIX."stores_categories ON  
        ".ASL_PREFIX."categories.id  = ".ASL_PREFIX."stores_categories.category_id WHERE ".ASL_PREFIX."stores_categories.store_id = %d", $value->id) );

      


      //  Conver Categoris into String with | JOIN
      $_cats = [];
      foreach($categories as $c) {

        $_cats[] = $c->category_name;
      }

      $_cats = implode('|', $_cats);

      //  Convert the brands
      if($value->brand) {

        $store_brand = explode(',', $value->brand);

        $store_brand_list = [];
        
        foreach($store_brand as $sb) {

          if(isset($brand_list[$sb])) {

            $store_brand_list[] =  $brand_list[$sb]->name;
          }
        }

        $value->brand = implode('|', $store_brand_list);
      }

      //  Convert the specials
      if($value->special) {

        $store_special = explode(',', $value->special);

        $store_special_list = [];
        
        foreach($store_special as $sb) {

          if(isset($special_list[$sb])) {

            $store_special_list[] =  $special_list[$sb]->name;
          }
        }

        $value->special = implode('|', $store_special_list);
      }


      //  Make Open Hours Importable String
      $open_hours_value = '';
      
      if($value->open_hours) {

        $open_hours = json_decode($value->open_hours);

        if(is_object($open_hours)) {

          $open_details = array();
          foreach($open_hours as $key => $_day) {


            $key_value = '';

            if($_day && is_array($_day)) {

              $key_value = implode(',', $_day);
            }
            else if($_day == '1') {

              $key_value = $_day;
            }
            else  {

              $key_value = '0';
            }

            $open_details[] = $key.'='.$key_value;
          }

          $open_hours_value = implode('|', $open_details);
        }
      }


      //  Logo
      $value->logo_name  = (isset($logo_name) && isset($logo_name[0]))?$logo_name[0]->name:'';

      //  Logo image
      if($with_logo_image)
        $value->logo_image  = ($logo_name && isset($logo_name[0]))? ASL_UPLOAD_URL.'Logo/'.$logo_name[0]->path: '';

      
      //  Categories
      $value->categories = $_cats;

      $value->order      = $value->ordr;
      unset($value->ordr);

      //  Open hours
      $value->open_hours = $open_hours_value;

      //  With Update Id?
      if($with_update_id) {
        
        $value->update_id = $value->id;
      }

      // Custom Values
      if(isset($value->custom) && $value->custom) {

        $custom_fields_data     = json_decode($value->custom, true);
        

        foreach ($fields as $field => $f_value) {
          
          $value->$field = (isset($custom_fields_data[$field]))? $custom_fields_data[$field]: '';
        }
      }

      unset($value->id);
      unset($value->created_on);
      unset($value->logo_id);
      unset($value->custom);
      
      //  Push into rows collection
      $all_rows[] = $value;
    }


    try {


      $csv->setRows($all_rows);
      
      $download_file = 'public/export/stores-data-export-'.time().'.csv';
      $path_to_save = ASL_PLUGIN_PATH.$download_file;

      $csv->write(\AgileStoreLocator\Admin\CSV\Reader::DOWNLOAD, 'stores-data-export.csv');;
    }
    catch (\Exception $e) {
        
        echo $e->getMessage();die;
    }

    
    //$csv->write(\AgileStoreLocator\Admin\CSV\Reader::FILE, $path_to_save);
    //$response->success  = true;
    //$response->msg      = ASL_URL_PATH.$download_file;
    die;
  }
}