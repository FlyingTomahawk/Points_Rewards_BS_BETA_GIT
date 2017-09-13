<?php
/*
  $Id$ nb_shopping_cart_points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  class nb_shopping_cart_points {
	var $version = '1.0';
    var $code = 'nb_shopping_cart_points';
    var $group = 'navbar_modules_right';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;    
    
    function __construct() {
      $this->title = MODULE_NAVBAR_SHOPPING_CART_POINTS_TITLE;
      $this->description = MODULE_NAVBAR_SHOPPING_CART_POINTS_DESCRIPTION;

      if ( defined('MODULE_NAVBAR_SHOPPING_CART_POINTS_STATUS') ) {
        $this->sort_order = MODULE_NAVBAR_SHOPPING_CART_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_NAVBAR_SHOPPING_CART_POINTS_STATUS == 'True');
        
        switch (MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENT_PLACEMENT) {
          case 'Home':
          $this->group = 'navbar_modules_home';
          break;
          case 'Left':
          $this->group = 'navbar_modules_left';
          break;
          case 'Right':
          $this->group = 'navbar_modules_right';
          break;
        } 
      }
    }

    function getOutput() {
      global $oscTemplate, $cart, $currencies;
      
      ob_start();
      require('includes/modules/navbar_modules/templates/shopping_cart_points.php');
      $data = ob_get_clean();

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_NAVBAR_SHOPPING_CART_POINTS_STATUS');
    }

    function install() {
	  tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_NAVBAR_SHOPPING_CART_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Shopping Cart Module', 'MODULE_NAVBAR_SHOPPING_CART_POINTS_STATUS', 'True', 'Do you want to add the module to your Navbar?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENT_PLACEMENT', 'Right', 'Should the module be loaded in the Left or Right or the Home area of the Navbar?', '6', '1', 'tep_cfg_select_option(array(\'Left\', \'Right\', \'Home\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_NAVBAR_SHOPPING_CART_POINTS_SORT_ORDER', '550', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_NAVBAR_SHOPPING_CART_POINTS_VERSION',
				   'MODULE_NAVBAR_SHOPPING_CART_POINTS_STATUS', 
				   'MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENT_PLACEMENT', 
				   'MODULE_NAVBAR_SHOPPING_CART_POINTS_SORT_ORDER');
    }
  }
  
  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }
  