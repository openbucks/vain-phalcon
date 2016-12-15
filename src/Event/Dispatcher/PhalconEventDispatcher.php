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
use Vain\Core\Event\Dispatcher\EventDispatcherInterface;
use Vain\Core\Event\EventInterface;
use Vain\Core\Event\Handler\EventHandlerInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Phalcon\Event\PhalconEvent;
use Vain\Phalcon\Exception\UnsupportedPrioritiesException;
use Vain\Phalcon\Exception\UnsupportedResponsesException;

/**
 * Class PhalconEventDispatcher
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconEventDispatcher implements
    PhalconEventManagerInterface,
    EventDispatcherInterface,
    EventManagerInterface
{
    private $eventDispatcher;

    /**
     * PhalconEventDispatcher constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function attach($eventType, $handler, $priority = 100)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addHandler(string $eventName, EventHandlerInterface $listener) : EventManagerInterface
    {
        return $this->attach($eventName, $listener);
    }

    /**
     * @inheritDoc
     */
    public function removeHandler(string $eventName, EventHandlerInterface $listener) : EventManagerInterface
    {
        return $this->detach($eventName, $listener);
    }

    /**
     * @inheritDoc
     */
    public function removeHandlers(string $eventName) : EventManagerInterface
    {
        return $this->detachAll($eventName);
    }

    /**
     * @inheritDoc
     */
    public function detach($eventType, $handler)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detachAll($type = null)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(EventInterface $event) : EventDispatcherInterface
    {
        $this->eventDispatcher->dispatch($event);

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
        return $this->getHandlers((string)$type);
    }

    /**
     * @inheritDoc
     */
    public function getHandlers($eventName) : array
    {
        return [];
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
