<?php
/*
  $Id$ nb_shopping_cart_points.php

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

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_TITLE', 'Warenkorb mit Bonuspunkten');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_DESCRIPTION', 'Zeige den Warenkorb mit Bonuspunkten im Navigationsbalken');

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HT_WARNING', 'Das benötigte <strong>Bonuspunkte Header Tags Modul</strong> ist nicht installiert.');
  define('MODULE_CONTENT_REVIEWS_POINTMODULE_NAVBAR_SHOPPING_CART_POINTS_HT_INSTALL_NOWS_HT_INSTALL_NOW', '<u>Installieren Sie jetzt das Bonuspunkte Header Tags Modul</u>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_OT_WARNING', 'Das benötigte <strong>Bonuspunkte Order Total Modul</strong> ist nicht installiert.');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_OT_INSTALL_NOW', '<u>Installieren Sie jetzt das Bonuspunkte Order Total Modul</u>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PM_WARNING', 'Das benötigte <strong>Punkte Zahlungsart Modul</strong> ist nicht installiert.');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PM_INSTALL_NOW', '<u>Installieren Sie jetzt das Punkte Zahlungsart Modul</u>');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENTS', '<i class="fa fa-shopping-cart"></i> %s Produkt(e) <span class="caret"></span>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_NO_CONTENTS', '<i class="fa fa-shopping-cart"></i> 0 Produkt(e)');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HAS_CONTENTS', '%s Produkt(e), %s');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_VIEW_CART', 'Zum Warenkorb');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CHECKOUT', '<i class="fa fa-angle-right"></i> Zur Kasse');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PRODUCT', '<a href="' . tep_href_link('product_info.php', 'products_id=%s') . '">%s x %s</a>');
  
  define('MODULE_NAVBAR_TEXT_POINTS_BALANCE', 'Punktestatus');
  define('MODULE_NAVBAR_TEXT_POINTS', 'Punkte:');
  define('MODULE_NAVBAR_TEXT_VALUE', 'Wert:');
  