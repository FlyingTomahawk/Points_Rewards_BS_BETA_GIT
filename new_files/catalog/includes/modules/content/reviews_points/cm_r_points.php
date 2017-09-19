<?php
/*
  $Id cm_r_points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

  class cm_r_points {
    var $version = '1.0';
    var $code = '';
    var $group = '';
    var $title = '';
    var $description = '';
    var $sort_order = 0;
    var $enabled = false;

    function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_REVIEWS_POINTS_TITLE;
      $this->description = MODULE_CONTENT_REVIEWS_POINTS_DESCRIPTION;
      $this->description .= '<div class="secWarning">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';

      if ( defined('MODULE_CONTENT_REVIEWS_POINTS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_REVIEWS_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_REVIEWS_POINTS_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate, $product_info, $currencies, $request_type;
      
      require_once('includes/functions/redemptions.php');

      $content_width = (int)MODULE_CONTENT_REVIEWS_POINTS_CONTENT_WIDTH;

      if ( tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS) ) {
        
          ob_start();
          include('includes/modules/content/' . $this->group . '/templates/points.php');
          $template = ob_get_clean();

          $oscTemplate->addContent($template, $this->group);
      }
    }

    function isEnabled() {
      if (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
    		$this->enabled = false;
    	} else {
    		return $this->enabled;
    	}
    }
    
    function check() {
      return defined('MODULE_CONTENT_REVIEWS_POINTS_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_CONTENT_REVIEWS_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Reviews Points Module', 'MODULE_CONTENT_REVIEWS_POINTS_STATUS', 'True', 'Should the points info be shown on the reviews page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_REVIEWS_POINTS_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '2', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_REVIEWS_POINTS_SORT_ORDER', '20', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array();
      $keys[] = 'MODULE_CONTENT_REVIEWS_POINTS_VERSION';
      $keys[] = 'MODULE_CONTENT_REVIEWS_POINTS_STATUS';
      $keys[] = 'MODULE_CONTENT_REVIEWS_POINTS_CONTENT_WIDTH';
      $keys[] = 'MODULE_CONTENT_REVIEWS_POINTS_SORT_ORDER';
      return $keys;
    }
  } // end class

  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }
  

