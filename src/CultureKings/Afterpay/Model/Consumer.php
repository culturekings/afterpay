<?php

namespace CultureKings\Afterpay\Model;

/**
 * Class Consumer
 * @package CultureKings\Afterpay\Model
 */
class Consumer
{
    /**
     * @var string
     */
    protected $phoneNumber;
    /**
     * @var string
     */
    protected $givenNames;
    /**
     * @var string
     */
    protected $surname;
    /**
     * @var string
     */
    protected $email;

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getGivenNames()
    {
        return $this->givenNames;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @param $givenNames
     * @return $this
     */
    public function setGivenNames($givenNames)
    {
        $this->givenNames = $givenNames;
        return $this;
    }

    /**
     * @param $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
