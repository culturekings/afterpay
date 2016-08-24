<?php
namespace CultureKings\Afterpay\Exception;

use CultureKings\Afterpay\Model\ErrorResponse;
use \Exception;
use \RuntimeException;

/**
 * Class ApiException
 * @package CultureKings\Afterpay\Exception
 */
class ApiException extends RuntimeException
{
    /**
     * @var ErrorResponse
     */
    protected $errorResponse;

    /**
     * ApiException constructor.
     * @param ErrorResponse  $errorResponse
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct(ErrorResponse $errorResponse, $message = "", $code = 0, Exception $previous = null)
    {
        $this->errorResponse = $errorResponse;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ErrorResponse
     */
    public function getErrorResponse()
    {
        return $this->errorResponse;
    }
}
