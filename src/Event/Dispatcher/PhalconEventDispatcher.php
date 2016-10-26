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
namespace Vain\Phalcon\Event\Dispatcher;

use Phalcon\Events\ManagerInterface as PhalconEventManagerInterface;
use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Event\EventInterface;
use Vain\Event\Listener\ListenerInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Event\Resolver\ResolverInterface;
use Vain\Phalcon\Event\PhalconEvent;
use Vain\Phalcon\Exception\UnsupportedPrioritiesException;
use Vain\Phalcon\Exception\UnsupportedResponsesException;

/**
 * Class PhalconEventDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEventDispatcher implements PhalconEventManagerInterface, EventDispatcherInterface, EventManagerInterface
{
    const NAME_SEPARATOR = ':';
    const NAME_COUNT = 2;

    private $listeners = [];

    private $resolver;

    /**
     * PhalconEventDispatcher constructor.
     *
     * @param ResolverInterface $resolver
     */
    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @param ListenerInterface[] $listeners
     * @param EventInterface      $event
     *
     */
    protected function propagateEvent($listeners, EventInterface $event)
    {
        foreach ($listeners as $listener) {
            $listener->handle($event);
        }
    }

    /**
     * @inheritDoc
     */
    public function dispatch(EventInterface $event) : EventDispatcherInterface
    {
        $eventGroup = $this->resolver->resolveGroup($event);
        $eventName = $event->getName();

        if (array_key_exists($eventGroup, $this->listeners)) {
            $this->propagateEvent($this->listeners[$eventGroup], $event);
        }

        if (array_key_exists($eventName, $this->listeners)) {
            $this->propagateEvent($this->listeners[$eventName], $event);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function attach($eventType, $handler, $priority = 100)
    {
        $this->listeners[$eventType][] = $handler;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addListener(string $eventName, ListenerInterface $listener) : EventManagerInterface
    {
        return $this->attach($eventName, $listener);
    }

    /**
     * @inheritDoc
     */
    public function removeListener(string $eventName, ListenerInterface $listener) : EventManagerInterface
    {
        return $this->detach($eventName, $listener);
    }

    /**
     * @inheritDoc
     */
    public function removeListeners(string $eventName) : EventManagerInterface
    {
        return $this->detachAll($eventName);
    }

    /**
     * @inheritDoc
     */
    public function detach($eventType, $handler)
    {
        if (false === array_key_exists($eventType, $this->listeners)) {
            return $this;
        }

        if (false === ($key = array_search($handler, $this->listeners[$eventType]))) {
            return $this;
        }

        unset($this->listeners[$eventType]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detachAll($type = null)
    {
        if (null === $type) {
            $this->listeners = [];

            return $this;
        }

        $this->listeners[$type] = [];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function fire($eventType, $source, $data = null)
    {
        return $this->dispatch(new PhalconEvent($eventType, $source, $data));
    }

    /**
     * @inheritDoc
     */
    public function getListeners($type)
    {
        if (false === array_key_exists($type, $this->listeners)) {
            return [];
        }

        return $this->listeners[$type];
    }

    /**
     * @param bool $enablePriorities
     *
     * @throws UnsupportedPrioritiesException
     */
    public function enablePriorities($enablePriorities)
    {
        throw new UnsupportedPrioritiesException($this);
    }

    /**
     * @return bool
     */
    public function arePrioritiesEnabled()
    {
        return false;
    }

    /**
     * @param bool $collect
     *
     * @throws UnsupportedResponsesException
     */
    public function collectResponses($collect)
    {
        throw new UnsupportedResponsesException($this);
    }

    /**
     * @return bool
     */
    public function isCollecting()
    {
        return false;
    }

    /**
     * @throws UnsupportedResponsesException
     */
    public function getResponses()
    {
        throw new UnsupportedResponsesException($this);
    }
}