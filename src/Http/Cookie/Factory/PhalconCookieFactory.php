<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/18/16
 * Time: 12:40 PM
 */

namespace Vain\Phalcon\Http\Cookie\Factory;

use Vain\Http\Cookie\Factory\CookieFactoryInterface;
use Vain\Phalcon\Http\Cookie\PhalconCookie;

class PhalconCookieFactory implements CookieFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createCookie($name, $value, \DateTime $expiryDate = null, $path = '/', $domain = null, $secure = false, $httpOnly = false)
    {
        return new PhalconCookie($name, $value, $expiryDate, $path, $domain, $secure, $httpOnly);
    }
}