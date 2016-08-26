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

use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Event\EventInterface;

/**
 * Class BadNameException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class BadNameException extends DispatcherException
{
    /**
     * UnknownEventException constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     * @param EventInterface           $event
     * @param string                   $separator
     * @param int                      $count
     */
    public function __construct(EventDispatcherInterface $dispatcher, EventInterface $event, $separator, $count)
    {
        parent::__construct(
            $dispatcher,
            sprintf(
                'Event name %s should contain exactly %d characters %s',
                $event->getName(),
                $separator,
                $count - 1
            ),
            0,
            null
        );
    }
}