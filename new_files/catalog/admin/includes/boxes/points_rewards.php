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


    foreach ( $cl_box_groups as &$group ) {
    if ( $group['heading'] == BOX_HEADING_CUSTOMERS ) {
      $group['apps'][] = array('code' => 'customers_points.php',
							   'title' => MODULES_ADMIN_MENUCUSTOMERS_POINTS,
							   'link' => tep_href_link('customers_points.php')
							   );
	  $group['apps'][] = array('code' => 'customers_points_pending.php',
							   'title' => MODULES_ADMIN_MENUCUSTOMERS_POINTS_PENDING,
							   'link' => tep_href_link('customers_points_pending.php')
							   );
	  $group['apps'][] = array('code' => 'customers_points_referral.php',
							   'title' => MODULES_ADMIN_MENUCUSTOMERS_POINTS_REFERRAL,
							   'link' => tep_href_link('customers_points_referral.php')	  
						       );
      break;
    }
  }
?>