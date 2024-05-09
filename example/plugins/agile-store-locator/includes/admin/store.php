<?php

namespace AgileStoreLocator\Admin;

use AgileStoreLocator\Admin\Base;

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * The store manager functionality of the plugin.
 *
 * @link       https://agilestorelocator.com
 * @since      4.7.32
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/Admin/Store
 */

class Store extends Base {


  /**
   * [__construct description]
   */
  public function __construct() {
    
    parent::__construct();
  }

  /**
   * [admin_delete_all_stores Delete All Stores, Logos and Category Relations]
   * @return [type] [description]
   */
  public function admin_delete_all_stores() {
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $response = new \stdclass();
    $response->success = false;
    
    global $wpdb;
    $prefix = ASL_PREFIX;
    
    $wpdb->query("TRUNCATE TABLE `{$prefix}stores_categories`");
    $wpdb->query("TRUNCATE TABLE `{$prefix}stores`");
    //$wpdb->query("TRUNCATE TABLE `{$prefix}storelogos`");
  
    $response->success  = true;
    $response->msg      = esc_attr__('All Stores are deleted','asl_locator');

    echo json_encode($response);die;
  }


  /**
   * [get_store_list GET List of Stores]
   * @return [type] [description]
   */
  public function get_store_list() {
    
    global $wpdb;

    $start      = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;   
    $params     = isset($_REQUEST)?$_REQUEST:null;
    $categories = isset($_REQUEST['categories'])?intval($_REQUEST['categories']):null;


    $acolumns = array(
      ASL_PREFIX.'stores.id', ASL_PREFIX.'stores.id ',ASL_PREFIX.'stores.id ','title','description',
      'lat','lng','street','state','city',
      'phone','email','website','postal_code','is_disabled',
      ASL_PREFIX.'stores.id','marker_id', 'logo_id', 'pending',
      ASL_PREFIX.'stores.created_on'/*,'country_id'*/
    );

    $columnsFull = array(
      ASL_PREFIX.'stores.id as id',ASL_PREFIX.'stores.id as id',ASL_PREFIX.'stores.id as id','title','description','lat','lng','street','state', ASL_PREFIX.'countries.country','city','phone','email','website','postal_code','is_disabled',ASL_PREFIX.'stores.created_on', 'pending'
    );
    

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if($value != '') {

          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);


          if($key == 'is_disabled')
          {
            $value = ($value == 'yes')?1:0;
          }
          elseif($key == 'marker_id' || $key == 'logo_id')
          {
            
            $clause[] = ASL_PREFIX."stores.{$key} = '{$value}'";
            continue;
          }
          elseif($key == 'country')
          {
            
            $clause[] = ASL_PREFIX."countries.{$key} LIKE '%{$value}%'";
            continue;
          }

          $clause[] = ASL_PREFIX."stores.{$key} LIKE '%{$value}%'";
        }
      } 
    }
    

    //iDisplayStart::Limit per page
    $sLimit = "";
    $displayStart = isset($_REQUEST['iDisplayStart'])?intval($_REQUEST['iDisplayStart']):0;
    
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".$displayStart.", ".
        intval( $_REQUEST['iDisplayLength'] );
    }
    else
      $sLimit = "LIMIT ".$displayStart.", 20 ";

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {
          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= $acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]." ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }


    //  When Pending isn't required, filter the pending stores
    if(!(isset($_REQUEST['filter']) && isset($_REQUEST['filter']['pending']))) {

      $clause[] = '('.ASL_PREFIX."stores.pending IS NULL OR ".ASL_PREFIX."stores.pending = 0)";
    }

    //  When Categories filter is applied
    if($categories) {
      $clause[]    = ASL_PREFIX.'stores_categories.category_id = '.$categories;
    }
    
    //  Add the lang Filter
    $clause[] = ASL_PREFIX."stores.lang = '{$this->lang}'";

    $sWhere = implode(' AND ', $clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    

    $fields  .= ',marker_id,logo_id,group_concat(category_id) as categories,'.ASL_PREFIX.'countries.country';

    ###get the fields###
    $sql      =   ("SELECT $fields FROM ".ASL_PREFIX."stores LEFT JOIN ".ASL_PREFIX."stores_categories ON ".ASL_PREFIX."stores.id = ".ASL_PREFIX."stores_categories.store_id LEFT JOIN ".ASL_PREFIX."countries ON ".ASL_PREFIX."stores.country = ".ASL_PREFIX."countries.id ");

    //  Count Stores
    $sqlCount = "SELECT COUNT(DISTINCT(".ASL_PREFIX."stores.id)) 'count' FROM ".ASL_PREFIX."stores LEFT JOIN ".ASL_PREFIX."stores_categories ON ".ASL_PREFIX."stores.id = ".ASL_PREFIX."stores_categories.store_id LEFT JOIN ".ASL_PREFIX."countries ON ".ASL_PREFIX."stores.country = ".ASL_PREFIX."countries.id ";
    
    

    /*
     * SQL queries
     * Get data to display
     */
    $dQuery = $sQuery = "{$sql} {$sWhere} GROUP BY ".ASL_PREFIX."stores.id {$sOrder} {$sLimit}";
    

    $data_output = $wpdb->get_results($sQuery);
    $wpdb->show_errors = true;
    $error = $wpdb->last_error;
      
    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;

    /*
     * Output
     */
    $sEcho  = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      "iTotalRecords" => $iTotal,
      "query" => $dQuery,
      'orderby' => $sOrder,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );

    if($error) {

      $output['error'] = $error;
      $output['query'] = $dQuery;
    }


    $days_in_words = array('0'=>'Sun','1'=>'Mon','2'=>'Tues','3'=>'Wed','4'=>'Thur','5'=>'Fri','6'=>'Sat');
      
    //  Loop over the stores
    foreach($data_output as $aRow) {
        
      $row = $aRow;

      $edit_url = 'admin.php?page=edit-agile-store&store_id='.$row->id;

      $row->action = '<div class="edit-options"><a class="row-cpy" title="Duplicate" data-id="'.$row->id.'"><svg width="14" height="14"><use xlink:href="#i-clipboard"></use></svg></a><a href="'.$edit_url.'"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="glyphicon-trash"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';

      //  Show a approve button
      if(isset($row->pending) && $row->pending == '1') {

        $row->action .= '<button data-id="'.$row->id.'" data-loading-text="'.esc_attr__('Approving...','asl_locator').'" class="btn btn-approve btn-success" type="button">'.esc_attr__('Approve','asl_locator').'</button>';
      }

      $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';

      //Show country with state
      /*if($row->state && isset($row->iso_code_2))
        $row->state = $row->state.', '.$row->iso_code_2;*/

      $output['aaData'][] = $row;

        //get the categories
      if($aRow->categories) {

        $categories_ = $wpdb->get_results("SELECT category_name FROM ".ASL_PREFIX."categories WHERE id IN ($aRow->categories)");

        $cnames = array();
        foreach($categories_ as $cat_)
          $cnames[] = $cat_->category_name;

        $aRow->categories = implode(', ', $cnames);
      }  
    }

    echo wp_json_encode($output);
    die;
    
    /*switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }*/
  }


  /**
   * [validate_coordinates Validate that all the coordinates are Valid]
   * @return [type] [description]
   */
  public function validate_coordinates() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false; 

    //  initial message
    $message = esc_attr__('Success! All coordinates looks correct values', 'asl_locator');

    //  get the stores
    $invalid_stores = $wpdb->get_results("SELECT id FROM ".ASL_PREFIX."stores WHERE (lat = '' AND lng = '') OR (lat IS NULL AND lng IS NULL) OR !(lat BETWEEN -90.10 AND 90.10) OR !(lng BETWEEN -180.10 AND 180.10) OR !(lat REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$') OR !(lng REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$')");

    //  Validate the Count difference
    if($invalid_stores) {

      $coord_with_err = count($invalid_stores);

      //  When less than 10, show the numbers
      if($coord_with_err < 10) {

        //  get the store IDs
        $store_ids = array_map(function($value) { return $value->id;}, $invalid_stores);

        $store_ids = implode(',', $store_ids);

        $coord_with_err .= ' ('.$store_ids.')';
      }

      //  prepare the message
      if($coord_with_err)
        $message = esc_attr__("Error! Wrong coordinates of {$coord_with_err} stores", 'asl_locator');
    }

    // Check the Default Coordinates
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'default_lat' || `key` = 'default_lng'";
    $all_configs_result = $wpdb->get_results($sql);


    $all_configs = array();

    foreach($all_configs_result as $c) {
      $all_configs[$c->key] = $c->value;
    }

    $is_valid  = \AgileStoreLocator\Helper::validate_coordinate($all_configs['default_lat'], $all_configs['default_lng']);

    //  Default Lat/Lng are invalid
    if(!$is_valid) {

      $message .= '<br>'.esc_attr__('Default Lat & Default Lng values are invalid!', 'asl_locator');
    }

    //  All Passed
    if(!$invalid_stores && $is_valid) {

      $response->success = true;
    }


    $response->msg = $message;
    

    echo json_encode($response);die;
  }


  /**
   * [remove_duplicates Remove all the duplicate rows]
   * @return [type] [description]
   */
  public function remove_duplicates() {

    global $wpdb;

    $response           = new \stdclass();
    $response->success  = false;

    $asl_prefix   = ASL_PREFIX; 

    $remove_query = "DELETE s1 FROM {$asl_prefix}stores s1
                    INNER JOIN {$asl_prefix}stores s2 
                    WHERE s1.id < s2.id AND s1.title = s2.title AND s1.lat = s2.lat AND s1.lng = s2.lng;";

    //  All Count
    $all_count   = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores");

    //  Previous count
    $all_count   = $all_count[0];

    //  Remove the duplicates
    if($wpdb->query($remove_query)) {
      
      //  All Count
      $new_count     = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores");

      //  Previous count
      $new_count     = $new_count[0];

      $removed       = $all_count->c - $new_count->c;

      $response->msg = $removed.' '.esc_attr__('Duplicate stores removed','asl_locator');

      $response->success = true;
    }
    else {
     
      $response->error = esc_attr__('No Duplicate deleted!','asl_locator');//$form_data
      $response->msg   = $wpdb->show_errors();
    }


    echo json_encode($response);die;
  }
  
  /**
   * [duplicate_store to  Duplicate the store]
   * @return [type] [description]
   */
  public function duplicate_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $store_id = isset($_REQUEST['store_id'])? intval($_REQUEST['store_id']): 0;


    $result = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores WHERE id = ".$store_id);   

    if($result && $result[0]) {

      $result = (array)$result[0];

      unset($result['id']);
      unset($result['created_on']);
      unset($result['updated_on']);

      //insert into stores table
      if($wpdb->insert( ASL_PREFIX.'stores', $result)){
        $response->success = true;
        $new_store_id = $wpdb->insert_id;

        //get categories and copy them
        $s_categories = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$store_id);

        /*Save Categories*/
        foreach ($s_categories as $_category) { 

          $wpdb->insert(ASL_PREFIX.'stores_categories', 
            array('store_id'=>$new_store_id,'category_id'=>$_category->category_id),
            array('%s','%s'));      
        }

        
        //SEnd the response
        $response->msg = esc_attr__('Store duplicated successfully.','asl_locator');
      }
      else
      {
        $response->error = esc_attr__('Error occurred while saving Store','asl_locator');//$form_data
        $response->msg   = $wpdb->show_errors();
      } 

    }

    echo json_encode($response);die;
  }
  
  /**
   * [add_new_store POST METHODS for Add New Store]
   */
  public function add_new_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $form_data     = stripslashes_deep($_REQUEST['data']);
    

    /*Make them STR :: Attributes*/   
    if(isset($form_data['brand']) && is_array($form_data['brand'])) {
      $form_data['brand'] = implode(',', $form_data['brand']);
    }

    if(isset($form_data['special']) && is_array($form_data['special'])) {
      $form_data['special'] = implode(',', $form_data['special']);
    }

    //  Generate Slug
    $form_data['slug']    = \AgileStoreLocator\Helper::slugify($form_data);

    //  lang
    $form_data['lang']    = $this->lang;

    //  Custom Field
    $custom_fields        = (isset($_REQUEST['asl-custom']) && $_REQUEST['asl-custom'])? stripslashes_deep($_REQUEST['asl-custom']): null;
    $form_data['custom']  = ($custom_fields && is_array($custom_fields) && count($custom_fields) > 0)? json_encode($custom_fields): null;
    
    
    // Insert into stores table
    if($wpdb->insert( ASL_PREFIX.'stores', $form_data)) {

      $response->success = true;

      $store_id   = $wpdb->insert_id;
      $categories = (isset($_REQUEST['category']) && $_REQUEST['category'])? ($_REQUEST['category']): null;

      // Save Categories
      if($categories)
        foreach ($categories as $category) {

        $wpdb->insert(ASL_PREFIX.'stores_categories', 
          array(
            'store_id'    => $store_id,
            'category_id' => $category
          ),
          array('%s','%s')
        );
      }

      //  Add a filter for asl-wc to modify the data
      if(isset($_REQUEST['sl_wc']))
        apply_filters( 'asl_woocommerce_store_settings', $_REQUEST['sl_wc'], $store_id);

      $response->msg = esc_attr__('Store added successfully.','asl_locator');
    }
    else {

      $wpdb->show_errors  = true;
      $response->error    = esc_attr__('Error occurred while saving Store','asl_locator');
      $response->msg      = $wpdb->print_error();
    }
    
    echo json_encode($response);die;  
  }

  /**
   * [update_store update Store]
   * @return [type] [description]
   */
  public function update_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $form_data = stripslashes_deep($_REQUEST['data']);
    $update_id = isset($_REQUEST['updateid'])? intval($_REQUEST['updateid']) : 0;


    // Make them STR :: Attributes
    if(isset($form_data['brand']) && is_array($form_data['brand'])) {
      $form_data['brand'] = implode(',', ($form_data['brand']));
    }
    if(isset($form_data['special']) && is_array($form_data['special'])) {
      $form_data['special'] = implode(',', ($form_data['special']));
    }

    //  Custom Field
    $custom_fields        = (isset($_REQUEST['asl-custom']) && $_REQUEST['asl-custom'])? stripslashes_deep($_REQUEST['asl-custom']): null;
    $form_data['custom']  = ($custom_fields && is_array($custom_fields) && count($custom_fields) > 0)? json_encode($custom_fields): null;
    
    //  Generate Slug
    $form_data['slug']  = \AgileStoreLocator\Helper::slugify($form_data);

    
    //  When Update Id is there
    if($update_id && is_numeric($update_id)) {
      
      //  Update into stores table
      $wpdb->update(ASL_PREFIX."stores",
        array(
          'title'         => $form_data['title'],
          'description'   => $form_data['description'],
          'phone'         => $form_data['phone'],
          'fax'           => $form_data['fax'],
          'email'         => $form_data['email'],
          'street'        => $form_data['street'],
          'postal_code'   => $form_data['postal_code'],
          'city'          => $form_data['city'],
          'state'         => $form_data['state'],
          'lat'           => $form_data['lat'],
          'lng'           => $form_data['lng'],
          'website'       => $this->fixURL($form_data['website']),
          'country'       => $form_data['country'],
          'is_disabled'   => (isset($form_data['is_disabled']) && $form_data['is_disabled'])?'1':'0',
          'description_2' => $form_data['description_2'],
          'logo_id'     => $form_data['logo_id'],
          'marker_id'   => $form_data['marker_id'],
          'brand'       => isset($form_data['brand'])?$form_data['brand']:'',
          'special'     => isset($form_data['special'])?$form_data['special']:'',
          'slug'        => $form_data['slug'],
          'custom'      => $form_data['custom'],
          'logo_id'   => $form_data['logo_id'],
          'open_hours'  => $form_data['open_hours'],
          'ordr'      => $form_data['ordr'],
          'updated_on'  => date('Y-m-d H:i:s')
        ),
        array('id' => $update_id)
      );

      
      $sql = "DELETE FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$update_id;
      $wpdb->query($sql);

      $categories = (isset($_REQUEST['category']) && $_REQUEST['category'])? ($_REQUEST['category']): null;

      // Save Categories
      if($categories)
        foreach ($categories as $category) {

        $wpdb->insert(ASL_PREFIX.'stores_categories', 
          array(
            'store_id'    => $update_id,
            'category_id' => $category
          ),
          array('%s','%s'));  
      }
      
      //  Add a filter for asl-wc to modify the data
      if(isset($_REQUEST['sl_wc'])) {
        apply_filters( 'asl_woocommerce_store_settings', $_REQUEST['sl_wc'], $update_id);
      }
    
      
      $response->msg      = esc_attr__('Store updated successfully.','asl_locator');
      $response->success  = true;
    }
    else {

      $response->msg      = esc_attr__('Error! Update id not found.','asl_locator');
    }


    echo json_encode($response);die;
  }


  /**
   * [delete_store To delete the store/stores]
   * @return [type] [description]
   */
  public function delete_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    
    $delete_sql;

    //  For Multiple rows
    if($multiple) {

      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."stores WHERE id IN (".$item_ids.")";
    }
    else {

      $store_id      = intval($_REQUEST['store_id']);
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."stores WHERE id = ".$store_id;
    }

    //  Delete Store?
    if($wpdb->query($delete_sql)) {

      $response->success = true;
      $response->msg = ($multiple)?__('Stores deleted successfully.','asl_locator'):esc_attr__('Store deleted successfully.','asl_locator');
    }
    else {
      $response->error = esc_attr__('Error occurred while saving record','asl_locator');//$form_data
      $response->msg   = $wpdb->show_errors();
    }
    
    echo json_encode($response);die;
  }


  /**
   * [store_status To Change the Status of Store]
   * @return [type] [description]
   */
  public function store_status() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $status = (isset($_REQUEST['status']) && $_REQUEST['status'] == '1')?'0':'1';
    
    $status_title  = ($status == '1')? esc_attr__('Disabled','asl_locator'): esc_attr__('Enabled','asl_locator'); 
    $delete_sql;

    $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
    $update_sql    = "UPDATE ".ASL_PREFIX."stores SET is_disabled = {$status} WHERE id IN (".$item_ids.")";

    if($wpdb->query($update_sql)) {

      $response->success  = true;
      $response->msg      = esc_attr__('Selected Stores','asl_locator').' '.$status_title;
    }
    else {
      $response->error = esc_attr__('Error occurred while Changing Status','asl_locator');
      $response->msg   = $wpdb->show_errors();
    }
    
    echo json_encode($response);die;
  }

  /**
   * [approve_stores Approve Stores]
   * @return [type] [description]
   */
  public function approve_stores() {

    global $wpdb;

    $response          = new \stdclass();
    $response->success = false;

    //  store to approve
    $store_id = intval($_REQUEST['store_id']);

    //  Approve the store
    if(Store::approve_store($store_id)) {

      $response->pending_count = Store::pending_store_count();

      $response->success = true;
      $response->msg     = esc_attr__('Success! Store is approved and registered into the listing.','asl_locator');
    }
    else if (!$response->error) {
      $response->error = esc_attr__('Error occurred while approving the records','asl_locator');//$form_data
    }
    
    echo json_encode($response);die;
  }

  /**
   * [approve_store Approve the store that is pending to be live]
   * @param  [type] $store_id [description]
   * @return [type]           [description]
   */
  public static function approve_store($store_id) {

    global $wpdb;

    $store   = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."stores WHERE id = %d", $store_id));

    //  Store is found?
    if(!$store || !isset($store[0])) {

      return ['msg' => esc_attr__('Error! Store not found.','asl_locator'), 'success' => false];
    }

    //  First index of the store
    $store = $store[0];

    //  Has valid coordinates?
    $is_valid    = \AgileStoreLocator\Helper::validate_coordinate($store->lat, $store->lng);
    $api_key     = \AgileStoreLocator\Helper::get_configs('server_key');


    //  Already approved?
    if($store->pending != '1') {
      return ['msg' => $store->title.' '.esc_attr__('Store is already approved.','asl_locator'), 'success' => false];
    }

    //  Validate the API
    if(!$is_valid && !$api_key) {
      return ['msg' => esc_attr__('Google Server API key is missing.','asl_locator'), 'success' => false];
    }


    //  Get the right coordinates
    $coordinates = ($is_valid)? ['lat' => $store->lat, 'lng' => $store->lng]: \AgileStoreLocator\Helper::getCoordinates($store->street, $store->city, $store->state, $store->postal_code, $store->country, $api_key);

    //  When we have coordinates
    if($coordinates) {

      if($wpdb->update( ASL_PREFIX.'stores', array('pending' => null, 'lat' => $coordinates['lat'], 'lng' => $coordinates['lng']), array('id'=> $store->id ))){

        return ['success' => true];
      }
    }
    
    //  Failed for the coordinates
    return ['msg' => esc_attr__('Error! Failed to validate for the coordinates by the Google API, validate the Server API key.','asl_locator'), 'success' => false];
  }


  /**
   * [pending_store_count Return the count of pending stores]
   * @return [type] [description]
   */
  public static function pending_store_count() {

    global $wpdb;

    //  Get the Count of the Pendng Stores
    $pending_stores = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores WHERE pending = 1");

    $pending_stores = ($pending_stores && isset($pending_stores[0]))? $pending_stores[0]->c: 0;

    return $pending_stores;
  }


  /**
   * [register_notification Send the notification to the owner about registeration of the new store]
   * @param  [type] $form_data [description]
   * @param  [type] $store_id  [description]
   * @return [type]            [description]
   */
  public static function register_notification($form_data, $store_id) {

    global $wpdb;

    $all_configs = \AgileStoreLocator\Helper::get_configs(['admin_notify', 'notify_email']);
      
    //   Validate the admin notification checkbox is enabled
    if(isset($all_configs['admin_notify']) && $all_configs['admin_notify'] == '1') {

      $admin_email = (isset($all_configs['notify_email']) && $all_configs['notify_email'])? $all_configs['notify_email']: null;
      $user_email  = $form_data['email'];

      //  Check if the admin email is there
      if($admin_email) {

        //  When no-email is provided
        if(!$user_email) {
          $user_email = $admin_email;
        }

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        //  Prepare the store details
        $locality = implode(', ', array($form_data['city'], $form_data['state'], $form_data['postal_code']));
        $address  = [$form_data['street'], $locality];

        if(is_array($address)) {
          $address = implode(', ', $address);
        }
        
        $address  = strip_tags(trim($address));

        $subject  = esc_attr__("Store Locator Updates! New Store Registered",'asl_locator');

        $message  = '<p>'.esc_attr__('New store is registered with these details.','asl_locator'). '</p><br>'.
                    '<p>'.esc_attr__('Title: ','asl_locator'). strip_tags($form_data['title']).'</p>'.
                    '<p>'.esc_attr__('Address: ','asl_locator').$address.'</p>'.
                    __( '<p><a href="%verification_url%" target="_blank">Approve Store</a> to adding it in listing.</p>', 'asl_locator');


        //  Generate the code
        $activation_code = md5(uniqid());

        //  Save it as meta
        \AgileStoreLocator\Helper::set_option($store_id, 'activation_code', $activation_code);

        $message  = str_replace( '%verification_url%', self::store_activation_link($store_id, $activation_code), $message );
        
        //  Send a email notification
        \AgileStoreLocator\Helper::send_email($admin_email, $subject, $message);
      }
    }
  }

  /**
   * [verify_store_link Verify the link for the store and approve it]
   * @param  [type] $store_id        [description]
   * @param  [type] $validation_code [description]
   * @return [type]                  [description]
   */
  public static function verify_store_link($store_id, $validation_code) {

    $activation_code = \AgileStoreLocator\Helper::get_option($store_id, 'activation_code');

    //  When the code match, remove it from pending state
    if($activation_code && $activation_code == $validation_code) {
      
      $results = self::approve_store($store_id);

      if($results['success']) {

        echo esc_attr__('Success! Store has been approved.','asl_locator');
      }
      else
        echo $results['msg'];

      die;
    }
  }


  /**
   * [store_activation_link Generate a link to activate the store]
   * @param  [type] $store_id        [description]
   * @param  [type] $activation_code [description]
   * @return [type]                  [description]
   */
  public static function store_activation_link($store_id, $activation_code){

    return admin_url( 'admin-ajax.php' ).'?action=asl_approve_store&sl-store='.$store_id.'&sl-verify='.$activation_code;
  }
  
}