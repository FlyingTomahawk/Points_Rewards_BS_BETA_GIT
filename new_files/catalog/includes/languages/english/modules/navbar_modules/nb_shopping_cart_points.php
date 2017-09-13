<?php
/*
  $Id$ nb_shopping_cart_points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com 

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_TITLE', 'Shopping Cart with points');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_DESCRIPTION', 'Show Shopping Cart with points in Navbar');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENTS', '<i class="fa fa-shopping-cart"></i> %s item(s) <span class="caret"></span>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_NO_CONTENTS', '<i class="fa fa-shopping-cart"></i> 0 items');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HAS_CONTENTS', '%s item(s), %s');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_VIEW_CART', 'View Cart');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CHECKOUT', '<i class="fa fa-angle-right"></i> Checkout');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PRODUCT', '<a href="' . tep_href_link('product_info.php', 'products_id=%s') . '">%s x %s</a>');
  
  define('MODULE_NAVBAR_TEXT_POINTS_BALANCE', 'Points Status');
  define('MODULE_NAVBAR_TEXT_POINTS', 'Points:');
  define('MODULE_NAVBAR_TEXT_VALUE', 'Value:');
  