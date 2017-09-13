<?php
/*
  $Id: points_hooks.php
  $Loc: catalog/includes/hooks/shop/points/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

class hook_shop_points_points_hooks {

  function listen_PointsCreateAccountMailMod() {
    global $gender, $lastname, $firstname, $customer_id, $currencies, $email_text, $language;
    
    require('includes/languages/' . $language . '/hooks/shop/points/points_hooks.php');
    
    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT > 0)) {
      tep_add_welcome_points($customer_id);
	      
	    $points_account = '<a href="' . tep_href_link('my_points.php', '', 'SSL') . '"><b><u>' . POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_ACCOUNT . '</u></b></a>.';
	    $points_faq = '<a href="' . tep_href_link('my_points_help.php', '', 'NONSSL') . '"><b><u>' . POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_FAQ . '</u></b></a>.';
	    $email_text .= sprintf(POINTS_HOOK_CREATE_ACCOUNT_EMAIL_WELCOME_POINTS , $points_account, number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT, MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_NEW_SIGNUP_POINT_AMOUNT)), $points_faq) ."\n\n";
    }
  }
  
  
}