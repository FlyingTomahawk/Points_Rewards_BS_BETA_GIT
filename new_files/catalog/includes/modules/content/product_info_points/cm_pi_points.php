<?php
/*
  $Id cm_pi_points.php

   originally coded by Ben Zukrel 
   Improved and converted for osC Bootstrap by
   @Tsimi
   and
   @raiwa Rainer Schmied / info@oscaddons.com  / www.oscaddons.com

   Additional credits to @LeeFoster for bug reports and fixes
   German translation by @Tsimi
   German revision by @raiwa
   Spanish translation by @TITO4
   Spanish revision by @PiLLaO 
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  class cm_pi_points {
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

      $this->title = MODULE_CONTENT_PRODUCT_INFO_POINTS_TITLE;
      $this->description = MODULE_CONTENT_PRODUCT_INFO_POINTS_DESCRIPTION;
      $this->description .= '<div class="secWarning">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';
      if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_HT_WARNING . '<br>
                                <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_HT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER')) {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_OT_WARNING . '<br>
                                <a href="modules.php?set=order_total&module=ot_redemptions&action=install">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_OT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_PAYMENT_POINTS_STATUS') || MODULE_PAYMENT_POINTS_STATUS != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_PM_WARNING . '<br>
                                <a href="modules.php?set=payment&module=points&action=install">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_PM_INSTALL_NOW . '</a></div>';
      }

      if ( defined('MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate, $product_info, $currencies, $new_price, $request_type;
      
      require_once('includes/functions/redemptions.php');

      $content_width = (int)MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH;

      if (isset($product_info) && tep_not_null($product_info) ) {

        if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
          $products_price_points = tep_display_points($new_price, tep_get_tax_rate($product_info['products_tax_class_id']));
        } else {
          $products_price_points = tep_display_points($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
        }
        $products_points = tep_calc_products_price_points($products_price_points);
        $products_points_value = tep_calc_price_pvalue($products_points);
        if ((MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SPECIALS == 'True') || $new_price == false) {
          $points_output = sprintf(MODULE_CONTENT_PRODUCT_INFO_TEXT_POINTS , number_format($products_points, MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format($products_points_value), '<a href="' . tep_href_link('my_points_help.php', '#heading3', $request_type) . '" title="' . MODULE_CONTENT_PRODUCT_INFO_POINTS_MY_POINTS_HELP . '">' . MODULE_CONTENT_PRODUCT_INFO_POINTS_MY_POINTS_HELP . '</a>');
        
          ob_start();
          include('includes/modules/content/' . $this->group . '/templates/points.php');
          $template = ob_get_clean();

          $oscTemplate->addContent($template, $this->group);
        }
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
      return defined('MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Info Points Module', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS', 'True', 'Should the points info be shown on the product info page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '2', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER', '20', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array();
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_VERSION';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_STATUS';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_CONTENT_WIDTH';
      $keys[] = 'MODULE_CONTENT_PRODUCT_INFO_POINTS_SORT_ORDER';
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
  

