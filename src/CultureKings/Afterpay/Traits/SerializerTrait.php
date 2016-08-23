<?php
namespace CultureKings\Afterpay\Traits;

use JMS\Serializer\SerializerInterface;

/**
 * Class SerializerTrait
 * @package CultureKings\Afterpay\Traits
 */
trait SerializerTrait
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
}
