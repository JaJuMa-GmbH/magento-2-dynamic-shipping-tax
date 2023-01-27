<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2022-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\DynamicShippingTax\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const CONFIG_PATH_DYNAMIC_SHIPPING_TAX_CLASS = 'tax/classes/dynamic_shipping_tax_class';

    /**
     * Get dynamic shipping tax class type
     *
     * @return mixed
     */
    public function getDynamicShippingTaxType()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_DYNAMIC_SHIPPING_TAX_CLASS);
    }

    /**
     * Get default tax class
     *
     * @param mixed $store
     * @return int
     */
    public function getDefaultTaxClass($store): int
    {
        return (int)$this->scopeConfig->getValue(
            \Magento\Tax\Model\Config::CONFIG_XML_PATH_SHIPPING_TAX_CLASS,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
