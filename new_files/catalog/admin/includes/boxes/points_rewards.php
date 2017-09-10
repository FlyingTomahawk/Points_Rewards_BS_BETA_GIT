<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
  
  Points Rewards BS v1.0 (admin file)
*/


    foreach ( $cl_box_groups as &$group ) {
    if ( $group['heading'] == BOX_HEADING_CUSTOMERS ) {
      $group['apps'][] = array('code' => 'customers_points.php',
							   'title' => BOX_CUSTOMERS_POINTS,
							   'link' => tep_href_link('customers_points.php')
							   );
	  $group['apps'][] = array('code' => 'customers_points_pending.php',
							   'title' => BOX_CUSTOMERS_POINTS_PENDING,
							   'link' => tep_href_link('customers_points_pending.php')
							   );
	  $group['apps'][] = array('code' => 'customers_points_referral.php',
							   'title' => BOX_CUSTOMERS_POINTS_REFERRAL,
							   'link' => tep_href_link('customers_points_referral.php')	  
						       );
      break;
    }
  }
?>