<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Event\Listener;

use Vain\Event\EventInterface;
use Vain\Event\Listener\ListenerInterface;
use Vain\Phalcon\Exception\MissingMethodException;

/**
 * Class AbstractPhalconListener
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractPhalconListener implements ListenerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(EventInterface $event)
    {
        list ($component, $method) = explode(':', $event->getName());

        if (false === method_exists($this, $method)) {
            throw new MissingMethodException($this, $method);
        }
        
        call_user_func([$this, $method], $event);
    }
}