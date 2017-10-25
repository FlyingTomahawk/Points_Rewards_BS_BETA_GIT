<?php
/*
  $Id: my_points_help.php
  $Loc: catalog/includes/languages/german/
  
   Version: 1.1
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
   $answer_expire = 'Die Belohnungsantwort läuft ' . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES . ' Monate nach dem Aufgabedatum ab.';
 } else {
   $answer_expire = 'Die Belohnungsantwort hat kein Verfalldatum und kann akkumuliert werden bis Sie diese Einsetzen möchten.';
 }

if (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE > 1) {
  $point_or_answer = 'answer';
} else {
  $point_or_answer = 'point';
}

// Definition if the navigation bar and page title
define('NAVBAR_TITLE', 'Bonuspunkte Fragen & Antworten');
define('HEADING_TITLE', 'Bonuspunkte Fragen & Antworten');

// Definitions of the FAQ questions
define('POINTS_FAQ_1', '1. Was ist das Bonuspunkte System?');
define('POINTS_FAQ_2', '2. Wie funktioniert das System?');
define('POINTS_FAQ_3', '3. Bonuspunkte und deren Wert');
define('POINTS_FAQ_4', '4. Einlösen der Bonuspunkte');
define('POINTS_FAQ_5', '5. Mindestpunkte erforderlich');
define('POINTS_FAQ_6', '6. Mindestkaufbetrag erforderlich');
define('POINTS_FAQ_7', '7. Maximal Bonuspunkte pro Bestellung');
define('POINTS_FAQ_8', '8. Kriege Ich Bonuspunkte für Versandkosten?');
define('POINTS_FAQ_9', '9. Kriege Ich Bonuspunkte für Mehrwertsteuer?');
define('POINTS_FAQ_10', '10. Kriege Ich Bonuspunkte für bereits reduzierte Produkte?');
define('POINTS_FAQ_11', '11. Kriege Ich Bonuspunkte für Bestellungen die mit Punkten bezahlt wurden?');
define('POINTS_FAQ_12', '12. Verdienen Sie Empfehlungspunkte');
define('POINTS_FAQ_13', '13. Verdienen Sie Bonuspunkte indem Sie eine Produktbewertung schreiben');
define('POINTS_FAQ_14', '14. Produkt-Einschränkungen');
define('POINTS_FAQ_15', '15. Sonderangebots-Einschränkungen');
define('POINTS_FAQ_16', '16. Nutzungsbedingungen');
define('POINTS_FAQ_17', '17. Falls Probleme auftauchen');
define('POINTS_FAQ_18', '18. Bestellungen mit Gastkonto'); // PWA Guest Checkout support

// Definition of the answer for each of the questions:

// FAQ1
define('TEXT_FAQ_1', 'Als Dank für Ihre bisherige Treue und als kleinen Ansporn für zukünftige Einkaufe haben wir für Sie das Bonuspunkte System ins leben gerufen.
                      <br><br>Unser Bonuspunkte System ist ganz einfach.  Während des Einkaufs bei ' . STORE_NAME . ' können Sie für das ausgegebene Geld Bonuspunkte verdienen.
                      <br>Diese Bonuspunkte können dann wiederum beim nächsten Einkauf bei ' . STORE_NAME . ' eingelöst werden.');

// FAQ2
define('TEXT_FAQ_2', 'Nachdem eine Bestellung getätigt wurde, wird der Gesamtwert<small><font color="FF6633">*</font></small> der Bestellung verwendet um die verdienten Bonuspunkte zu berechnen.
					  Diese Bonuspunkte werden in Ihrem Kundenkonto als offene Punkte angezeigt.
                      <br>Alle offenen Bonuspunkte werden in Ihrem <a href="' . tep_href_link('my_points.php') . '"> <u>Kundenkonto</u></a> aufgelisted bis diese von ' . STORE_NAME . ' bestätigt werden.
			          <br><br>Sobald die Punkte bestätigt wurden, werden diese Ihrem Konto gutgeschrieben und stehen Ihnen dann jederzeit zur Verfügung.
                      <br>Um den aktuellen Status der Punkte einzusehen müssen Sie angemeldet sein. 
                      <br><br>Wenn Sie zur Kasse gehen haben Sie die Möglichkeit Ihre Punkte einzulösen.
                      <p align="right"<small><font color="FF6633">*</font> in den meisten Fällen exklusive Versand und MwSt.</small></p>');

// FAQ3
define('TEXT_FAQ_3', 'Derzeit wird für ' .  $currencies->format(1) . ' die Sie bei ' . STORE_NAME . ' ausgeben jeweils ' . number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE,MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES)  . ' Punkt(e) gutgeschrieben.
                      <br>Zum Beispiel:<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Produktkosten:</b>&nbsp; ' .  $currencies->format(100) . '<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Wert der verdienten Punkte:</b>&nbsp; ' .  $currencies->format(tep_calc_shopping_pvalue(100 * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE)) . '<br><br>
                      Bitte beachten Sie dass wir jederzeit ohne Vorankündigung den Wechselkurs anpassen können. Hier sehen Sie immer den aktuellen Wert.');

// FAQ4
define('TEXT_FAQ_4', 'Falls Bonuspunkte in Ihrem Konto vorhanden sind können Sie diese bei Ihren Einkäufen bei ' . STORE_NAME . ' einlösen.
                      <br>Wärend des Checkouts, auf der gleichen Seite wo die Zahlungsweise ausgewählt werden kann, wird eine sogenannte Checkbox oder Kontrollkästchen angezeigt. Markieren Sie das Kontrollkästchen um die vorhandenen Bonuspunkte zu verwenden.
                      Bitte beachten Sie, falls sie genügend Punkte haben um Ihren gesamten Einkauf mit Bonuspunkten zu bezahlen, die Zahlungsweise \"Punkte\" auswählen müssen.
                      <br>Wenn Sie mit dem Checkout fortfahren werden Sie auf der Bestätigungsseite sehen dass die Punkte vom Gesamtwert abgezogen sind. Sobald Sie Ihre Bestellung bestätigen, wird Ihr Bonuspunktestand aktualisiert und die Punkte werden von Ihrem Konto abgezogen.
                      <br>Beachten Sie dass Sie nur neue Bonuspunkte erhalten für den Betrag der nicht mit Punkten bezahlt wurde.');


// FAQ5 - conditionnal depending on the point limit value set in admin
define('TEXT_FAQ_5_A', 'Derzeit benötigen Sie mindestens <b>%s</b> Punkte <b>(%s)' . '</b> um diese einzulösen.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

define('TEXT_FAQ_5_B', 'Derzeit ist kein Mindestpunkteguthaben erforderlich, um Ihre Bonuspunkte einzulösen. Bitte beachten Sie dass Sie trotzdem eine Zahlungsart auswählen müssen falls Sie nicht genug Punkte besitzen um den Gesamtbetrag Ihres Einkaufs zu begleichen.<br>
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ6 - conditionnal depending on the point min amount value set in admin
define('TEXT_FAQ_6_A', 'Derzeit wird ein Mindest Gesamtbetrag von <b>%s</b> pro Einkauf benötigt um die Bonuspunkte einlösen zu können.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');
						  
define('TEXT_FAQ_6_B', 'Derzeit wird kein Mindest Gesamtbetrag benötigt um Bonuspunkte einzulösen.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ7
define('TEXT_FAQ_7', 'Derzeit können Sie maximal <b>%s</b> Punkte <b>(' . $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE)) . ')' . '</b> pro Bestellung einlösen.
                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ8 - conditionnal depending on the use point for shipping value set in admin
define('TEXT_FAQ_8_A', 'Nein. Bei der Punkteberechnung werden die Versandkosten nicht berücksichtigt.');
define('TEXT_FAQ_8_B', 'Ja. Bei der Punkteberechnung werden die Versandkosten hinzugefügt.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ9 - conditionnal depending on the value set in admin for ginving point for tax value
define('TEXT_FAQ_9_A', 'Nein. Bei der Punkteberechnung wird die Mehrwertsteuer nicht berücksichtigt.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

define('TEXT_FAQ_9_B', 'Ja. Bei der Punkteberechnung wird die Mehrwertsteuer hinzugefügt.
	                      <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ10 - conditionnal depending on value set in admin for giving point on specials
define('TEXT_FAQ_10_A', 'Nein. Bei der Punkteberechnung werden die Sonderangebote oder Produkte im Ausverkauf nicht berücksichtigt.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

define('TEXT_FAQ_10_B', 'Ja. Bei der Punkteberechnung werden die Sonderangebote oder Produkte im Ausverkauf hinzugefügt.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ11
define('TEXT_FAQ_11_A', 'Nein. Für Bestellungen bei denen Bonuspunkte eingelöst wurden gibt es keine neuen Punkte.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

define('TEXT_FAQ_11_B', 'Ja. Bitte beachten Sie dass es nur Punkte für den Betrag gibt der nicht mit Punkten beglichen worden ist.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ12
define('TEXT_FAQ_12_A', '<em>"Mund zu Mund" Werbung ist die stärkste und effektivste Werbung.</em>
	                       <br>Die Idee hinter den sogennanten Empfehlungspunkten ist, beide Parteien profitieren zu lassen.
	                       <br>Wenn ein empfohlener Freund oder Verwandter eine Bestellung tätigt kann er wärend dem Checkoutprozess bei den Zahlungsarten in einer Box Ihre E-Mailadresse als Referenz eingeben.
	                       <br>When die Bestellung des empfohlenen Freundes bestätigt und abgschlossen ist, werden wir Ihrem Kundenkonto <b>' .  MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM . '</b> Punkte gutschreiben.');

define('TEXT_FAQ_12_B', 'Diese Funktion ist zur Zeit deaktiviert.');

// FAQ13
define('TEXT_FAQ_13_A', '<em>"Eine Bewertung schreiben ist sehr hilfreich für andere Kunden, und evtl. wird der eine oder andere auf Ihren Rat hören."</em>
                         <br>Produktbewertungen helfen uns unser Sortiment und Service zu verbessern und hilft anderen bei der Auswahl des richtigen Produkts.
                         <br>Wir möchten uns bei Ihnen für Ihre Bewertung bedanken und werden Ihrem Kundenkonto <b>%s</b> Punkte gutschreiben.
                         <br>Ihre Bewertung muss alle folgenden Bedingungen erfüllen:
                         <ul>
                           <li>Ihre Bewertung muss originell sein</li>
                           <li>Bewertungen sollten nicht bereits veröffentlichte Inhalte duplizieren.</li>
                           <li>Bewertungen müssen wahrheitsgetreu und objektiv sein.</li>
                           <li>Bewertungen sollten kein Spam, Werbung in jeglicher Form oder Links beinhalten.</li>
                           <li>Bewertungen sollten nicht die persönliche Sicherheit des anderen missbrauchen, belästigen oder bedrohen.</li>
                         </ul>
                         ' . STORE_NAME .' behält sich das Recht vor, eine Bewertung abzulehnen oder zu entfernen, die den oben genannten Bedingungen nicht entspricht.
                         <br>Das ' . STORE_NAME .' Personal behält sich das Recht vor, falsch geschriebene Wörter oder grammatikalische Fehler zu korrigieren.
                         <br>' . STORE_NAME .' ist nicht verantwortlich oder haftbar in irgendwelcher Weise für Bewertungen die von Kunden geschrieben wurden.');

define('TEXT_FAQ_13_B', 'Diese Funktion ist zur Zeit deaktiviert.');

// FAQ14
define('TEXT_FAQ_14_A', 'Derzeit können nur folgende Produkte mit Bonuspunkten bezahlt werden.<ul>%s</ul>');

define('TEXT_FAQ_14_B', 'Derzeit können nur Produkte aus folgenden Kategorien mit Bonuspunkten bezahlt werden.<ul>%s</ul>');

define('TEXT_FAQ_14_C', 'Derzeit gelten keine Einschränkungen.');

define('TEXT_FAQ_14_D', '<br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ15
define('TEXT_FAQ_15_A', 'Derzeit können keine Sonderangebote mit Bonuspunkten bezahlt werden.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

define('TEXT_FAQ_15_B', 'Derzeit gelten keine Einschränkungen für Sonderangebote.
	                       <br><br>Wir empfehlen Ihnen regelmässig hier vorbei zu schauen da die Richtlinen sich ändern können.');

// FAQ16
define('TEXT_FAQ_16', '
<ul>
  <li>Bonuspunkte sind nur für registrierte ' . STORE_NAME . ' Kunden verfügbar.</li>
  <li>Bonuspunkte können nur online bei ' . STORE_NAME . ' eingelöst werden.</li>
  <li>Bonuspunkte sind nicht rückzahlbar und können nicht zwischen Kunden übertragen werden.</li>
  <li>Bonuspunkte sind unter keinen Umständen übertragbar oder gegen Bargeld umtauschbar.</li>
  <li>Bonuspunkte werden für stornierte Bestellungen nicht zurückerstattet.</li>
  <li>Bei Einkäufen mit Bonuspunkten müssen Sie trotzdem eine Zahlungsart auswählen falls Sie nicht genug Punkte besitzen um den Gesamtbetrag Ihres Einkaufs zu begleichen.</li>
</ul>
Bitte beachten Sie dass wir jederzeit ohne Vorankündigung die Richtlinien ändern können.');

// FAQ17
define('TEXT_FAQ_17', 'Falls Sie weitere Fragen zu unserem Bonuspunkte System haben nehmen Sie bitte mit uns <a href="' . tep_href_link('contact_us.php') . '"> <u>Kontakt</u></a> auf.');

// FAQ18 PWA Guest Checkout support
define('TEXT_FAQ_18_A', 'Wenn Sie die Option "Gast Checkout (Purchase Without Account)" verwenden:<br>
                         <ul>
                           <li>Während Ihrer ersten Bestellung können Sie einen Freund oder Verwandten vermitteln, der Ihnen von uns erzählt hat. Dein Freund erhält dann Empfehlungspunkte.</li>
                           <li>Sie erhalten Bonuspunkte, die Sie jedoch nur einlösen können, wenn Sie Ihr Gastkonto in ein reguläres Konto umwandeln und nach Abschluss des Bestellvorgangs ein Kontopasswort festlegen.</li>
                          </ul>');
define('TEXT_FAQ_18_B', 'Wenn Sie die Option "Gast Checkout (Purchase Without Account)" verwenden:<br>
                         <ul>
                           <li>Sie erhalten Bonuspunkte, die Sie jedoch nur einlösen können, wenn Sie Ihr Gastkonto in ein reguläres Konto umwandeln und nach Abschluss des Bestellvorgangs ein Kontopasswort festlegen.</li>
                         </ul>');
define('TEXT_FAQ_18_C', 'Wenn Sie die Option "Gast Checkout (Purchase Without Account)" verwenden:<br>
                         <ul>
                           <li>Während Ihrer ersten Bestellung können Sie einen Freund oder Verwandten vermitteln, der Ihnen von uns erzählt hat. Dein Freund erhält dann Empfehlungspunkte.</li>
                           <li>Sie erhalten keine Bonuspunkte und können keine Punkte bei Ihrer nächsten Bestellung einlösen.</li>
                         </ul>');
define('TEXT_FAQ_18_D', 'Wenn Sie die Option "Gast Checkout (Purchase Without Account)" verwenden, ist das Punkte-System nicht verfügbar.');

// Below is the section that will actually displax on the FAQ page
define('TEXT_INFORMATION', '<a name="Top"></a><span class="pointWarning"><b>Bitte wählen Sie aus einem der folgenden Themen:</b></span>');
?>