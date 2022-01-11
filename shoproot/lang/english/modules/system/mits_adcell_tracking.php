<?php
/**
 * --------------------------------------------------------------
 * File: mits_cron_database_backups.php
 * Created by PhpStorm
 * Date: 23.05.2018
 * Time: 16:38
 *
 * Author: Hetfield
 * Copyright: (c) 2018 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 *
 * Released under the GNU General Public License
 * --------------------------------------------------------------
 */

$adcell_pid = (defined('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID') && MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID != '') ? MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID : '<span style="color:red;"><i>X</i></span>';

define('MODULE_MITS_ADCELL_TRACKING_TEXT_TITLE', 'MITS ADCELL Tracking <span style="white-space:nowrap;">&copy; by <span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (<a href="https://www.merz-it-service.de/" target="_blank">MerZ IT-SerVice</a>)</span></span>');
define('MODULE_MITS_ADCELL_TRACKING_TEXT_DESCRIPTION', '
   <div> 
    <a href="https://www.merz-it-service.de/" target="_blank">
        <img src="' . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="" style="display:block;max-width:100%;height:auto;" />
    </a><br />    
    <div>    
      <p>Mit diesem Modul k&ouml;nnen Sie das Affiliate Tracking der First Lead GmbH / ADCELL in die modified eCommerce Shopsoftware integrieren. </p>
      <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
      <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>
    </div>
  </div>
');
define('MODULE_MITS_ADCELL_TRACKING_STATUS_TITLE', 'Modul aktivieren?');
define('MODULE_MITS_ADCELL_TRACKING_STATUS_DESC', 'M&ouml;chten sie dieses Modul aktivieren?');
define('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID_TITLE', 'ProgrammID (ADCELL)');
define('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID_DESC', 'Tragen Sie hier die ProgrammID ein.');
define('MODULE_MITS_ADCELL_TRACKING_EVENT_ID_TITLE', 'EventID (ADCELL)');
define('MODULE_MITS_ADCELL_TRACKING_EVENT_ID_DESC', 'Tragen Sie hier die EventID ein.');
define('MODULE_MITS_ADCELL_TRACKING_RETARGETING_TITLE', 'Retargeting aktivieren?');
define('MODULE_MITS_ADCELL_TRACKING_RETARGETING_DESC', 'Soll das Retargeting aktiviert werden?');
define('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID_TITLE', 'PURPOSE-ID');
define('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID_DESC', 'Tragen Sie hier die PURPOSE-ID vom Cookie Consent Modul ein, falls Sie dort ADCELL eingerichtet haben.<div style="margin-top:10px;padding:10px;background:#fff;border:1px solid #f00;"><strong style="font-size: 10px;">Cookies, die f&uuml;r das ADCELL-Tracking verwendet werden und in das Cookie Consent Modul eingetragen werden m&uuml;ssen:</strong>
<ul style="font-size:10px;">
  <li>
    <strong>ADCELLpid' . $adcell_pid . '</strong><br />
    Dieser Cookie wird gesetzt nach dem Klick auf ein ADCELL Werbemittel und enth&auml;lt Informationen &uuml;ber Publisher, Werbemittel, SubID, Referrer und Zeitstempel. Das X im Cookie-Namen steht f&uuml;r die ProgrammID des Werbemittels. Die G&uuml;ltigkeitsdauer des Cookies ist abh&auml;ngig vom entsprechenden Programm.
  </li>
  <li>
    <strong>ADCELLspid' . $adcell_pid . '</strong><br />
    Dieser Cookie wird gesetzt nach dem Klick auf ein ADCELL Werbemittel und enth&auml;lt Informationen &uuml;ber Publisher, Werbemittel, SubID, Referrer und Zeitstempel. Das X im Cookie-Namen steht f&uuml;r die ProgrammID des Werbemittels. Der Cookie wird nach Beenden des Browsers gel&ouml;scht.
  </li>
  <li>
    <strong>ADCELLvpid' . $adcell_pid . '</strong><br />
    Dieser Cookie wird gesetzt nach dem Ausspielen eines ADCELL Werbemittels und enthält Informationen über Publisher, Werbemittel, SubID, Referrer und Zeitstempel. Das X im Cookie-Namen steht für die ProgrammID des Werbemittels. Die Gültigkeitsdauer des Cookies ist abhängig vom entsprechenden Programm.
  </li>
  <li>
    <strong>ADCELLjh' . $adcell_pid . '</strong><br />
    Dieser Cookie wird nach wiederholtem Ausspielen oder Klicken auf ein ADCELL Werbemittel gesetzt. Damit wird der Weg des Nutzers &uuml;ber die verschiedenen Publisher nachvollzogen. Das X im Cookie-Namen steht f&uuml;r die ProgrammID des Werbemittels.
  </li>
  <li>
    <strong>ADCELLnoTrack</strong><br />
    Dieser Cookie wird gesetzt, wenn der Nutzer nicht getrackt werden m&ouml;chte. In Gegenwart des Cookies werden keine Cookies gesetzt, die au&szlig;erhalb des Surfens auf www.adcell.de gesetzt werden k&ouml;nnten. 
  </li>
</ul>
</div>');

