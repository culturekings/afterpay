<?php

namespace CultureKings\Afterpay\Model\Merchant;

use CultureKings\Afterpay\Model\Money;
use DateTime;

/**
 * Class Refund
 *
 * @package CultureKings\Afterpay\Model
 */
class Refund
{
    /**
     * @var string
     */
    protected $refundId;
    /**
     * @var DateTime
     */
    protected $refundedAt;
    /**
     * @var string
     */
    protected $merchantReference;
    /**
     * @var Money
     */
    protected $amount;
    /**
     * @var string
     */
    protected $requestId;

    /**
     * @return string
     */
    public function getRefundId()
    {
        return $this->refundId;
    }

    /**
     * @return DateTime
     */
    public function getRefundedAt()
    {
        return $this->refundedAt;
    }

    /**
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $refundId
     * @return $this
     */
    public function setRefundId($refundId)
    {
        $this->refundId = $refundId;

        return $this;
    }

    /**
     * @param DateTime $refundedAt
     * @return $this
     */
    public function setRefundedAt(DateTime $refundedAt)
    {
        $this->refundedAt = $refundedAt;

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

    /**
     * @param Money $amount
     * @return $this
     */
    public function setAmount(Money $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
    * @param string $requestId
    * @return $this
    */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }
}
