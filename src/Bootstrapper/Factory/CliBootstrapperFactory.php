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
use Vain\Event\Listener\Proxy\ListenerProxyInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Container\ContainerBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Event\EventBootstrapperDecorator;
use Vain\Phalcon\Bootstrapper\Decorator\Extension\ExtensionBootstrapperDecorator;

/**
 * Class CliBootstrapperFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CliBootstrapperFactory implements BootstrapperFactoryInterface
{
    private $eventConfig;

    private $listenerProxy;

    private $eventManager;

    /**
     * MvcBootstrapperFactory constructor.
     *
     * @param ConfigInterface        $eventConfig
     * @param ListenerProxyInterface $listenerProxy
     * @param EventManagerInterface  $eventManager
     */
    public function __construct(
        ConfigInterface $eventConfig,
        ListenerProxyInterface $listenerProxy,
        EventManagerInterface $eventManager
    ) {
        $this->eventConfig = $eventConfig;
        $this->listenerProxy = $listenerProxy;
        $this->eventManager = $eventManager;
    }

    /**
     * @inheritDoc
     */
    public function createBootstrapper()
    {
        return new EventBootstrapperDecorator(
            new ContainerBootstrapperDecorator(
                new ExtensionBootstrapperDecorator(
                    new Bootstrapper()
                )
            ),
            $this->eventManager,
            $this->listenerProxy,
            $this->eventConfig
        );
    }
}