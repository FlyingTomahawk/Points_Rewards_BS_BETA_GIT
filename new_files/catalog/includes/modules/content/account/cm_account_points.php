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

  class cm_account_points {
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_ACCOUNT_POINTS_TITLE;
      $this->description = MODULE_CONTENT_ACCOUNT_POINTS_DESCRIPTION;
      if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_ACCOUNT_POINTS_HT_WARNING . '<br>
                                <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . MODULE_CONTENT_ACCOUNT_POINTS_HT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER')) {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_ACCOUNT_POINTS_OT_WARNING . '<br>
                                <a href="modules.php?set=order_total&module=ot_redemptions&action=install">' . MODULE_CONTENT_ACCOUNT_POINTS_OT_INSTALL_NOW . '</a></div>';
      }
      if (!defined('MODULE_PAYMENT_POINTS_STATUS') || MODULE_PAYMENT_POINTS_STATUS != 'True') {
        $this->description .=   '<div class="secWarning">' . MODULE_CONTENT_ACCOUNT_POINTS_PM_WARNING . '<br>
                                <a href="modules.php?set=payment&module=points&action=install">' . MODULE_CONTENT_ACCOUNT_POINTS_PM_INSTALL_NOW . '</a></div>';
      }
	  
      if ( defined('MODULE_CONTENT_ACCOUNT_POINTS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_ACCOUNT_POINTS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_ACCOUNT_POINTS_STATUS == 'True');
      }
    }

    function execute() {
        global $oscTemplate, $language, $customer_id, $currencies;
    
		if (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') {
			
		    require_once('includes/functions/redemptions.php');
			
			$has_points = tep_get_shopping_points($customer_id);	
			$oscTemplate->_data[$this->group] += array('points' => array('title' => MODULE_CONTENT_ACCOUNT_POINTS_PUBLIC_TITLE,
                                                                         'sort_order' => MODULE_CONTENT_ACCOUNT_POINTS_SORT_ORDER,
                                                                         'links' => array('points_balance' => array('title' => '<div class="alert alert-info">' . sprintf(MODULE_CONTENT_ACCOUNT_POINTS_CURRENT_BALANCE, number_format($has_points, MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue($has_points))) . '</div>',
                                                                                                                    'link' => NULL,
                                                                                                                    'icon' => NULL),
                                                                                                    'view' => array('title' => MODULE_CONTENT_ACCOUNT_POINTS_VIEW,
                                                                                                                    'link' => tep_href_link('my_points.php', '', 'SSL'),
                                                                                                                    'icon' => 'fa fa-plus'),
                                                                                               'view_help' => array('title' => MODULE_CONTENT_ACCOUNT_POINTS_VIEW_HELP,
                                                                                                                    'link' => tep_href_link('my_points_help.php', '', 'SSL'),
                                                                                                                    'icon' => 'fa fa-info-circle'))));															   
		}
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_CONTENT_ACCOUNT_POINTS_STATUS');
    }

    function install() {
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Credit Balance Module', 'MODULE_CONTENT_ACCOUNT_POINTS_STATUS', 'True', 'Should Credit Balance be shown in the Account page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_ACCOUNT_POINTS_SORT_ORDER', '50', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from configuration where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_CONTENT_ACCOUNT_POINTS_STATUS', 'MODULE_CONTENT_ACCOUNT_POINTS_SORT_ORDER');
    }
  }

