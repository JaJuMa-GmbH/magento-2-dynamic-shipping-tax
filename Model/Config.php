<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2022-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\DynamicShippingTax\Model;

class Config
{
    const SHIPPING_TAX_TYPE_DEFAULT = 0;
    const SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_TAX = 1;
    const SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_PRICE_AMOUNT = 2;
}
