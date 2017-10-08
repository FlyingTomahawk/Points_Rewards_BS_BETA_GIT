<?php
/*
  $Id: points.php
  $Loc: catalog/includes/languages/english/hooks/shop/checkout_payment/

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

// used in checkout_payment
define('POINTS_HOOK_CHECKOUT_PAYMENT_REDEEM_SYSTEM', 'Einlösen der Bonuspunkte ');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REFERRAL', 'Empfehlungssystem');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REDEEM_SYSTEM_START', 'Sie haben einen Kredit von %s möchten Sie damit Ihre Bestellung bezahlen?<br />Die geschätzte Gesamtsumme Ihres Einkaufs ist: %s .');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REDEEM_SYSTEM_SPENDING', 'Aktivieren Sie das Kontrollkästchen, um die maximal zulässigen Punkte für diese Bestellung zu verwenden. (%s Punkte %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REDEEM_SYSTEM_PAYING',  'Bitte wählen Sie die "Punkte" Zahlungsart um die gesamte Bestellung mit Punkten zu bezahlen. (%s points %s)&nbsp;&nbsp;<i class="fa fa-arrow-right"></i>');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">Die Gesamtsumme ist grösser als die maximal erlaubten Bonuspunkte. Sie müssen zusätzlich eine Zahlungsart auswählen.</span>');
define('POINTS_HOOK_CHECKOUT_PAYMENT_REFERRAL_REFERRED', 'Falls Sie von einem unserer Kunden empfohlen wurden geben Sie bitte hier die E-Mailadresse dieses Kunden ein.');
