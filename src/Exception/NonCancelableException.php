<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 9:06 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Event\Exception\EventException;
use Vain\Phalcon\Event\PhalconEvent;

class NonCancelableException extends EventException
{
    /**
     * NonCanceableEventException constructor.
     * @param PhalconEvent $event
     */
    public function __construct(PhalconEvent $event)
    {
        parent::__construct($event, 'Trying to stop event propagation on non-cancelable event', 0, null);
    }
}