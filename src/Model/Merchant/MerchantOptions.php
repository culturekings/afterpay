<?php

namespace CultureKings\Afterpay\Model\Merchant;

/**
 * Class MerchantOptions
 * @package CultureKings\Afterpay\Model
 */
class MerchantOptions
{
    /**
     * @var string
     */
    protected $redirectConfirmUrl;
    /**
     * @var string
     */
    protected $redirectCancelUrl;

    /**
     * @return string
     */
    public function getRedirectConfirmUrl()
    {
        return $this->redirectConfirmUrl;
    }

    /**
     * @param string $redirectConfirmUrl
     * @return $this
     */
    public function setRedirectConfirmUrl($redirectConfirmUrl)
    {
        $this->redirectConfirmUrl = $redirectConfirmUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectCancelUrl()
    {
        return $this->redirectCancelUrl;
    }

    /**
     * @param string $redirectCancelUrl
     * @return $this
     */
    public function setRedirectCancelUrl($redirectCancelUrl)
    {
        $this->redirectCancelUrl = $redirectCancelUrl;

        return $this;
    }
}
