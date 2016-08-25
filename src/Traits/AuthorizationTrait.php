<?php
namespace CultureKings\Afterpay\Traits;

use CultureKings\Afterpay\Model\Authorization;

/**
 * Class AuthorizationTrait
 * @package CultureKings\Afterpay\Traits
 */
trait AuthorizationTrait
{
    /**
     * @var Authorization
     */
    private $authorization;

    /**
     * @return Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param Authorization $authorization
     */
    public function setAuthorization(Authorization $authorization)
    {
        $this->authorization = $authorization;
    }
}
