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

// Initialisation of some required parameters for the FAQ answers
 if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
   $answer_expire = 'Reward answer will expire ' . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES . ' months from the date issuance.';
 } else {
   $answer_expire = 'Reward answer do not expire and can be accumulated until you decide to use them.';
 }

if (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE > 1) {
  $point_or_answer = 'answer';
} else {
  $point_or_answer = 'point';
}

// Definition if the navigation bar and page title
define('NAVBAR_TITLE', 'Reward Point Program FAQ');
define('HEADING_TITLE', 'Reward Point Program FAQ');

// Definitions of the FAQ questions
define('POINTS_FAQ_1', '1. What is the Reward Point Program?');
define('POINTS_FAQ_2', '2. How does the Program work?');
define('POINTS_FAQ_3', '3. Points and Values');
define('POINTS_FAQ_4', '4. Redeeming Shopping Points');
define('POINTS_FAQ_5', '5. Minimum Points Required');
define('POINTS_FAQ_6', '6. Minimum Purchase Amount Required');
define('POINTS_FAQ_7', '7. Maximum Points Redemptions allowed per order');
define('POINTS_FAQ_8', '8. Will I earn points for shipping fees?');
define('POINTS_FAQ_9', '9. Will I earn points for tax fees?');
define('POINTS_FAQ_10', '10. Will I earn points for discounted products?');
define('POINTS_FAQ_11', '11. Will I earn points when purchases paid with points?');
define('POINTS_FAQ_12', '12. Earning Referral Points');
define('POINTS_FAQ_13', '13. Earning Points While writing a Products Review');
define('POINTS_FAQ_14', '14. Products Restrictions');
define('POINTS_FAQ_15', '15. Products on sale Restrictions');
define('POINTS_FAQ_16', '16. Conditions of Use');
define('POINTS_FAQ_17', '17. When Problems Occur');

// Definition of the answer for each of the questions:

// FAQ1
define('TEXT_FAQ_1', 'To thank you all for your support and to offer future incentives to you we wanted to give something back, this is why we have launched this great Reward Point Program.
                      <br><br>Our Reward Point Program is as simple as it sounds.  While shopping at ' . STORE_NAME . ' you will earn Shopping Points for the money you spend.
                      <br>Once earned, you\'ll be able to use those points to pay for future purchases at  ' . STORE_NAME);

