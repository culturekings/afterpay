<?php
namespace CultureKings\Afterpay\Model\InStore;

/**
 * Class Reversal
 * @package CultureKings\Afterpay\Model\InStore
 */
class Reversal
{
    /**
     * @var string
     */
    protected $reverseId;
    /**
     * @var \DateTimeInterface
     */
    protected $reversedAt;
    /**
     * @var \DateTimeInterface
     */
    protected $requestedAt;
    /**
     * @var string
     */
    protected $reversingRequestId;

    /**
     * @return string
     */
    public function getReverseId()
    {
        return $this->reverseId;
    }

    /**
     * @param string $reverseId
     *
     * @return Reversal
     */
    public function setReverseId($reverseId)
    {
        $this->reverseId = $reverseId;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReversedAt()
    {
        return $this->reversedAt;
    }

    /**
     * @param \DateTimeInterface $reversedAt
     *
     * @return Reversal
     */
    public function setReversedAt(\DateTimeInterface $reversedAt)
    {
        $this->reversedAt = $reversedAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getRequestedAt()
    {
        return $this->requestedAt;
    }

    /**
     * @param \DateTimeInterface $requestedAt
     *
     * @return Reversal
     */
    public function setRequestedAt(\DateTimeInterface $requestedAt)
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getReversingRequestId()
    {
        return $this->reversingRequestId;
    }

    /**
     * @param string $reversingRequestId
     *
     * @return Reversal
     */
    public function setReversingRequestId($reversingRequestId)
    {
        $this->reversingRequestId = $reversingRequestId;

        return $this;
    }
}
