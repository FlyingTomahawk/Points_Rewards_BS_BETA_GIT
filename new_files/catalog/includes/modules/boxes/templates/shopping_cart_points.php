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
?>
<div class="panel panel-default">
  <div class="panel-heading"><a href="<?php echo tep_href_link('shopping_cart.php'); ?>"><?php echo MODULE_BOXES_SHOPPING_CART_POINTS_BOX_TITLE; ?></a></div>
  <div class="panel-body">
    <ul class="list-unstyled">
      <?php echo $cart_contents_string; ?>
    </ul>
  </div>
</div>
