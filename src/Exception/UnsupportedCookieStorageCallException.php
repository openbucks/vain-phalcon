<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 11:59 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Http\Exception\CookieStorageException;

class UnsupportedCookieStorageCallException extends CookieStorageException
{
    /**
     * UnsupportedHeaderStorageCallException constructor.
     * @param CookieStorageInterface $cookieStorage
     * @param string $method
     */
    public function __construct(CookieStorageInterface $cookieStorage, $method)
    {
        parent::__construct($cookieStorage, sprintf('Call to method %s on cookie storage object is not supported', $method), 0, null);
    }
}