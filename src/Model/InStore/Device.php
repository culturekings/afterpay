<?php

namespace CultureKings\Afterpay\Model\InStore;

/**
 * Class Device
 * @package CultureKings\Afterpay\Model\InStore
 */
class Device
{
    /**
     * @var
     */
    protected $deviceId;
    /**
     * @var
     */
    protected $key;

    /**
     * @var string $secret
     */
    protected $secret;
    /**
     * @var string $name
     */
    protected $name;
    /**
     * @var array $attributes
     */
    protected $attributes;

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     *
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
