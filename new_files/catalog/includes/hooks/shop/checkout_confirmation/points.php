<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/shop/checkout_confirmation/

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

class hook_shop_checkout_confirmation_points {
  
  function __construct() {
    require_once(DIR_FS_CATALOG . 'includes/functions/redemptions.php');
  }

  function listen_CheckoutConfirmPoints() {
    global $language, $session, $customer_id, $order, $payment, $$payment, $messageStack, $customer_shopping_points_spending, $customer_referral;
        
    require('includes/languages/' . $language . '/hooks/shop/checkout_confirmation/points.php');

    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True')) {
      if (isset($_POST['customer_shopping_points_spending']) && is_numeric($_POST['customer_shopping_points_spending']) && ($_POST['customer_shopping_points_spending'] > 0)) {
        $customer_shopping_points_spending = false;
        // This if sentence should include check for amount of points on account compared to the transferred point from checkout_payment.php
        // Possible Hack Fix included
        if (tep_calc_shopping_pvalue($_POST['customer_shopping_points_spending']) < $order->info['total'] && !is_object($$payment) || (tep_get_shopping_points($customer_id) < $_POST['customer_shopping_points_spending'])) {
          $customer_shopping_points_spending = false;
          tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(POINTS_HOOKS_ERROR_POINTS_NOT), 'SSL'));
        } else {
          $customer_shopping_points_spending = $_POST['customer_shopping_points_spending'];
          if (!tep_session_is_registered('customer_shopping_points_spending')) tep_session_register('customer_shopping_points_spending');
        }
      }

      //To ensure only the first order of a new customer is entitled to grant point to his/her referrer. Otherwise, a hacker might hard-code the email address of  a referrer and cheat for point on every single order the new customer made.
      if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM) && (tep_count_customer_orders() == 0)) {
        if (isset($_POST['customer_referred']) && tep_not_null($_POST['customer_referred'])) {
          $customer_referral = false;
          $check_mail = trim($_POST['customer_referred']);
          if (tep_validate_email($check_mail) == false) {
            tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(POINTS_HOOK_ERROR_NOT_VALID), 'SSL'));
          } else {
            $valid_referral_query = tep_db_query("select customers_id from customers where customers_email_address = '" . $check_mail . "' limit 1");
            $valid_referral = tep_db_fetch_array($valid_referral_query);
            if (!tep_db_num_rows($valid_referral_query)) {
              tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(POINTS_HOOK_ERROR_NOT_FOUND), 'SSL'));
            }
    
            if ($check_mail == $order->customer['email_address']) {
              tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(POINTS_HOOK_ERROR_SELF), 'SSL'));
            } else {
              $customer_referral = $valid_referral['customers_id'];
              if (!tep_session_is_registered('customer_referral')) tep_session_register('customer_referral');
            }
          }
        }
      }
    }

    if ((MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') && (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True')) {
      if (!tep_session_is_registered('customer_shopping_points_spending')) tep_session_register('customer_shopping_points_spending');
      if (isset($_POST['customer_shopping_points_spending']) && tep_not_null($_POST['customer_shopping_points_spending'])) {
        $customer_shopping_points_spending = tep_db_prepare_input($_POST['customer_shopping_points_spending']);
      }
      if (isset($_POST['customer_shopping_points_points']) && tep_not_null($_POST['customer_shopping_points_points']) && $payment == 'points') {
        $customer_shopping_points_spending = tep_db_prepare_input($_POST['customer_shopping_points_points']);
      }
    }
  }

} // end class
