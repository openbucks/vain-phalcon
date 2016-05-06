<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/6/16
 * Time: 11:14 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Event\EventInterface;

class BadNameException extends DispatcherException
{
    /**
     * UnknownEventException constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param EventInterface $event
     * @param string $separator
     * @param int $count
     */
    public function __construct(EventDispatcherInterface $dispatcher, EventInterface $event, $separator, $count)
    {
        parent::__construct($dispatcher, sprintf('Event name %s should contain exactly %d characters %s', $event->getName(), $separator, $count - 1), 0, null);
    }
}