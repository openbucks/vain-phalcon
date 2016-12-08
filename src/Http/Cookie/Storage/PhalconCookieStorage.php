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
namespace Vain\Phalcon\Http\Cookie\Storage;

use Phalcon\Http\Response\CookiesInterface as PhalconCookiesInterface;
use Vain\Http\Cookie\Storage\AbstractCookieStorage;
use Vain\Phalcon\Exception\UnsupportedCookieStorageCallException;

/**
 * Class PhalconCookieStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconCookieStorage extends AbstractCookieStorage implements PhalconCookiesInterface
{
    /**
     * @inheritDoc
     */
    public function useEncryption($useEncryption)
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function isUsingEncryption()
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function set(
        $name,
        $value = null,
        $expire = 0,
        $path = "/",
        $secure = null,
        $domain = null,
        $httpOnly = null
    ) {
        return $this->createCookie(
            $name,
            $value,
            (new \DateTime())->modify("+ {$expire}"),
            $path,
            $secure,
            $domain,
            $httpOnly
        );
    }

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        return $this->getCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->hasCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function delete($name)
    {
        return $this->removeCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function send()
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function reset()
    {
        return $this->resetCookies();
    }
}
