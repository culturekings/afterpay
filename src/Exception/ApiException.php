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
     *
     * @param ErrorResponse    $errorResponse
     * @param Exception|string $message
     * @param int              $code
     * @param Exception|null   $previous
     */
    public function __construct(ErrorResponse $errorResponse, $message = "", $code = 0, Exception $previous = null)
    {
        $this->errorResponse = $errorResponse;

        //allow minimal construction
        if ($message instanceof Exception) {
            $previous = $message;
            $message = $previous->getMessage();
        }

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
