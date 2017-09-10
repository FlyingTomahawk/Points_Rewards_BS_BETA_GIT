<?php
/*
  $Id$
  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link('login.php', '', 'SSL'));
  }

  require('includes/languages/' . $language . '/my_points.php');

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link('my_points.php', '', 'SSL'));

  require('includes/template_top.php');

?>

<div class="page-header">
	<h1><?php echo HEADING_TITLE; ?></h1>
</div>

<div class="contentContainer">
  <div class="contentText">
	<p><?php echo MY_POINTS_HELP_LINK; ?></p>

  
<?php
  $has_point = tep_get_shopping_points($customer_id);
  if ($has_point > 0) {
?>
<div class="alert alert-info">
<div class="row">
	<div class="col-sm-6">
		<?php echo sprintf(MY_POINTS_CURRENT_BALANCE, number_format($has_point,POINTS_DECIMAL_PLACES),$currencies->format(tep_calc_shopping_pvalue($has_point))); ?>
	</div>
<?php
  if (tep_not_null(POINTS_AUTO_EXPIRES)) {
	  $expires_query = tep_db_query("select customers_points_expires from customers where customers_id = '" . (int)$customer_id . "' and customers_points_expires > curdate() limit 1");
	  $expires = tep_db_fetch_array($expires_query);
?>
	<div class="col-sm-6 text-right">
		<?php echo '<strong>' . MY_POINTS_EXPIRE . '</strong> ' . tep_date_short($expires['customers_points_expires']); ?>
	</div>
</div>
</div>
<?php
      }
?>


<?php
    $pending_points_query = "select unique_id, orders_id, points_pending, points_comment, date_added, points_status, points_type from customers_points_pending where customer_id = '" . (int)$customer_id . "' order by unique_id desc";
    $pending_points_split = new splitPageResults($pending_points_query, MAX_DISPLAY_POINTS_RECORD);
    $pending_points_query = tep_db_query($pending_points_split->sql_query);

    if (tep_db_num_rows($pending_points_query)) {
?>

<table class="table table-condensed table-striped table-hover">
<thead>
	<tr>
		 <th><?php echo HEADING_ORDER_DATE; ?></th> 
		 <th><?php echo HEADING_ORDERS_NUMBER; ?></th> 
		 <th><?php echo HEADING_POINTS_COMMENT; ?></th> 
		 <th><?php echo HEADING_POINTS_STATUS; ?></th>
		 <th><?php echo HEADING_POINTS_TOTAL; ?></th>
	</tr>
 </thead>
 <tbody>
<?php
    while ($pending_points = tep_db_fetch_array($pending_points_query)) {
	    $orders_status_query = tep_db_query("select o.orders_id, o.orders_status, s.orders_status_name from orders o, orders_status s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = '" . (int)$pending_points['orders_id'] . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "'");
	    $orders_status = tep_db_fetch_array($orders_status_query);
	    
	    if ($pending_points['points_status'] == '1') $points_status_name = TEXT_POINTS_PENDING;
	    if ($pending_points['points_status'] == '2') $points_status_name = TEXT_POINTS_CONFIRMED;
	    if ($pending_points['points_status'] == '3') $points_status_name = '<span class="pointWarning">' . TEXT_POINTS_CANCELLED . '</span>';
	    if ($pending_points['points_status'] == '4') $points_status_name = '<span class="pointWarning">' . TEXT_POINTS_REDEEMED . '</span>';
	    
	    if ($orders_status['orders_status'] == 2 && $pending_points['points_status'] == 1 || $orders_status['orders_status'] == 3 && $pending_points['points_status'] == 1) {
		    $points_status_name = TEXT_POINTS_PROCESSING;
	    }
	    
	    if (($pending_points['points_type'] == 'SP') && ($pending_points['points_comment'] == 'TEXT_DEFAULT_COMMENT')) {
		    $pending_points['points_comment'] = TEXT_DEFAULT_COMMENT;
	    }
	    
		if ($pending_points['points_comment'] == 'TEXT_DEFAULT_REDEEMED') {
			$pending_points['points_comment'] = TEXT_DEFAULT_REDEEMED;
		}
		
		if ($pending_points['points_type'] == 'RF') {
			$referred_name_query = tep_db_query("select customers_name from orders where orders_id = '" . (int)$pending_points['orders_id'] . "' limit 1");
			$referred_name = tep_db_fetch_array($referred_name_query);
			if ($pending_points['points_comment'] == 'TEXT_DEFAULT_REFERRAL') {
				$pending_points['points_comment'] = TEXT_DEFAULT_REFERRAL;
			}
		}
	
	if (($pending_points['points_type'] == 'RV') && ($pending_points['points_comment'] == 'TEXT_DEFAULT_REVIEWS')) {
		$pending_points['points_comment'] = TEXT_DEFAULT_REVIEWS;
	}
	
	if (($pending_points['orders_id'] > '0') && (($pending_points['points_type'] == 'SP')||($pending_points['points_type'] == 'RD'))) {
?>
 
   <tr style="cursor:pointer;" onclick="document.location.href='<?php echo tep_href_link('account_history_info.php', 'order_id=' . $pending_points['orders_id'], 'SSL'); ?>'" title="<?php echo TEXT_ORDER_HISTORY .'&nbsp;' . $pending_points['orders_id']; ?>">
 
 <?php
	}
	
	if ($pending_points['points_type'] == 'RV') {
?>

   <tr style="cursor:pointer;" onclick="document.location.href='<?php echo tep_href_link('product_reviews_info.php', 'products_id=' . $pending_points['orders_id'], 'NONSSL'); ?>'" title="<?php echo TEXT_REVIEW_HISTORY; ?>">
  
<?php
	}
	
	if (($pending_points['orders_id'] == 0) || ($pending_points['points_type'] == 'RF') || ($pending_points['points_type'] == 'RV')) {
		$orders_status['orders_status_name'] = '<span class="pointWarning">' . TEXT_STATUS_ADMINISTATION . '</span>';
		$pending_points['orders_id'] = '<span class="pointWarning">' . TEXT_ORDER_ADMINISTATION . '</span>';
	}
?>

		<td><?php echo tep_date_short($pending_points['date_added']); ?></td>
		<td><?php echo '#' . $pending_points['orders_id'] . '&nbsp;&nbsp;' . $orders_status['orders_status_name']; ?></td>
		<td><?php echo  $pending_points['points_comment'] .'&nbsp;' . $referred_name['customers_name']; ?></td>
		<td><?php echo  $points_status_name; ?></td>
		<td><?php echo number_format($pending_points['points_pending'],POINTS_DECIMAL_PLACES); ?></td>
	</tr>
<?php
	}
?>
</tbody>
</table>

<?php
  }
?>

<div class="row">
  <div class="col-md-6 pagenumber"><?php echo $pending_points_split->display_count(TEXT_DISPLAY_NUMBER_OF_RECORDS); ?></div>
  <div class="col-md-6"><span class="pull-right pagenav"><ul class="pagination"><?php echo $pending_points_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></ul></span><span class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></span></div>
  </div>
<?php  
 } else {
?>

	<div class="alert alert-info">
		<p><?php echo TEXT_NO_POINTS; ?></p>
	</div>
  
<?php
  }
?>

  <div class="buttonSet">
    <div class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right', tep_href_link('index.php')); ?></div>
  </div>
  </div>
</div>	
  
 

<?php
  require('includes/template_bottom.php');
  require('includes/application_bottom.php');
?>