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
use Vain\Event\Config\Factory\EventConfigFactoryInterface;
use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Event\EventInterface;
use Vain\Event\Handler\EventHandlerInterface;
use Vain\Event\Handler\Storage\EventHandlerStorageInterface;
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

    private $handlers = [];

    private $config;

    private $resolver;

    private $configFactory;

    private $handlerStorage;

    /**
     * PhalconEventDispatcher constructor.
     *
     * @param \ArrayAccess                 $config
     * @param EventConfigFactoryInterface  $configFactory
     * @param ResolverInterface            $resolver
     * @param EventHandlerStorageInterface $handlerStorage
     */
    public function __construct(
        \ArrayAccess $config,
        EventConfigFactoryInterface $configFactory,
        ResolverInterface $resolver,
        EventHandlerStorageInterface $handlerStorage
    ) {
        $this->config = $config;
        $this->configFactory = $configFactory;
        $this->resolver = $resolver;
        $this->handlerStorage = $handlerStorage;
    }

    /**
     * @param EventHandlerInterface[] $listeners
     * @param EventInterface          $event
     *
     */
    protected function propagateEvent($listeners, EventInterface $event)
    {
        foreach ($listeners as $listener) {
            $listener->handle(
                $event,
                $this->configFactory->createConfig(
                    $event->getName(),
                    ['alias' => get_class($listener), 'background' => false]
                )
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function dispatch(EventInterface $event) : EventDispatcherInterface
    {
        $eventGroup = $this->resolver->resolveGroup($event);
        $eventName = $event->getName();
        if (false === $this->config->offsetExists($eventGroup)) {
            return $this;
        }

        foreach ($this->config->offsetGet($eventGroup) as $listenerConfig) {
            $eventConfig = $this->configFactory->createConfig($eventName, $listenerConfig);
            $this->handlerStorage->getHandler($eventConfig)->handle($event, $eventConfig);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function attach($eventType, $handler, $priority = 100)
    {
        $this->handlers[$eventType][] = $handler;

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
        if (false === array_key_exists($eventType, $this->handlers)) {
            return $this;
        }

        if (false === ($key = array_search($handler, $this->handlers[$eventType]))) {
            return $this;
        }

        unset($this->handlers[$eventType]);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detachAll($type = null)
    {
        if (null === $type) {
            $this->handlers = [];

            return $this;
        }

        $this->handlers[$type] = [];

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
        if (false === array_key_exists($eventName, $this->handlers)) {
            return [];
        }

        return $this->handlers[$eventName];
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