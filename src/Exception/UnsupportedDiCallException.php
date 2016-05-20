<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 11:40 AM
 */

namespace Vain\Phalcon\Exception;

use \Phalcon\DiInterface as PhalconDiInterface;

class UnsupportedDiCallException extends DiException
{
    /**
     * UnsupportedDiCallException constructor.
     * @param PhalconDiInterface $di
     * @param string $method
     */
    public function __construct(PhalconDiInterface $di, $method)
    {
        parent::__construct($di, sprintf('Call to method %s on di object is not supported', $method), 0, null);
    }
}