<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 9:27 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Event\Dispatcher\EventDispatcherInterface;

class InvalidHandlerException extends DispatcherException
{
    /**
     * InvalidHandlerException constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param string $handler
     */
    public function __construct(EventDispatcherInterface $dispatcher, $handler)
    {
        parent::__construct($dispatcher, sprintf('Handler must be object, %s given', gettext($handler)), 0, null);
    }
}