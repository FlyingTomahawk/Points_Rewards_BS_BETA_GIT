<?php
/*
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/
define('MOD_VER', '1.0');

define('HEADING_TITLE', 'Offene Bonuspunkte');
define('HEADING_RATE', 'Wechselkurse: ');
define('HEADING_AWARDS', 'Verleiht: ');
define('HEADING_REDEEM', 'Eingelöst: ');
define('HEADING_POINT', 'Punkt');
define('HEADING_POINTS', 'Punkte');
define('HEADING_TITLE_SEARCH', 'Suche Kunden ID:');

define('TABLE_HEADING_CUSTOMERS', 'Kunden');
define('TABLE_HEADING_ORDER_TOTAL', 'Gesamtsumme');
define('TABLE_HEADING_ORDERS_STATUS', 'Bestellstatus');
define('TABLE_HEADING_POINTS_STATUS', 'Punktestatus');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_POINTS', 'Punkte');
define('TABLE_HEADING_POINTS_VALUE', 'Wert');

define('TABLE_HEADING_SORT', 'Sortiere diese Zeile nach ');
define('TABLE_HEADING_SORT_UA', ' --> A-B-C aufsteigend');
define('TABLE_HEADING_SORT_U1', ' --> 1-2-3 aufsteigend');
define('TABLE_HEADING_SORT_DA', ' --> Z-Y-X absteigend');
define('TABLE_HEADING_SORT_D1', ' --> 3-2-1 absteigend');

define('TEXT_DEFAULT_COMMENT', 'Bonuspunkte');
define('TEXT_DEFAULT_REDEEMED', 'Empfehlungspunkte');

define('TEXT_POINTS_PENDING', 'Offen');
define('TEXT_POINTS_PROCESSING', 'In Bearbeitung');
define('TEXT_POINTS_CONFIRMED', 'Bestätigt');
define('TEXT_POINTS_CANCELLED', 'Storniert');
define('TEXT_POINTS_REDEEMED', 'Eingelöst');

define('TEXT_SHOW_ALL', 'Alle anzeigen');

define('TEXT_INFO_POINTS_COMMENT', 'Aktueller Punkte-Kommentar: ');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart: ');

define('TEXT_INFO_HEADING_ADJUST_POINTS', 'Offene Punkte anpassen.');
define('TEXT_INFO_HEADING_DELETE_RECORD', 'Eintrag löschen');
define('TEXT_INFO_HEADING_PENDING_NO', 'Offene Punkte für Bestellnr.');
define('TEXT_CONFIRM_POINTS', 'Offene Punkte bestätigen?');
define('TEXT_CONFIRM_POINTS_LONG', 'Sie können die Punkte bestätigen ohne die Punkte-Auflistung zu aktuallisieren.<br>Punktebestätigungen ohne Aktualisierung werden aus der Datenbank entfernt und der aktuelle Punktestand wird durch "Bestätigt" ersetzt.');
define('TEXT_CANCEL_POINTS', 'Offene Punkte stornieren?');
define('TEXT_CANCEL_POINTS_LONG', 'Sie können die Punkte stornieren ohne die Punkte-Auflistung zu aktuallisieren.<br>Punktestornierungen ohne Aktualisierung werden aus der Datenbank entfernt oder der aktuelle Punktestand wird durch "Storniert" und der Standard-Kommentar wird durch Ihren Kommentar ersetzt.');
define('TEXT_CANCELLATION_REASON', 'Stornierungsgrund:');
define('TEXT_ADJUST_INTRO', 'Diese Option ermöglicht es Ihnen die Punkte anzupassen before diese Bestätigt werden.<br>Bitte beachten Sie, die offenen Punkte werden somit ersetzt und können nicht rückgängig gemacht werden.');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher dass Sie diesen Eintrag löschen möchten?<br>Der Eintrag wird aus der Datenbank gelöscht.');
define('TEXT_POINTS_TO_ADJUST', 'Neuer Punktestand:');
define('TEXT_ROLL_POINTS', 'Punkte zurücksetzen');
define('TEXT_ROLL_POINTS_LONG', 'Diese Option ermöglichtes Ihnen bereits Bestätigte Punkte in den Status "Offen" zu setzen.<br>Die Punkte werden dem Kundenkonto abgezogen und der Status auf "Offen" gesetzt.');
define('TEXT_ROLL_REASON', 'Zurücksetz-Grund:');

define('TEXT_QUEUE_POINTS_TABLE', 'Punkteauflistiung aktualisieren?');
define('TEXT_NOTIFY_CUSTOMER', 'Kunden benachrichtigen');
define('TEXT_SET_EXPIRE', 'Neues Verfalldatum setzen');

define('BUTTON_TEXT_ADJUST_POINTS', 'Punkte anpassen');
define('BUTTON_TEXT_CANCEL_PENDING_POINTS', 'Punkte stornieren');
define('BUTTON_TEXT_CONFIRM_PENDING_POINTS', 'Punkte bestätigen');
define('BUTTON_TEXT_REMOVE_RECORD', 'Eintrag löschen');
define('BUTTON_TEXT_ROLL_POINTS', 'Punkte zurücksetzen');
define('ICON_PREVIEW_EDIT', 'Bestelldetails einsehen oder Status ändern');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bonuspunkte Aktualisierung');
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,');
define('EMAIL_GREET_NONE', 'Liebe(r) %s');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnr.:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_ORDER_STAUTS', 'Bestellstatus:');
define('EMAIL_TEXT_INTRO', 'Wir möchten Ihnen mitteilen dass Ihr Bonuspunkte-Konto aktualisiert wurde.');
define('EMAIL_TEXT_BALANCE_CANCELLED', 'Es tut uns leid, aber wir mussten Ihre Punkte für die folgenden Details stornieren.');
define('EMAIL_TEXT_BALANCE_CONFIRMED', 'Punkte für die folgenden Details bestätigt.');
define('EMAIL_TEXT_BALANCE_ROLL_BACK', 'Bestätigte Punkte für die folgenden Details wurden in den vorherigen Status zurückgesetzt.');
define('EMAIL_TEXT_ROLL_COMMENT', 'Kommentar:');
define('EMAIL_TEXT_BALANCE', 'Ihr aktueller Bonuspunktestand ist: %s im Wert von %s .');
define('EMAIL_TEXT_EXPIRE', 'Die Punkte sind gültig bis am: %s .');
define('EMAIL_TEXT_POINTS_URL', 'Link zu Ihrem Bonuspunkte-Konto. %s');
define('EMAIL_TEXT_POINTS_URL_HELP', 'Unseren Bonuspunkte FAQ finden Sie hier. %s');
define('EMAIL_TEXT_COMMENT', 'Stornierungsgrund:');
define('EMAIL_TEXT_SUCCESS_POINTS', 'Die Bonuspunkte stehen Ihrem Konto zur verfügung und können bei Ihrer nächsten Bestellung verwendet werden. '. "\n" .'Vielen Dank für Ihren Einkauf bei ' . STORE_NAME . '.');
define('EMAIL_CONTACT', 'Falls Sie Fragen haben oder Hilfe zu unserem Service brauchen senden Sie uns bitte eine E-Mail an: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n" . 'Dies ist eine automatisch generierte Nachricht, bitte nicht antworten!');
//Auto Remainder bof
define('EMAIL_EXPIRE_SUBJECT', 'Bonuspunkte verfallen in ' . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_EXPIRES_REMIND.' Tag(en)');
define('EMAIL_EXPIRE_INTRO', 'Dies ist eine automatisch generierte Erinnerung.');
define('EMAIL_EXPIRE_DET', 'Ihr aktueller Punktestand ist %s Punkte, die Punkte verfallen am %s .');
define('EMAIL_EXPIRE_TEXT', 'Nach diesem Datum werden alle Ihre kumulierten Bonuspunkte verfallen und Sie fangen somit wieder von Neuem an.');
//Auto Remainder eof
define('SUCCESS_POINTS_UPDATED', 'Erfolgreich: Bonuspunkte-Konto wurde erfolgreich aktualisiert.');
define('SUCCESS_DATABASE_UPDATED', 'Erfolgreiche Aktualisierung: Die Datenbank wurde erfolgreich aktualisiert und der Punktestatus auf ' . TEXT_POINTS_CANCELLED . ' gesetzt mit folendem Kommentar "%s".');
define('NOTICE_EMAIL_SENT_TO', 'Hinweis: E-Mail gesendet an: %s');
define('NOTICE_RECORED_REMOVED', 'Hinweis: Die Punkteeintragreihe Nr. %s wurde aus der Datenbank gelöscht.');
define('WARNING_DATABASE_NOT_UPDATED', 'Warnung: Leere Felder, Nichts zu ändern. Die Datenbank wurde nicht aktualisiert.');
define('POINTS_ENTER_JS_ERROR', 'Ungültiger Eintrag! \n Nur Zahlen werden akzeptiert!');

define('TEXT_LINK_CREDIT', 'Klicken Sie hier um das <a target="_blank" href="customers_points_credit.php"><u>Auto Kredit</u></a> oder <a target="_blank" href="customers_points_expire.php"><u>Auto Verfall</u></a> Skript manuell zu starten.');

define('INSTALL_CHECK_HT_WARNING', 'Das benötigte <strong>Bonuspunkte Header Tags Modul</strong> ist nicht installiert.');
define('INSTALL_CHECK_HT_INSTALL_NOW', '<u>Installieren Sie jetzt das Bonuspunkte Header Tags Modul</u>');
define('INSTALL_CHECK_OT_WARNING', 'Das benötigte <strong>Bonuspunkte Order Total Modul</strong> ist nicht installiert.');
define('INSTALL_CHECK_OT_INSTALL_NOW', '<u>Installieren Sie jetzt das Bonuspunkte Order Total Modul</u>');
define('INSTALL_CHECK_PM_WARNING', 'Das benötigte <strong>Punkte Zahlungsart Modul</strong> ist nicht installiert.');
define('INSTALL_CHECK_PM_INSTALL_NOW', '<u>Installieren Sie jetzt das Punkte Zahlungsart Modul</u>');

?>
