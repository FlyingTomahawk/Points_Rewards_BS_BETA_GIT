<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

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

      require_once('includes/functions/redemptions.php');

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
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Products ID Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID', '', 'Restriction Products by Product ID.<br>Set a comma separated list of Products ID Allowed or leave empty to disable it.', '6', '6', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Categories ID Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH', '', 'Restriction Products by Categories ID.<br>Set a comma separated list of Cpaths Allowed or leave empty to disable it.', '6', '17', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Products Price Restriction', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEMPTION_DISCOUNTED', 'False', 'When customers redeem points, do you want to exclude items already discounted ?<br>Redemptions enabled only on items with full price', '6', '18', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('If you wish to limit points before Redemptions, set points limit to', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE', '0', 'Set the No. of points nedded before they can be redeemed. Set to 0 if you wish to disable it.', '6', '19', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('If you wish to limit points to be use per order, set points Max to', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE', '1000', 'Set the Maximum No. of points customer can redeem per order. to avoid points maximum limit, set to high No. ', '6', '20', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Restrict Points Redemption For Minimum Purchase Amount', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT', '', 'Enter the Minimum Purchase Amount(total cart contain) required before Redemptions enabled.<br>Leave empty for no Restriction', '6', '21', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('New signup customers Welcome Points amount', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT', '0', 'Set the Welcome Points amount to be auto-credited for New signup customers. Set to 0 if you wish to disable it', '6', '22', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum number of points records to display', 'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_MAX_DISPLAY_POINTS_RECORD', '20', 'Set the Maximum number of points records to display per page in my_points.php page', '6', '23', now())");
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
			
			
// BEGIN file modifications install scripts
      // check if hook support is present
      $this->check_hook_support();
                  
      //loop pages
      foreach (get_pages() as $page) {
    
        $this->create_backup($page);
        
        $page_array = null;

        if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
          $page_array = array();

          // create page content array
          if (filesize(DIR_FS_CATALOG . $page) > 0) {
            $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
            $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
            fclose($fg);

            $page_array = explode("\n", $data);
          }

          $fp = fopen(DIR_FS_CATALOG . $page, 'w');
          fwrite($fp, implode("\n", $page_array));
          fclose($fp);
          
          // add points code to all relevant files                
          $page_array = $this->install_points_hooks($page, $page_array);


          $fp = fopen(DIR_FS_CATALOG . $page, 'w');
          fwrite($fp, implode("\n", $page_array));
          fclose($fp);
        }    
          
        // check installation
        $this->check_points_hooks($page);

      } // end loop through pages
      
    } // end install

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");

      if ( defined('MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE') && MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE == 'True' ) {
        tep_db_query("DROP TABLE IF EXISTS customers_points_pending");
        tep_db_query("ALTER TABLE customers DROP customers_shopping_points,
					            DROP customers_points_expires");	
      }
      
      //loop pages
      foreach (get_pages() as $page) {

        // remove hook register and calls in all related pages
        // define hook code for all pages
        $points_remove_hook = null;
        $points_remove_lines = null;
        $points_remove_hook = array();
        $points_remove_lines = array();
        $points_remove_hook[] = array('// POINTS REWARDS BS');
        $points_remove_lines[] = 0;
        
        switch ($page) {
        case 'checkout_confirmation.php':        
          $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'checkout_confirmation\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('    echo $OSCOM_Hooks->call(\'checkout_confirmation\', \'CheckoutConfirmPoints\');');
          $points_remove_lines[] = 1;
          break;                                           
        case 'checkout_payment.php':
          $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'checkout_payment\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('<!-- POINTS REWARDS BS -->');
          $points_remove_lines[] = 0;
          $points_remove_hook[] = array('    <?php echo $OSCOM_Hooks->call(\'checkout_payment\', \'CheckoutPaymentPoints\'); ?>');
          $points_remove_lines[] = 1;
          break;          
        case 'checkout_process.php':
          $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'checkout_process\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('  echo $OSCOM_Hooks->call(\'checkout_process\', \'CheckoutProcessAddPoints\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('  echo $OSCOM_Hooks->call(\'checkout_process\', \'CheckoutProcessUnregister\');');
          $points_remove_lines[] = 1;
          break;          
        case 'create_account.php':
          $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'create_account\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('      echo $OSCOM_Hooks->call(\'create_account\', \'CreateAccountMailMod\');');
          $points_remove_lines[] = 1;
          break;          
        case 'create_account_success.php':
          $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'create_account_success\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('<!-- POINTS REWARDS BS -->');
          $points_remove_lines[] = 0;
          $points_remove_hook[] = array('	    <?php echo $OSCOM_Hooks->call(\'create_account_success\', \'CreateAccountSuccess\'); ?>');
          $points_remove_lines[] = 0;
          break;
        case str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'orders.php':
          if ( !file_exists(DIR_FS_CATALOG . 'includes/hooks/admin/orders/paypal.php') ) {
            $points_remove_hook[] = array('  $OSCOM_Hooks->register(\'orders\');');
            $points_remove_lines[] = 1;
          }
          $points_remove_hook[] = array('          echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderUpdatePoints\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('        echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderRemovePoints\');');
          $points_remove_lines[] = 1;
          $points_remove_hook[] = array('<!-- POINTS REWARDS BS -->');
          $points_remove_lines[] = 0;
          $points_remove_hook[] = array('	    <?php echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderPointsFields\'); ?>');
          $points_remove_lines[] = 0;
          break;
        }
  
        $page_array = null;

        if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
          $page_array = array();

          // create page content array
          if (filesize(DIR_FS_CATALOG . $page) > 0) {
            $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
            $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
            fclose($fg);

            $page_array = explode("\n", $data);
          }

          if (is_array($points_remove_hook)) {
            $fp = fopen(DIR_FS_CATALOG . $page, 'w');
            fwrite($fp, implode("\n", $page_array));
            fclose($fp);

            if ( in_array('// POINTS REWARDS BS', $page_array) ) {
              for ($i=0, $n=(sizeof($page_array)); $i<$n; $i++) {
                for ($j=0, $k=sizeof($points_remove_hook); $j<$k; $j++) {
                  if ( isset($page_array[$i]) && (in_array($page_array[$i], $points_remove_hook[$j])) ) {
                    if ( $points_remove_lines[$j] == 1 ) {
                        unset($page_array[$i-1]); // remove blank line(s) above
                        unset($page_array[$i+1]); // remove blank line(s) below
                    }
                    unset($page_array[$i]); // remove points hook code
                  } // end if in array code
                } // end loop code array
              }  // end loop page array
            } // end if in array // POINTS REWARDS BS
            

            $fp = fopen(DIR_FS_CATALOG . $page, 'w');
            fwrite($fp, implode("\n", $page_array));
            fclose($fp);
          } // end is_array $points_remove_hook
    
        } // end remove code if page file exists

        // check removed code
        $this->check_remove_points_hooks($page, $points_remove_hook);
        
      } // end loop through pages
    } //end remove

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
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEMPTION_DISCOUNTED',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_MAX_DISPLAY_POINTS_RECORD',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_DISPLAY_POINTS_REDEEMED',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_UNINSTALL_DATABASE',
                   'MODULE_HEADER_TAGS_POINTS_REWARDS_SORT_ORDER');
    }

    // function add points and rewards hooks register and call in account files  
    function install_points_hooks($page, $page_array) {
         
      // define hook register and call ref code and added code lines
      $points_code_hook = null;
      $points_code_hook_ref = null;
      $points_code_lines = null;
      $points_code_hook_ref = array();
      $points_code_hook = array();
      $points_code_lines = array();
      $hook_register = false;
      
      switch ($page) {
      case 'checkout_confirmation.php':        
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'checkout_confirmation\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '// POINTS REWARDS BS',
                                      '  $OSCOM_Hooks->register(\'checkout_confirmation\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = '$payment_modules->update_status();';
        $points_code_hook[] = array('',
                                    '// POINTS REWARDS BS',
                                    '    echo $OSCOM_Hooks->call(\'checkout_confirmation\', \'CheckoutConfirmPoints\');');
        $points_code_lines[] = 1;
        break;                                           
      case 'checkout_payment.php':
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'checkout_payment\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '// POINTS REWARDS BS',
                                      '  $OSCOM_Hooks->register(\'checkout_payment\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = '$radio_buttons++;';
        $points_code_hook[] = array('<!-- POINTS REWARDS BS -->',
                                    '    <?php echo $OSCOM_Hooks->call(\'checkout_payment\', \'CheckoutPaymentPoints\'); ?>',
                                    '');
        $points_code_lines[] = 8;
        break;          
      case 'checkout_process.php':
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'checkout_process\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '// POINTS REWARDS BS',
                                      '  $OSCOM_Hooks->register(\'checkout_process\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = 'tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);';
        $points_code_hook[] = array('',
                                    '// POINTS REWARDS BS',
                                    '  echo $OSCOM_Hooks->call(\'checkout_process\', \'CheckoutProcessAddPoints\');');
        $points_code_lines[] = 2;
        $points_code_hook_ref[] = 'tep_session_unregister(\'comments\');';
        $points_code_hook[] = array('',
                                    '// POINTS REWARDS BS',
                                    '  echo $OSCOM_Hooks->call(\'checkout_process\', \'CheckoutProcessUnregister\');');
        $points_code_lines[] = 1;
        break;          
      case 'create_account.php':
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'create_account\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '// POINTS REWARDS BS',
                                      '  $OSCOM_Hooks->register(\'create_account\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = '$email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;';
        $points_code_hook[] = array('// POINTS REWARDS BS',
                                    '      echo $OSCOM_Hooks->call(\'create_account\', \'CreateAccountMailMod\');',
                                    '');
        $points_code_lines[] = 1;
        break;          
      case 'create_account_success.php':
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'create_account_success\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '// POINTS REWARDS BS',
                                      '  $OSCOM_Hooks->register(\'create_account_success\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = '<?php echo TEXT_ACCOUNT_CREATED; ?>';
        $points_code_hook[] = array('<!-- POINTS REWARDS BS -->',
                                    '	    <?php echo $OSCOM_Hooks->call(\'create_account_success\', \'CreateAccountSuccess\'); ?>');
        $points_code_lines[] = 1;
        break;
      case str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'orders.php':
        foreach ($page_array as $page_array_element) {
          if (strpos($page_array_element, '$OSCOM_Hooks->register(\'orders\')')) {
            $hook_register = true;
            break;
          }
        }
        if ( $hook_register !== true ) {
          $points_code_hook_ref[] = '(\'includes/application_top.php\');';
          $points_code_hook[] = array('',
                                      '  $OSCOM_Hooks->register(\'orders\');');
          $points_code_lines[] = 1;
        }
        $points_code_hook_ref[] = '$customer_notified = \'1\';';
        $points_code_hook[] = array('// POINTS REWARDS BS',
                                     '          echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderUpdatePoints\');',
                                     '');
        $points_code_lines[] = 3;
        $points_code_hook_ref[] = 'tep_remove_order($oID, $_POST[\'restock\']);';
        $points_code_hook[] = array('',
                                    '// POINTS REWARDS BS',
                                    '        echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderRemovePoints\');',
                                    '');
        $points_code_lines[] = 3;
        $points_code_hook_ref[] = '<td><?php echo tep_draw_checkbox_field(\'notify_comments\', \'\', true); ?></td>';
        $points_code_hook[] = array('<!-- POINTS REWARDS BS -->',
                                    '	    <?php echo $OSCOM_Hooks->call(\'orders\', \'PointsOrderPointsFields\'); ?>');
        $points_code_lines[] = 2;
        break;
      }
      
       // add hook code to files
      if ( !in_array('// POINTS REWARDS BS', $page_array) ) {
        for ($i=0, $n=sizeof($page_array); $i<$n; $i++) {
          for ($j=0, $k=sizeof($points_code_hook_ref); $j<$k; $j++) {
            if ( strpos($page_array[$i], $points_code_hook_ref[$j]) ) {
              array_splice($page_array, $i+$points_code_lines[$j], 0, $points_code_hook[$j]);
            }
          }
        }
      }
  
      return $page_array;
    } 

    // function check points and rewards hooks register and call installation in account files  
    function check_points_hooks($page) {
     
        $page_array = null;
        $error = false;

        if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
          $page_array = array();

          // create page content array
          if (filesize(DIR_FS_CATALOG . $page) > 0) {
            $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
            $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
            fclose($fg);

            $page_array = explode("\n", $data);
          }
          
          if ( !in_array('// POINTS REWARDS BS', $page_array) ) {
            $error = true;
            $this->recover_backup($page);
          }

          $this->show_install_message($page, $error);
          
        } // end check installation

        return $page_array;

    } 

    // function check remove points and rewards hooks register and call installation in account files  
    function check_remove_points_hooks($page, $points_remove_hook) {
     
        // check remove
        $page_array = null;
        $error = false;

        if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
          $page_array = array();

          // create page content array
          if (filesize(DIR_FS_CATALOG . $page) > 0) {
            $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
            $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
            fclose($fg);

            $page_array = explode("\n", $data);
          }
          
          for ($i=0, $n=sizeof($page_array); $i<$n; $i++) {
            if ( tep_not_null($page_array[$i]) && strpos($page_array[$i], 'POINTS REWARDS BS') !== false ) {
              $error = true;
            }
          }

          $this->show_remove_message($page, $error);
          
        } // end check remove

    } 

    // function create htaccess backup  
    function create_backup($orig_filename) {
      $separator = ((substr(DIR_FS_CATALOG, -1) != '/') ? '/' : '');
      $backupDir = DIR_FS_BACKUP . $separator . 'points_backups';
      $backupDir .= '/';
      // create backup dir
      if(!is_dir($backupDir)) mkdir($backupDir, 0755);
      // create .htacces protection like in includes dir
      if (!is_file($backupDir . '.htaccess')) {
        $htaccessfile = $backupDir . '.htaccess';
        //define .htaccess content
        $htacces = '
<Files *.php>
Order Deny,Allow
Deny from all
</Files>
';
        file_put_contents($htaccessfile, $htacces);
      }
      $pointsfileOrig = DIR_FS_CATALOG . $separator . $orig_filename;
      if (strpos($orig_filename, '/')) $orig_filename = substr($orig_filename, strrpos($orig_filename, '/')+1); // for ext/.../paypal files
      $pointsfileBkup = $backupDir . $orig_filename . '.bak';
      
      $result = copy($pointsfileOrig, $pointsfileBkup);
    } 

    // function recover backups if error 
    function recover_backup($orig_filename) {
      $separator = ((substr(DIR_FS_CATALOG, -1) != '/') ? '/' : '');
      $backupDir = DIR_FS_BACKUP . $separator . 'points_backups';
      $backupDir .= '/';

      $pointsfileOrig = DIR_FS_CATALOG . $separator . $orig_filename;
      if (strpos($orig_filename, '/')) $orig_filename = substr($orig_filename, strrpos($orig_filename, '/')+1); // for ext/.../paypal files
      $pointsfileBkup = $backupDir . $orig_filename . '.bak';
      
      $result = copy($pointsfileBkup, $pointsfileOrig);
    } 

   
    function show_install_message($page, $error) {
      global $messageStack;
      if ($error == false) {
        $messageStack->add_session('Points and Rewards hook codes have been successfully added to the file: "' . $page . '"', 'success');
      } else {
        $bak_page = $page;
        if (strpos($bak_page, '/')) $bak_page = substr($bak_page, strrpos($bak_page, '/')+1); // for ext/.../paypal files
        $messageStack->add_session('There was an error encountered when trying to add the points and rewards hook code to the file: "' . $page . '".<br>The original file has been recovered from the auto backup: "/points_backups/' . $bak_page . '.bak" Please check the file and apply the required modifications manually.', 'warning');
      }
    }
  
    function show_remove_message($page, $error) {
      global $messageStack;
      if ($error == false) {
        $messageStack->add_session('Points and Rewards hook codes have been successfully removed from the file: "' . $page . '"', 'success');
      } else {
        $bak_page = $page;
        if (strpos($bak_page, '/')) $bak_page = substr($bak_page, strrpos($bak_page, '/')+1); // for ext/.../paypal files
        $messageStack->add_session('There was an error encountered when trying to remove the points and rewards hook code from the file: "' . $page . '".<br>Please check the file and recover the backup file: "/points_backups/' . $bak_page . '.bak" or your own previous backup file if needed.', 'warning');
      }
    }
   
    // function check if hook support exists  
    function check_hook_support() {
      global $messageStack;
     
      if ( file_exists(DIR_FS_CATALOG . 'includes/classes/hooks.php') ) {
        $hook_class_file_error = false;
      } else {
        $messageStack->add_session('The file "includes/classes/hooks.php" has not been found on your server. It is required, please copy the class file from "legacy/catalog/includes/classes/hooks.php."', 'warning');
      }
      
// BEGIN catalog/application_top.php
      $page = 'includes/application_top.php';
      if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {

        $this->create_backup($page);

        $page_array = array();

        // check if hook class is included and initiated in application_top.php
        $points_code_hook_class_incl = '\'includes/classes/hooks.php\'';
        $points_code_hook_class_new = '$OSCOM_Hooks = new hooks(\'shop\');';
    
        // create page content array
        if (filesize(DIR_FS_CATALOG . $page) > 0) {
          $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
          $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
          fclose($fg);

          $page_array = explode("\n", $data);
      

          if ( isset($points_code_hook_class_incl) && isset($points_code_hook_class_new) ) {
            $fp = fopen(DIR_FS_CATALOG . $page, 'w');
            fwrite($fp, implode("\n", $page_array));
            fclose($fp);
   
            $hook_class_error = true;
            for ($i=0, $n=sizeof($page_array); $i<$n; $i++) {
              if ( (tep_not_null($page_array[$i]) && strpos($page_array[$i], $points_code_hook_class_incl) !== false) && 
                   (tep_not_null($page_array[$i+1]) && strpos($page_array[$i+1], $points_code_hook_class_new) !== false) ) {
                $hook_class_error = false;
              }
            }
                      
            if ($hook_class_error == true) {
              $points_code_hook_class_ref_1 = 'require(\'includes/functions/html_output.php\');';
              $points_code_hook_class_ref_2 = 'require(DIR_WS_FUNCTIONS . \'html_output.php\');';
              $sswcleaner_hook_class = array('// hooks',
                                           '  require(\'includes/classes/hooks.php\');',
                                           '  $OSCOM_Hooks = new hooks(\'shop\');',
                                           '');
              
              for ($i=0, $n=sizeof($page_array); $i<$n; $i++) {
               if ( strpos($page_array[$i], $points_code_hook_class_ref_1) || strpos($page_array[$i], $points_code_hook_class_ref_2)) {
                  array_splice($page_array, $i+2, 0, $sswcleaner_hook_class);
                }
              }
            
              $fp = fopen(DIR_FS_CATALOG . $page, 'w');
              fwrite($fp, implode("\n", $page_array));
              fclose($fp);
            
              // check installation
              $page_array = null;
              $hook_class_install_error = false;

              if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
                $page_array = array();

                // create page content array
                if (filesize(DIR_FS_CATALOG . $page) > 0) {
                  $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
                  $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
                  fclose($fg);

                  $page_array = explode("\n", $data);
                }
        
                if ( !in_array('// hooks', $page_array) || 
                     !in_array('  require(\'includes/classes/hooks.php\');', $page_array) || 
                     (!in_array('  $OSCOM_Hooks = new hooks(\'shop\');', $page_array) 
                       ) ) {
                  $this->recover_backup($page);
                  $messageStack->add_session('There was an error encountered when trying to add the hook class code to the file: "includes/application_top.php".<br>The original file has been recovered from the auto backup: "/points_backups/application_top.php.bak" Please check the file and apply the required hook support manually.', 'warning');
                } else {
                  $messageStack->add_session('Hook class code has been successfully added to the file: "includes/application_top.php".', 'success');
                }
              }
            } elseif ($hook_class_file_error == false) {
              $messageStack->add_session('Hook support found, Great!"', 'success'); // hook support ok
            }

          } // end add hook support to application_top.php            
        } // end if file size > 0 
      }  // end if file catalog/application_top.php exists
      
