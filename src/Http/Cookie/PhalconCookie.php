<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:58 PM
 */

namespace Vain\Phalcon\Http\Cookie;

use Phalcon\Http\CookieInterface as PhalconCookieInterface;
use Vain\Http\Cookie\AbstractCookie;
use Vain\Phalcon\Exception\UnsupportedCookieCallException;

class PhalconCookie extends AbstractCookie implements PhalconCookieInterface
{
    /**
     * @inheritDoc
     */
    public function send()
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function useEncryption($useEncryption)
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function isUsingEncryption()
    {
        throw new UnsupportedCookieCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function setExpiration($expire)
    {
        return $this->setExpiryDate(new \DateTime($expire));
    }

    /**
     * @inheritDoc
     */
    public function getExpiration()
    {
        return $this->getExpiryDate()->getTimestamp();
    }

    /**
     * @inheritDoc
     */
    public function getSecure()
    {
        return $this->isSecure();
    }

    /**
     * @inheritDoc
     */
    public function getHttpOnly()
    {
        return $this->isHttpOnly();
    }

}