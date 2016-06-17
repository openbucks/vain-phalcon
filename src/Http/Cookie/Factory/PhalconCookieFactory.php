<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Http\Cookie\Factory;

use Vain\Http\Cookie\Factory\CookieFactoryInterface;
use Vain\Phalcon\Http\Cookie\PhalconCookie;

/**
 * Class PhalconCookieFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
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