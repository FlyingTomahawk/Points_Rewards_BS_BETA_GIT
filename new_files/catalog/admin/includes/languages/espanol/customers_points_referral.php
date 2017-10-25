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

define('MOD_VER', '2.00');

define('HEADING_TITLE', 'Referencia- Revisar Puntos Pendientes');
define('HEADING_RATE', 'Tasa de Cambio : ');
define('HEADING_AWARDS', 'Premios : ');
define('HEADING_REDEEM', 'Canjeo : ');
define('HEADING_POINT', 'punto');
define('HEADING_POINTS', 'puntos');
define('HEADING_TITLE_SEARCH', 'Buscar ID de Cliente:');

define('TABLE_HEADING_CUSTOMERS', 'Clientes');
define('TABLE_HEADING_POINTS_TYPE', 'Tipo de Puntos');
define('TABLE_HEADING_DATE_ADDED', 'Fecha en que se añadieron');
define('TABLE_HEADING_POINTS_STATUS', 'Estado de Puntos');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_POINTS', 'Puntos');
define('TABLE_HEADING_POINTS_VALUE', 'Valor');

define('TABLE_HEADING_SORT', 'Ordenar las filas por ');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C Desde Arriba');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 Desde Arriba');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X Desde Arriba');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 Desde Arriba');

define('TEXT_DEFAULT_REFERRAL', 'Puntos por Referencia');
define('TEXT_DEFAULT_REVIEWS', 'Revisar Puntos');
define('TEXT_TYPE_REFERRAL', 'Referencia');
define('TEXT_TYPE_REVIEW', 'Revisar');

define('TEXT_POINTS_PENDING', 'Pendiente');
define('TEXT_POINTS_CONFIRMED', 'Confirmado');
define('TEXT_POINTS_CANCELLED', 'Cancelado');
define('TEXT_SHOW_ALL', 'Mostrar Todo');

define('TEXT_INFO_POINTS_COMMENT', 'Comentario a Puntos Actuales : ');
define('TEXT_INFO_ORDER_ID', 'Id de Pedido:');
define('TEXT_INFO_ORDER_TOTAL', 'Total de Pedido:');
define('TEXT_INFO_ORDER_STATUS', 'Estado de Pedido:');
define('TEXT_INFO_PRODUCT_ID', 'Id de Producto:');
define('TEXT_INFO_REVIEW_ID', 'Id de Comentario:');
define('TEXT_INFO_PRODUCT_NAME', 'Nombre de Producto:');
define('TEXT_INFO_REFERRED', 'Referido:');
define('TEXT_INFO_PAYMENT_METHOD', 'Forma de Pago:');
define('TEXT_INFO_CURRENT_BALANCE', 'Saldo Actual de Puntos:');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Ajustar Puntos Pendientes.');
define('TEXT_INFO_HEADING_DELETE_RECORD', 'Eliminar registro');
define('TEXT_INFO_HEADING_PENDING_NO', 'Puntos pendiesntes del pedido nº');
define('TEXT_CONFIRM_POINTS', '¿Confirmar Puntos Pendientes al Cliente?');
define('TEXT_CONFIRM_POINTS_LONG', 'Puede confirmar los puntos al cliente poniendo o sin poner en cola la tabla de puntos.<br>Confirmar los puntos sin poner en cola también eliminará esta línea de la tabla, y el estado actual de puntos se cambiará a "Confirmado" .');
define('TEXT_CANCEL_POINTS', '¿Cancelar Puntos Pendientes de Cliente?');
define('TEXT_CANCEL_POINTS_LONG', 'Puede cancelar los puntos al cliente poniendo o sin poner en cola la tabla de puntos.<br>Cancelar los puntos sin poner en cola también eliminará esta línea de la tabla, el estado actual de puntos se cambiará a "Cancelado" y el comentario por defecto se cambiará por el Motivo de la Cancelación.');
define('TEXT_CANCELLATION_REASON', 'Motivo de la Cancelación:');
define('TEXT_ADJUST_INTRO', 'Esta opción da la posibilidad de ajustar la cantidad total de puntos pendientes antes de confirmarlos.<br>Observe que esto reemplazará la cantidad actual de puntos pendientes y no se puede deshacer.');
define('TEXT_DELETE_INTRO', '¿Seguro que quiere eliminar este registro?<br>Esto eliminará el registro de la base de datos.');
define('TEXT_POINTS_TO_ADJUST', 'Nueva cantidad de puntos :');
define('TEXT_ROLL_POINTS', 'Revertir puntos.');
define('TEXT_ROLL_POINTS_LONG', 'Esta opción da la posibilidad de revertir puntos confirmados al estado de pendientes.<br>Los puntos se deducirán de la cuenta del cliente y se mostrará el estado por defecto de pendiente.');
define('TEXT_ROLL_REASON', 'Motivo para Revertir :');

define('TEXT_QUEUE_POINTS_TABLE', 'Poner en cola la tabla de puntos de clientes');
define('TEXT_NOTIFY_CUSTOMER', 'Notificar al Cliente');
define('TEXT_SET_EXPIRE', 'Fijar nueva fecha de expiración');

