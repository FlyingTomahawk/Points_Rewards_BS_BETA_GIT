<?php
/*
  $Id: customers_points.php, V2.1rc2a 2008/SEP/29 15:17:12 dsa Exp $
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
*/
define('MOD_VER', '2.00');

define('HEADING_TITLE', 'Puntos Válidos de Clientes');
define('HEADING_RATE', 'Tasa de Cambio : ');
define('HEADING_AWARDS', 'Premios : ');
define('HEADING_REDEEM', 'Canjeo : ');
define('HEADING_POINT', 'punto');
define('HEADING_POINTS', 'puntoss');
define('HEADING_TITLE_SEARCH', 'Buscar id, nombre o mes en el que expiran (p.ee May=05)');

define('TABLE_HEADING_FIRSTNAME', 'Nombre');
define('TABLE_HEADING_LASTNAME', 'Apellidos');
define('TABLE_HEADING_DOB', 'Fecha de nacimiento');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_POINTS', 'Puntos');
define('TABLE_HEADING_POINTS_VALUE', 'valor');
define('TABLE_HEADING_POINTS_EXPIRES', 'Expira');

define('TABLE_HEADING_SORT', 'Ordenar esta fila por ');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C Desde arriba');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 Desde arriba');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X Desde arriba');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 Desde arriba');

define('TEXT_SHOW_ALL', 'Mostrar Todo');
define('TEXT_SORT_CUSTOMERS', 'Mostrar Clientes');
define('TEXT_SORT_POINTS', 'con puntos');
define('TEXT_SORT_NO_POINTS', 'sin puntos');
define('TEXT_SORT_BIRTH', 'B.day este mes');
define('TEXT_SORT_BIRTH_NEXT', 'B.day siguiente mes');
define('TEXT_SORT_EXPIRE', 'Expiran este mes');
define('TEXT_SORT_EXPIRE_NEXT', 'Expiran el próximo mes');
define('TEXT_SORT_EXPIRE_WIN', 'Expiran en un mes');


define('TEXT_DATE_ACCOUNT_CREATED', 'Cuenta Creada:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Última Modificación:');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Ajustar Puntos del Cliente.');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Total del pedido :');
define('TEXT_INFO_NUMBER_OF_PENDING', 'Total de Puntos Pendientes :');

define('TEXT_ADD_POINTS', 'Añadir Puntos.');




define('TEXT_ADD_POINTS_LONG', 'Se pueden añadir puntos al cliente con o sin tener que poner en cola de la tabla de puntos.<br>Poniendo en cola, añadirá una línea a la tabla a la qeu se añadirán sus comentarios con Queuing will add a line to table with your comment else, points account updated only(if customer notify your comment will be added to the email) .');



define('TEXT_ADJUST_INTRO', 'Esta opción le capacita para ajustar de forma rápida la cantidad total de puntos.<br>Fíjese que esto reemplazará la cantidad actual de puntos y que el cliente no recibirá notifiación.');
define('TEXT_DELETE_POINTS', 'Eliminar Puntos.');



define('TEXT_DELETE_POINTS_LONG', 'Se pueden eliminar puntos al cliente con o sin tener que poner en cola de la tabla de puntos.<br>Queuing will add a line to table with your comment else, points account updated only(if customer notify your comment will be added to the email) .');



define('TEXT_POINTS_TO_ADD', 'Puntos a Añadir :');
define('TEXT_POINTS_TO_ADJUST', 'Nuevo total de puntos :');
define('TEXT_POINTS_TO_DELETE', 'Puntos a Eliminar :');
define('TEXT_COMMENT', 'Comentario :');

define('TEXT_QUEUE_POINTS_TABLE', '¿Poner en cola de la tabla de puntos?');
define('TEXT_NOTIFY_CUSTOMER', 'Notificar al Cliente');
define('TEXT_SET_EXPIRE', 'Fijar nueva fecha de expiración');

define('BUTTON_TEXT_ADD_POINTS', 'Añadir Puntos');
define('BUTTON_TEXT_DELETE_POINTS', 'Eliminar Puntos');
define('BUTTON_TEXT_ADJUST_POINTS', 'Ajustar la cantidad  actual de puntos');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Cuenta de Puntos Actualizada.');
define('EMAIL_GREET_MR', '<b>Estimado Sr. %s,</b>');
define('EMAIL_GREET_MS', 'Estiamda Sr. %s,');
define('EMAIL_GREET_NONE', 'Estimado/a %s');
define('EMAIL_TEXT_INTRO', 'Le informamos que se ha actualizado su Cuenta de Puntos en nuestra tienda.');
define('EMAIL_TEXT_BALANCE_ADD', 'Enhorabuena! ' . "\n" . 'Hemos otrogado a su cuenta un total de %s puntos, valorados en %s');
define('EMAIL_TEXT_BALANCE_DEL', 'Lamentamos comunicarle que a su Cuenta de Puntos se le han restado un total de %s puntos, valorados en %s .');
define('EMAIL_TEXT_BALANCE', 'El balance actual de su Cuenta de Puntos es de %s puntos, valorados en %s .');
define('EMAIL_TEXT_EXPIRE', 'Puntos que expirarán : %s .');
define('EMAIL_TEXT_POINTS_URL', 'Para su comodidad, aquí tiene el enlace a su Cuenta de Puntos en nuestra Tienda Online. %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'Las Preguntas Frecuentes del Programa de Puntos de nuestrra tienda online está aquí . %s');
define('EMAIL_TEXT_COMMENT', 'Comentario: %s');
define('EMAIL_TEXT_SUCCESS_POINTS', 'Los Puntos están disponibles en su cuenta, y durante el proceso de compra podrá pagar sus pedidos con su saldo de puntos. '. "\n" .'Gracias por sus compras en ' . STORE_NAME . ', y estamos a su servicio para su próxima visita.');
define('EMAIL_CONTACT', 'Para cualquier aclaración que necesite sobre nuestros servicios online, por favor no dude en enviarnos un email a: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Esta es una respuesta automática. Por favor, no responda a este email.');

define('SUCCESS_POINTS_UPDATED', 'Correcto: La cuenta de Puntos del Cliente se ha actualizado correctamente.');
define('SUCCESS_DATABASE_UPDATED', 'Queue Success: La base de datos se ha actualizado correctamente.');
define('NOTICE_EMAIL_SENT_TO', 'Observación: Email enviado a: %s');
define('WARNING_DATABASE_NOT_UPDATED', 'Aviso: Campos vacíos, nada que cambiar. La base de datos no se ha actualizado.');
define('POINTS_ENTER_JS_ERROR', 'Entrada No Válida. \n Sólo se aceptan números.');

define('TEXT_LINK_CREDIT', 'Haga click para ejecutar manualmente el script de <a href="customers_points_credit.php"><u>Auto Crédito</u></a> o <a href="customers_points_expire.php"><u>Auto Expiración</u></a>.');
?>
