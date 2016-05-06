<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 11:57 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Event\Dispatcher\EventDispatcherInterface;

class UnsupportedResponsesException extends DispatcherException
{
    /**
     * UnsupportedResponsesException constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        parent::__construct($dispatcher, 'Response collecting is not supported in Phalcon bridge', 0, null);
    }
}