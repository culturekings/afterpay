<?php

namespace CultureKings\Afterpay\Model;

/**
 * Class Payment
 * @package CultureKings\Afterpay\Model
 */
class Payment
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $token;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var \DateTime
     */
    protected $created;
    /**
     * @var Money
     */
    protected $totalAmount;
    /**
     * @var string
     */
    protected $merchantReference;
    /**
     * @var PaymentEvent[]
     */
    protected $events = [];
    /**
     * @var Refund[]
     */
    protected $refunds = [];
    /**
     * @var OrderDetails
     */
    protected $orderDetails;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return $this
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return Money
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param Money $totalAmount
     * @return $this
     */
    public function setTotalAmount(Money $totalAmount)
    {
        $this->totalAmount = $totalAmount;

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
     * @return $this
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }

    /**
     * @return PaymentEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param PaymentEvent[] $events
     * @return $this
     */
    public function setEvents(array $events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * @return Refund[]
     */
    public function getRefunds()
    {
        return $this->refunds;
    }

    /**
     * @param Refund[] $refunds
     * @return $this
     */
    public function setRefunds(array $refunds)
    {
        $this->refunds = $refunds;

        return $this;
    }

    /**
     * @return OrderDetails
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * @param OrderDetails $orderDetails
     * @return $this
     */
    public function setOrderDetails(OrderDetails $orderDetails)
    {
        $this->orderDetails = $orderDetails;

        return $this;
    }
}
