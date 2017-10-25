<?php
/*
  $Id: ot_redemptions.php
  $Loc: catalog/includes/modules/order_total/
  
   Version 1.1
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

  class ot_redemptions {
    var $title, $output;

    function __construct() {
      $this->code = 'ot_redemptions';
      $this->title = MODULE_ORDER_TOTAL_REDEMPTIONS_TITLE;
      $this->description = MODULE_ORDER_TOTAL_REDEMPTIONS_DESCRIPTION;
      if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_ORDER_TOTAL_REDEMPTIONS_HT_WARNING . '<br>
                                <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . MODULE_ORDER_TOTAL_REDEMPTIONS_HT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_PAYMENT_POINTS_STATUS') || MODULE_PAYMENT_POINTS_STATUS != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_ORDER_TOTAL_REDEMPTIONS_PM_WARNING . '<br>
                                <a href="modules.php?set=payment&module=points&action=install">' . MODULE_ORDER_TOTAL_REDEMPTIONS_PM_INSTALL_NOW . '</a></div>';
      }
      if($this->check())
        $this->enabled = ( !defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True') ? true : false);
      else
        $this->enabled = false;
      $this->sort_order = MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER;

      $this->output = array();
    }

    function process() {
	    global $order, $currencies, $customer_shopping_points_spending;

// if customer is using points to pay   
        if (isset($customer_shopping_points_spending) && is_numeric($customer_shopping_points_spending) && ($customer_shopping_points_spending > 0)) {
	      
	        $order->info['total'] = $this->format_raw($order->info['total'] - tep_calc_shopping_pvalue($customer_shopping_points_spending));
	        $order->info['payment_method'] = ( $order->info['total'] > 0) ? $order->info['payment_method'] . '+' . str_replace(':', '', MODULE_ORDER_TOTAL_REDEMPTIONS_POINTS) : str_replace(':', '', MODULE_ORDER_TOTAL_REDEMPTIONS_POINTS);
	      
	        $this->output[] = array('title' =>''. MODULE_ORDER_TOTAL_REDEMPTIONS_TEXT . ':',
                                    'text' => '<span class="text-warning">-' . $currencies->format(tep_calc_shopping_pvalue($customer_shopping_points_spending), true, $order->info['currency'], $order->info['currency_value']) . '</span>',
                                    'value' => tep_calc_shopping_pvalue($customer_shopping_points_spending));
        }
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER'");
        $this->_check = tep_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER');
    }

    function install() {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER', '4', 'Sort order of display.', '6', '2', now())");
    }

    function remove() {
        tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

	function format_raw($number, $currency_code = '', $currency_value = '') {
      global $currencies, $currency;

      if (empty($currency_code) || !$currencies->is_set($currency_code)) {
        $currency_code = $currency;
      }

      if (empty($currency_value) || !is_numeric($currency_value)) {
        $currency_value = $currencies->currencies[$currency_code]['value'];
      }

      return number_format(tep_round($number * $currency_value, $currencies->currencies[$currency_code]['decimal_places']), $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }
  }
?>
