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

define('MODULE_MITS_ADCELL_TRACKING_TITLE', 'MITS ADCELL Tracking <span style="white-space:nowrap;">&copy; by <span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (<a href="https://www.merz-it-service.de/" target="_blank">MerZ IT-SerVice</a>)</span></span>');
define('MODULE_MITS_ADCELL_TRACKING_DESCRIPTION', '
   <div> 
    <a href="https://www.merz-it-service.de/" target="_blank">
        <img src="' . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="" style="display:block;max-width:100%;height:auto;" />
    </a><br />    
    <div>    
      <p>With this module you can integrate the affiliate tracking of First Lead GmbH / Adcell into the modified eCommerce shop software. </p>
      <p>If you have any questions, problems or wishes for this module or other concerns about the modified eCommerce shop software, simply contact us:</p> 
      <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Contact page on merz-it-service.de</strong></a></div>
    </div>
  </div>
');
define('MODULE_MITS_ADCELL_TRACKING_STATUS_TITLE', 'Activate module?');
define('MODULE_MITS_ADCELL_TRACKING_STATUS_DESC', 'Would you like to activate this module?');
define('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID_TITLE', 'ProgrammID (ADCELL)');
define('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID_DESC', 'Enter the ProgrammID here.');
define('MODULE_MITS_ADCELL_TRACKING_EVENT_ID_TITLE', 'EventID (ADCELL)');
define('MODULE_MITS_ADCELL_TRACKING_EVENT_ID_DESC', 'Enter the EventID here.');
define('MODULE_MITS_ADCELL_TRACKING_RETARGETING_TITLE', 'Activate retargeting?');
define('MODULE_MITS_ADCELL_TRACKING_RETARGETING_DESC', 'Should retargeting be activated?');
define('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID_TITLE', 'PURPOSE-ID');
define('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID_DESC', 'Enter the Purpose ID from the Cookie Consent module here if you have set up Adcell.<div style="margin-top:10px;padding:10px;background:#fff;border:1px solid #f00;"><strong style="font-size: 10px;">Cookies that are used for adcelling tracking and have to be entered in the cookie consent module:</strong>
<ul style="font-size:10px;">
  <li>
    <strong>ADCELLpid' . $adcell_pid . '</strong><br />
    This cookie is set after clicking on an adcel advertising medium and contains information about publishers, advertising material, subid, referrer and timeline. The X in the cookie name stands for the programid of the advertising material. The period of validity of the cookie depends on the corresponding program.
  </li>
  <li>
    <strong>ADCELLspid' . $adcell_pid . '</strong><br />
    This cookie is set after clicking on an adcel advertising medium and contains information about publishers, advertising material, subid, referrer and timeline. The X in the cookie name stands for the programid of the advertising material. The cookie is deleted after the browser ends.
  </li>
  <li>
    <strong>ADCELLvpid' . $adcell_pid . '</strong><br />
    This cookie is set after playing an adCell advertising medium and contains information about publishers, advertising material, subid, referrer and time temple. The X in the cookie name stands for the programid of the advertising material. The period of validity of the cookie depends on the corresponding program.
  </li>
  <li>
    <strong>ADCELLjh' . $adcell_pid . '</strong><br />
    This cookie is placed after repeated playing out or clicking on an adcel advertising material. This traces the user\'s path over the various publishers. The X in the cookie name stands for the programid of the advertising material.
  </li>
  <li>
    <strong>ADCELLnoTrack</strong><br />
    This cookie is set if the user does not want to be tracked. In the presence of the cookies, no cookies are set that could be set outside the surf at www.adcell.de. 
  </li>
</ul>
</div>');

