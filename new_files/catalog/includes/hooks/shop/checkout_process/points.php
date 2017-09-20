<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/shop/checkout_process/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

class hook_shop_checkout_process_points {
  
  function __construct() {
    require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php');
  }

  function listen_CheckoutProcessAddPoints() {
    global $order, $customer_shopping_points_spending, $customer_id, $insert_id, $session, $customer_referral;
        
    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True')) {
// customer pending points added 
      if ($order->info['total'] > 0) {
	      $points_toadd = get_points_toadd($order);
	      $points_comment = 'TEXT_DEFAULT_COMMENT';
	      $points_type = 'SP';
	      if ((get_redemption_awards($customer_shopping_points_spending) == true) && ($points_toadd >0)) {
		      tep_add_pending_points($customer_id, $insert_id, $points_toadd, $points_comment, $points_type);
	      }
      }
// customer referral points added 
      if ((tep_session_is_registered('customer_referral')) && (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM))) {
	      $referral_twice_query = tep_db_query("select unique_id from customers_points_pending where orders_id = '". (int)$insert_id ."' and points_type = 'RF' limit 1");
	      if (!tep_db_num_rows($referral_twice_query)) {
		      $points_toadd = MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM;
		      $points_comment = 'TEXT_DEFAULT_REFERRAL';
		      $points_type = 'RF';
		      tep_add_pending_points($customer_referral, $insert_id, $points_toadd, $points_comment, $points_type);
	      }
      }
// customer shoppping points account balanced 
      if ($customer_shopping_points_spending) {
	      tep_redeemed_points($customer_id, $insert_id, $customer_shopping_points_spending);
      }
    }
  }
    
  function listen_CheckoutProcessUnregister() {
    global $session;
        
    if (tep_session_is_registered('customer_shopping_points')) tep_session_unregister('customer_shopping_points');
    if (tep_session_is_registered('customer_shopping_points_spending')) tep_session_unregister('customer_shopping_points_spending');
    if (tep_session_is_registered('customer_referral')) tep_session_unregister('customer_referral');
  }

} // end class
