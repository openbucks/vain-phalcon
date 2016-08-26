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
namespace Vain\Phalcon\Exception;

use Vain\Http\Cookie\VainCookieInterface;
use Vain\Http\Exception\CookieException;

/**
 * Class UnsupportedCookieCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedCookieCallException extends CookieException
{
    /**
     * UnsupportedCookieCallException constructor.
     *
     * @param VainCookieInterface $cookie
     * @param string              $method
     */
    public function __construct(VainCookieInterface $cookie, $method)
    {
        parent::__construct($cookie, sprintf('Call to method %s on cookie object is not supported', $method), 0, null);
    }
}