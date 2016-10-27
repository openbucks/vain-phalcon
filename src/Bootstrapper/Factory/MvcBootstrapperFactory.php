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
namespace Vain\Phalcon\Bootstrapper\Factory;

use Vain\Config\ConfigInterface;
use Vain\Event\Handler\Proxy\HandlerProxyInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Event\EventBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Router\RouterBootstrapperDecorator;

/**
 * Class MvcBootstrapperFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MvcBootstrapperFactory implements BootstrapperFactoryInterface
{
    private $routerConfig;

    private $eventConfig;

    private $handlerProxy;

    private $eventManager;

    /**
     * MvcBootstrapperFactory constructor.
     *
     * @param ConfigInterface       $routerConfig
     * @param ConfigInterface       $eventConfig
     * @param HandlerProxyInterface $handlerProxy
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        ConfigInterface $routerConfig,
        ConfigInterface $eventConfig,
        HandlerProxyInterface $handlerProxy,
        EventManagerInterface $eventManager
    ) {
        $this->routerConfig = $routerConfig;
        $this->eventConfig = $eventConfig;
        $this->handlerProxy = $handlerProxy;
        $this->eventManager = $eventManager;
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return
            new EventBootstrapperDecorator(
                new RouterBootstrapperDecorator(
                    new Bootstrapper(),
                    $this->routerConfig
                ),
                $this->eventManager,
                $this->handlerProxy,
                $this->eventConfig
            );
    }
}