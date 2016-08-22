<?php

namespace CultureKings\Afterpay\Model;

/**
 * Class Item
 *
 * @package CultureKings\Afterpay\Model
 */
class Item
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $sku;
    /**
     * @var int
     */
    protected $quantity;
    /**
     * @var Money
     */
    protected $price;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return Money
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $SKU
     * @return $this
     */
    public function setSKU($SKU)
    {
        $this->sku = $SKU;

        return $this;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @param Money $price
     * @return $this
     */
    public function setPrice(Money $price)
    {
        $this->price = $price;

        return $this;
    }
}
