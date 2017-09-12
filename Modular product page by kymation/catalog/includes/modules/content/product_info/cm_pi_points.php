<?php
/*
  $Id cm_pi_points.php, v1.0.2 20160330 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

  class cm_pi_points {
    public $version = '1.0.2';
    public $code = '';
    public $group = '';
    public $title = '';
    public $description = '';
    public $sort_order = 0;
    public $enabled = false;

    public function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_PRODUCT_INFO_POINTS_TITLE;
      $this->description = MODULE_CONTENT_PRODUCT_INFO_POINTS_DESCRIPTION;
      $this->description .= '<div class="secWarning">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';

      if ( defined('MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS == 'True');
      }
    }

    public function execute() {
      global $oscTemplate, $product_info, $currencies, $currency;
      
      $content_width = (int)MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH;

      if (isset($product_info) && $product_info->product_exists() === true) {
        
        ob_start();
        include('includes/modules/content/' . $this->group . '/templates/' . basename(__FILE__));
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
      }
    }

    public function isEnabled() {
      return $this->enabled;
    }

    public function check() {
      return defined('MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS');
    }

    public function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Description Module', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS', 'True', 'Should the product description block be shown on the product info page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '2', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER', '20', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    public function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    public function keys() {
      $keys = array();
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_VERSION';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER';
      return $keys;
    }
  }


  ////////////////////////////////////////////////////////////////////////////
  //                                                                        //
  //  This is the end of the module class.                                  //
  //  Everything past this point is an independent function, not a method.  //
  //                                                                        //
  ////////////////////////////////////////////////////////////////////////////


  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }
  

