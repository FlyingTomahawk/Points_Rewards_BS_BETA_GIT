<?php
/*
  $Id: points_hooks.php
  $Loc: catalog/includes/languages/english/hooks/shop/points/

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/

// used in several places
define('POINTS_HOOK_INFORMATION_MY_POINTS_HELP', 'Bonuspunkte Fragen & Antworten');

// used in create account
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_WELCOME_POINTS', '<li><strong>Bonuspunkte System</strong> - Als kleines Willkommensgeschenk für neue Kunden haben wir Ihrem %s %s Bonuspunkte im Wert von %s gutgeschrieben.' . "\n" . 'Für weiter Informationen lesen Sie bitte unsere %s .');
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_ACCOUNT', 'Bonuspunkte Konto');
define('POINTS_HOOK_CREATE_ACCOUNT_EMAIL_POINTS_FAQ', 'Bonuspunkte Fragen & Antworten');

// used in create account success
define('POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_TITLE', 'As part of our Welcome to new customers, we have credited your account <u>%s</u> with a total of %s Shopping Points, worth %s .');
define('POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_TITLE', 'Als kleines Willkommensgeschenk für neue Kunden haben wir Ihrem Konto <u>%s</u> ein Total von %s Bonuspunkte, im Wert von %s gutgeschrieben.');
define('POINTS_HOOK_CREATE_ACCOUNT_SUCCESS_WELCOME_POINTS_LINK', 'Für weiter Informationen lesen Sie bitte unsere <u>%s</u> .');

// used in checkout_payment
define('TABLE_HEADING_REDEEM_SYSTEM', 'Einlösen der Bonuspunkte');
define('TABLE_HEADING_REFERRAL', 'Empfehlungssystem');
define('TEXT_REDEEM_SYSTEM_START', 'Sie haben einen Kredit von %s möchten Sie damit Ihre Bestellung bezahlen?<br />Die geschätzte Gesamtsumme Ihres Einkaufs ist: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Aktivieren Sie das Kontrollkästchen, um die maximal zulässigen Punkte für diese Bestellung zu verwenden. (%s Punkte %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('TEXT_REDEEM_SYSTEM_PAYING',  'Bitte wählen Sie die "Punkte" Zahlungsart um die gesamte Bestellung mit Punkten zu bezahlen. (%s points %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">Die Gesamtsumme ist grösser als die maximal erlaubten Bonuspunkte. Sie müssen zusätzlich eine Zahlungsart auswählen.</span>');
define('TEXT_REFERRAL_REFERRED', 'Falls Sie von einem unserer Kunden empfohlen wurden geben Sie bitte hier die E-Mailadresse dieses Kunden ein.');

// used in checkout_confirmation.php
  define('POINTS_HOOKS_ERROR_POINTS_NOT', 'Sie haben nicht genug Punkte um die gesamte Bestellung zu bezahlen. Bitte wählen Sie eine andere Zahlungsart.');
  define('POINTS_HOOK_ERROR_NOT_VALID', 'Die E-Mailadresse scheint nicht gültig zu sein - bitte korrigieren Sie Ihren Eintrag.');
  define('POINTS_HOOK_ERROR_NOT_FOUND', 'Die eingegebene E-Mailadresse wurde nicht gefunden.');
  define('POINTS_HOOK_ERROR_SELF', 'Guter Versuch, aber Sie können sich nicht selber empfehlen.');
