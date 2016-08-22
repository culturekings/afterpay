<?php
namespace CultureKings\Afterpay;

use JMS\Serializer\Serializer;

/**
 * Class SerializerTrait
 *
 * @package CultureKings\Afterpay
 */
trait SerializerTrait
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
}
