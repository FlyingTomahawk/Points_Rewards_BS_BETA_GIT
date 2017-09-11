<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

  class ht_points_rewards {
    var $code = 'ht_points_rewards';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->title = MODULE_HEADER_TAGS_POINTS_REWARDS_TITLE;
      $this->description = MODULE_HEADER_TAGS_POINTS_REWARDS_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') ) {
        $this->sort_order = MODULE_HEADER_TAGS_POINTS_REWARDS_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $oscTemplate, $customer_id, $product_info;

      switch (basename($PHP_SELF) ) {
        case 'logoff.php':
          if (tep_session_is_registered('customer_shopping_points')) tep_session_unregister('customer_shopping_points');
          if (tep_session_is_registered('customer_shopping_points_spending')) tep_session_unregister('customer_shopping_points_spending');
          if (tep_session_is_registered('customer_referral')) tep_session_unregister('customer_referral');
          break;
        case 'product_reviews_write.php':
          if ( (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS)) ) {
            $points_toadd = MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS;
            $comment = 'TEXT_DEFAULT_REVIEWS';
            $points_type = 'RV';
            tep_add_pending_points($customer_id, $product_info['products_id'], $points_toadd, $comment, $points_type);
          }
          break;
      }

    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Points system Module', 'MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM', 'True', 'Enable the system so customers can earn points for orders made?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Redemptions system', 'MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM', 'True', 'Enable customers to Redeem points at checkout?', '6', '2', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Points per 1 currency unit purchase', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE', '1', 'No. of points awarded for each 1. currency unit spent.<br>(currency defined according to admin DEFAULT currency)', '6', '3', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('The value of 1 point when Redeemed', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE', '0.1', 'The value of one point.<br>(pointvalue currency defined according to admin DEFAULT currency)', '6', '4', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Points Decimal Places', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES', '0', 'Pad the points value this amount of decimal places', '6', '5', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Auto Credit Pending Points', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_ON', '', 'Enable Auto Credit Pending Points and set a days period before the reward points will actually added to customers account.<br>For same day set to 0(zero).<br>To disable this option leave empty.', '6', '6', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Auto Expires Points', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES', '12', 'Set a month period before points will auto Expires.<br>To disable this option leave empty.', '6', '7', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Points Expires Auto Remainder', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_EXPIRES_REMIND', '30', 'Enable Points Expires Auto Remainder and set the numbers of days prior points expiration for the script to run.(Auto Expires Points must be enabled)<br>To disable this option leave empty.', '6', '8', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Award points for shipping', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SHIPPING', 'False', 'Enable customers to earn points for shipping fees?', '6', '9', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Award points for Tax', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_TAX', 'False', 'Enable customers to earn points for Tax?', '6', '10', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Award points for Specials', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SPECIALS', 'True', 'Enable customers to earn points for items already discounted?<br>When set to false, Points awarded only on items with full price', '6', '11', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Award points for order with redeemed points', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REDEEMED', 'True', 'When order made with Redeemed Points. Enable customers to earn points for the amount spend other then points?<br>When set to false, customers will NOT awarded even if only part of the payment made by points.', '6', '12', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Award points for Products Reviews', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS', '50', 'If you want to award points when customers add Product Review, set the points amount to be given or leave empty to disable this option', '6', '13', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable and set points for Referral System', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM', '100', 'Do you want to Enable the Referral System and award points when customers refer someone?<br>Set the amount of points to be given or leave empty to disable this option.', '6', '14', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Products Model Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_MODEL', '', 'Restriction Products by model.<br>Set product model Allowed or leave empty to disable it.', '6', '15', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Products ID Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID', '', 'Restriction Products by Product ID.<br>Set a comma separated list of Products ID Allowed or leave empty to disable it.', '6', '6', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Categories ID Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH', '', 'Restriction Products by Categories ID.<br>Set a comma separated list of Cpaths Allowed or leave empty to disable it.', '6', '17', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Products Price Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEMPTION_DISCOUNTED', 'False', 'When customers redeem points, do you want to exclude items already discounted ?<br>Redemptions enabled only on items with full price', '6', '18', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('If you wish to limit points before Redemptions, set points limit to', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE', '0', 'Set the No. of points nedded before they can be redeemed. Set to 0 if you wish to disable it.', '6', '19', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('If you wish to limit points to be use per order, set points Max to', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE', '1000', 'Set the Maximum No. of points customer can redeem per order. to avoid points maximum limit, set to high No. ', '6', '20', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Restrict Points Redemption For Minimum Purchase Amount', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT', '', 'Enter the Minimum Purchase Amount(total cart contain) required before Redemptions enabled.<br>Leave empty for no Restriction', '6', '21', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('New signup customers Welcome Points amount', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT', '0', 'Set the Welcome Points amount to be auto-credited for New signup customers. Set to 0 if you wish to disable it', '6', '22', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum number of points records to display', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_MAX_DISPLAY_POINTS_RECORD', '20', 'Set the Maximum number of points records to display per page in my_points.php page', '6', '23', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Points information in Product info page', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_DISPLAY_POINTS_INFO', 'True', 'Do you want to show Points information Product info page?', '6', '24', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Keep Records of Redeemed Points', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_DISPLAY_POINTS_REDEEMED', 'True', 'Do you want to keep records of all Points redeemed?', '6', '26', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Uninstall Remove Database Table', 'MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE', 'False', 'Do you want to remove the Ponts and Rewards Database Table when uninstall the module? (All Database entries like Customer Points will be deleted, Use this option only if you will not use Points and Rewards System any more!)', '6', '25', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_POINTS_REWARDS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '27', now())");

      if (tep_db_num_rows(tep_db_query("select * from information_schema.columns where table_schema='". DB_DATABASE . "' and table_name='customers' and column_name like 'customers_shopping_points'")) != 1 ) {
        tep_db_query("alter table customers add column `customers_shopping_points` DECIMAL(15,4) NOT NULL DEFAULT '0.0000', add column `customers_points_expires` DATE NULL DEFAULT NULL");
      }
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
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");

      if ( defined('MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE') && MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE == 'True' ) {
        tep_db_query("DROP TABLE IF EXISTS customers_points_pending");
        tep_db_query("ALTER TABLE customers DROP customers_shopping_points,
					            DROP customers_points_expires");	
      }
      
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_ON',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_EXPIRES_REMIND',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SHIPPING',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_TAX',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SPECIALS',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REDEEMED',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_MODEL',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEMPTION_DISCOUNTED',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_MAX_DISPLAY_POINTS_RECORD',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_DISPLAY_POINTS_INFO',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_DISPLAY_POINTS_REDEEMED',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_SORT_ORDER');
    }
  }
?>
