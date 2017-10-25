<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/shop/checkout_payment/

   Version: 1.1
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

class hook_shop_checkout_payment_points {
  
  function __construct() {
    require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php');
  }
  
  function listen_CheckoutPaymentPoints() {
    global $cart, $order, $language;
        
    require('includes/languages/' . $language . '/hooks/shop/checkout_payment/points.php');

    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True')) {
      $cart_show_total= $cart->show_total();
      echo points_selection($cart_show_total);
      
      // PWA guest checkout support BEGIN
      if ( defined('MODULE_CONTENT_PWA_LOGIN_STATUS') && MODULE_CONTENT_PWA_LOGIN_STATUS == 'True' && tep_session_is_registered('customer_is_guest') ) {
        $orders_check_query = tep_db_query("select count(*) as total from orders o, orders_status s where o.customers_email_address = '" . $order->customer['email_address'] . "'");
        $orders_check = tep_db_fetch_array($orders_check_query);
        $check_first_order = $orders_check['total'];
      } else {
        $check_first_order = tep_count_customer_orders();
      }
      // PWA guest checkout support END

      if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM) && ($check_first_order == 0)) {
        echo referral_input();
      }
    }
  }

} // end class