// FAQ2
define('TEXT_FAQ_2', 'When an order is placed, the total amount<small><font color="FF6633">*</font></small> of the order will be used to calculate the amount of points earned.
                      These points are added to your Shopping Points account as pending points.
                      <br>All pending points are listed in your <a href="' . tep_href_link('my_points.php') . '"> <u>Shopping Points account </u></a> and will stay there until approved/confirmed by ' . STORE_NAME . '.
                      <br><br>Once any pending points have been approved, they will be released and your account will be credited with the value of those points.  Ready for you to spend on whatever you want.
                      <br>You must login to your account in order to view the status of your points.
                      <br><br>During the checkout procces you\'ll be able to pay for your order with your points balance.
                      <p align="right"<small><font color="FF6633">*</font> in most cases shipping fees and taxes excluded. See refered FAQ for more details.</small></p>');

// FAQ3
define('TEXT_FAQ_3', 'Currently, for every %s spent at ' . STORE_NAME . ' you\'ll earn %s Point(s).
                      <br>For example:<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Product Cost:</b>&nbsp; %s<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Value of Points Earned:</b>&nbsp; %s<br><br>
                      Please note, we reserve the right to make changes to the above rate at any time without prior notice.  The rate shown here will always be current.');

// FAQ4
define('TEXT_FAQ_4', 'If you have a balance in your Shopping Points Account, you can use those points to pay for purchases made at ' . STORE_NAME . '.
                      <br>During the checkout proccess, on the same page that you select a payment method, there will be a box to enter the amount of points you wish to redeem.  Enter the amount of points you would like to spend or tick the box to use all available points.
                      Please note that if you have enough points to pay your entire purchase with points, you will need to choose the payment method \ "Points \".
                      <br>Continue the checkout procedure and at the confirmation page you\'ll notice that the value of the points redeemed will have been credited towards your order.  Once you confirm your order, your Shopping Points account will be updated and the points used deducted from your balance.
                      <br>Note that any purchase made by redeeming points will only be rewarded with additional points for the amount spent other then points.');


// FAQ5 - conditionnal depending on the point limit value set in admin
define('TEXT_FAQ_5_A', 'Currently, a minimum balance of <b>%s</b> points <b>(%s)' . '</b> is required before you can redeem them.
	                      <br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_5_B', 'Currently, no minimum balance is required to redeem your points.  Please note, you\'ll still have to select another payment method if there isn\'t enough in your Shopping Points account to cover the cost of your purchase.<br>
	                      <br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ6 - conditionnal depending on the point min amount value set in admin
define('TEXT_FAQ_6_A', 'Currently, a minimum of <b>%s</b> in total (per purchase) is required before any Points Redemptions can take place.
	                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_6_B', 'Currently, no Minimum Purchase Amount required to redeem your points.
	                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ7
define('TEXT_FAQ_7', 'A maximum of <b>%s</b> points <b>(%s)' . '</b> is allowed to redeem per order.
                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ8 - conditionnal depending on the use point for shipping value set in admin
define('TEXT_FAQ_8_A', 'No. When calculating the amount of points earned, the shipping fees are excluded.');
define('TEXT_FAQ_8_B', 'Yes. When calculating the amount of points earned, the shipping fees are included.
	                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ9 - conditionnal depending on the value set in admin for ginving point for tax value
define('TEXT_FAQ_9_A', 'No. When calculating the amount of points earned, the taxes are excluded.
	                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_9_B', 'Yes. When calculating the amount of points earned, the taxes are included.
	                      <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ10 - conditionnal depending on value set in admin for giving point on specials
define('TEXT_FAQ_10_A', 'No. When calculating the amount of points earned, all items which have been discounted are excluded.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_10_B', 'Yes. When calculating the amount of points earned, all items which have been discounted are included.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ11
define('TEXT_FAQ_11_A', 'No. When calculating the amount of points earned. Any purchase made by redeeming points are excluded.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_11_B', 'Yes. Please note, any purchase made by redeeming points will only be rewarded with additional points for the amount spent other then points.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ12
define('TEXT_FAQ_12_A', '<em>"Word-of-mouth" advertising is the most powerful form of advertising there is.</em>
	                       <br>Referral Points is based on the idea that we should both benefit from your referrals.
	                       <br>When referred friend place an order, during the checkout procces on the same page that you select a payment method there will be a box to enter a Referral code .
	                       Your Referral code is your registered email address with us.
	                       <br>When we receive your referred friends completed and approved order, we will reward your Points account with <b>' .  MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM . '</b> points .
	                       <br>The more first time orders we receive from your referrals, the more reward points you will receive.');

define('TEXT_FAQ_12_B', 'Currently this feature is disabled.');

// FAQ13
define('TEXT_FAQ_13_A', '<em>"Writing Review is ego boost knowing others read your opinions, and maybe even take your advice."</em>
                         <br>Sharing Your Product Reviews will assist us to continually improve our offers and service to you as well as helps others to choose the right products.
                         <br>We would like to thank you for helpful review that you gave us, therefore for every quality review, we will reward your Points account with <b>%s</b> worth of points .
                         <br>Your Review must meet all of the following conditions:
                         <ul>
                           <li>Your Reviews must be original.</li>
                           <li>Reviews must be focused and concise on the product under review.</li>
                           <li>Reviews should not duplicate content already published.</li>
                           <li>Be truthful and objective.</li>
                           <li>Reviews should not include posts that have spam, commercial or advertising content or links.</li>
                           <li>Reviews should not abuse, harass, or threaten another\'s personal safety .</li>
                         </ul>
                         ' . STORE_NAME .' reserves the right to refuse or remove any review that does not comply with above conditions.
                         <br>' . STORE_NAME .' staff reserves the right to correct misspelled words, grammatical errors.
                         <br>' . STORE_NAME .' is not responsible or liable in any way for ratings and reviews posted by its customers.');

define('TEXT_FAQ_13_B', 'Currently this feature is disabled.');

// FAQ14
define('TEXT_FAQ_14_A', 'Currently, only  the following items can be purchased using your points balance.<ul>%s</ul>');

define('TEXT_FAQ_14_B', 'Currently, only items in the following categories and their corresponding sub-categories can be purchased using your points balance.<ul>%s</ul>');

define('TEXT_FAQ_14_C', 'Currently, no restrictions apply to what items may be purchased using your points balance.');

define('TEXT_FAQ_14_D', '<br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ15
define('TEXT_FAQ_15_A', 'Currently, no items which have been discounted can be purchased using your points balance.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

define('TEXT_FAQ_15_B', 'Currently, no restrictions apply to the kind of items which may be purchased using your points balance.
	                       <br><br>We strongly advise you to check this page often as we may make changes to this policy.');

// FAQ16
define('TEXT_FAQ_16', '
<ul>
  <li>Shopping Points are only available to registered ' . STORE_NAME . ' member\'s.</li>
  <li>Shopping Points Reward can only be collected and used with online purchases. and are only validated at ' . STORE_NAME . '.</li>
  <li>Points are non-refundable and can\'t be transferred between member\'s.</li>
  <li>Shopping Points are non-transferable or exchangeable for cash under any circumstances.</li>
  <li>Shopping Points will not be refunded for any cancelled order.</li>
  <li>When buying with Points,you will still have to select another payment method if there is not enough in your Shopping Points Account to cover the cost of your purchase.</li>
  <li>When calculating the amount of points earned. shipping fees and taxes are excluded(unless other.see refered FAQ for more details).</li>
</ul>
Please note, we reserve the right to make changes to this policy at any time without prior notice or liability.');

// FAQ17
define('TEXT_FAQ_17', 'For any queries regarding our Reward Point Program, please <a href="' . tep_href_link('contact_us.php') . '"> <u>contact us </u></a>.  Make sure you provide as much information as possible in the e-mail.');

// Below is the section that will actually displax on the FAQ page
define('TEXT_INFORMATION', '<a name="Top"></a><span class="pointWarning"><b>Please choose from one of the topics below:</b></span>');
?>