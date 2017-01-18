<?php
namespace CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\Item;
use CultureKings\Afterpay\Model\Money;

/**
 * Class Order
 * @package CultureKings\Afterpay\Model\InStore
 */
class Order
{
    /**
     * @var int
     */
    protected $orderId;
    /**
     * @var \DateTimeInterface
     */
    protected $orderedAt;
    /**
     * @var string
     */
    protected $requestId;
    /**
     * @var \DateTimeInterface
     */
    protected $requestAt;
    /**
     * @var string
     */
    protected $merchantReference;
    /**
     * @var string
     */
    protected $preApprovalCode;
    /**
     * @var Money
     */
    protected $amount;
    /**
     * @var Item[]
     */
    protected $orderItems = [];

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     *
     * @return Order
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getOrderedAt()
    {
        return $this->orderedAt;
    }

    /**
     * @param \DateTimeInterface $orderedAt
     *
     * @return Order
     */
    public function setOrderedAt(\DateTimeInterface $orderedAt)
    {
        $this->orderedAt = $orderedAt;

        return $this;
    }

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
     * @return Order
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getRequestAt()
    {
        return $this->requestAt;
    }

    /**
     * @param \DateTimeInterface $requestAt
     *
     * @return Order
     */
    public function setRequestAt(\DateTimeInterface $requestAt)
    {
        $this->requestAt = $requestAt;

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
     * @return Order
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreApprovalCode()
    {
        return $this->preApprovalCode;
    }

    /**
     * @param string $preApprovalCode
     *
     * @return Order
     */
    public function setPreApprovalCode($preApprovalCode)
    {
        $this->preApprovalCode = $preApprovalCode;

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
     * @return Order
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return Item[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @param Item[] $orderItems
     *
     * @return Order
     */
    public function setOrderItems($orderItems)
    {
        $this->orderItems = $orderItems;

        return $this;
    }

    /**
     * @param Item $orderItem
     *
     * @return $this
     */
    public function addOrderItem(Item $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }
}
