<?php
namespace CultureKings\Afterpay\Model\InStore;

use CultureKings\Afterpay\Model\Money;

/**
 * Class PreApproval
 * @package CultureKings\Afterpay\Model\InStore
 */
class PreApproval
{
    /**
     * @var Money
     */
    protected $minimum;
    /**
     * @var Money
     */
    protected $amount;
    /**
     * @var \DateTimeInterface
     */
    protected $expiresAt;

    /**
     * @return Money
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param Money $minimum
     *
     * @return PreApproval
     */
    public function setMinimum(Money $minimum)
    {
        $this->minimum = $minimum;

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
     * @return PreApproval
     */
    public function setAmount(Money $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTimeInterface $expiresAt
     *
     * @return PreApproval
     */
    public function setExpiresAt(\DateTimeInterface $expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
