<?php
namespace CultureKings\Afterpay;

/**
 * Class Authorization
 *
 * @package CultureKings\Afterpay
 */
class Authorization
{
    /**
     * @var string
     */
    protected $merchantId;
    /**
     * @var string
     */
    protected $secret;

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }
}
