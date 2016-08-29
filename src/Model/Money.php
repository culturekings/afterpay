<?php

namespace CultureKings\Afterpay\Model;

/**
 * Class Money
 *
 * @package CultureKings\Afterpay\Model
 */
class Money
{
    /**
     * @var double
     */
    protected $amount;
    /**
     * @var string
     */
    protected $currency;

    /**
     * Money constructor.
     * @param float  $amount
     * @param string $currency
     */
    public function __construct($amount = null, $currency = null)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param double $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }


    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }
}
