<?php
/*

  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  class ot_redemptions {
    var $title, $output;

    function ot_redemptions() {
      $this->code = 'ot_redemptions';
      $this->title = MODULE_ORDER_TOTAL_REDEMPTIONS_TITLE;
      $this->description = MODULE_ORDER_TOTAL_REDEMPTIONS_DESCRIPTION;
      if($this->check())
        $this->enabled = ((USE_REDEEM_SYSTEM == 'true') ? true : false);
      else
        $this->enabled = false;
      $this->sort_order = MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER;

      $this->output = array();
    }

    function process() {
	    global $order, $currencies, $customer_shopping_points_spending;

// if customer is using points to pay   
        if (isset($customer_shopping_points_spending) && is_numeric($customer_shopping_points_spending) && ($customer_shopping_points_spending > 0)) {
	      
	        $order->info['total'] = number_format($order->info['total'] - tep_calc_shopping_pvalue($customer_shopping_points_spending), 4);
	        $order->info['payment_method'] = ( $order->info['total'] > 0) ? $order->info['payment_method'] . '+' . str_replace(':', '', TEXT_POINTS) : str_replace(':', '', TEXT_POINTS);
	      
	        $this->output[] = array('title' =>''. MODULE_ORDER_TOTAL_REDEMPTIONS_TEXT . ':',
                                    'text' => '<span class="pointWarning">-' . $currencies->format(tep_calc_shopping_pvalue($customer_shopping_points_spending), true, $order->info['currency'], $order->info['currency_value'].'</span>'),
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
        tep_db_query("ALTER TABLE `customers` ADD `customers_shopping_points` DECIMAL(15,4) NOT NULL DEFAULT '0.0000', 
					ADD `customers_points_expires` DATE NULL DEFAULT NULL");
	    tep_db_query("CREATE TABLE IF NOT EXISTS customers_points_pending (
						  unique_id INT(11) NOT NULL AUTO_INCREMENT,
						  customer_id INT(11) NOT NULL DEFAULT '0',
						  orders_id INT(11) NOT NULL DEFAULT '0',
						  points_pending DECIMAL(15,4) NOT NULL DEFAULT '0.0000',
						  points_comment VARCHAR(200),
						  date_added DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
						  points_status INT(1) NOT NULL DEFAULT '1',
						  points_type VARCHAR(2) NOT NULL DEFAULT 'SP',
						  PRIMARY KEY  (unique_id))");
		tep_db_query("INSERT INTO `configuration_group` (`configuration_group_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES ('777', 'Points/Rewards', 'Points/Rewards System Configuration', '777', '1')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Points system', 'USE_POINTS_SYSTEM', 'true', 'Enable the system so customers can earn points for orders made?', '777', '1', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Redemptions system', 'USE_REDEEM_SYSTEM', 'true', 'Enable customers to Redeem points at checkout?', '777', '2', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Points per 1.USD purchase', 'POINTS_PER_AMOUNT_PURCHASE', '1', 'No. of points awarded for each 1. dollar spent.<br>(currency defined according to admin DEFAULT currency)', '777', '3', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('The value of 1 point when Redeemed', 'REDEEM_POINT_VALUE', '0.1', 'The value of one point.<br>(pointvalue currency defined according to admin DEFAULT currency)', '777', '4', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Points Decimal Places', 'POINTS_DECIMAL_PLACES', '0', 'Pad the points value this amount of decimal places', '777', '5', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Auto Credit Pending Points', 'POINTS_AUTO_ON', '', 'Enable Auto Credit Pending Points and set a days period before the reward points will actually added to customers account.<br>For same day set to 0(zero).<br>To disable this option leave empty.', '777', '6', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Auto Expires Points', 'POINTS_AUTO_EXPIRES', '12', 'Set a month period before points will auto Expires.<br>To disable this option leave empty.', '777', '7', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Points Expires Auto Remainder', 'POINTS_EXPIRES_REMIND', '30', 'Enable Points Expires Auto Remainder and set the numbers of days prior points expiration for the script to run.(Auto Expires Points must be enabled)<br>To disable this option leave empty.', '777', '8', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Award points for shipping', 'USE_POINTS_FOR_SHIPPING', 'false', 'Enable customers to earn points for shipping fees?', '777', '9', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Award points for Tax', 'USE_POINTS_FOR_TAX', 'false', 'Enable customers to earn points for Tax?', '777', '10', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Award points for Specials', 'USE_POINTS_FOR_SPECIALS', 'true', 'Enable customers to earn points for items already discounted?<br>When set to false, Points awarded only on items with full price', '777', '11', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Award points for order with redeemed points', 'USE_POINTS_FOR_REDEEMED', 'true', 'When order made with Redeemed Points. Enable customers to earn points for the amount spend other then points?<br>When set to false, customers will NOT awarded even if only part of the payment made by points.', '777', '12', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Award points for Products Reviews', 'USE_POINTS_FOR_REVIEWS', '50', 'If you want to award points when customers add Product Review, set the points amount to be given or leave empty to disable this option', '777', '13', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable and set points for Referral System', 'USE_REFERRAL_SYSTEM', '100', 'Do you want to Enable the Referral System and award points when customers refer someone?<br>Set the amount of points to be given or leave empty to disable this option.', '777', '14', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Products Model Restriction', 'RESTRICTION_MODEL', '', 'Restriction Products by model.<br>Set product model Allowed or leave empty to disable it.', '777', '15', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Products ID Restriction', 'RESTRICTION_PID', '', 'Restriction Products by Product ID.<br>Set a comma separated list of Products ID Allowed or leave empty to disable it.', '777', '777', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Categories ID Restriction', 'RESTRICTION_PATH', '', 'Restriction Products by Categories ID.<br>Set a comma separated list of Cpaths Allowed or leave empty to disable it.', '777', '17', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Enable Products Price Restriction', 'REDEMPTION_DISCOUNTED', 'false', 'When customers redeem points, do you want to exclude items already discounted ?<br>Redemptions enabled only on items with full price', '777', '18', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('If you wish to limit points before Redemptions, set points limit to', 'POINTS_LIMIT_VALUE', '0', 'Set the No. of points nedded before they can be redeemed. Set to 0 if you wish to disable it.', '777', '19', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('If you wish to limit points to be use per order, set points Max to', 'POINTS_MAX_VALUE', '1000', 'Set the Maximum No. of points customer can redeem per order. to avoid points maximum limit, set to high No. ', '777', '20', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Restrict Points Redemption For Minimum Purchase Amount', 'POINTS_MIN_AMOUNT', '', 'Enter the Minimum Purchase Amount(total cart contain) required before Redemptions enabled.<br>Leave empty for no Restriction', '777', '21', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('New signup customers Welcome Points amount', 'NEW_SIGNUP_POINT_AMOUNT', '0', 'Set the Welcome Points amount to be auto-credited for New signup customers. Set to 0 if you wish to disable it', '777', '22', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Maximum number of points records to display', 'MAX_DISPLAY_POINTS_RECORD', '20', 'Set the Maximum number of points records to display per page in my_points.php page', '777', '23', NOW(), NOW(), NULL, NULL)");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Display Points information in Product info page', 'DISPLAY_POINTS_INFO', 'true', 'Do you want to show Points information Product info page?', '777', '24', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Keep Records of Redeemed Points', 'DISPLAY_POINTS_REDEEMED', 'true', 'Do you want to keep records of all Points redeemed?', '777', '25', NOW(), NOW(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),')");
		tep_db_query("INSERT INTO `configuration` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER', '4', 'Sort order of display.', '6', '2', NOW(), NOW(), NULL, NULL)");
    }

    function remove() {
        tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
	    tep_db_query("DELETE FROM `configuration_group` WHERE `configuration_group_title` LIKE '%Points/Rewards%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_SYSTEM%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_REDEEM_SYSTEM%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_PER_AMOUNT_PURCHASE%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%REDEEM_POINT_VALUE%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_DECIMAL_PLACES%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_AUTO_ON%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_AUTO_EXPIRES%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_EXPIRES_REMIND%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_FOR_SHIPPING%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_FOR_TAX%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_FOR_SPECIALS%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_FOR_REDEEMED%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_POINTS_FOR_REVIEWS%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%USE_REFERRAL_SYSTEM%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%RESTRICTION_MODEL%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%RESTRICTION_PID%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%RESTRICTION_PATH%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%REDEMPTION_DISCOUNTED%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_LIMIT_VALUE%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_MAX_VALUE%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%POINTS_MIN_AMOUNT%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%NEW_SIGNUP_POINT_AMOUNT%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%MAX_DISPLAY_POINTS_RECORD%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%DISPLAY_POINTS_INFO%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%DISPLAY_POINTS_REDEEMED%'");
		tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER%'");
		tep_db_query("DROP TABLE IF EXISTS customers_points_pending");
		tep_db_query("ALTER TABLE customers DROP customers_shopping_points,
					  DROP customers_points_expires");	
    }
  }
?>
