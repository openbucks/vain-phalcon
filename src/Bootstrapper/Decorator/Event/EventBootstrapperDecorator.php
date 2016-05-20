<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 10:01 AM
 */

namespace Vain\Phalcon\Bootstrapper\Decorator\Event;

use Vain\Event\Dispatcher\EventDispatcherInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Di\Injectable as PhalconDiInjectable;

class EventBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $eventDispatcher;

    /**
     * EventBootstrapperDecorator constructor.
     * @param BootstrapperInterface $bootstrapper
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(BootstrapperInterface $bootstrapper, EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconDiInjectable $application)
    {
        $application->getDI()->setShared('eventsManager', $this->eventDispatcher);

        return parent::bootstrap($application);
    }
}