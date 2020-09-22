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

use Phalcon\Di\DiInterface as PhalconDiInterface;

/**
 * Class UnsupportedDiCallException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedDiCallException extends DiException
{
    /**
     * UnsupportedDiCallException constructor.
     *
     * @param PhalconDiInterface $di
     * @param string             $method
     */
    public function __construct(PhalconDiInterface $di, $method)
    {
        parent::__construct($di, sprintf('Call to method %s on di object is not supported', $method));
    }
}
