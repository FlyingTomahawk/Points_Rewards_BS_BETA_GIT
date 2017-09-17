<?php
/*
  $Id: points_hooks.php
  $Loc: catalog/includes/languages/english/hooks/shop/points/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

// used in several places
define('POINTS_HOOK_INFORMATION_MY_POINTS_HELP', 'Point Program FAQ');

// used in create account
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_WELCOME_POINTS', '<li><strong>Reward Point Program</strong> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');

// used in create account success
define('POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your account <u>%s</u> with a total of %s Shopping Points, worth %s .');
define('POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_LINK', 'Please refer to the <u>%s</u> as conditions may apply.');

// used in checkout_payment
define('TABLE_HEADING_REDEEM_SYSTEM', 'Shopping Points Redemptions ');
define('TABLE_HEADING_REFERRAL', 'Referral System');
define('TEXT_REDEEM_SYSTEM_START', 'You have a credit balance of %s would you like to use it to pay for this order?<br />The estimated total of your purchase is: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Tick the checkbox to use Maximum Points allowed for this order. (%s points %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('TEXT_REDEEM_SYSTEM_PAYING',  'Please select points payment to pay your entire order with your points. (%s points %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">Total Purchase is greater than the maximum points allowed, you will also need to choose a payment method</span>');
define('TEXT_REFERRAL_REFERRED', 'If you were referred to us by one of our customers please enter their email address here. ');

// used in checkout_confirmation.php
  define('POINTS_HOOKS_ERROR_POINTS_NOT', 'Points value are not enough to cover the cost of your purchase. Please select another payment method');
  define('POINTS_HOOK_ERROR_NOT_VALID', 'The referral email does not appear to be valid - please make any necessary corrections.');
  define('POINTS_HOOK_ERROR_NOT_FOUND', 'The referral email address you entered was not found.');
  define('POINTS_HOOK_ERROR_SELF', 'Sorry you can not refer yourself.');
