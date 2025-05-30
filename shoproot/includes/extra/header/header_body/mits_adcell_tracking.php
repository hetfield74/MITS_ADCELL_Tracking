<?php
/**
 * --------------------------------------------------------------
 * File: mits_adcell_tracking.php
 * Created by PhpStorm
 * Date: 08.12.2021
 * Time: 17:03
 *
 * Author: Hetfield
 * Copyright: (c) 2021 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 *
 * Released under the GNU General Public License
 * --------------------------------------------------------------
 */

if (defined('MODULE_MITS_ADCELL_TRACKING_STATUS') && strtolower(MODULE_MITS_ADCELL_TRACKING_STATUS) == 'true'
  && defined('MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID') && MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID != ''
  && defined('MODULE_MITS_ADCELL_TRACKING_EVENT_ID') && MODULE_MITS_ADCELL_TRACKING_EVENT_ID != ''
) {
    if (defined('MODULE_COOKIE_CONSENT_STATUS') && strtolower(MODULE_COOKIE_CONSENT_STATUS) == 'true'
      && defined('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID') && MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID != ''
      && (in_array(MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID, $_SESSION['tracking']['allowed']) || defined('COOKIE_CONSENT_NO_TRACKING'))
    ) {
        $adcell_oil = ' data-type="text/javascript" type="as-oil" data-purposes="' . MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID . '" data-managed="as-oil"';
        $show_adcell = true;
    } else {
        if (defined('MODULE_COOKIE_CONSENT_STATUS') && strtolower(MODULE_COOKIE_CONSENT_STATUS) == 'true'
          && defined('MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID') && MODULE_MITS_ADCELL_TRACKING_COOKIE_CONSENT_PURPOSE_ID != ''
        ) {
            $adcell_oil = '';
            $show_adcell = false; // false, wenn adcell tracking im consent manager konfiguriert werden muss
        } else {
            $adcell_oil = '';
            $show_adcell = true;
        }
    }

    if ($show_adcell === true) {
        $adcell_pid = MODULE_MITS_ADCELL_TRACKING_PROGRAMM_ID;
        $adcell_eventid = MODULE_MITS_ADCELL_TRACKING_EVENT_ID;

        // 1st Party Tracking
        ?>
      <script type="text/javascript" src="https://t.adcell.com/js/trad.js"<?php
      echo $adcell_oil; ?>></script>
      <script<?php
      echo $adcell_oil; ?>>Adcell.Tracking.track();</script>
        <?php

        if (defined('MODULE_MITS_ADCELL_TRACKING_RETARGETING') && strtolower(MODULE_MITS_ADCELL_TRACKING_RETARGETING) == 'true') {
            // Homepage
            if (basename($PHP_SELF) == FILENAME_DEFAULT && !isset($_GET['cPath']) && !isset($_GET['manufacturers_id'])) {
                ?>
              <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=track&pid=<?php
              echo $adcell_pid; ?>&type=startpage" async<?php
              echo $adcell_oil; ?>></script>
                <?php
            }

            // Product Page
            if (basename($PHP_SELF) == FILENAME_PRODUCT_INFO
              && (isset($_GET['products_id']) && $_GET['products_id'] != '')
              && (isset($product) && is_object($product) && $product->isProduct())
              && isset($current_category_id)) {
                $productIds = '';
                $data = $product->getAlsoPurchased();
                if (is_array($data) && count($data) > 0) {
                    foreach ($data as $key => $value) {
                        $productIds .= ';' . $data[$key]['PRODUCTS_ID'];
                    }
                    $productIds = substr($productIds, 1);
                }
                ?>
              <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=product&pid=<?php
              echo $adcell_pid; ?>&productId=<?php
              echo $product->data['products_id']; ?>&productName=<?php
              echo urlencode($product->data['products_name']); ?>&categoryId=<?php
              echo $current_category_id; ?>&productIds=<?php
              echo $productIds; ?>&productSeparator=;" async<?php
              echo $adcell_oil; ?>></script>
                <?php
            }

            // Search Page
            if (basename($PHP_SELF) == FILENAME_ADVANCED_SEARCH_RESULT
              && (isset($_GET['keywords']) && $_GET['keywords'] != '')
              && (isset($module_content) && is_array($module_content))
            ) {
                $count_module_content = sizeof($module_content);
                $productIds = '';
                if ($count_module_content > 0) {
                    foreach ($module_content as $key => $value) {
                        $productIds .= ';' . $module_content[$key]['PRODUCTS_ID'];
                    }
                    $productIds = substr($productIds, 1);
                    ?>
                  <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=search&pid=<?php
                  echo $adcell_pid; ?>&search=<?php
                  echo $_GET['keywords']; ?>&productIds=<?php
                  echo $productIds; ?>&productSeparator=;" async<?php
                  echo $adcell_oil; ?>></script>
                    <?php
                }
            }

            // Category Page
            if (basename($PHP_SELF) == FILENAME_DEFAULT
              && (isset($current_category_id) && $current_category_id != 0)
              && (isset($module_content) && is_array($module_content))
            ) {
                $count_module_content = sizeof($module_content);
                $productIds = '';
                if ($count_module_content > 0) {
                    foreach ($module_content as $key => $value) {
                        $productIds .= ';' . $module_content[$key]['PRODUCTS_ID'];
                    }
                    $productIds = substr($productIds, 1);

                    $categoryName = (isset($category['categories_name']) && !empty($category['categories_name'])) ? urlencode($category['categories_name']) : '';
                    ?>
                  <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=category&pid=<?php
                  echo $adcell_pid; ?>&categoryName=<?php
                  echo $categoryName; ?>&categoryId=<?php
                  echo $current_category_id; ?>&productIds=<?php
                  echo $productIds; ?>&productSeparator=;" async<?php
                  echo $adcell_oil; ?>></script>
                    <?php
                }
            }

            // Basket:
            if (basename($PHP_SELF) == FILENAME_SHOPPING_CART && $_SESSION['cart']->count_contents() > 0 && isset($products) && is_array($products)) {
                $count_products = sizeof($products);
                $basketProductCount = 0;
                $productIds = $ProductQuantities = '';
                if ($count_products > 0) {
                    foreach ($products as $key => $value) {
                        $productIds .= ';' . xtc_get_prid($products[$key]['id']);
                        $ProductQuantities .= ';' . $products[$key]['quantity'];
                        $basketProductCount += $products[$key]['quantity'];
                    }
                    $productIds = substr($productIds, 1);
                    $ProductQuantities = substr($ProductQuantities, 1);

                    if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 0 && $_SESSION['customers_status']['customers_status_add_tax_ot'] == 1) {
                        $basketTotal = number_format($_SESSION['cart']->show_total() - $_SESSION['cart']->show_tax(false), 2);
                    } else {
                        $basketTotal = number_format($_SESSION['cart']->show_total() - $_SESSION['cart']->show_tax(false), 2);
                    }
                    ?>
                  <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=basket&pid=<?php
                  echo $adcell_pid; ?>&productIds=<?php
                  echo $productIds; ?>&productSeparator=;&quantities=<?php
                  echo $ProductQuantities; ?>&basketProductCount=<?php
                  echo $basketProductCount; ?>&basketTotal=<?php
                  echo $basketTotal; ?>" async<?php
                  echo $adcell_oil; ?>></script>
                    <?php
                }
            }

            // Checkout:
            if (substr(basename($PHP_SELF), 0, 8) == 'checkout' && basename($PHP_SELF) != FILENAME_CHECKOUT_SUCCESS) {
                if (isset($order->products)
                  && is_array($order->products)
                  && count($order->products) > 0
                  && isset($order->info['total'])
                  && isset($_SESSION['cartID'])
                ) {
                    $count_products = sizeof($order->products);
                    $checkoutProductIds = $checkoutProductQuantities = '';
                    $checkoutProductCount = 0;
                    $products = $order->products;
                    foreach ($products as $key => $value) {
                        $checkoutProductIds .= ';' . xtc_get_prid($products[$key]['id']);
                        $checkoutProductQuantities .= ';' . $products[$key]['quantity'];
                        $checkoutProductCount += $products[$key]['quantity'];
                    }
                    $checkoutProductIds = substr($checkoutProductIds, 1);
                    $checkoutProductQuantities = substr($checkoutProductQuantities, 1);
                    ?>
                  <script type="text/javascript" src="https://t.adcell.com/js/inlineretarget.js?method=checkout&pid=<?php
                  echo $adcell_pid; ?>&basketId=<?php
                  echo $_SESSION['cartID']; ?>&basketTotal=<?php
                  echo number_format($order->info['total'], 2); ?>&basketProductCount=<?php
                  echo $checkoutProductCount; ?>&productIds=<?php
                  echo $checkoutProductIds; ?>&productSeparator=;&quantities=<?php
                  echo $checkoutProductQuantities; ?>" async<?php
                  echo $adcell_oil; ?>></script>
                    <?php
                }
            }
        }

        // Conversion Tracking
        if (basename($PHP_SELF) == FILENAME_CHECKOUT_SUCCESS && isset($last_order)) {
            $adcell_subtotal_final = 0;
            $adcell_products_query = xtc_db_query("SELECT final_price, products_tax, allow_tax FROM " . TABLE_ORDERS_PRODUCTS . " WHERE orders_id = " . $last_order);
            while ($adcell_products = xtc_db_fetch_array($adcell_products_query)) {
                if ($adcell_products['allow_tax'] == 0) {
                    $adcell_subtotal_final += $adcell_products['final_price'];
                } elseif ($adcell_products['allow_tax'] == 1) {
                    $adcell_subtotal_final += ($adcell_products['final_price'] / (100 + $adcell_products['products_tax']) * 100); //$xtPrice->xtcRemoveTax($products['final_price'], $products['products_tax']);
                }
            }
            ?>
          <script type="text/javascript" src="https://t.adcell.com/t/track.js?pid=<?php
          echo $adcell_pid; ?>&eventid=<?php
          echo $adcell_eventid; ?>&referenz=<?php
          echo $last_order; ?>&betrag=<?php
          echo number_format($adcell_subtotal_final, 2); ?>" async<?php
          echo $adcell_oil; ?>></script>
            <?php
            /*
             <noscript>
               <img border="0" width="1" height="1" src="https://t.adcell.com/t/track?pid=<?php echo $adcell_pid; ?>&eventid=<?php echo $adcell_eventid; ?>&referenz=<?php echo $last_order; ?>&betrag=<?php echo number_format($adcell_subtotal_final, 2); ?>">
             </noscript>
             */
        }
    }
}