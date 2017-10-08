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

define('NAVBAR_TITLE', 'Info de Puntos');

define('HEADING_TITLE', 'Información de Mis Puntos');

define('HEADING_ORDER_DATE', 'Fecha');
define('HEADING_ORDERS_NUMBER', 'Nº de Pedido y Estado');
define('HEADING_ORDERS_STATUS', 'Estado del Pedido');
define('HEADING_POINTS_COMMENT', 'Comentarios');
define('HEADING_POINTS_STATUS', 'Mis Puntos');
define('HEADING_POINTS_TOTAL', 'Puntos');

define('TEXT_DEFAULT_COMMENT', 'Puntos por Compras');
define('TEXT_DEFAULT_REDEEMED', 'Puntos Canjeados');

define('TEXT_DEFAULT_REFERRAL', 'Puntos por Referencias');
define('TEXT_DEFAULT_REVIEWS', 'Puntos por Comentarios');

define('TEXT_ORDER_HISTORY', 'Ver detalles del pedido nº ');
define('TEXT_REVIEW_HISTORY', 'Mostrar este Comentario.');

define('TEXT_ORDER_ADMINISTATION', '---');
define('TEXT_STATUS_ADMINISTATION', '-----------');

define('TEXT_POINTS_PENDING', 'Pendiente');
define('TEXT_POINTS_PROCESSING', 'En Proceso');
define('TEXT_POINTS_CONFIRMED', 'Confirmado');
define('TEXT_POINTS_CANCELLED', 'Cancelado');
define('TEXT_POINTS_REDEEMED', 'Canjeado');

define('MY_POINTS_EXPIRE', 'Expira el: ');
define('MY_POINTS_CURRENT_BALANCE', '<strong>Saldo de Puntos :</strong> %s puntos. <strong>Valorados en:</strong> %s .');

define('MY_POINTS_HELP_LINK', ' Por favor, revise las <a href="' . tep_href_link('my_points_help.php') . '" title="Reward Point Program FAQ"><u>Preguntas Frecuentes del Programa de Puntos</u></a> para más información.');

define('TEXT_NO_PURCHASES', 'Todavía no ha realizado ninguna compra, y no ha conseguido puntos.');
define('TEXT_NO_POINTS', 'Todavía no tiene puntos.');

define('TEXT_DISPLAY_NUMBER_OF_RECORDS', 'Mostrando <strong>%d</strong> a <strong>%d</strong> (de <strong>%d</strong> registros de puntos)');
?>
