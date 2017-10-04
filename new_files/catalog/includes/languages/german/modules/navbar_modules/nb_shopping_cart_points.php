<?php
/*
  $Id$ nb_shopping_cart_points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com 

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_TITLE', 'Warenkorb mit Bonuspunkten');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_DESCRIPTION', 'Zeige den Warenkorb mit Bonuspunkten im Navigationsbalken');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENTS', '<i class="fa fa-shopping-cart"></i> %s Produkt(e) <span class="caret"></span>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_NO_CONTENTS', '<i class="fa fa-shopping-cart"></i> 0 Produkt(e)');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HAS_CONTENTS', '%s Produkt(e), %s');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_VIEW_CART', 'Zum Warenkorb');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CHECKOUT', '<i class="fa fa-angle-right"></i> Zur Kasse');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PRODUCT', '<a href="' . tep_href_link('product_info.php', 'products_id=%s') . '">%s x %s</a>');
  
  define('MODULE_NAVBAR_TEXT_POINTS_BALANCE', 'Punktestatus');
  define('MODULE_NAVBAR_TEXT_POINTS', 'Punkte:');
  define('MODULE_NAVBAR_TEXT_VALUE', 'Wert:');
  