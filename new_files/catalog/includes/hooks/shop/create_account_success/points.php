<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/shop/create_account_success/

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

class hook_shop_create_account_success_points {
  
  function __construct() {
    require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php');
  }

  function listen_CreateAccountSuccess() {
    global $language, $request_type, $currencies;

    require('includes/languages/' . $language . '/hooks/shop/create_account_success/points.php');

	  if ( MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True' && MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT > 0 ) {
	    echo sprintf(POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_TITLE, null, number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT)));
	    echo sprintf(POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_LINK, '<a href="' . tep_href_link('my_points_help.php','#heading13', $request_type) . '" title="' . POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_MY_POINTS_HELP . '">' . POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_MY_POINTS_HELP . '</a>');
	  }
  }

} // end class
