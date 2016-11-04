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
use Vain\Event\Handler\EventHandlerInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Phalcon\Bootstrapper\Bootstrapper;
use Vain\Phalcon\Bootstrapper\Decorator\Event\EventBootstrapperDecorator;

/**
 * Class CliBootstrapperFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CliBootstrapperFactory implements BootstrapperFactoryInterface
{
    private $eventConfig;

    private $handlerProxy;

    private $eventManager;

    /**
     * MvcBootstrapperFactory constructor.
     *
     * @param ConfigInterface       $eventConfig
     * @param EventHandlerInterface $handlerProxy
     * @param EventManagerInterface $eventManager
     */
    public function __construct(
        ConfigInterface $eventConfig,
        EventHandlerInterface $handlerProxy,
        EventManagerInterface $eventManager
    ) {
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
                new Bootstrapper(),
                $this->eventManager,
                $this->handlerProxy,
                $this->eventConfig
            );
    }
}