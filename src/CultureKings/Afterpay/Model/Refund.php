<?php

namespace CultureKings\Afterpay\Model;

use DateTime;

/**
 * Class Refund
 * @package CultureKings\Afterpay\Model
 */
class Refund
{
    /**
     * @var string
     */
    protected $id;
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
     * @return string
     */
    public function getId()
    {
        return $this->id;
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
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @param $merchantReference
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
}
