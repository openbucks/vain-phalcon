<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/12/16
 * Time: 12:58 PM
 */

namespace Vain\Phalcon\Http\Cookie;

use Phalcon\Http\CookieInterface as PhalconCookieInterface;

class PhalconCookie implements PhalconCookieInterface
{
    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }

    /**
     * @inheritDoc
     */
    public function getValue($filters = null, $defaultValue = null)
    {
        // TODO: Implement getValue() method.
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        // TODO: Implement send() method.
    }

    /**
     * @inheritDoc
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritDoc
     */
    public function useEncryption($useEncryption)
    {
        // TODO: Implement useEncryption() method.
    }

    /**
     * @inheritDoc
     */
    public function isUsingEncryption()
    {
        // TODO: Implement isUsingEncryption() method.
    }

    /**
     * @inheritDoc
     */
    public function setExpiration($expire)
    {
        // TODO: Implement setExpiration() method.
    }

    /**
     * @inheritDoc
     */
    public function getExpiration()
    {
        // TODO: Implement getExpiration() method.
    }

    /**
     * @inheritDoc
     */
    public function setPath($path)
    {
        // TODO: Implement setPath() method.
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        // TODO: Implement getPath() method.
    }

    /**
     * @inheritDoc
     */
    public function setDomain($domain)
    {
        // TODO: Implement setDomain() method.
    }

    /**
     * @inheritDoc
     */
    public function getDomain()
    {
        // TODO: Implement getDomain() method.
    }

    /**
     * @inheritDoc
     */
    public function setSecure($secure)
    {
        // TODO: Implement setSecure() method.
    }

    /**
     * @inheritDoc
     */
    public function getSecure()
    {
        // TODO: Implement getSecure() method.
    }

    /**
     * @inheritDoc
     */
    public function setHttpOnly($httpOnly)
    {
        // TODO: Implement setHttpOnly() method.
    }

    /**
     * @inheritDoc
     */
    public function getHttpOnly()
    {
        // TODO: Implement getHttpOnly() method.
    }
}