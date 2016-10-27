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
namespace Vain\Phalcon\Bootstrapper\Decorator\Event;

use Vain\Config\ConfigInterface;
use Vain\Event\Handler\Proxy\HandlerProxyInterface;
use Vain\Event\Manager\EventManagerInterface;
use Vain\Phalcon\Bootstrapper\BootstrapperInterface;
use Vain\Phalcon\Bootstrapper\Decorator\AbstractBootstrapperDecorator;
use Phalcon\Application as PhalconApplication;

/**
 * Class EventBootstrapperDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventBootstrapperDecorator extends AbstractBootstrapperDecorator
{
    private $eventManager;

    private $listenerProxy;

    private $config;

    /**
     * EventBootstrapperDecorator constructor.
     *
     * @param BootstrapperInterface  $bootstrapper
     * @param EventManagerInterface  $eventManager
     * @param HandlerProxyInterface $listenerProxy
     * @param ConfigInterface        $config
     */
    public function __construct(
        BootstrapperInterface $bootstrapper,
        EventManagerInterface $eventManager,
        HandlerProxyInterface $listenerProxy,
        ConfigInterface $config
    ) {
        $this->eventManager = $eventManager;
        $this->listenerProxy = $listenerProxy;
        $this->config = $config;
        parent::__construct($bootstrapper);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap(PhalconApplication $application)
    {
        parent::bootstrap($application);

        foreach ($this->config as $componentName => $componentData) {
            $this->eventManager->addHandler(sprintf('%s', $componentName), $this->listenerProxy);
        }
    }
}