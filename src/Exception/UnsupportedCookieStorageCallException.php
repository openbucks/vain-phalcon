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
declare(strict_types = 1);

namespace Vain\Phalcon\Exception;

use Vain\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Http\Exception\CookieStorageException;

/**
 * Class UnsupportedCookieStorageCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedCookieStorageCallException extends CookieStorageException
{
    /**
     * UnsupportedHeaderStorageCallException constructor.
     *
     * @param CookieStorageInterface $cookieStorage
     * @param string                 $method
     */
    public function __construct(CookieStorageInterface $cookieStorage, $method)
    {
        parent::__construct(
            $cookieStorage,
            sprintf('Call to method %s on cookie storage object is not supported', $method)
        );
    }
}