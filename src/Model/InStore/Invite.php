<?php
namespace CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\Money;

/**
 * Class Invite
 * @package CultureKings\Afterpay\Model\InStore
 */
class Invite
{
    /**
     * @var string
     */
    protected $mobile;
    /**
     * @var Money
     */
    protected $expectedAmount;

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     *
     * @return Invite
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return Money
     */
    public function getExpectedAmount()
    {
        return $this->expectedAmount;
    }

    /**
     * @param Money $expectedAmount
     *
     * @return Invite
     */
    public function setExpectedAmount($expectedAmount)
    {
        $this->expectedAmount = $expectedAmount;

        return $this;
    }
}
