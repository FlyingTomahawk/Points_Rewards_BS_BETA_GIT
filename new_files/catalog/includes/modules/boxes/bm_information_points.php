<?php
/*
  $Id$ bm_information_points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  class bm_information_points {
	var $version = '1.0';
    var $code = 'bm_information_points';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->title = MODULE_BOXES_INFORMATION_POINTS_TITLE;
      $this->description = MODULE_BOXES_INFORMATION_POINTS_DESCRIPTION;

      if ( defined('MODULE_BOXES_INFORMATION_POINTS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_INFORMATION_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_INFORMATION_POINTS_STATUS == 'True');

        $this->group = ((MODULE_BOXES_INFORMATION_POINTS_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate;

      ob_start();
      include('includes/modules/boxes/templates/information_points.php');
      $data = ob_get_clean();

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_INFORMATION_POINTS_STATUS');
    }

    function install() {
	  tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_BOXES_INFORMATION_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Information Points Module', 'MODULE_BOXES_INFORMATION_POINTS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_INFORMATION_POINTS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_INFORMATION_POINTS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_INFORMATION_POINTS_VERSION',
	               'MODULE_BOXES_INFORMATION_POINTS_STATUS', 
	               'MODULE_BOXES_INFORMATION_POINTS_CONTENT_PLACEMENT', 
				   'MODULE_BOXES_INFORMATION_POINTS_SORT_ORDER');
    }
  }

  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }