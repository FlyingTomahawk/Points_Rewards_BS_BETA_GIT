<?php
if ($cart->count_contents() > 0) {
  ?>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo sprintf(MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENTS, $cart->count_contents()); ?></a>
    <ul class="dropdown-menu">
      <li><?php echo '<a href="' . tep_href_link('shopping_cart.php') . '">' . sprintf(MODULE_NAVBAR_SHOPPING_CART_POINTS_HAS_CONTENTS, $cart->count_contents(), $currencies->format($cart->show_total())) . '</a>'; ?></li>
      <li role="separator" class="divider"></li>
      <?php      
      $products = $cart->get_products();
      foreach ($products as $k => $v) {
        echo '<li>' . sprintf(MODULE_NAVBAR_SHOPPING_CART_POINTS_PRODUCT, $v['id'], $v['quantity'], $v['name']) . '</li>';
      }        
      ?>
	  <li role="separator" class="divider"></li>
      <li><?php echo '<a href="' . tep_href_link('shopping_cart.php') . '">' . MODULE_NAVBAR_SHOPPING_CART_POINTS_VIEW_CART . '</a>'; ?></li>
	   <?php 
		if (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_REDEEM_SYSTEM == 'True') {
		  $has_points = tep_get_shopping_points($customer_id);
			if ($has_points > 0) {
			  echo '<li role="separator" class="divider"></li>';
			  echo '<li class="points"><strong><a href="' . tep_href_link('my_points.php', '', 'SSL') . '"><br />'. MODULE_NAVBAR_TEXT_POINTS_BALANCE . '</a></strong><br />' . MODULE_NAVBAR_TEXT_POINTS . '&nbsp;' . number_format($has_points,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES) . '<br />' .  MODULE_NAVBAR_TEXT_VALUE . '&nbsp;' . $currencies->format(tep_calc_shopping_pvalue($has_points)) . '</li>';
			}   
		}
	   ?>
    </ul>
  </li>
  <?php
  echo '<li><a href="' . tep_href_link('checkout_shipping.php', '', 'SSL') . '">' . MODULE_NAVBAR_SHOPPING_CART_POINTS_CHECKOUT . '</a></li>';
}
else {
  echo '<li><p class="navbar-text">' . MODULE_NAVBAR_SHOPPING_CART_POINTS_NO_CONTENTS . '</p></li>';
}
?>
<style>
.points {
	padding: 3px 20px;
	color: #333;
	margin-top: -20px;
}
@media (max-width: 768px) {
	.points{
		color: #9d9d9d;
	}
}
</style>