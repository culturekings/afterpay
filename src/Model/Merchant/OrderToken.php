<?php

namespace CultureKings\Afterpay\Model\Merchant;

/**
 * Class OrderToken
 * @package CultureKings\Afterpay\Model
 */
class OrderToken
{
    /**
     * @var string
     */
    protected $token;
    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param \DateTime $expires
     * @return $this
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }
}
