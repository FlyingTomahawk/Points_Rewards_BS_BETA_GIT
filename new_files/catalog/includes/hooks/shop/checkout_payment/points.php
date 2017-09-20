<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/shop/checkout_payment/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

class hook_shop_checkout_payment_points {
  
  function __construct() {
    require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php');
  }
  
  function listen_CheckoutPaymentPoints() {
    global $cart, $language;
        
    require('includes/languages/' . $language . '/hooks/shop/checkout_payment/points.php');

    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True')) {
      $cart_show_total= $cart->show_total();
      echo points_selection($cart_show_total);
      if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM) && (tep_count_customer_orders() == 0)) {
        echo referral_input();
      }
    }
  }

} // end class