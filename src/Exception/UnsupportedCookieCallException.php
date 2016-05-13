<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/13/16
 * Time: 9:29 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Http\Cookie\VainCookieInterface;
use Vain\Http\Exception\CookieException;

class UnsupportedCookieCallException extends CookieException
{
    /**
     * UnsupportedCookieCallException constructor.
     * @param VainCookieInterface $cookie
     * @param string $method
     */
    public function __construct(VainCookieInterface $cookie, $method)
    {
        parent::__construct($cookie, sprintf('Call to method %s on cookie object is not supported', $method), 0, null);
    }
}