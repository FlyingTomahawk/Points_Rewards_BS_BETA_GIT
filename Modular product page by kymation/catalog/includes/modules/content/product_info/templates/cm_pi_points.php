<?php
/*
  $Id cm_pi_points.php, v1.0 20160227 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

?>

<!-- Start cm_pi_points module -->
<div id="cm_pi_points" class="col-sm-<?php echo $content_width; ?>">
  <div itemprop="points">

    <?php 
// BOF POINTS REWARDS BS
    if ((USE_POINTS_SYSTEM == 'true') && (DISPLAY_POINTS_INFO == 'true')) {
	    if ($new_price = tep_get_products_special_price($product_info->products_id)) {
		    $products_price_points = tep_display_points($new_price, tep_get_tax_rate($product_info->products_tax_class_id));
	    } else {
		    $products_price_points = tep_display_points($product_info->products_price(), tep_get_tax_rate($product_info->products_tax_class_id));
	    }
	    $products_points = tep_calc_products_price_points($products_price_points);
	    $products_points_value = tep_calc_price_pvalue($products_points);
	    if ((USE_POINTS_FOR_SPECIALS == 'true') || $new_price == false) {
		echo '<p>' . sprintf(TEXT_PRODUCT_POINTS , number_format($products_points,POINTS_DECIMAL_PLACES), $currencies->format($products_points_value)) . '</p>';
	    }
    }
// EOF POINTS REWARDS BS
?>
	
  </div>
</div>
<!-- End cm_pi_points module -->
