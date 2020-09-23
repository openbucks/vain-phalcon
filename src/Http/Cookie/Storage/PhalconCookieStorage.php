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
use Phalcon\Http\Cookie\CookieInterface as PhalconCookieInterface;
use Vain\Core\Http\Cookie\Storage\AbstractCookieStorage;
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
    public function useEncryption($useEncryption): PhalconCookiesInterface
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function isUsingEncryption(): bool
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function set(
        string $name,
        $value = null,
        int $expire = null,
        string $path = null,
        ?bool $secure = null,
        ?string $domain = null,
        ?bool $httpOnly = null,
        array $options = null
    ): PhalconCookiesInterface {
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
    public function get($name): PhalconCookieInterface
    {
        return $this->getCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function has($name): bool
    {
        return $this->hasCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function delete($name): bool
    {
        return $this->removeCookie($name);
    }

    /**
     * @inheritDoc
     */
    public function send(): bool
    {
        throw new UnsupportedCookieStorageCallException($this, __METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function reset(): PhalconCookiesInterface
    {
        return $this->resetCookies();
    }
}
