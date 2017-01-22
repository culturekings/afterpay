<?php

namespace CultureKings\Afterpay\Model\Merchant;

use DateTime;

/**
 * Class ShippingCourier
 *
 * @package CultureKings\Afterpay\Model\Merchant
 */
class ShippingCourier
{
    /**
     * @var DateTime
     */
    protected $shippedAt;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $tracking;
    /**
     * @var string
     */
    protected $priority;

    /**
     * @return DateTime
     */
    public function getShippedAt()
    {
        return $this->shippedAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param DateTime $shippedAt
     * @return $this
     */
    public function setShippedAt(DateTime $shippedAt)
    {
        $this->shippedAt = $shippedAt;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $tracking
     * @return $this
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;
        return $this;
    }

    /**
     * @param $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }
}
