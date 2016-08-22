<?php
namespace CultureKings\Afterpay\Model;

/**
 * Class Discount
 * @package CultureKings\Afterpay\Model
 */
class Discount
{
    /**
     * @var string
     */
    protected $displayName;
    /**
     * @var Money
     */
    protected $amount;


    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $displayName
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
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
