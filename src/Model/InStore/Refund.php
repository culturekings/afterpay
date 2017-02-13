<?php
namespace CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\Money;
use DateTimeInterface;

/**
 * Class Refund
 * @package CultureKings\Afterpay\Model\InStore
 */
class Refund
{
    /**
     * @var string
     */
    protected $requestId;
    /**
     * @var DateTimeInterface
     */
    protected $requestedAt;
    /**
     * @var DateTimeInterface
     */
    protected $refundedAt;
    /**
     * @var string
     */
    protected $merchantReference;
    /**
     * @var string
     */
    protected $orderId;
    /**
     * @var string
     */
    protected $orderMerchantReference;
    /**
     * @var Money
     */
    protected $amount;

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     *
     * @return Refund
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRequestedAt()
    {
        return $this->requestedAt;
    }

    /**
     * @param DateTimeInterface $requestedAt
     *
     * @return Refund
     */
    public function setRequestedAt(DateTimeInterface $requestedAt)
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRefundedAt()
    {
        return $this->refundedAt;
    }

    /**
     * @param DateTimeInterface $refundedAt
     *
     * @return Refund
     */
    public function setRefundedAt(DateTimeInterface $refundedAt)
    {
        $this->refundedAt = $refundedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @param string $merchantReference
     *
     * @return Refund
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return Refund
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderMerchantReference()
    {
        return $this->orderMerchantReference;
    }

    /**
     * @param string $orderMerchantReference
     *
     * @return Refund
     */
    public function setOrderMerchantReference($orderMerchantReference)
    {
        $this->orderMerchantReference = $orderMerchantReference;

        return $this;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param Money $amount
     *
     * @return Refund
     */
    public function setAmount(Money $amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
