<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2022-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\DynamicShippingTax\Model\System\Config\Source\Tax;

use Jajuma\DynamicShippingTax\Model\Config;

class Dynamic implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected array $options = [];

    /**
     * Option Dynamic Shipping Tax
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        if (!$this->options) {
            $options = [
                [
                    'value' => Config::SHIPPING_TAX_TYPE_DEFAULT,
                    'label' => __('No dynamic shipping tax calculation')
                ],
                [
                    'value' => Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_TAX,
                    'label' => __('Use the highest product tax')
                ],
                [
                    'value' => Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_PRICE_AMOUNT,
                    'label' => __('Use highest amount tax')
                ]
            ];

            $this->options = $options;
        }

        return $this->options;
    }
}
