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

// Initialisation of some required parameters for the FAQ answers
 if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)){
   $answer_expire = 'Sus puntos expirarán pasados ' . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES . ' meses desde su emisión.';
 } else {
   $answer_expire = 'Sus puntos no expiran y se pueden acumular hasta que decida usarlos.';
 }

if (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE > 1) {
  $point_or_answer = 'answer';
} else {
  $point_or_answer = 'point';
}

// Definition if the navigation bar and page title
define('NAVBAR_TITLE', 'Programa de Puntos: FAQ');
define('HEADING_TITLE', 'Programa de Puntos: Preguntas Frecuentes');

// Definitions of the FAQ questions
define('POINTS_FAQ_1', '1. ¿Qué es el Programa de Puntos?');
define('POINTS_FAQ_2', '2. ¿Cómo funciona el Programa?');
define('POINTS_FAQ_3', '3. Puntos y Equivalencias');
define('POINTS_FAQ_4', '4. Canjear Puntos por Compras');
define('POINTS_FAQ_5', '5. Puntos mínimos requeridos');
define('POINTS_FAQ_6', '6. Compra mínima requerida');
define('POINTS_FAQ_7', '7. Puntos máximos que se permiten canjear por pedido');
define('POINTS_FAQ_8', '8. ¿Obtendré Puntos por los gastos de envío?');
define('POINTS_FAQ_9', '9. ¿Obtendré Puntos por tasas e impuestos?');
define('POINTS_FAQ_10', '10. ¿Obtendré Puntos por productos con descuento?');
define('POINTS_FAQ_11', '11. ¿Obtendré Puntos al hacer compras usando los puntos que ya tengo?');
define('POINTS_FAQ_12', '12. Obtener Puntos por Referencias a amigos');
define('POINTS_FAQ_13', '13. Obtener Puntos por escribir Comentarios');
define('POINTS_FAQ_14', '14. Restricciones de uso para algunos Productos');
define('POINTS_FAQ_15', '15. Restricciones de uso para algunos Productos en Oferta');
define('POINTS_FAQ_16', '16. Condiciones de Uso');
define('POINTS_FAQ_17', '17. Cuando hay Problemas...');
define('POINTS_FAQ_18', '18. Pedidos sin cuenta de cliente'); // PWA Guest Checkout support


// Definition of the answer for each of the questions:

