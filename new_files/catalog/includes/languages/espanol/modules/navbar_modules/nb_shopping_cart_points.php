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

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_TITLE', 'Carrito con Puntos');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_DESCRIPTION', 'Mostrar Carrito con Puntos en la Barra de Navegación');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HT_WARNING', '<strong>Módulo de Cabezera de Puntos y Premios</strong> no está instalado. Es requerido.');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HT_INSTALL_NOW', '<u>Instalar ahora el Módulo de Cabezera de Puntos y Premios</u>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_OT_WARNING', '<strong>El módulo total de pedido de Canjeo de Puntos</strong> no está instalado. Es requerido.');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_OT_INSTALL_NOW', '<u>Instalar ahora el módulo total de pedido de Canjeo de Puntos</u>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PM_WARNING', '<strong>Módulo de pago por Puntos</strong> no está instalado. Es requerido.');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PM_INSTALL_NOW', '<u>Instalar ahora el módulo de pago por Puntos</u>');

  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CONTENTS', '<i class="fa fa-shopping-cart"></i> %s producto(s) <span class="caret"></span>');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_NO_CONTENTS', '<i class="fa fa-shopping-cart"></i> 0 productos');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_HAS_CONTENTS', '%s producto(s), %s');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_VIEW_CART', 'Ver Carro');
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_CHECKOUT', '<i class="fa fa-angle-right"></i> Realizar Pedido');
  
  define('MODULE_NAVBAR_SHOPPING_CART_POINTS_PRODUCT', '<a href="' . tep_href_link('product_info.php', 'products_id=%s') . '">%s x %s</a>');
  
  define('MODULE_NAVBAR_TEXT_POINTS_BALANCE', 'Estado de Puntos');
  define('MODULE_NAVBAR_TEXT_POINTS', 'Puntos:');
  define('MODULE_NAVBAR_TEXT_VALUE', 'Valor:');
  