<?php
namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model\ErrorResponse;
use CultureKings\Afterpay\Model;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;

/**
 * Class Customer
 * @package CultureKings\Afterpay\Service\InStore
 */
class Customer extends AbstractService
{
    /**
     * @param Model\InStore\Invite $invite
     * @param HandlerStack|null    $stack
     *
     * @return bool
     */
    public function invite(Model\InStore\Invite $invite, HandlerStack $stack = null)
    {
        try {
            $params = $this->generateParams($invite, $stack);

            $this->getClient()->post(
                'invite',
                $params
            );
        } catch (BadResponseException $e) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $e->getResponse()->getBody(),
                    ErrorResponse::class,
                    'json'
                ),
                $e
            );
        }

        return true;
    }
}
