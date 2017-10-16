<?php
/*
  $Id$
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

  class points {
    var $code, $title, $description, $enabled;

    function __construct() {
      global $order;

      $this->code = 'points';
      $this->title = MODULE_PAYMENT_POINTS_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_POINTS_TEXT_DESCRIPTION;
      if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_PAYMENT_POINTS_HT_WARNING . '<br>
                                <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . MODULE_PAYMENT_POINTS_HT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER')) {
        $this->description .=   '<div class="secWarning">' . MODULE_PAYMENT_POINTS_OT_WARNING . '<br>
                                <a href="modules.php?set=order_total&module=ot_redemptions&action=install">' . MODULE_PAYMENT_POINTS_OT_INSTALL_NOW . '</a></div>';
      }
      $this->sort_order = defined('MODULE_PAYMENT_POINTS_SORT_ORDER') ? MODULE_PAYMENT_POINTS_SORT_ORDER : 0;
      $this->enabled = defined('MODULE_PAYMENT_POINTS_STATUS') && (MODULE_PAYMENT_POINTS_STATUS == 'True') ? true : false;
      $this->order_status = defined('MODULE_PAYMENT_POINTS_ORDER_STATUS_ID') && ((int)MODULE_PAYMENT_POINTS_ORDER_STATUS_ID > 0) ? (int)MODULE_PAYMENT_POINTS_ORDER_STATUS_ID : 0;

      if ( $this->enabled === true ) {
        if ( isset($order) && is_object($order) ) {
          $this->update_status();
        }
      }
    }

    function update_status() {
      global $order, $cart, $max_points;
	  
      if( !function_exists('check_points_redemtion') ) {
        require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php'); 
      }
	  
      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_POINTS_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '" . MODULE_PAYMENT_POINTS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }

      if ($this->enabled == true) {
        $this->enabled = false;
        $cart_show_total = $cart->show_total();
        if ( tep_not_null($max_points = check_points_redemtion ($cart_show_total)) ) {
          if ($order->info['total'] <= tep_calc_shopping_pvalue($max_points)) {
            $this->enabled = true;
          }
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      global $max_points;
      return array('id' => $this->code,
                   'module' => $this->title . tep_draw_hidden_field('customer_shopping_points_points', $max_points));
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_PAYMENT_POINTS_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Cash On Delivery Module', 'MODULE_PAYMENT_POINTS_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_POINTS_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_POINTS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_POINTS_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
   }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_POINTS_STATUS', 'MODULE_PAYMENT_POINTS_ZONE', 'MODULE_PAYMENT_POINTS_ORDER_STATUS_ID', 'MODULE_PAYMENT_POINTS_SORT_ORDER');
    }
  }
?>
