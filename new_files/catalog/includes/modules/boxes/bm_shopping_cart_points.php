<?php
/*
  $Id$ bm_shopping_cart_points.php

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

  class bm_shopping_cart_points {
    var $version = '1.0';
    var $code = 'bm_shopping_cart_points';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->title = MODULE_BOXES_SHOPPING_CART_POINTS_TITLE;
      $this->description = MODULE_BOXES_SHOPPING_CART_POINTS_DESCRIPTION;
      if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_BOXES_SHOPPING_CART_POINTS_HT_WARNING . '<br>
                                <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . MODULE_BOXES_SHOPPING_CART_POINTS_HT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER')) {
        $this->description .=   '<div class="secWarning">' . MODULE_BOXES_SHOPPING_CART_POINTS_OT_WARNING . '<br>
                                <a href="modules.php?set=order_total&module=ot_redemptions&action=install">' . MODULE_BOXES_SHOPPING_CART_POINTS_OT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_PAYMENT_POINTS_STATUS') || MODULE_PAYMENT_POINTS_STATUS != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_BOXES_SHOPPING_CART_POINTS_PM_WARNING . '<br>
                                <a href="modules.php?set=payment&module=points&action=install">' . MODULE_BOXES_SHOPPING_CART_POINTS_PM_INSTALL_NOW . '</a></div>';
      }

      if ( defined('MODULE_BOXES_SHOPPING_CART_POINTS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_SHOPPING_CART_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_SHOPPING_CART_POINTS_STATUS == 'True');

        $this->group = ((MODULE_BOXES_SHOPPING_CART_POINTS_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate, $cart, $currencies, $new_products_id_in_cart, $customer_id;

      require_once('includes/functions/redemptions.php');

      $cart_contents_string = '';

      if ($cart->count_contents() > 0) {
        $cart_contents_string = NULL;
        $products = $cart->get_products();
        for ($i=0, $n=sizeof($products); $i<$n; $i++) {

          $cart_contents_string .= '<li';
          if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
            $cart_contents_string .= ' class="newItemInCart"';
          }
          $cart_contents_string .= '>';

          $cart_contents_string .= $products[$i]['quantity'] . '&nbsp;x&nbsp;';

          $cart_contents_string .= '<a href="' . tep_href_link('product_info.php', 'products_id=' . $products[$i]['id']) . '">';

          $cart_contents_string .= $products[$i]['name'];

          $cart_contents_string .= '</a></li>';

          if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
            tep_session_unregister('new_products_id_in_cart');
          }
        }

        $cart_contents_string .= '<li class="text-right"><hr>' . $currencies->format($cart->show_total()) . '</li>';

		  if (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True') {
				  $has_points = tep_get_shopping_points($customer_id);
				  if ($has_points > 0) {
						  $cart_contents_string .= '<li class="text-right"><div class="text-center"><strong><a href="' . tep_href_link('my_points.php', '', 'SSL') . '"><br />'. MODULE_BOXES_SHOPPING_CART_POINTS_POINTS_BALANCE . '</a></strong></div>' . MODULE_BOXES_SHOPPING_CART_POINTS_POINTS . '&nbsp;' . number_format($has_points,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . '<br />' .  MODULE_BOXES_SHOPPING_CART_POINTS_VALUE . '&nbsp;' . $currencies->format(tep_calc_shopping_pvalue($has_points)) . '</li>';
				  }   
		  }

		
      } else {
        $cart_contents_string .= '<p>' . MODULE_BOXES_SHOPPING_CART_POINTS_BOX_CART_EMPTY . '</p>';
      }
              
      ob_start();
      include('includes/modules/boxes/templates/shopping_cart_points.php');
      $data = ob_get_clean();

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_SHOPPING_CART_POINTS_STATUS');
    }

    function install() {
	  tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_BOXES_SHOPPING_CART_POINTS_VERSION', '" . $this->version . "', 'The version of this module that you are running', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Shopping Cart with Points Module', 'MODULE_BOXES_SHOPPING_CART_POINTS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_SHOPPING_CART_POINTS_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_SHOPPING_CART_POINTS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_SHOPPING_CART_POINTS_VERSION', 
				   'MODULE_BOXES_SHOPPING_CART_POINTS_STATUS', 
				   'MODULE_BOXES_SHOPPING_CART_POINTS_CONTENT_PLACEMENT', 
				   'MODULE_BOXES_SHOPPING_CART_POINTS_SORT_ORDER');
    }
  }
  
    ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }
?>
