<?php
namespace CultureKings\Afterpay\Model\InStore;

/**
 * Class DeviceToken
 * @package CultureKings\Afterpay\Model\InStore
 */
class DeviceToken
{
    /**
     * @var string
     */
    protected $token;
    /**
     * @var int
     */
    protected $expiresIn;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     *
     * @return $this
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }
}
