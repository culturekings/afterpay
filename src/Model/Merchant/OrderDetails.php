<?php

namespace CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model;

/**
 * Class OrderDetails
 *
 * @package CultureKings\Afterpay\Model\Merchant
 */
class OrderDetails
{
    /**
     * @var Consumer
     */
    protected $consumer;
    /**
     * @var Contact
     */
    protected $billing;
    /**
     * @var Contact
     */
    protected $shipping;
    /**
     * @var ShippingCourier
     */
    protected $courier;
    /**
     * @var Model\Item[]
     */
    protected $items = array();
    /**
     * @var Discount[]
     */
    protected $discounts = array();
    /**
     * @var Model\Money
     */
    protected $totalAmount;
    /**
     * @var Model\Money
     */
    protected $taxAmount;
    /**
     * @var Model\Money
     */
    protected $shippingAmount;

    /**
     * @var MerchantOptions
     */
    protected $merchant;

    /**
     * @var string
     */
    protected $paymentType;

    /**
     * @var string
     */
    protected $merchantReference;

    /**
     * @return Consumer
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * @return Contact
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * @return Contact
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @return ShippingCourier
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * @return Model\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * @return Model\Money
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param Model\Money $totalAmount
     * @return $this
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return Model\Money
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @return Model\Money
     */
    public function getShippingAmount()
    {
        return $this->shippingAmount;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @param Consumer $consumer
     * @return $this
     */
    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * @param Contact $billing
     * @return $this
     */
    public function setBilling(Contact $billing)
    {
        $this->billing = $billing;

        return $this;
    }

    /**
     * @param Contact $shipping
     * @return $this
     */
    public function setShipping(Contact $shipping)
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * @param ShippingCourier $courier
     * @return $this
     */
    public function setCourier(ShippingCourier $courier)
    {
        $this->courier = $courier;

        return $this;
    }

    /**
     * @param Model\Item[] $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param Discount[] $discounts
     * @return $this
     */
    public function setDiscounts(array $discounts)
    {
        $this->discounts = $discounts;

        return $this;
    }

    /**
     * @param Model\Money $taxAmount
     * @return $this
     */
    public function setTaxAmount(Model\Money $taxAmount)
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    /**
     * @param Model\Money $shippingAmount
     * @return $this
     */
    public function setShippingAmount(Model\Money $shippingAmount)
    {
        $this->shippingAmount = $shippingAmount;

        return $this;
    }

    /**
     * @return MerchantOptions
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param MerchantOptions $merchant
     * @return $this
     */
    public function setMerchant(MerchantOptions $merchant)
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * @param string $merchantReference
     * @return $this
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }
}
