<?php

namespace CultureKings\Afterpay\Model;


/**
 * Class Money
 * @package CultureKings\Afterpay\Model
 */
class Money
{
    /**
     * @var float
     */
    protected $amount;
    /**
     * @var string
     */
    protected $currency;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
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
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
