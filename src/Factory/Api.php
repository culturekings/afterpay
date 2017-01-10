<?php
namespace CultureKings\Afterpay\Factory;

use CultureKings\Afterpay\Model\Authorization;
use CultureKings\Afterpay\Service\Merchant\Configuration as ConfigurationService;
use CultureKings\Afterpay\Service\Merchant\Payments as PaymentsService;
use CultureKings\Afterpay\Service\Merchant\Orders as OrdersService;
use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;

/**
 * Class Api
 * @package CultureKings\Afterpay\Factory
 * @deprecated
 */
class Api extends MerchantApi
{

}
