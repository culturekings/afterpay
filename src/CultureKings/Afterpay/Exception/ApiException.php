<?php
namespace CultureKings\Afterpay\Exception;

use CultureKings\Afterpay\Model\ErrorResponse;
use \Exception;
use \RuntimeException;

class ApiException extends RuntimeException
{
    /**
     * @var ErrorResponse
     */
    protected $errorResponse;

    /**
     * ApiException constructor.
     * @param ErrorResponse $errorResponse
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
