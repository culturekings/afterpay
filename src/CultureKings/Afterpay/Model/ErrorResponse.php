<?php

namespace CultureKings\Afterpay\Model;


/**
 * Class ErrorResponse
 * @package CultureKings\Afterpay\Model
 */
class ErrorResponse
{

    /**
     * @var string
     */
    protected $errorCode;
    /**
     * @var string
     */
    protected $errorId;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $httpStatusCode;

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorId()
    {
        return $this->errorId;
    }

    /**
     * @param string $errorId
     */
    public function setErrorId($errorId)
    {
        $this->errorId = $errorId;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @param string $httpStatusCode
     */
    public function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;

        return $this;
    }
}
