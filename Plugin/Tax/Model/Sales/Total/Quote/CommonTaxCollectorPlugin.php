<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2022-present JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\DynamicShippingTax\Plugin\Tax\Model\Sales\Total\Quote;

use Jajuma\DynamicShippingTax\Helper\Config as ConfigHelper;
use Jajuma\DynamicShippingTax\Model\Config;
use Magento\Customer\Model\ResourceModel\GroupRepository;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\Item;
use Magento\Tax\Api\Data\QuoteDetailsItemInterface;
use Magento\Tax\Api\Data\TaxClassKeyInterface;
use Magento\Tax\Api\Data\TaxClassKeyInterfaceFactory;
use Magento\Tax\Model\Calculation;
use Magento\Tax\Model\Sales\Total\Quote\CommonTaxCollector;

/**
 * Class CommonTaxCollectorPlugin
 *
 * Get Tax by option selected in admin config at step place order checkout
 *
 */
class CommonTaxCollectorPlugin
{
    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * @var GroupRepository
     */
    private GroupRepository $groupRepository;

    /**
     * @var Calculation
     */
    private Calculation $taxCalculation;

    /**
     * @var TaxClassKeyInterfaceFactory
     */
    protected TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory;

    /**
     * @var ConfigHelper
     */
    protected ConfigHelper $configHelper;

    /**
     * @param Session $customerSession
     * @param GroupRepository $groupRepository
     * @param Calculation $taxCalculation
     * @param TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory
     * @param ConfigHelper $configHelper
     */
    public function __construct(
        Session $customerSession,
        GroupRepository $groupRepository,
        Calculation $taxCalculation,
        TaxClassKeyInterfaceFactory $taxClassKeyDataObjectFactory,
        ConfigHelper $configHelper
    ) {
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
        $this->taxCalculation = $taxCalculation;
        $this->taxClassKeyDataObjectFactory = $taxClassKeyDataObjectFactory;
        $this->configHelper = $configHelper;
    }

    /**
     * Re-set shipping tax class id
     *
     * @param CommonTaxCollector $subject
     * @param QuoteDetailsItemInterface|null $result
     * @param ShippingAssignmentInterface $shippingAssignment
     * @param Total $total
     * @param bool $useBaseCurrency
     * @return QuoteDetailsItemInterface|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function afterGetShippingDataObject(
        CommonTaxCollector $subject,
        ?QuoteDetailsItemInterface $result,
        ShippingAssignmentInterface $shippingAssignment,
        Total $total,
        bool $useBaseCurrency
    ): ?QuoteDetailsItemInterface {
        if ($result) {
            $store = $shippingAssignment->getShipping()->getAddress()->getQuote()->getStore();
            $itemDataObject = $result;

            $dynamicType = $this->configHelper->getDynamicShippingTaxType();
            $quoteItems = $shippingAssignment->getShipping()->getAddress()->getQuote()->getAllVisibleItems();
            if ($dynamicType == Config::SHIPPING_TAX_TYPE_DEFAULT || count($quoteItems) == 0) {
                return $result;
            }

            $taxClassId = $this->configHelper->getDefaultTaxClass($store);
            if ($dynamicType == Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_TAX) {
                $taxClassId = $this->getTaxHighestByProductTax($quoteItems, $store);
            }

            if ($dynamicType == Config::SHIPPING_TAX_TYPE_HIGHEST_PRODUCT_PRICE_AMOUNT) {
                $taxClassId = $this->getTaxByHighestProductPrice($quoteItems);
            }

            // Set tax class id when place order
            $itemDataObject->setTaxClassKey(
                $this->taxClassKeyDataObjectFactory->create()
                    ->setType(TaxClassKeyInterface::TYPE_ID)
                    ->setValue($taxClassId)
            );
        }

        return $result;
    }

    /**
     * Get tax class id by highest product tax
     *
     * @param mixed $quoteItems
     * @param mixed $store
     * @return mixed|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getTaxHighestByProductTax($quoteItems, $store)
    {
        $taxClassId = null;
        $highestProductTax = 0;

        foreach ($quoteItems as $quoteItem) {
            if ($quoteItem->getParentItem()) {
                continue;
            }
            //$itemTaxClassId = $quoteItem->getData('tax_class_id');
            $itemTaxClassId = $this->getItemTaxClassId($quoteItem);
            $itemTaxPercent = $quoteItem->getTaxPercent();

            //Recalculate tax percent from customer group tax, need check more
            if (!$itemTaxPercent) {
                $itemTaxPercent = $this->getTaxPercent($itemTaxClassId, $store);
            }

            if ($itemTaxPercent >= $highestProductTax) {
                $taxClassId = $itemTaxClassId;
                $highestProductTax = $itemTaxPercent;
            }
        }

        return $taxClassId;
    }

    /**
     * Get tax class id by highest product tax
     *
     * @param mixed $quoteItems
     * @return mixed|null
     */
    private function getTaxByHighestProductPrice($quoteItems)
    {
        $taxClassId = null;
        $highestProductPrice = 0;
        foreach ($quoteItems as $quoteItem) {
            /** @var $quoteItem Item */
            if ($quoteItem->getParentItem()) {
                continue;
            }

            $itemPrice = $quoteItem->getRowTotal();
            //$itemTaxClassId = $quoteItem->getData('tax_class_id');
            $itemTaxClassId = $this->getItemTaxClassId($quoteItem);
            if ($itemPrice >= $highestProductPrice) {
                $taxClassId = $itemTaxClassId;
                $highestProductPrice = $itemPrice;
            }
        }

        return $taxClassId;
    }

    /**
     * Get tax percent
     *
     * @param int $productTaxClassId
     * @param mixed $store
     * @return float|int
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getTaxPercent(int $productTaxClassId, $store)
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

    /**
     * Retrieve the tax class ID for a quote item.
     *
     * This method checks the tax class ID of the provided quote item. If the item
     * is of type 'configurable', it attempts to retrieve the tax class ID from the
     * associated child (simple) product instead of the parent (configurable) product.
     *
     * @param \Magento\Quote\Model\Quote\Item $quoteItem The quote item for which the tax class ID is being retrieved.
     * @return int|string|null The tax class ID of the quote item or its associated child product, if applicable.
     */
    private function getItemTaxClassId($quoteItem): string
    {
        //Magento always get the parent tax class id here, need check and get from child item
        $taxClassId = $quoteItem->getData('tax_class_id');
        if ($quoteItem->getProductType() === 'configurable') {
            if (method_exists($quoteItem, 'getProduct')) {
                $parentProduct = $quoteItem->getProduct();
                if ($parentProduct) {
                    $simpleOption = $parentProduct->getCustomOption('simple_product');
                    if ($simpleOption) {
                        if (method_exists($simpleOption, 'getProduct')) {
                            $product = $simpleOption->getProduct();
                            if ($product) {
                                $taxClassId = $product->getData('tax_class_id');
                            }
                        }
                    }
                }
            }
        }
        
        return (string)$taxClassId;
    }
}