// FAQ1
define('TEXT_FAQ_1', 'Queremos darle algo a cambio como agradecimiento por su apoyo y para ofrecerle incentivos futuros. Por este motivo hemos lanzado nuestro Programa de Puntos.
                      <br><br>Nuestro Programa de Premios en Puntos es tan sencillo como suena.  Al realizar sus compras en ' . STORE_NAME . ' obtendrá Puntos por Compra en función del importe empleado.
                      <br>Una vez obtenidos, los puede usar para pagar futuras compras en ' . STORE_NAME);

// FAQ2
define('TEXT_FAQ_2', 'Cuando se realiza un pedido, se usará el importe total<small><font color="FF6633">*</font></small> del pedido para calcular su equivalencia en puntos obtenidos.
                      Estos puntos se añaden a su Cuenta de Puntos como puntos pendientes.
                      <br>Todos los puntos pendientes aparecen en un listado en su <a href="' . tep_href_link('my_points.php') . '"> <u>Cuenta de Puntos </u></a> y ahí permanecerán hasta que sean aprobados/confirmados por ' . STORE_NAME . '.
                      <br><br>Una vez que se han aprobado, serán liberados, y en su cuenta aparecerá su valor como disponible para lo que quieras.
                      <br>Tiene que entrar en su cuenta para ver su saldo de puntos.
                      <br><br>Durante el proceso de compra podrá pagar su pedido con el saldo de puntos.
                      <p align="right"<small><font color="FF6633">*</font>  En la mayoría de los casos, impuestos y gastos de envío están excluidos del cálculo. Lea todas las Preguntas Frecuentes para más detalles.</small></p>');

// FAQ3
define('TEXT_FAQ_3', 'Actualmente, por cada %s en compras en ' . STORE_NAME . ' obtendrá %s Punto(s).
                      <br>Por ejemplo:<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Precio del Producto:</b>&nbsp; %s<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Valor de los Puntos Obtenidos:</b>&nbsp; %s<br><br>
                      Por favor, no olvide que nos reservamos el derecho a ralizar cambios en cualquier momento y sin previo aviso a la conversión anterior. La conversión anterior siempre mostrará la tasa vigente.');

// FAQ4
define('TEXT_FAQ_4', 'Si tiene saldo en su Cuenta de Puntos, puede usar dichos puntos para realizar pagos por compras en ' . STORE_NAME . '.
                      <br>Durante el proceso de su pedido, en la misma página en la que escoge el medio de pago, encontrará una casilla que podrá marcar para emplear todos sus puntos disponibles.
                      Tenga en cuenta que si tiene suficientes puntos para pagar la totalidad de su compra con puntos de bonificación, tendrá que elegir el método de pago \"Puntos\".
                      <br>Al continuar con el proceso de su pedido, en la página de confirmación verá que el valor de los puntos canjeados se habrán restado de su compra.  Una vez que confirme su pedido, su Cuenta de Puntos se actualizará y se restarán de su saldo los puntos usados.
                      <br>Nota: cualquier compra realizada con puntos sólo obterndrá nuevos puntos por la cantidad pagada sin y contar la deducción de los puntos.');


// FAQ5 - conditionnal depending on the point limit value set in admin
define('TEXT_FAQ_5_A', 'Actualmente se requiere un saldo mínimo de <b>%s</b> puntos <b>(%s)' . '</b> para poder canjearlos.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_5_B', 'Actualmente no se requiere un saldo mínimo para canjear sus puntos.  En cualquier caso, si su saldo de puntos no es suficiente, también tendrá que seleccionar una forma de pago para cubrir el importe restante de su pedido 
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ6 - conditionnal depending on the point min amount value set in admin
define('TEXT_FAQ_6_A', 'Actualmente se requiere un importe total mínimo por pedido <b>%s</b> para poder usar sus puntos.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_6_B', 'Actualmente no se requiere un importe mínimo por pedido para poder usar sus puntos.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ7
define('TEXT_FAQ_7', 'El máximo de puntos permitido por compra para ser canjeados es de <b>%s</b> puntos <b>(%s)' . '</b>.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ8 - conditionnal depending on the use point for shipping value set in admin
define('TEXT_FAQ_8_A', 'No. Al calcular los puntos obtenidos, los gastos de envío quedan excluidos.');
define('TEXT_FAQ_8_B', 'Sí. Al calcular los puntos obtenidos, se incluyen los gastos de envío en dicho cálculo.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ9 - conditionnal depending on the value set in admin for ginving point for tax value
define('TEXT_FAQ_9_A', 'No. Al calcular los puntos obtenidos, los impuestos quedan excluidos.
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_9_B', 'Sí. Se incluyen los impuestos en el cálculo de puntos obtenidos. 
	                      <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ10 - conditionnal depending on value set in admin for giving point on specials
define('TEXT_FAQ_10_A', 'No. Al calcular los puntos obtenidos, se excluyen todos los productos con descuento.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_10_B', 'Sí. Al calcular los puntos obtenidos, se incluyen todos los productos con descuento.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ11
define('TEXT_FAQ_11_A', 'No. Al calcular los puntos obtenidos, queda excluida cualquier compra realizada por canjeo de puntos.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_11_B', 'Sí. Por favor, tenga en cuenta que en cualquier compra realizada por canjeo de puntos sólo se premiará con nuevos puntos el importe pagado con otros medios de pago y sin considerar el valor de los puntos canjeados.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ12
define('TEXT_FAQ_12_A', '<em>La publicidad  de "Correr la Voz" es la forma más poderosa de anunciarse.</em>
	                       <br>Los Puntos por Referencias se basan en la idea de que ambas partes deberían beneficiarse de sus recomendaciones.
	                       <br>Cuando un amigo al que se envió una referencia hace un pedido, durante el proceso de compra habrá una casilla  en la misma página en la que se escoge forma de pago para incluir un código de Referencia.
	                       Su código de Referencia es el email con el que se ha registrado con nosotros.
	                       <br>Cuando recibamos pedidos completos y aprobados de sus amigos recomendados, le recompensaremos en su cuenta de Puntos con <b>' .  MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM . '</b> puntos .
	                       <br>Cuantos más primeros pedidos recibamos de sus referencias, más premios en puntos recibirá.');

define('TEXT_FAQ_12_B', 'Actualmente esta característica no está activada.');

// FAQ13
define('TEXT_FAQ_13_A', '<em>"Escribir un Comentario permite que otras personas lean sus opiniones, y puede que incluso seguir su consejo."</em>
                         <br>compartir sus Comentarios de Productos nos ayudará a mejorar constantemente nuestras ofertas y servicios, así como ayudar a otras personas a escoger el producto adecuado.
                         <br>Nos gustaría agradecerle los comentarios útiles que nos ofrece. Por eso, cada comentario de calidad lo recompensaremos en su cuenta de Puntos con un valor en puntos de <b>%s</b>.
                         <br>Su comentario debe cumplir las siguientes condiciones:
                         <ul>
                           <li>Su Comentario debe ser original.</li>
                           <li>Los Comentarios deben centrarse y referirse al producto al que se refiere.</li>
                           <li>Los Comentarios no deberían duplicar contenido ya publicado.</li>
                           <li>Ser veraz y objetivo.</li>
                           <li>Los Comentarios no deberían incluir mensajes que contengan spam, contenido comercial o publicitario, ni enlaces.</li>
                           <li>Los Comentarios no deberían ser abusivos, insultantes o amenazantes para otras personas.</li>
                         </ul>
                         ' . STORE_NAME .' se reserva el derecho a rechazar o eliminar cualquier comentario que no cumpla las anteriores condiciones.
                         <br>' . STORE_NAME .' se reserva el derecho a realizar correcciones en errores ortográficos y/o gramaticales .
                         <br>' . STORE_NAME .' no se responsabiliza en absoluto por las valoraciones y comentarios de sus clientes.');

define('TEXT_FAQ_13_B', 'Actualmente esta característica no está activada.');

// FAQ14
define('TEXT_FAQ_14_A', 'Actualmente sólo se pueden adquirir con su saldo de puntos los siguientes artículos.<ul>%s</ul>');

define('TEXT_FAQ_14_B', 'Actualmente sólo se pueden adquirir los artículos de las siguientes categorías y sus correspondientes sub-categorías usando su saldo de puntos.<ul>%s</ul>');

define('TEXT_FAQ_14_C', 'Actualmente no se aplica ninguna restricción a cuáles productos se pueden comprar usando su saldo de puntos.');

define('TEXT_FAQ_14_D', '<br>Le recomendamos encarecidamente que compruebe con frecuencia esta página para comprobar cambios que podamos realizar en nuestra política.');

// FAQ15
define('TEXT_FAQ_15_A', 'Actualmente no se pueden adquirir productos rebajados con su saldo en puntos.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

define('TEXT_FAQ_15_B', 'Actualmente no hay restricciones aplicables al tipo de productos en oferta que se puedan comprar usando su saldo de puntos.
	                       <br><br>Recomendamos encarecidamente que visite esta página con frecuencia, ya que podemos realizar cambios al respecto.');

// FAQ16
define('TEXT_FAQ_16', '
<ul>
  <li>Los Puntos sólo están disponibles para miembros registrados en ' . STORE_NAME . '.</li>
  <li>Los Premios en Puntos sólo se pueden conseguir y emplear en compras online, y sólo se validan en ' . STORE_NAME . '.</li>
  <li>Los puntos no son monetizables y no pueden transferirse entre miembros.</li>
  <li>Los Puntos no son transferibles o cambiables por dinero bajo ninguna circunstancia.</li>
  <li>Los Puntos no se reembolsarán en pedidos cancelados.</li>
  <li>Al comprar con Puntos, tendrá que escoger además otra  forma de pago si su saldo de Puntos no fuera suficiente para cubrir el total de su pedido.</li>
  <li>Al calcular la cantidad de puntos obtenidos, gastos de envío e impuestos quedan excluidos (salvo noticia en contra. Vea las Preguntas Frecuentes para más detalle).</li>
</ul>
Por favor, tenga en cuenta que nos reservamos el derecho a realizar cambios a nuestra politica sin aviso previo.');

// FAQ17
define('TEXT_FAQ_17', 'Para cualquier aclaración sobre nuestro Programa de premios en Puntos, por favor, <a href="' . tep_href_link('contact_us.php') . '"> <u>contacte con nosotros</u></a>. Asegúrese de facilitarnos toda la información posible en su email.');

// FAQ18 PWA Guest Checkout support
define('TEXT_FAQ_18_A', 'Si usa la opción Compra de Invitados (Comprar sin Cuenta de Cliente):<br>
                         <ul>
                           <li>Durante su primer pedido puede referir a un amigo que le informó sobre nosotros. Su amigo recibirá puntos por referencias.</li>
                           <li>Recibirá puntos por compra, pero solo podrá canjearlos si opta por convertir su Cuenta de Invitado en una Cuenta Regular y establece una contraseña de cuenta una vez que haya finalizado el proceso de compra.</li>
                          </ul>');
define('TEXT_FAQ_18_B', 'Si usa la opción Compra de Invitados (Comprar sin Cuenta de Cliente):<br>
                         <ul>
                           <li>Recibirá puntos por compra, pero solo podrá canjearlos si opta por convertir su Cuenta de Invitado en una Cuenta Regular y establece una contraseña de cuenta una vez que haya finalizado el proceso de compra.</li>
                         </ul>');
define('TEXT_FAQ_18_C', 'Si usa la opción Compra de Invitados (Comprar sin Cuenta de Cliente):<br>
                         <ul>
                           <li>Durante su primer pedido puede referir a un amigo que le informó sobre nosotros. Su amigo recibirá puntos por referencias.</li>
                           <li>No recibirá puntos por compra y no podrá canjear puntos en su siguiente compra.</li>
                         </ul>');
define('TEXT_FAQ_18_D', 'Si usa la opción Compra de Invitados (Comprar sin Cuenta de Cliente), el sistema de puntos no está diponible para Usted.');

// Below is the section that will actually displax on the FAQ page
define('TEXT_INFORMATION', '<a name="Top"></a><span class="pointWarning"><b>Por favor, escoja alguna de las cuestiones siguientes:</b></span>');
?>