define('BUTTON_TEXT_ADJUST_POINTS', 'Ajustar Puntos');
define('BUTTON_TEXT_CANCEL_PENDING_POINTS', 'Cancelar Puntos');
define('BUTTON_TEXT_CONFIRM_PENDING_POINTS', 'Confirmar Puntos');
define('BUTTON_TEXT_REMOVE_RECORD', 'Eliminar este registro');
define('BUTTON_TEXT_ROLL_POINTS', 'Revertir Puntos');
define('ICON_PREVIEW_EDIT', 'Ver detalles de pedido o editar estado');
define('ICON_REVIEWS_EDIT', 'Ver o editar el contenido de los Comentarios');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Actualización de la Cuenta de Puntos.');
define('EMAIL_GREET_MR', 'Estimado D. %s,');
define('EMAIL_GREET_MS', 'Estimada Dª %s,');
define('EMAIL_GREET_NONE', 'Hola %s');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de Pedido:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha del Pedido:');
define('EMAIL_TEXT_ORDER_STAUTS', 'Estado del Pedido:');
define('EMAIL_TEXT_INTRO', 'Le informamos que se ha actualizado su Cuenta de Puntos.');
define('EMAIL_TEXT_BALANCE_CANCELLED', 'Lamentamos comunicarle que hemos tenido que cancelar sus puntos por los siguientes detalles.');
define('EMAIL_TEXT_BALANCE_CONFIRMED', 'Puntos confirmados por los siguientes detalles del pedido.');
define('EMAIL_TEXT_BALANCE_ROLL_BACK', 'Los puntos confirmados del siguiente pedido han vuelto a su estado previo.');
define('EMAIL_TEXT_ROLL_COMMENT', 'Comentario :');
define('EMAIL_TEXT_BALANCE', 'Su saldo actual de Puntos es: %s puntos, valorados en %s .');
define('EMAIL_TEXT_EXPIRE', 'Los Puntos caducarán el: %s .');
define('EMAIL_TEXT_POINTS_URL', 'Para su comodidad, aquí tiene el enlace a su Cuenta de Puntos . %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'La página de Preguntas Frecuentes de nuestro Programa de Premios en Puntos está aquí . %s');
define('EMAIL_TEXT_COMMENT', 'Motivo de Cancelación :');
define('EMAIL_TEXT_SUCCESS_POINTS', 'Los Puntos están disponibles en su cuenta. Durante el proceso de compra podrá pagar su pedido con su saldo de puntos. '. "\n" .'Gracias por sus compras en  ' . STORE_NAME . ', y esperamos en que siga confiando en nosotros.');
define('EMAIL_CONTACT', 'Si necesita ayuda o tiene alguna pregunta sobre cualquiera de nuestros servicios online, por favor, escríbanos a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Éste es un mensaje automático. Por favor, no responda al mismo.');

define('SUCCESS_DATABASE_UPDATED', 'Puesta en Cola Correcta: La base de datos se ha actualizado correctamente y el estdo de los puntos se han puesto a ' . TEXT_POINTS_CANCELLED . '  con este comentario " '. $comment_cancel . ' ".');
define('SUCCESS_POINTS_UPDATED', 'Correcto: La cuenta de Puntos de Cliente se ha actualziado correctamente.');
define('NOTICE_EMAIL_SENT_TO', 'Nota: Email enviado a : %s');
define('NOTICE_RECORED_REMOVED', 'Nota: El registro de puntos nº ' . $uID . ' se ha eliminado de la base de datos.');
define('WARNING_DATABASE_NOT_UPDATED', 'Aviso: Campos vacíos. Nada que cambiar. La base de datos no se ha ctualizado.');
define('POINTS_ENTER_JS_ERROR', 'Entrada No Válida \n Sólo se admiten números');

define('TEXT_LINK_CREDIT', 'Click aquí para ejecutar manualmente el script <a target="_blank" href="customers_points_credit.php"><u>Auto Crédito</u></a> o <a target="_blank" href="customers_points_expire.php"><u>Auto Expiración</u></a>.');

define('INSTALL_CHECK_HT_WARNING', '<strong>Módulo de Cabecera de Puntos y Premios</strong> no está instalado. Es requerido.');
define('INSTALL_CHECK_HT_INSTALL_NOW', '<u>Instalar ahora el Módulo de Cabecera de Puntos y Premios</u>');
define('INSTALL_CHECK_OT_WARNING', '<strong>El módulo total de pedido de Canjeo de Puntos</strong> no está instalado. Es requerido.');
define('INSTALL_CHECK_OT_INSTALL_NOW', '<u>Instalar ahora el módulo total de pedido de Canjeo de Puntos</u>');
define('INSTALL_CHECK_PM_WARNING', '<strong>Módulo de pago por Puntos</strong> no está instalado. Es requerido.');
define('INSTALL_CHECK_PM_INSTALL_NOW', '<u>Instalar ahora el módulo de pago por Puntos</u>');
?>