// BEGIN admin/application_top.php
      $page = str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'includes/application_top.php';
      if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {

        $this->create_backup($page);

        $page_array = array();

        // check if hook class is included and initiated in application_top.php
        $points_code_hook_class_incl = '\'includes/classes/hooks.php\'';
        $points_code_hook_class_new = '$OSCOM_Hooks = new hooks(\'admin\');';
    
        // create page content array
        if (filesize(DIR_FS_CATALOG . $page) > 0) {
          $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
          $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
          fclose($fg);

          $page_array = explode("\n", $data);
      

          if ( isset($points_code_hook_class_incl) && isset($points_code_hook_class_new) ) {
            $fp = fopen(DIR_FS_CATALOG . $page, 'w');
            fwrite($fp, implode("\n", $page_array));
            fclose($fp);
   
            $hook_class_error = true;
            for ($i=0, $n=sizeof($page_array); $i<$n; $i++) {
              if ( (tep_not_null($page_array[$i]) && strpos($page_array[$i], $points_code_hook_class_incl) !== false) && 
                   (tep_not_null($page_array[$i+1]) && strpos($page_array[$i+1], $points_code_hook_class_new) !== false) ) {
                $hook_class_error = false;
              }
            }
                      
            if ($hook_class_error == true) {
              $sswcleaner_hook_class = array('  require(DIR_FS_CATALOG . \'includes/classes/hooks.php\');',
                                           '  $OSCOM_Hooks = new hooks(\'admin\');',
                                           '');
              
              array_splice($page_array, sizeof($page_array), 0, $sswcleaner_hook_class);
            
              $fp = fopen(DIR_FS_CATALOG . $page, 'w');
              fwrite($fp, implode("\n", $page_array));
              fclose($fp);
            
              // check installation
              $page_array = null;
              $hook_class_install_error = false;

              if ( file_exists(DIR_FS_CATALOG . $page) && tep_is_writable(DIR_FS_CATALOG . $page) ) {
                $page_array = array();

                // create page content array
                if (filesize(DIR_FS_CATALOG . $page) > 0) {
                  $fg = fopen(DIR_FS_CATALOG . $page, 'rb');
                  $data = fread($fg, filesize(DIR_FS_CATALOG . $page));
                  fclose($fg);

                  $page_array = explode("\n", $data);
                }
        
                if ( !in_array('  require(DIR_FS_CATALOG . \'includes/classes/hooks.php\');', $page_array) || 
                     (!in_array('  $OSCOM_Hooks = new hooks(\'admin\');', $page_array) 
                       ) ) {
                  $this->recover_backup($page);
                  $messageStack->add_session('There was an error encountered when trying to add the hook class code to the file: "' . str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'cludes/application_top.php".<br>The original file has been recovered from the auto backup: "/points_backups/application_top.php.bak" Please check the file and apply the required hook support manually.', 'warning');
                } else {
                  $messageStack->add_session('Hook class code has been successfully added to the file: "' . str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'includes/application_top.php".', 'success');
                }
              }
            } elseif ($hook_class_file_error == false) {
              $messageStack->add_session('Hook support found, Great!"', 'success'); // hook support ok
            }

          } // end add hook support to application_top.php            
        } // end if file size > 0 
      }  // end if file admin/application_top.php exists 

    } // end check hook support
   
  } // end class

  function get_pages() {
    $pages_array = array('checkout_confirmation.php',
                         'checkout_payment.php',
                         'checkout_process.php',
                         'create_account.php',
                         'create_account_success.php',
                         str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . 'orders.php');
    
    
//echo '<br><br>$page' . str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN) . '<br><br>';    
//die;

    
    // check if pages exist
    for ($i=0, $n=sizeof($pages_array); $i<$n; $i++) {
      if ( !file_exists(DIR_FS_CATALOG . $pages_array[$i]) ) unset($pages_array[$i]);
    }
    return $pages_array;
  }
    ?>
