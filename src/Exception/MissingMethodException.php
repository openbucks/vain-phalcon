<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 12:02 PM
 */

namespace Vain\Phalcon\Exception;

use Vain\Event\Dispatcher\EventDispatcherInterface;

class MissingMethodException extends DispatcherException
{
    /**
     * MissingMethodException constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param object $handler
     * @param string $method
     */
    public function __construct(EventDispatcherInterface $dispatcher, $handler, $method)
    {
        parent::__construct($dispatcher, sprintf('Handler %s does not have method %s', get_class($handler), $method), 0, null);
    }
}