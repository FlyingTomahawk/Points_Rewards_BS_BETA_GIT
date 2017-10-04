<?php
/*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/
define('MOD_VER', '1.0');

define('HEADING_TITLE', 'Qualifizierte Bonuspunkte');
define('HEADING_RATE', 'Wechselkurse: ');
define('HEADING_AWARDS', 'Verleiht: ');
define('HEADING_REDEEM', 'Eingelöst: ');
define('HEADING_POINT', 'Punkt');
define('HEADING_POINTS', 'Punkte');
define('HEADING_TITLE_SEARCH', 'Suche nach Namen oder Verfall Monat (z.B. Mai=05)');

define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_DOB', 'Gebursdatum');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_POINTS', 'Punkte');
define('TABLE_HEADING_POINTS_VALUE', 'Wert');
define('TABLE_HEADING_POINTS_EXPIRES', 'Verfalldatum');

define('TABLE_HEADING_SORT', 'Sortiere diese Zeile nach ');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C aufsteigend');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 aufsteigend');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X absteigend');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 absteigend');

define('TEXT_SHOW_ALL', 'Alle anzeigen');
define('TEXT_SORT_CUSTOMERS', 'Kunden anzeigen');
define('TEXT_SORT_POINTS', 'Mit Punkte');
define('TEXT_SORT_NO_POINTS', 'Ohne Punkte');
define('TEXT_SORT_BIRTH', 'Geburtstag diesen Monat');
define('TEXT_SORT_BIRTH_NEXT', 'Geburtstag nächsten Monat');
define('TEXT_SORT_EXPIRE', 'Verfalldatum diesen Monat');
define('TEXT_SORT_EXPIRE_NEXT', 'Verfalldatum nächsten Monat');
define('TEXT_SORT_EXPIRE_WIN', 'Verfalldatum innerhalb einem Monat');


define('TEXT_DATE_ACCOUNT_CREATED', 'Konto erstellt:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Zuletzt bearbeitet:');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Offene Punkte anpassen.');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Gesamtsumme:');
define('TEXT_INFO_NUMBER_OF_PENDING', 'Total offene Punkte:');

define('TEXT_ADD_POINTS', 'Punkte hinzufügen.');
define('TEXT_ADD_POINTS_LONG', 'Sie können Punkte hinzufügen mit oder ohne die Punkte-Auflistung zu aktuallisieren.<br>Bei einer Aktualisierung wird eine Zeile mit Ihrem Kommentar hinzugefügt, oder das Punktekonto aktuallisiert (wenn ein Kommentar in der Kundenbenachrichting hinzugefügt wird) .');
define('TEXT_ADJUST_INTRO', 'Diese Option ermöglicht es Ihnen die Punkte anzupassen before diese Bestätigt werden.<br>Bitte beachten Sie, die offenen Punkte werden somit ersetzt und können nicht rückgängig gemacht werden.');
define('TEXT_DELETE_POINTS', 'Punkte löschen.');
define('TEXT_DELETE_POINTS_LONG', 'Sie können Punkte löschen mit oder ohne die Punkte-Auflistung zu aktuallisieren.<br>Bei einer Aktualisierung wird eine Zeile mit Ihrem Kommentar hinzugefügt, oder das Punktekonto aktuallisiert (wenn ein Kommentar in der Kundenbenachrichting hinzugefügt wird) .');
define('TEXT_POINTS_TO_ADD', 'Punkte zum hinzufügen:');
define('TEXT_POINTS_TO_ADJUST', 'Neuer Punktestand:');
define('TEXT_POINTS_TO_DELETE', 'Punkte zum löschen:');
define('TEXT_COMMENT', 'Kommentar:');

define('TEXT_QUEUE_POINTS_TABLE', 'Punkteauflistiung aktualisieren?');
define('TEXT_NOTIFY_CUSTOMER', 'Kunden benachrichtigen');
define('TEXT_SET_EXPIRE', 'Neues Verfalldatum setzen');

define('BUTTON_TEXT_ADD_POINTS', 'Punkte hinzufügen');
define('BUTTON_TEXT_DELETE_POINTS', 'Punkte löschen');
define('BUTTON_TEXT_ADJUST_POINTS', 'Punktestand anpassen');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bonuspunkte Aktualisierung');
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,');
define('EMAIL_GREET_NONE', 'Liebe(r) %s');
define('EMAIL_TEXT_INTRO', 'Wir möchten Ihnen mitteilen dass Ihr Bonuspunkte-Konto aktualisiert wurde.');
define('EMAIL_TEXT_BALANCE_ADD', 'Glückwünsch! ' . "\n" . 'Wir haben Ihr Konto mit insgesamt %s Punkte im Wert von %s gutgeschrieben.');
define('EMAIL_TEXT_BALANCE_DEL', 'Es tut uns leid, aber Ihrem Bonuspunkte-Konto wurden insgesamt %s Punkte im Wert von %s abgezogen.');
define('EMAIL_TEXT_BALANCE', 'Ihr aktueller Bonuspunktestand ist: %s Punkte im Wert von %s .');
define('EMAIL_TEXT_EXPIRE', 'Die Punkte verfallen am %s .');
define('EMAIL_TEXT_POINTS_URL', 'Link zu Ihrem Bonuspunkte-Konto. %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'Unseren Bonuspunkte FAQ finden Sie hier. %s');
define('EMAIL_TEXT_COMMENT', 'Kommentar: %s');
define('EMAIL_TEXT_SUCCESS_POINTS', 'Die Bonuspunkte stehen Ihrem Konto zur verfügung und können bei Ihrer nächsten Bestellung verwendet werden. '. "\n" .'Vielen Dank für Ihren Einkauf bei ' . STORE_NAME . '.');
define('EMAIL_CONTACT', 'Falls Sie Fragen haben oder Hilfe zu unserem Service brauchen senden Sie uns bitte eine E-Mail an: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Dies ist eine automatisch generierte Nachricht, bitte nicht antworten!');

define('SUCCESS_POINTS_UPDATED', 'Erfolgreich: Bonuspunkte-Konto wurde erfolgreich aktualisiert.');
define('SUCCESS_DATABASE_UPDATED', 'Erfolgreiche Aktualisierung: Die Datenbank wurde erfolgreich aktualisiert und der Punktestatus auf ' . TEXT_POINTS_CANCELLED . ' gesetzt mit folendem Kommentar "%s".');
define('NOTICE_EMAIL_SENT_TO', 'Hinweis: E-Mail gesendet an: %s');
define('WARNING_DATABASE_NOT_UPDATED', 'Warnung: Leere Felder, Nichts zu ändern. Die Datenbank wurde nicht aktualisiert.');
define('POINTS_ENTER_JS_ERROR', 'Ungültiger Eintrag! \n Nur Zahlen werden akzeptiert!');

define('TEXT_LINK_CREDIT', 'Klicken Sie hier um das <a href="customers_points_credit.php"><u>Auto Kredit</u></a> oder <a href="customers_points_expire.php"><u>Auto Verfall</u></a> Skript manuell zu starten.');
?>
