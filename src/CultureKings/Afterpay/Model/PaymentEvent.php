<?php

namespace CultureKings\Afterpay\Model;

use DateTime;

/**
 * Class PaymentEvent
 * @package CultureKings\Afterpay\Model
 */
class PaymentEvent
{
    /**
     * @var DateTime
     */
    protected $created;
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $type;

    /**
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param DateTime $created
     * @return $this
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
        return $this;
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
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
