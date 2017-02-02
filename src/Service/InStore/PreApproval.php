<?php

namespace CultureKings\Afterpay\Service\InStore;

use CultureKings\Afterpay\Exception\ApiException;
use CultureKings\Afterpay\Model;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\HandlerStack;

/**
 * Class PreApproval
 * @package CultureKings\Afterpay\Service\InStore
 */
class PreApproval extends AbstractService
{
    /**
     * @param string            $preApprovalCode
     * @param HandlerStack|null $stack
     *
     * @return array|\JMS\Serializer\scalar|object
     */
    public function enquiry($preApprovalCode, HandlerStack $stack = null)
    {
        try {
            $params = $this->generateParams(['preApprovalCode' => $preApprovalCode], $stack);

            $result = $this->getClient()->post('preapprovals/enquire', $params);

            return $this->getSerializer()->deserialize(
                (string) $result->getBody(),
                Model\InStore\PreApproval::class,
                'json'
            );
        } catch (BadResponseException $exception) {
            throw new ApiException(
                $this->getSerializer()->deserialize(
                    (string) $exception->getResponse()->getBody(),
                    Model\ErrorResponse::class,
                    'json'
                ),
                $exception
            );
        }
    }
}
