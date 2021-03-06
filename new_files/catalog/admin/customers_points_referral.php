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

  require('includes/application_top.php');

  require('includes/classes/currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $comment_cancel = null;
  $uID = null;
  $potype = null;
  $viewedSort = null;
  $sort = null;
  
  if (tep_not_null($action)) {
    switch ($action) {
      case 'confirm_points':
        $uID = tep_db_prepare_input($_GET['uID']);
        $customer_id = $_POST['customer_id'];
        $points_pending = tep_db_prepare_input($_POST['points_pending']);

        if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
          $expire  = date('Y-m-d', strtotime('+ '. MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES .' month'));
          $expire_date = "\n" . sprintf(EMAIL_TEXT_EXPIRE, tep_date_short($expire));
	      tep_db_query("update customers set customers_shopping_points = customers_shopping_points + '". $points_pending ."', customers_points_expires = '". $expire ."' where customers_id = '". (int)$customer_id ."'");
        } else {
	      tep_db_query("update customers set customers_shopping_points = customers_shopping_points + '". $points_pending ."' where customers_id = '". (int)$customer_id ."'");          
          $expire_date = "\n" . sprintf(EMAIL_TEXT_EXPIRE, tep_date_short($_POST['customers_points_expires']));
        }

        $customer_notified = '0';
        if (isset($_POST['notify_confirm']) && ($_POST['notify_confirm'] == 'on')) {
          $date_added = $_POST['date_added'];
          $points_type = $_POST['points_type'];
          $points_disc = (($_POST['points_type'] == 'RF') ? TEXT_TYPE_REFERRAL : TEXT_DEFAULT_REVIEWS);
          $products_name = $_POST['products_name'];
          $balance = ($_POST['customers_shopping_points'] + $points_pending);
          $customer_balance = sprintf(EMAIL_TEXT_BALANCE, number_format($balance,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format($balance * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE));
          $customers_email_address = $_POST['customers_email_address'];
          $customer_name = $_POST['customer_name'];
          $gender = $_POST['customers_gender'];
          $first_name = $_POST['customers_firstname'];
          $last_name = $_POST['customers_lastname'];
          $name = $first_name . ' ' . $last_name;

          if (ACCOUNT_GENDER == 'true') {
            if ($gender == 'm') {
                $greet = sprintf(EMAIL_GREET_MR, $last_name);
            } else {
                $greet = sprintf(EMAIL_GREET_MS, $last_name);
            }
          } else {

          $greet = sprintf(EMAIL_GREET_NONE, $first_name);
          }
          if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
            $points_expire_date = $expire_date;
          }
          if ($points_type == 'RF') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_REFERRED . ' ' . $customer_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }
          if ($points_type == 'RV') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_PRODUCT_NAME . ' ' . $products_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }
          $can_use = "\n\n" . EMAIL_TEXT_SUCCESS_POINTS;

          $email_text = $greet  . "\n" . EMAIL_TEXT_INTRO . "\n" . EMAIL_TEXT_BALANCE_CONFIRMED . "\n" . $details . "\n" . $customer_balance  . $points_expire_date . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL, tep_catalog_href_link('my_points.php', '', 'SSL')) . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL_HELP, tep_catalog_href_link('my_points_help.php', '', 'NONSSL')) . $can_use . "\n" . EMAIL_CONTACT . "\n" . EMAIL_SEPARATOR . "\n" . '<b>' . STORE_NAME . '</b>.' . "\n";

          tep_mail($name, $customers_email_address, EMAIL_TEXT_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

          $customer_notified = '1';
          $messageStack->add_session(sprintf(NOTICE_EMAIL_SENT_TO, $name . '(' . $customers_email_address . ').'), 'success');
        }

        if (isset($_POST['queue_confirm'])) {
	      tep_db_query("update customers_points_pending set points_status = 2 where unique_id = '". (int)$uID ."' limit 1");
	      $sql = "optimize table customers_points_pending";
        } else {
          $messageStack->add_session(sprintf(NOTICE_RECORED_REMOVED, $uID), 'warning');
          tep_db_query("delete from customers_points_pending where unique_id = '". (int)$uID ."' limit 1");
          $sql = "optimize table customers_points_pending";
        }
        $messageStack->add_session(SUCCESS_POINTS_UPDATED, 'success');
        tep_redirect(tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action'))));
        break;
      case 'cancel_points':
        $uID = tep_db_prepare_input($_GET['uID']);
        $comment = tep_db_prepare_input($_POST['comment_cancel']);
        $customer_id = $_POST['customers_id'];
        $points_pending = tep_db_prepare_input($_POST['points_pending']);

        $customer_notified = '0';
        if (isset($_POST['notify_cancel']) && ($_POST['notify_cancel'] == 'on')) {
          $date_added = $_POST['date_added'];
          $points_type = $_POST['points_type'];
          $points_disc = (($_POST['points_type'] == 'RF') ? TEXT_TYPE_REFERRAL : TEXT_DEFAULT_REVIEWS);
          $products_name = $_POST['products_name'];
          $balance = $_POST['customers_shopping_points'];
          $customers_email_address = $_POST['customers_email_address'];
          $customer_name = $_POST['customer_name'];
          $gender = $_POST['customers_gender'];
          $first_name = $_POST['customers_firstname'];
          $last_name = $_POST['customers_lastname'];
          $name = $first_name . ' ' . $last_name;
          
          $notify_comment = '';
          if (isset($_POST['comment_cancel']) && tep_not_null($comment_cancel)) {
            $notify_comment = sprintf(EMAIL_TEXT_COMMENT . ' ' . $comment_cancel) . "\n";
          }

          if (ACCOUNT_GENDER == 'true') {
            if ($gender == 'm') {
              $greet = sprintf(EMAIL_GREET_MR, $last_name);
            } else {
              $greet = sprintf(EMAIL_GREET_MS, $last_name);
            }
          } else {
              $greet = sprintf(EMAIL_GREET_NONE, $first_name);
          }
          if ($balance > 0) {
            $customer_balance = sprintf(EMAIL_TEXT_BALANCE, number_format($balance,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format($balance * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE));
            $can_use = "\n\n" . EMAIL_TEXT_SUCCESS_POINTS;
            if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
              $points_expire_date = "\n" . sprintf(EMAIL_TEXT_EXPIRE, tep_date_short($customer['customers_points_expires']));
            }
          }
          if ($points_type == 'RF') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_REFERRED . ' ' . $customer_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }
          if ($points_type == 'RV') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_PRODUCT_NAME . ' ' . $products_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }

          $email_text = $greet  . "\n" . EMAIL_TEXT_INTRO . "\n" . EMAIL_TEXT_BALANCE_CANCELLED . "\n" . $details . "\n" . $notify_comment . $customer_balance . $points_expire_date . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL, tep_catalog_href_link('my_points.php', '', 'SSL')) . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL_HELP, tep_catalog_href_link('my_points_help.php', '', 'NONSSL')) . $can_use . "\n" . EMAIL_CONTACT . "\n" . EMAIL_SEPARATOR . "\n" . '<b>' . STORE_NAME . '</b>.' . "\n";

        tep_mail($name, $customers_email_address, EMAIL_TEXT_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

        $customer_notified = '1';
        $messageStack->add_session(sprintf(NOTICE_EMAIL_SENT_TO, $name . '(' . $customers_email_address . ').'), 'success');
        }
        $database_queue = '0';
        if (isset($_POST['queue_cancel'])) {
          if (isset($_POST['comment_cancel']) && tep_not_null($comment_cancel)) {
            $set_comment = ", points_comment = '" . $comment_cancel . "'";
          }
 	      tep_db_query("update customers_points_pending set points_status = 3 " . $set_comment . " where unique_id = '". (int)$uID ."' limit 1");
 	      $sql = "optimize table customers_points_pending";          
        $database_queue = '1';
        $messageStack->add_session(sprintf(SUCCESS_DATABASE_UPDATED, $comment_cancel), 'success');
        } else {
           tep_db_query("delete from customers_points_pending where unique_id = '". (int)$uID ."' limit 1");
           $sql = "optimize table customers_points_pending";
        }

        tep_redirect(tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action'))));
        break;
     case 'adjustpoints':
        $uID = tep_db_prepare_input($_GET['uID']);
        $adjust = tep_db_prepare_input($_POST['points_to_aj']);

        $points_adjusted = false;
        if (tep_not_null($adjust)) {
  	      tep_db_query("update customers_points_pending set points_pending = '" . $adjust . "' where unique_id = '". (int)$uID ."' limit 1");
  	      $sql = "optimize table customers_points_pending";
        } else {
          $messageStack->add_session(WARNING_DATABASE_NOT_UPDATED, 'warning');
        }
        tep_redirect(tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action'))));
        break;
      case 'pe_rollback':
        $uID = tep_db_prepare_input($_GET['uID']);
        $customer_id = tep_db_prepare_input($_POST['customer_id']);
        $comment_roll = tep_db_prepare_input($_POST['comment_roll']);
        $points_pending = tep_db_prepare_input($_POST['points_pending']);

		tep_db_query("update customers set customers_shopping_points = customers_shopping_points - '". $points_pending ."' where customers_id = '". (int)$customer_id ."'");
 
        if (isset($_POST['comment_roll']) && tep_not_null($comment_roll)) {
          $set_comment = ", points_comment = '" . $comment_roll . "'";
        }

	    tep_db_query("update customers_points_pending set points_status = 1 " . $set_comment . " where unique_id = '". (int)$uID ."' limit 1");
	    $sql = "optimize table customers_points_pending";

        $customer_notified = '0';
        if (isset($_POST['notify_roll']) && ($_POST['notify_roll'] == 'on')) {
          $date_added = $_POST['date_added'];
          $points_type = $_POST['points_type'];
          $points_disc = (($_POST['points_type'] == 'RF') ? TEXT_TYPE_REFERRAL : TEXT_DEFAULT_REVIEWS);
          $products_name = $_POST['products_name'];
          $balance = ($_POST['customers_shopping_points'] - $points_pending);
          $customers_email_address = $_POST['customers_email_address'];
          $customer_name = $_POST['customer_name'];
          $gender = $_POST['customers_gender'];
          $first_name = $_POST['customers_firstname'];
          $last_name = $_POST['customers_lastname'];
          $name = $first_name . ' ' . $last_name;

          $notify_comment = '';
          if (isset($_POST['comment_roll']) && tep_not_null($comment_roll)) {
            $notify_comment = sprintf(EMAIL_TEXT_ROLL_COMMENT . ' ' . $comment_roll) . "\n";
          }

          if (ACCOUNT_GENDER == 'true') {
            if ($gender == 'm') {
              $greet = sprintf(EMAIL_GREET_MR, $last_name);
            } else {
              $greet = sprintf(EMAIL_GREET_MS, $last_name);
            }
          } else {
              $greet = sprintf(EMAIL_GREET_NONE, $first_name);
          }
          if ($balance > 0) {
            $customer_balance = sprintf(EMAIL_TEXT_BALANCE, number_format($balance,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format($balance * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE));
            $can_use = "\n\n" . EMAIL_TEXT_SUCCESS_POINTS;
            if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
              $points_expire_date = "\n" . sprintf(EMAIL_TEXT_EXPIRE, tep_date_short($customer['customers_points_expires']));
            }
          }
          if ($points_type == 'RF') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_REFERRED . ' ' . $customer_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }
          if ($points_type == 'RV') {
            $details = EMAIL_SEPARATOR . "\n" . TABLE_HEADING_POINTS_TYPE . ': ' . $points_disc . "\n" . TABLE_HEADING_DATE_ADDED . ': ' . tep_date_short($date_added) . "\n" . TEXT_INFO_PRODUCT_NAME . ' ' . $products_name . "\n" . TABLE_HEADING_POINTS . ': ' . number_format($points_pending,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . "\n" . TABLE_HEADING_POINTS_VALUE . ': ' . $currencies->format($points_pending * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE) . "\n" . EMAIL_SEPARATOR;
          }

          $email_text = $greet  . "\n" . EMAIL_TEXT_INTRO . "\n" . EMAIL_TEXT_BALANCE_ROLL_BACK . "\n" . $details . "\n" . $notify_comment . $customer_balance . $points_expire_date . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL, tep_catalog_href_link('my_points.php', '', 'SSL')) . "\n\n" . sprintf(EMAIL_TEXT_POINTS_URL_HELP, tep_catalog_href_link('my_points_help.php', '', 'NONSSL')) . $can_use . "\n" . EMAIL_CONTACT . "\n" . EMAIL_SEPARATOR . "\n" . '<b>' . STORE_NAME . '</b>.' . "\n";

        tep_mail($name, $customers_email_address, EMAIL_TEXT_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

        $customer_notified = '1';
        $messageStack->add_session(sprintf(NOTICE_EMAIL_SENT_TO, $name . '(' . $customers_email_address . ').'), 'success');
        }

        $messageStack->add_session(SUCCESS_POINTS_UPDATED, 'success');
        tep_redirect(tep_href_link('customers_points_referral.php'));
        break;
     case 'delete_points':
        $uID = tep_db_prepare_input($_GET['uID']);

        tep_db_query("delete from customers_points_pending where unique_id = '". (int)$uID ."' limit 1");
        $sql = "optimize table customers_points_pending";
        $messageStack->add_session(sprintf(NOTICE_RECORED_REMOVED, $uID), 'warning');

        tep_redirect(tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action'))));
        break;
    }
  }

  include('includes/classes/order.php');
  require('includes/template_top.php');
  
  $install_error = false;
  if (!defined('MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM') || MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM != 'True') {
    echo  '<div class="secWarning">' . INSTALL_CHECK_HT_WARNING . '<br>
           <a href="modules.php?set=header_tags&module=ht_points_rewards&action=install">' . INSTALL_CHECK_HT_INSTALL_NOW . '</a></div>';
    $install_error = true;
  }
  if (!defined('MODULE_ORDER_TOTAL_REDEMPTIONS_SORT_ORDER')) {
    echo '<div class="secWarning">' . INSTALL_CHECK_OT_WARNING . '<br>
           <a href="modules.php?set=order_total&module=ot_redemptions&action=install">' . INSTALL_CHECK_OT_INSTALL_NOW . '</a></div>';
    $install_error = true;
  }
  if (!defined('MODULE_PAYMENT_POINTS_STATUS') || MODULE_PAYMENT_POINTS_STATUS != 'True') {
    echo '<div class="secWarning">' . INSTALL_CHECK_PM_WARNING . '<br>
          <a href="modules.php?set=payment&module=points&action=install">' . INSTALL_CHECK_PM_INSTALL_NOW . '</a></div>';
    $install_error = true;
  }

  if ( $install_error === false ) {

  ?>
  <script language="javascript"><!--
  function validate(field) {
    var valid = "0123456789."
    var ok = "yes";
    var temp;
   for (var i=0; i<field.value.length; i++) {
    temp = "" + field.value.substring(i, i+1);
    if (valid.indexOf(temp) == "-1") ok = "no";
    }
    if (ok == "no") {
      alert("<?php echo POINTS_ENTER_JS_ERROR; ?>");
      field.focus();
      field.value = "";
    }
  }
  //--></script>
  <table border="0" width="100%" cellspacing="0" cellpadding="2">
  <?php
    $orders_statuses = array();
    $orders_status_array = array();
    $orders_status_query = tep_db_query("SELECT orders_status_id, orders_status_name FROM orders_status WHERE language_id = '" . (int)$languages_id . "'");
    while ($orders_status = tep_db_fetch_array($orders_status_query)) {
      $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                                 'text' => $orders_status['orders_status_name']);
      $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
    }
  
  // drop-down filter array
    $filter_array = array( array('id' => '1', 'text' => TEXT_POINTS_PENDING), 
                                     array('id' => '2', 'text' => TEXT_POINTS_CONFIRMED),
                                     array('id' => '3', 'text' => TEXT_POINTS_CANCELLED),
                                     array('id' => '4', 'text' => TEXT_SHOW_ALL));
                                     
    $potype_array = array( array('id' => '1', 'text' => TEXT_SHOW_ALL), 
                                     array('id' => '2', 'text' => TEXT_TYPE_REFERRAL),
                                     array('id' => '3', 'text' => TEXT_TYPE_REVIEW));
                                     
       $point_or_points = ((MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE > 1) ? HEADING_POINTS : HEADING_POINT);
  ?>
        <tr>
          <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE . '<br /><span class="smallText">' . HEADING_RATE . '&nbsp;&nbsp;&nbsp;' .  HEADING_AWARDS . $currencies->format(1) . ' = ' . number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) .'&nbsp;' . $point_or_points . '&nbsp;&nbsp;&nbsp;' . HEADING_REDEEM  .  number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . '&nbsp;' . $point_or_points . ' = ' . $currencies->format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE); ?></td>
              <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr><?php echo tep_draw_form('filterthis', 'customers_points_referral.php', '', 'get'); ?>
                  <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search', '', 'size="12"'); ?></td>
                </tr>
                <tr>
                  <td class="smallText" align="right"><?php echo TABLE_HEADING_POINTS_TYPE . ': ' .tep_draw_pull_down_menu('potype', $potype_array) . '&nbsp;'. TABLE_HEADING_POINTS_STATUS . ':'. tep_draw_pull_down_menu('filter', $filter_array, '', 'onChange="this.form.submit();"'); ?></td>
                </form></tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="dataTableHeadingRow">
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=c_name-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_CUSTOMERS . TABLE_HEADING_SORT_UA . '">+</a>&nbsp;' . TABLE_HEADING_CUSTOMERS . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=c_name-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_CUSTOMERS . TABLE_HEADING_SORT_DA; ?>">-</a></td>
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=p_type-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_TYPE . TABLE_HEADING_SORT_U1 . '">+</a>&nbsp;' . TABLE_HEADING_POINTS_TYPE . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=p_type-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_TYPE . TABLE_HEADING_SORT_D1; ?>">-</a></td>
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=points-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS . TABLE_HEADING_SORT_U1 . '">+</a>&nbsp;' . TABLE_HEADING_POINTS . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=poinst-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS . TABLE_HEADING_SORT_D1; ?>">-</a></td>
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=points-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_VALUE . TABLE_HEADING_SORT_U1 . '">+</a>&nbsp;' . TABLE_HEADING_POINTS_VALUE . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=points-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_VALUE . TABLE_HEADING_SORT_D1; ?>">-</a></td>
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=date-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_DATE_ADDED . TABLE_HEADING_SORT_UA . '">+</a>&nbsp;' . TABLE_HEADING_DATE_ADDED . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=date-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_DATE_ADDED . TABLE_HEADING_SORT_DA; ?>">-</a></td>
                  <td class="dataTableHeadingContent"><?php echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=p_status-asc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_STATUS . TABLE_HEADING_SORT_UA . '">+</a>&nbsp;' . TABLE_HEADING_POINTS_STATUS . '&nbsp;<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params() . 'viewedSort=p_status-desc') . '" title="' . TABLE_HEADING_SORT . TABLE_HEADING_POINTS_STATUS . TABLE_HEADING_SORT_DA; ?>">-</a></td>
                  <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                </tr>
  <?php
  //$potype ='';
   switch ($potype) {
    case '1':
      $potype = "where p.points_type != 'SP'";
        break;
    case '2':
        $potype = "where p.points_type = 'RF'";
        break;
    case '3':
        $potype = "where p.points_type = 'RV'";
        break;
    default:
        $potype = "where p.points_type != 'SP'";
    }
    
  //sort view
     if (isset($_GET['viewedSort'])){
       $viewedSort = $_GET['viewedSort'];
       tep_session_register('viewedSort');
     }
     if (isset($_GET['page']))
     {
       $page = $_GET['page'];
       tep_session_register('page');
     }
     if(!isset($page)) $page = 1;
   
     switch ($viewedSort) {
         case "c_name-asc":
           $sort .= "c.customers_lastname";
         break;
         case "c_name-desc":
           $sort .= "c.customers_lastname desc";
         break;
         case "p_type-asc":
           $sort .= "p.points_type";
         break;
         case "p_type-desc":
           $sort .= "p.points_type desc";
         break;
         case "points-asc":
           $sort .= "p.points_pending";
         break;
         case "points-desc":
           $sort .= "p.points_pending desc";
         break;
         case "date-asc":
           $sort .= "p.date_added";
         break;
         case "date-desc":
           $sort .= "p.date_added desc";
         break;
         case "p_status-asc":
           $sort .= "p.points_status";
         break;
         case "p_status-desc":
           $sort .= "p.points_status desc";
         break;
          default:
          $sort .= "p.unique_id desc";
     }
  
    $search = '';
      if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
        $search = tep_db_input(tep_db_prepare_input($_GET['search']));
        $search = "and p.customer_id ='" . (int)$search . "'";
      }
      
      $filter = (!isset($_GET['filter'])) ? 1 : $_GET['filter'];
      $filter = 'and p.points_status = ' . (int)tep_db_prepare_input((int)$filter);
  //    if (!isset($_GET['potype'])) $potype = "where p.points_type != 'SP'";
      if (isset($_GET['filter']) && $_GET['filter'] == '4') $filter = 'and p.points_status != 0';
      $pending_points_query_raw = "select p.*, c.customers_gender, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_shopping_points, c.customers_points_expires from customers_points_pending p left join customers c on c.customers_id = p.customer_id $potype $filter $search order by $sort";
      $pending_points_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $pending_points_query_raw, $pending_points_query_numrows);
      $pending_points_query = tep_db_query($pending_points_query_raw);
      
      while ($pending_points = tep_db_fetch_array($pending_points_query)) {
  
        if ($pending_points['points_type'] == 'RF') {
          $order_query = tep_db_query("select o.customers_name, o.payment_method, s.orders_status_name, ot.text as order_total from orders o, orders_total ot, orders_status s where o.orders_id=ot.orders_id and o.orders_id = '" . (int)$pending_points['orders_id'] . "' and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' limit 1");
          $order = tep_db_fetch_array($order_query);
          if (sizeof($order) > 0) $uInfo_array = array_merge($pending_points, $order); 
          $link = '<a href="' . tep_href_link('orders.php' . '?oID=' . $pending_points['orders_id'] . '&action=edit') . '">' . tep_image('images/icons/preview.gif', ICON_PREVIEW_EDIT) . '</a>&nbsp;';
        }
  
        if ($pending_points['points_type'] == 'RV') {
          $reviews_query = tep_db_query("select r.reviews_id, p.products_name from reviews r left join products_description p on p.products_id = r.products_id and p.language_id = '" . (int)$languages_id . "' where r.products_id = '" . $pending_points['orders_id'] . "' and r.customers_id = '" . (int)$pending_points['customer_id'] . "' limit 1");
          $reviews = tep_db_fetch_array($reviews_query);        
          if (sizeof($reviews) > 0) $uInfo_array = array_merge($pending_points, $reviews); 
          $link = '<a href="' . tep_href_link('reviews.php', 'page=' . $_GET['page'] . '&rID=' . $reviews['reviews_id'] . '&action=edit') . '">' . tep_image('images/icons/preview.gif', ICON_REVIEWS_EDIT) . '</a>&nbsp;';
        }
  
        if ((!isset($_GET['uID']) || (isset($_GET['uID']) && ($_GET['uID'] == $pending_points['unique_id']))) && !isset($uInfo)) {
          $uInfo = new objectInfo($uInfo_array);
        }
  
        if (isset($uInfo) && is_object($uInfo) && (defined($pending_points['unique_id']) && $pending_points['unique_id'] == $uInfo->unique_id)) {
          echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=edit') . '\'">' . "\n";
        } else {
          echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID')) . 'uID=' . $pending_points['unique_id']) . '\'">' . "\n";
        }
  
        if ($pending_points['points_status'] == 1) $points_status_name = TEXT_POINTS_PENDING;
        if ($pending_points['points_status'] == 2) $points_status_name = TEXT_POINTS_CONFIRMED;
        if ($pending_points['points_status'] == 3) $points_status_name = '<font color="FF0000">' . TEXT_POINTS_CANCELLED . '</font>';
  
        $type = ($pending_points['points_type'] == 'RF') ? TEXT_TYPE_REFERRAL : TEXT_TYPE_REVIEW;
  
  ?>
                  <td class="dataTableContent">&nbsp;<?php echo $link . $pending_points['customers_lastname'] . '&nbsp;' . $pending_points['customers_firstname']; ?></td>
                  <td class="dataTableContent">&nbsp;&nbsp;&nbsp;<?php echo $type; ?></td>
                  <td class="dataTableContent">&nbsp;&nbsp;&nbsp;<?php echo number_format($pending_points['points_pending'],MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES); ?></td>
                  <td class="dataTableContent">&nbsp;&nbsp;&nbsp;<?php echo $currencies->format($pending_points['points_pending'] * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEEM_POINT_VALUE); ?></td>
                  <td class="dataTableContent">&nbsp;&nbsp;&nbsp;<?php echo tep_date_short($pending_points['date_added']); ?></td>
                  <td class="dataTableContent">&nbsp;&nbsp;&nbsp;<?php echo $points_status_name; ?></td>
                  <td class="dataTableContent" align="right"><?php if (isset($uInfo) && is_object($uInfo) && ($pending_points['unique_id'] == $uInfo->unique_id)) { echo tep_image('images/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID')) . 'uID=' . $pending_points['unique_id']) . '">' . tep_image('images/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
                </tr>
  <?php
      }
  ?>
                <tr>
                  <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr>
                      <td class="smallText" valign="top"><?php echo $pending_points_split->display_count($pending_points_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                      <td class="smallText" align="right"><?php echo $pending_points_split->display_links($pending_points_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'uID', 'action'))); ?></td>
                    </tr>
  <?php
      if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
  ?>
                    <tr>
                      <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link('customers_points_referral.php') . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                    </tr>
  <?php
      }
  ?>
                  </table></td>
                </tr>
              </table></td>
  <?php
    $heading = array();
    $contents = array();
  
    switch ($action) {
      case 'confirm':
        $heading[] = array('text' => '<b>' . TEXT_CONFIRM_POINTS . '</b>');
  
        $contents = array('form' => tep_draw_form('points_confirm', 'customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=confirm_points'));      
        $value_field = TEXT_CONFIRM_POINTS_LONG. '<br>';
        $contents[] = array('text' => $value_field);
        $contents[] = array('text' => tep_draw_checkbox_field('notify_confirm', '', true) . ' ' . TEXT_NOTIFY_CUSTOMER);
        $contents[] = array('text' => tep_draw_checkbox_field('queue_confirm', '', true) . ' ' . TEXT_QUEUE_POINTS_TABLE);
        $contents[] = array('text' => tep_draw_hidden_field('customer_id', $uInfo->customer_id) . tep_draw_hidden_field('customers_firstname', $uInfo->customers_firstname) . tep_draw_hidden_field('customers_lastname', $uInfo->customers_lastname) . tep_draw_hidden_field('customers_gender', $uInfo->customers_gender) . tep_draw_hidden_field('customers_email_address', $uInfo->customers_email_address) . tep_draw_hidden_field('customers_shopping_points', $uInfo->customers_shopping_points) . tep_draw_hidden_field('customers_points_expires', $uInfo->customers_points_expires) . tep_draw_hidden_field('date_added', $uInfo->date_added) . tep_draw_hidden_field('points_pending', $uInfo->points_pending) . tep_draw_hidden_field('points_type', $uInfo->points_type));
      if ( $uInfo->points_type == 'RF') {
          $contents[] = array('text' => tep_draw_hidden_field('customer_name', $uInfo->customers_name));
      }
      if ( $uInfo->points_type == 'RV') {
          $contents[] = array('text' => tep_draw_hidden_field('products_name', $uInfo->products_name));
      }
  
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_draw_button(BUTTON_TEXT_CONFIRM_PENDING_POINTS, 'check') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id)));
      break;
      case 'cancel':
        $heading[] = array('text' => '<b>' . TEXT_CANCEL_POINTS . '</b>');
  
        $contents = array('form' => tep_draw_form('points_cancel', 'customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=cancel_points'));
        $contents[] = array('text' => TEXT_CANCEL_POINTS_LONG);
        $value_field = TEXT_CANCELLATION_REASON .'<br>'. tep_draw_input_field('comment_cancel', 0);
        $contents[] = array('text' => $value_field);
        $contents[] = array('text' => tep_draw_checkbox_field('notify_cancel', '', true) . ' ' . TEXT_NOTIFY_CUSTOMER);
        $contents[] = array('text' => tep_draw_checkbox_field('queue_cancel', '', true) . ' ' . TEXT_QUEUE_POINTS_TABLE);
        $contents[] = array('text' => tep_draw_hidden_field('customer_id', $uInfo->customer_id) . tep_draw_hidden_field('customers_firstname', $uInfo->customers_firstname) . tep_draw_hidden_field('customers_lastname', $uInfo->customers_lastname) . tep_draw_hidden_field('customers_gender', $uInfo->customers_gender) . tep_draw_hidden_field('customers_email_address', $uInfo->customers_email_address) . tep_draw_hidden_field('customers_shopping_points', $uInfo->customers_shopping_points) . tep_draw_hidden_field('customers_points_expires', $uInfo->customers_points_expires) . tep_draw_hidden_field('date_added', $uInfo->date_added) . tep_draw_hidden_field('points_pending', $uInfo->points_pending) . tep_draw_hidden_field('points_type', $uInfo->points_type));
      if ( $uInfo->points_type == 'RF') {
          $contents[] = array('text' => tep_draw_hidden_field('customer_name', $uInfo->customers_name));
      }
      if ( $uInfo->points_type == 'RV') {
          $contents[] = array('text' => tep_draw_hidden_field('products_name', $uInfo->products_name));
      }
        
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_draw_button(BUTTON_TEXT_CANCEL_PENDING_POINTS, 'cancel') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id)));
        break;
      case 'adjust':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_ADJUST_POINTS . '</b>');
  
        $contents = array('form' => tep_draw_form('points_adjust', 'customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=adjustpoints'));
        $contents[] = array('text' => '<b>'. TEXT_INFO_HEADING_ADJUST_POINTS . '</b><br>');
        $value_field = TEXT_ADJUST_INTRO . '<br><br>' . TEXT_POINTS_TO_ADJUST . '<br>'. tep_draw_input_field('points_to_aj', '' , 'onkeyup="validate(this)"');
        $contents[] = array('text' => $value_field);
             
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_draw_button(BUTTON_TEXT_ADJUST_POINTS, 'triangle-2-n-s') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id)));
        break;
      case 'rollback':
        $heading[] = array('text' => '<b>' . TEXT_ROLL_POINTS . '</b>');
  
        $contents = array('form' => tep_draw_form('points_roll', 'customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=pe_rollback'));
        $contents[] = array('text' => '<b>'. TEXT_ROLL_POINTS . '</b><br>');
        $value_field = TEXT_ROLL_POINTS_LONG. '<br>';
        $contents[] = array('text' => $value_field);
        $value_field = TEXT_ROLL_REASON .'<br>'. tep_draw_input_field('comment_roll', 0);
        $contents[] = array('text' => $value_field);
        $contents[] = array('text' => tep_draw_checkbox_field('notify_roll', '', true) . ' ' . TEXT_NOTIFY_CUSTOMER);
        $contents[] = array('text' => tep_draw_hidden_field('customer_id', $uInfo->customer_id) . tep_draw_hidden_field('customers_firstname', $uInfo->customers_firstname) . tep_draw_hidden_field('customers_lastname', $uInfo->customers_lastname) . tep_draw_hidden_field('customers_gender', $uInfo->customers_gender) . tep_draw_hidden_field('customers_email_address', $uInfo->customers_email_address) . tep_draw_hidden_field('customers_shopping_points', $uInfo->customers_shopping_points) . tep_draw_hidden_field('customers_points_expires', $uInfo->customers_points_expires) . tep_draw_hidden_field('date_added', $uInfo->date_added) . tep_draw_hidden_field('points_pending', $uInfo->points_pending) . tep_draw_hidden_field('points_type', $uInfo->points_type));
      if ( $uInfo->points_type == 'RF') {
          $contents[] = array('text' => tep_draw_hidden_field('customer_name', $uInfo->customers_name));
      }
      if ( $uInfo->points_type == 'RV') {
          $contents[] = array('text' => tep_draw_hidden_field('products_name', $uInfo->products_name));
      }
  
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_draw_button(BUTTON_TEXT_ROLL_POINTS, 'arrowreturnthick-1-w') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id)));
        break;
      case 'delete':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_RECORD . '</b>');
  
        $contents = array('form' => tep_draw_form('points_delete', 'customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=delete_points'));
        $contents[] = array('text' => TEXT_DELETE_INTRO );
  
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_draw_button(BUTTON_TEXT_REMOVE_RECORD, 'trash') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id)));
        break;
  
      default:
        if (isset($uInfo) && is_object($uInfo)) {
          $heading[] = array('text' => '<b>' . $uInfo->customers_firstname . ' ' . $uInfo->customers_lastname . '</b>');
  
      if ($uInfo->points_status == 1) {
        $contents[] = array('align' => 'center', 'text' => tep_draw_button(BUTTON_TEXT_CONFIRM_PENDING_POINTS, 'check', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=confirm')) .
                                 tep_draw_button(BUTTON_TEXT_CANCEL_PENDING_POINTS, 'cancel', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=cancel')) .
                                 tep_draw_button(BUTTON_TEXT_ADJUST_POINTS, 'triangle-2-n-s', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=adjust')) .
                                 tep_draw_button(IMAGE_EMAIL, 'mail-closed', tep_href_link('mail.php', 'selected_box=tools&customer=' . $uInfo->customers_email_address)) .
                                 tep_draw_button(BUTTON_TEXT_REMOVE_RECORD, 'trash', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=delete')));
          }
      if ($uInfo->points_status == 2) {
        $contents[] = array('align' => 'center', 'text' => tep_draw_button(BUTTON_TEXT_ROLL_POINTS, 'arrowreturnthick-1-w', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('action')) . 'uID=' . $uInfo->unique_id . '&action=rollback')) .
                                 tep_draw_button(IMAGE_EMAIL. 'mail-closed', tep_href_link('mail.php', 'selected_box=tools&customer=' . $uInfo->customers_email_address)) .
                                 tep_draw_button(BUTTON_TEXT_REMOVE_RECORD. 'trash', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=delete')));
      }
      if ($uInfo->points_status == 3) {
        $contents[] = array('align' => 'center', 'text' => tep_draw_button(BUTTON_TEXT_CONFIRM_PENDING_POINTS, 'check', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=confirm')) . 
                                 tep_draw_button(BUTTON_TEXT_ADJUST_POINTS, 'triangle-2-n-s', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=adjust')) . 
                                 tep_draw_button(IMAGE_DETAILS, 'pencil', tep_href_link('orders.php' . '?oID=' . $uInfo->orders_id . '&action=edit')) . 
                                 tep_draw_button(IMAGE_EMAIL, 'mail-closed', tep_href_link('mail.php', 'selected_box=tools&customer=' . $uInfo->customers_email_address)) . 
                                 tep_draw_button(BUTTON_TEXT_REMOVE_RECORD, 'trash', tep_href_link('customers_points_referral.php', tep_get_all_get_params(array('uID', 'action')) . 'uID=' . $uInfo->unique_id . '&action=delete')));
      }
      
      if($uInfo->points_comment == 'TEXT_DEFAULT_REFERRAL') {
         $uInfo->points_comment = TEXT_DEFAULT_REFERRAL;
      }
      if($uInfo->points_comment == 'TEXT_DEFAULT_REVIEWS') {
         $uInfo->points_comment = TEXT_DEFAULT_REVIEWS;
      }
      
      if ($uInfo->points_type == 'RF') {
        $order_link = '<a href="' . tep_href_link('orders.php', tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $uInfo->orders_id . '&action=edit') . '">' . tep_image('images/icons/preview.gif', ICON_PREVIEW_EDIT) . '</a>&nbsp;';
        
        $contents[] = array('text' => '<br><b>' . TEXT_INFO_POINTS_COMMENT . '</b><br>' . $uInfo->points_comment);
            $contents[] = array('text' => '<br>' . TEXT_INFO_REFERRED . ' ' . $uInfo->customers_name);
            $contents[] = array('text' => TEXT_INFO_ORDER_ID . ' ' . $uInfo->orders_id . ' ' . $order_link);
            $contents[] = array('text' => TEXT_INFO_ORDER_TOTAL . ' ' . strip_tags($uInfo->order_total));
            $contents[] = array('text' => TEXT_INFO_PAYMENT_METHOD . ' ' . $uInfo->payment_method);
            $contents[] = array('text' => TEXT_INFO_ORDER_STATUS . ' ' . $uInfo->orders_status_name);
            $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_BALANCE . ' ' . number_format($uInfo->customers_shopping_points,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES). ' ' . HEADING_POINTS);
          }
      if (isset($uInfo) && $uInfo->points_type == 'RV') {
        $review_link = '<a href="' . tep_href_link('reviews.php', 'page=' . $_GET['page'] . '&rID=' . $uInfo->reviews_id . '&action=edit') . '">' . tep_image('images/icons/preview.gif', ICON_REVIEWS_EDIT) . '</a>&nbsp;';
        
        $contents[] = array('text' => '<br><b>' . TEXT_INFO_POINTS_COMMENT . '</b><br>' . $uInfo->points_comment);
            $contents[] = array('text' => '<br>' . TEXT_INFO_PRODUCT_ID . ' ' . $uInfo->orders_id);
            $contents[] = array('text' => TEXT_INFO_PRODUCT_NAME . '<br>' . $uInfo->products_name);
            $contents[] = array('text' => TEXT_INFO_REVIEW_ID . ' ' . $uInfo->reviews_id . ' ' . $review_link);
            $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_BALANCE . ' ' . number_format($uInfo->customers_shopping_points,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES). ' ' . HEADING_POINTS);
          }
        }
        break;
    }
  
    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '<td width="25%" valign="top">' . "\n";
  
      $box = new box;
      echo $box->infoBox($heading, $contents);
  
      echo '</td>' . "\n";
    }
  ?>
            </tr>
          </table></td>
        </tr>
      </table>
  <?php
  } // INSTALL CHECK END

  require('includes/template_bottom.php');
  require('includes/application_bottom.php');
?>
