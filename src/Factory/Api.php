<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Service\Ping;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class Api
 * @package CultureKings\Afterpay\Factory
 */
abstract class Api
{
    /**
     * @param                      $endpoint
     * @param ClientInterface|null $client
     *
     * @return Ping
     */
    public static function ping(
        $endpoint,
        ClientInterface $client = null
    ) {
        AnnotationRegistry::registerLoader('class_exists');

        $afterpayClient = $client ?: new Client([ 'base_uri' => $endpoint ]);
        return new Ping($afterpayClient);
    }
}
