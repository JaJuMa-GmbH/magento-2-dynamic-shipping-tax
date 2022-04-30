<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2022-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\DynamicShippingTax\Plugin\Tax\Model\Sales\Total\Quote;

use Magento\Store\Model\Store;
use Jajuma\DynamicShippingTax\Model\Config;
use Magento\Tax\Api\Data\TaxClassKeyInterface;

/**
 * Class CommonTaxCollectorPlugin
 *
 * Get Tax by option selected in admin config at step place order checkout
 *
 */
class CommonTaxCollectorPlugin
{
    const CONFIG_PATH_DYNAMIC_SHIPPING_TAX_CLASS = 'tax/classes/dynamic_shipping_tax_class';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Magento\Customer\Model\ResourceModel\GroupRepository
     */
    private $groupRepository;

    /**
     * @var \Magento\Tax\Model\Calculation\Proxy
     */
    private $taxCalculation;

    /**
     * @var \Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory
     */
    protected $taxClassKeyDataObjectFactory;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Customer\Model\ResourceModel\GroupRepository $groupRepository
     * @param \Magento\Tax\Model\Calculation\Proxy $taxCalculation
     * @param \Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\ResourceModel\GroupRepository $groupRepository,
        \Magento\Tax\Model\Calculation\Proxy $taxCalculation,
        \Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
        $this->taxCalculation = $taxCalculation;
        $this->taxClassKeyDataObjectFactory = $taxClassKeyDataObjectFactory;
    }

    /**
     * @param \Magento\Tax\Model\Config  $subject
     * @param \Closure                   $proceed
     * @param null|string|bool|int|Store $store
     * @return mixed
     */
    public function afterGetShippingDataObject(\Magento\Tax\Model\Sales\Total\Quote\CommonTaxCollector $subject, $result, $shippingAssignment, $total, $useBaseCurrency)
    {
        $store = $shippingAssignment->getShipping()->getAddress()->getQuote()->getStore();
        $itemDataObject = $result; 
        if($itemDataObject) {
            $dynamicType = (int)$this->scopeConfig->getValue(
                self::CONFIG_PATH_DYNAMIC_SHIPPING_TAX_CLASS,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $store
            );
            $quoteItems = $shippingAssignment->getShipping()->getAddress()->getQuote()->getAllVisibleItems();

            if ($dynamicType == Config::SHIPPING_TAX_TYPE_DEFAULT || count($quoteItems) == 0) {
                return $result;
            }
    
            $taxClassId = false;
    
            if ($dynamicType == Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_TAX) {
                $taxClassId = $this->getHighestTaxClassProduct($quoteItems, $store);
            }
    
            if ($dynamicType == Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_PRICE_AMOUNT) {
                $taxClassId = $this->getHighestProductPriceTax($quoteItems, $store);
            }

            // Set Tax Class Id when place order
            $itemDataObject->setTaxClassKey(
                $this->taxClassKeyDataObjectFactory->create()
                    ->setType(TaxClassKeyInterface::TYPE_ID)
                    ->setValue($taxClassId)
            );
        }
        return $result;
    }

    /**
     * @array  $quoteItems
     * @int $store
     * @return integer
     */
    private function getHighestTaxClassProduct($quoteItems, $store)
    {
        $taxClassIds = [];
        $highestTaxRate = null;

        foreach ($quoteItems as $quoteItem) {
            /** @var $quoteItem \Magento\Quote\Model\Quote\Item */
            if ($quoteItem->getParentItem()) {
                continue;
            }

            // get the tax percent
            $taxPercent = $quoteItem->getTaxPercent();
            if (!$taxPercent) {
                $taxPercent = $this->getTaxPercent($quoteItem->getTaxClassId(), $store);
            }

            // Add the tax class into array
            if (is_float($taxPercent) && !in_array($taxPercent, $taxClassIds)) {
                $taxClassIds[(string)$taxPercent] = $quoteItem->getTaxClassId();
            }
        }

        // get the highest tax rate
        krsort($taxClassIds);
        if (count($taxClassIds) > 0) {
            $highestTaxRate = array_shift($taxClassIds);
        }
        if (!$highestTaxRate || is_null($highestTaxRate)) {
            return false;
        }

        return $highestTaxRate;
    }

    /**
     * Get tax by highest price product
     *
     * @array  $quoteItems
     * @int $store
     * @return integer
     */
    public function getHighestProductPriceTax($quoteItems, $store) {
        $productPriceArray = [];
        $highestPriceTax = null;

        foreach ($quoteItems as $quoteItem) {
            /** @var $quoteItem \Magento\Quote\Model\Quote\Item */
            if ($quoteItem->getParentItem()) {
                continue;
            }

            $productPrice = $quoteItem->getRowTotal();
            $taxClassId = $quoteItem->getTaxClassId();

            $productPriceArray[] = array($productPrice, $taxClassId);
        }

        usort($productPriceArray, function($a, $b) {
            return $b[0] <=> $a[0];
        });

        $highestPriceTax = $productPriceArray[0][1];

        if (!$highestPriceTax || is_null($highestPriceTax)) {
            return false;
        }

        return $highestPriceTax;
    }

    /**
     * @param int $productTaxClassId
     * @param null|string|bool|int|Store $store
     * @return float|int
     */
    private function getTaxPercent($productTaxClassId, $store)
    {
        $groupId = $this->customerSession->getCustomerGroupId();
        $group = $this->groupRepository->getById($groupId);
        $customerTaxClassId = $group->getTaxClassId();

        $request = $this->taxCalculation->getRateRequest(null, null, $customerTaxClassId, $store);
        $request->setData('product_class_id', $productTaxClassId);

        $taxPercent = $this->taxCalculation->getRate($request);
        if (!$taxPercent) {
            $taxPercent = 0;
        }

        return $taxPercent;
    }
}
