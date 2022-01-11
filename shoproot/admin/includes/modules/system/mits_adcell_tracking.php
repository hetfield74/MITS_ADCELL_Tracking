<?php
/**
 * --------------------------------------------------------------
 * File: mits_adcell_tracking.php
 * Created by PhpStorm
 * Date: 08.12.2021
 * Time: 17:33
 *
 * Author: Hetfield
 * Copyright: (c) 2021 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 *
 * Released under the GNU General Public License
 * --------------------------------------------------------------
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

class mits_adcell_tracking {
  var $code, $title, $description, $enabled;

  function __construct() {
    $this->code = 'mits_adcell_tracking';
    $this->version = '1.00';
    $this->title = constant('MODULE_' . strtoupper($this->code) . '_TEXT_TITLE') . ' - v' . $this->version;
    $this->description = constant('MODULE_' . strtoupper($this->code) . '_TEXT_DESCRIPTION');
    $this->sort_order = defined('MODULE_' . strtoupper($this->code) . '_SORT_ORDER') ? constant('MODULE_' . strtoupper($this->code) . '_SORT_ORDER') : 0;
    $this->enabled = ((constant('MODULE_' . strtoupper($this->code) . '_STATUS') == 'true') ? true : false);
  }

  function process($file) {
    //do nothing
  }

  function display() {
    return array(
      'text' => '<br>' . xtc_button(BUTTON_SAVE) . '&nbsp;' .
        xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module=' . $this->code))
    );
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_" . strtoupper($this->code) . "_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function install() {
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_" . strtoupper($this->code) . "_STATUS', 'true', 6, 1, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_" . strtoupper($this->code) . "_PROGRAMM_ID', '', 6, 2, NULL, now());");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_" . strtoupper($this->code) . "_EVENT_ID', '', 6, 3, NULL, now());");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_" . strtoupper($this->code) . "_RETARGETING', 'true', 6, 4, 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_" . strtoupper($this->code) . "_COOKIE_CONSENT_PURPOSE_ID', '', 6, 3, NULL, now());");

    xtc_db_query("ALTER TABLE " . TABLE_CUSTOMERS . " ADD `mits_adcell_bid` VARCHAR(250) NULL DEFAULT NULL");
  }

  function remove() {
    xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }

  function keys() {
    return array(
      'MODULE_' . strtoupper($this->code) . '_STATUS',
      'MODULE_' . strtoupper($this->code) . '_PROGRAMM_ID',
      'MODULE_' . strtoupper($this->code) . '_EVENT_ID',
      'MODULE_' . strtoupper($this->code) . '_RETARGETING',
      'MODULE_' . strtoupper($this->code) . '_COOKIE_CONSENT_PURPOSE_ID'
    );
  }

}