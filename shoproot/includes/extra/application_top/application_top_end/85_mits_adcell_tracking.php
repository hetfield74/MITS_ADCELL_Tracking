<?php
/**
 * --------------------------------------------------------------
 * File: 85_mits_adcell_tracking.php
 * Date: 14.12.2021
 * Time: 10:24
 *
 * Author: Hetfield
 * Copyright: (c) 2021 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if (defined('MODULE_MITS_ADCELL_TRACKING_STATUS') && strtolower(MODULE_MITS_ADCELL_TRACKING_STATUS) == 'true'
  && defined('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID') && MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID != ''
  && defined('MODULE_MITS_ADCELL_TRACKING_EVENT_ID') && MODULE_MITS_ADCELL_TRACKING_EVENT_ID != ''
) {
    if (isset($_GET['bid']) && !empty($_GET['bid']) && !isset($_SESSION['bid'])) {
        $_SESSION['bid'] = xtc_db_prepare_input($_GET['bid']);
        //$_COOKIE['_bid'] = xtc_db_prepare_input($_GET['bid']);
    }

    if (isset($_SESSION['customer_id'])) {
        $adcell_bid_query = xtc_db_query("SELECT mits_adcell_bid FROM " . TABLE_CUSTOMERS . " WHERE customers_id = " . (int)$_SESSION['customer_id']);
        $adcell_bid = xtc_db_fetch_array($adcell_bid_query);
        if (isset($adcell_bid['mits_adcell_bid']) && !empty($adcell_bid['mits_adcell_bid'])) {
            $_SESSION['bid'] = $adcell_bid['mits_adcell_bid'];
            //$_COOKIE['_bid'] = $adcell_bid['mits_adcell_bid'];
        } else {
            if (isset($_SESSION['bid'])) {
                xtc_db_query("UPDATE " . TABLE_CUSTOMERS . " SET mits_adcell_bid = '" . xtc_db_input($_SESSION['bid']) . "' WHERE customers_id = " . (int)$_SESSION['customer_id']);
            }
        }
    }
}
